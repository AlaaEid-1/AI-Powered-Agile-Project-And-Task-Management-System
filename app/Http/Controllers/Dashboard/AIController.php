<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Sprint;
use App\Models\Task;
use App\Services\GeminiService;
use Illuminate\Http\Request;
use Exception;

class AIController extends Controller
{
    protected $geminiService;

    public function __construct(GeminiService $geminiService)
    {
        $this->geminiService = $geminiService;
    }

    public function generate(Request $request, Project $project)
    {
        $request->validate([
            'prompt' => 'required|string|max:10000',
        ]);

        try {
            $data = $this->geminiService->generateSprints($request->prompt);

            if (!is_array($data)) {
                throw new Exception("Invalid JSON structure returned.");
            }

            // Create Backlog Tasks
            if (!empty($data['backlog']) && is_array($data['backlog'])) {
                foreach ($data['backlog'] as $backlogItem) {
                    Task::create([
                        'user_id' => auth()->id(),
                        'project_id' => $project->id,
                        'title' => $backlogItem['title'] ?? 'Untitled Backlog',
                        'description' => $backlogItem['description'] ?? '',
                        'status' => 'todo',
                        'priority' => 'low',
                    ]);
                }
            }

            // Create Sprints and Tasks
            if (!empty($data['sprints']) && is_array($data['sprints'])) {
                foreach ($data['sprints'] as $sprintData) {
                    $sprint = Sprint::create([
                        'project_id' => $project->id,
                        'name' => $sprintData['title'] ?? 'Untitled Sprint',
                        'start_date' => now(),
                        'end_date' => now()->addWeeks(2),
                    ]);

                    if (!empty($sprintData['tasks']) && is_array($sprintData['tasks'])) {
                        foreach ($sprintData['tasks'] as $taskData) {
                            $priority = in_array(strtolower($taskData['priority'] ?? ''), ['low', 'medium', 'high']) ? strtolower($taskData['priority']) : 'low';
                            $status = in_array(strtolower($taskData['status'] ?? ''), ['todo', 'in_progress', 'done']) ? strtolower($taskData['status']) : 'todo';

                            Task::create([
                                'user_id' => auth()->id(),
                                'project_id' => $project->id,
                                'sprint_id' => $sprint->id,
                                'title' => $taskData['title'] ?? 'Untitled Task',
                                'description' => $taskData['description'] ?? '',
                                'priority' => $priority,
                                'status' => $status,
                            ]);
                        }
                    }
                }
            }

            return redirect()->route('dashboard.projects.show', $project)
                ->with('info', 'AI has successfully generated your sprints and tasks!');

        } catch (Exception $e) {
            return back()->withErrors(['ai_error' => $e->getMessage()])->withInput();
        }
    }
}
