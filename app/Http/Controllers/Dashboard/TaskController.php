<?php

namespace App\Http\Controllers\Dashboard;

use App\Actions\FileUpload;
use App\Events\TaskCreated;
use App\Events\TaskUpdated;
use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;
use App\Models\Project;
use App\Models\Sprint;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class TaskController extends Controller
{
    public function index(Request $request, Project $project)
    {
        Gate::authorize('view', $project);

        $status = $request->query('status', 'todo');
        $statusList = ['todo', 'in_progress', 'done'];

        $status_options = array_map(function ($value) use ($project) {
            return [
                'label' => ucfirst(str_replace('_', ' ', $value)),
                'value' => $value,
                'count' => Task::where('status', $value)
                    ->where('project_id', $project->id)
                    ->count(),
            ];
        }, $statusList);

        $tasks = Task::query()
            ->where('status', $status)
            ->where('project_id', $project->id)
            ->latest()
            ->get();

        return view('dashboard.tasks.index', compact(
            'tasks',
            'status',
            'status_options',
            'project'
        ));
    }

    public function create(Project $project)
    {
        Gate::authorize('view', $project);

        return view('dashboard.tasks.create', [
            'task' => new Task(),
            'project' => $project,
        ]);
    }

    public function store(TaskRequest $request, FileUpload $fileUpload, Project $project)
    {
        Gate::authorize('view', $project);

        $clean = $request->validated();

        $task = Task::create(array_merge($clean, [
            'user_id' => auth()->id(),
            'project_id' => $project->id,
            'sprint_id' => $request->input('sprint_id'),
            'cover_image' => $fileUpload->handle(key: 'cover', path: 'tasks'),
        ]));

        try {
            TaskCreated::dispatch($task, auth()->user());
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::error('TaskCreated event broadcast failed: ' . $e->getMessage());
        }

        return redirect()->route('dashboard.projects.tasks.index', $project);
    }

    public function show(Project $project, Task $task)
    {
        Gate::authorize('view', $task);

        $task->load(['activities.user', 'user', 'sprint']);

        return view('dashboard.tasks.show', [
            'task' => $task,
            'project' => $project,
        ]);
    }

    public function edit(Project $project, Task $task)
    {
        Gate::authorize('update', $task);

        return view('dashboard.tasks.edit', [
            'task' => $task,
            'project' => $project,
        ]);
    }

    public function update(TaskRequest $request, FileUpload $fileUpload, Project $project, Task $task)
    {
        Gate::authorize('update', $task);

        $clean = $request->validated();
        $coverImage = $fileUpload->handle(key: 'cover', path: 'tasks');

        $oldStatus = $task->status;
        $oldSprintId = $task->sprint_id;

        $data = array_merge($clean, [
            'cover_image' => $coverImage ?: $task->cover_image,
        ]);

        $previousCover = $task->cover_image;
        $task->update($data);

        if ($coverImage && $previousCover && $previousCover !== $coverImage) {
            Storage::disk('public')->delete($previousCover);
        }

        // Dispatch appropriate update events safely
        try {
            if ($oldStatus !== $task->status) {
                $statusLabel = ucfirst(str_replace('_', ' ', $task->status));
                TaskUpdated::dispatch($task, 'status_changed', "changed status to {$statusLabel}", auth()->user());
            } elseif ($oldSprintId !== $task->sprint_id) {
                $sprintName = $task->sprint ? $task->sprint->name : 'Product Backlog';
                TaskUpdated::dispatch($task, 'sprint_moved', "moved task to {$sprintName}", auth()->user());
            } else {
                TaskUpdated::dispatch($task, 'edited', "updated task details", auth()->user());
            }
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::error('TaskUpdated event broadcast failed: ' . $e->getMessage());
        }

        return redirect()
            ->route('dashboard.projects.tasks.index', $project)
            ->with('status', 'Task updated!');
    }

    public function destroy(Project $project, Task $task)
    {
        Gate::authorize('delete', $task);

        $task->delete();

        if ($task->cover_image) {
            Storage::disk('public')->delete($task->cover_image);
        }

        return redirect()
            ->route('dashboard.projects.tasks.index', $project)
            ->with('status', 'Task deleted!');
    }

    public function updateStatus(Request $request, Task $task)
    {
        Gate::authorize('update', $task);

        $request->validate([
            'status' => 'nullable|in:todo,in_progress,done',
            'sprint_id' => 'nullable|exists:sprints,id',
        ]);

        $oldStatus = $task->status;
        $oldSprintId = $task->sprint_id;

        $data = [];
        if ($request->has('status')) {
            $data['status'] = $request->status;
        }
        if (array_key_exists('sprint_id', $request->all())) {
            $data['sprint_id'] = $request->sprint_id;
        }

        $task->update($data);
        $task->refresh();

        try {
            if (array_key_exists('sprint_id', $request->all()) && (string) $oldSprintId !== (string) $task->sprint_id) {
                $targetSprint = $task->sprint ? $task->sprint->name : 'Product Backlog';
                TaskUpdated::dispatch($task, 'sprint_moved', "moved task to {$targetSprint}", auth()->user());
            } elseif ($oldStatus !== $task->status) {
                $statusLabel = ucfirst(str_replace('_', ' ', $task->status));
                TaskUpdated::dispatch($task, 'status_changed', "changed status to {$statusLabel}", auth()->user());
            }
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::error('TaskUpdated status event broadcast failed: ' . $e->getMessage());
        }

        return response()->json([
            'message' => 'updated',
            'task_id' => $task->id,
            'status' => $task->status,
            'sprint_id' => $task->sprint_id,
        ]);
    }
}
