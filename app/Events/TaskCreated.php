<?php

namespace App\Events;

use App\Models\Task;
use App\Models\User;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TaskCreated implements ShouldBroadcast
{
    use Dispatchable, SerializesModels;

    public Task $task;
    public ?User $actor;

    public function __construct(Task $task, ?User $actor = null)
    {
        $this->task = $task;
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
        return 'TaskCreated';
    }

    public function broadcastWith(): array
    {
        $actorName = $this->actor ? $this->actor->name : 'Someone';
        $projectTitle = $this->task->project ? $this->task->project->title : 'Project';

        return [
            'task_id' => $this->task->id,
            'title' => 'New Task Created',
            'task_title' => $this->task->title,
            'action_type' => 'created',
            'project_id' => $this->task->project_id,
            'project_title' => $projectTitle,
            'actor_id' => $this->actor ? $this->actor->id : null,
            'actor_name' => $actorName,
            'message' => "{$actorName} created task \"{$this->task->title}\" in project \"{$projectTitle}\"",
            'created_at' => now()->toIso8601String(),
        ];
    }
}
