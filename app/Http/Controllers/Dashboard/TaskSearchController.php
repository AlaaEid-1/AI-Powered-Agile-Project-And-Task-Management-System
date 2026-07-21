<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TaskSearchController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $user = $request->user();
        $queryStr = trim($request->input('q', ''));

        if ($queryStr === '' || strlen($queryStr) < 2) {
            return response()->json([]);
        }

        // Fetch project IDs where user is owner or member
        $accessibleProjectIds = Project::query()
            ->where('user_id', $user->id)
            ->orWhereHas('users', function ($q) use ($user) {
                $q->where('users.id', $user->id);
            })
            ->pluck('id');

        $tasks = Task::with('project')
            ->whereIn('project_id', $accessibleProjectIds)
            ->where(function ($q) use ($queryStr) {
                $q->where('title', 'LIKE', "%{$queryStr}%")
                  ->orWhere('description', 'LIKE', "%{$queryStr}%");
            })
            ->latest()
            ->limit(8)
            ->get()
            ->map(function ($task) {
                return [
                    'id' => $task->id,
                    'title' => $task->title,
                    'status' => $task->status,
                    'project_id' => $task->project_id,
                    'project_title' => $task->project ? $task->project->title : 'Project',
                    'url' => route('dashboard.projects.tasks.show', ['project' => $task->project_id, 'task' => $task->id]),
                ];
            });

        return response()->json($tasks);
    }
}
