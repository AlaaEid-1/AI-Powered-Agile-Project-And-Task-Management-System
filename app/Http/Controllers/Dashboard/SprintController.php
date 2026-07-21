<?php

namespace App\Http\Controllers\Dashboard;

use App\Events\TaskUpdated;
use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Sprint;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class SprintController extends Controller
{
    // عرض كل السبرنتات داخل مشروع
    public function index(Project $project)
    {
        Gate::authorize('view', $project);

        $sprints = Sprint::where('project_id', $project->id)
            ->with('tasks')
            ->latest()
            ->get();

        return view('dashboard.sprints.index', compact('project', 'sprints'));
    }

    // صفحة إنشاء Sprint
    public function create(Project $project)
    {
        Gate::authorize('view', $project);

        return view('dashboard.sprints.create', compact('project'));
    }

    // حفظ Sprint
    public function store(Request $request, Project $project)
    {
        Gate::authorize('view', $project);

        $request->validate([
            'name' => 'required|string|max:255',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
        ]);

        Sprint::create([
            'project_id' => $project->id,
            'name' => $request->name,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        return redirect()
            ->route('dashboard.projects.sprints.index', $project)
            ->with('success', 'Sprint created successfully');
    }

    public function show(Project $project, Sprint $sprint)
    {
        Gate::authorize('view', $sprint);

        $tasks = [
            'todo' => $sprint->tasks()->where('status', 'todo')->get(),

            'in_progress' => $sprint->tasks()
                ->where('status', 'in_progress')
                ->get(),

            'done' => $sprint->tasks()
                ->where('status', 'done')
                ->get(),
        ];

        $backlog = $project->tasks()
            ->whereNull('sprint_id')
            ->latest()
            ->get();

        return view('dashboard.sprints.show', [
            'project' => $project,
            'sprint' => $sprint,
            'tasks' => $tasks,
            'backlog' => $backlog,
        ]);
    }

    public function attachTask(Project $project, Sprint $sprint, Task $task)
    {
        Gate::authorize('update', $sprint);

        $task->update([
            'sprint_id' => $sprint->id
        ]);

        try {
            TaskUpdated::dispatch($task, 'sprint_moved', "added task to sprint \"{$sprint->name}\"", auth()->user());
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::error('TaskUpdated attach task broadcast failed: ' . $e->getMessage());
        }

        return back()->with('success', 'Task added to sprint');
    }

    public function detachTask(Project $project, Sprint $sprint, Task $task)
    {
        Gate::authorize('update', $sprint);

        $task->update([
            'sprint_id' => null
        ]);

        try {
            TaskUpdated::dispatch($task, 'sprint_moved', "removed task from sprint into Product Backlog", auth()->user());
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::error('TaskUpdated detach task broadcast failed: ' . $e->getMessage());
        }

        return back()->with('success', 'Task removed from sprint');
    }
}
