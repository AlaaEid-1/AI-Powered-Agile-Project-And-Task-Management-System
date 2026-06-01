<?php

namespace App\Http\Controllers\Dashboard;

use App\Actions\FileUpload;
use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status', 'completed');

        $status_options = array_map(function ($value) {
            return [
                'label' => ucfirst(str_replace('_', ' ', $value)),
                'value' => $value,
                'count' => Task::where('status', $value)
                    ->where('user_id', 1)
                    ->count(),
            ];
        }, [
            'completed',
            'not_completed',
        ]);

        $tasks = Task::query()
            ->where('status', '=', $status)
            ->where('user_id', '=', 1)
            ->latest()
            ->get();

        return view('dashboard.tasks.index', [
            'tasks' => $tasks,
            'status' => $status,
            'status_options' => $status_options,
        ]);
    }

    public function create()
    {
        return view('dashboard.tasks.create', [
            'task' => new Task(),
        ]);
    }

    public function store(TaskRequest $request, FileUpload $fileUpload)
    {
        $clean = $request->validated();

        $data = array_merge($clean, [
            'user_id' => 1, // TODO: auth()->id()
            'cover_image' => $fileUpload->handle(key: 'cover', path: 'tasks'),
        ]);

        $task = Task::create($data);

        return redirect()
            ->route('dashboard.tasks.index')
            ->with('status', 'Task created!');
    }
    public function show(int $id)
    {
        $task = Task::findOrFail($id);

        return view('dashboard.tasks.show', [
            'task' => $task,
        ]);
    }

    public function edit(int $id)
    {
        $task = Task::findOrFail($id);

        return view('dashboard.tasks.edit', [
            'task' => $task,
        ]);
    }

    public function update(TaskRequest $request, FileUpload $fileUpload, string $id)
    {
        $task = Task::findOrFail($id);

        $clean = $request->validated();
        $data = \array_merge($clean, [
            'cover_image' => $fileUpload->handle(key: 'cover', path: 'tasks')
        ]);

        $task->update($data);

        $previous = $task->getPrevious();
        $prev_cover_image = $previous['cover_image'] ?? null;
        if ($prev_cover_image !== $task->cover_image) {
            Storage::disk('public')->delete($previous['cover_image']);
        }

        return redirect()
            ->route('dashboard.tasks.index')
            ->with('status', 'Task updated!');
    }

    public function destroy(string $id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        if ($task->cover_image) {
            Storage::disk('public')->delete($task->cover_image);
        }

        return redirect()
            ->route('dashboard.tasks.index')
            ->with('status', 'Task deleted!');
    }
}
