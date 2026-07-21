<?php

namespace App\Events;

use App\Models\Task;
use App\Models\User;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TaskUpdated implements ShouldBroadcast
{
    use Dispatchable, SerializesModels;

    public Task $task;
    public ?User $actor;
    public string $actionType; // updated, status_changed, sprint_moved
    public string $description;

    public function __construct(Task $task, string $actionType, string $description, ?User $actor = null)
    {
        $this->task = $task;
        $this->actionType = $actionType;
        $this->description = $description;
        $this->actor = $actor ?? auth()->user();
    }

    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('project.' . $this->task->project_id),
        ];
    }

    public function broadcastAs(): string
    {
        return 'TaskUpdated';
    }

    public function broadcastWith(): array
    {
        $actorName = $this->actor ? $this->actor->name : 'Someone';
        $projectTitle = $this->task->project ? $this->task->project->title : 'Project';
        $eventTitle = match ($this->actionType) {
            'status_changed' => 'Task Status Changed',
            'sprint_moved' => 'Task Sprint Assignment Changed',
            default => 'Task Updated',
        };

        return [
            'task_id' => $this->task->id,
            'title' => $eventTitle,
            'task_title' => $this->task->title,
            'action_type' => $this->actionType,
            'project_id' => $this->task->project_id,
            'project_title' => $projectTitle,
            'actor_id' => $this->actor ? $this->actor->id : null,
            'actor_name' => $actorName,
            'message' => "{$actorName} {$this->description} on task \"{$this->task->title}\"",
            'created_at' => now()->toIso8601String(),
        ];
    }
}
