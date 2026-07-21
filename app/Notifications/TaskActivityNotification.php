<?php

namespace App\Notifications;

use App\Models\Task;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class TaskActivityNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public Task $task;
    public ?User $actor;
    public string $actionType;
    public string $title;
    public string $message;

    public function __construct(Task $task, string $actionType, string $title, string $message, ?User $actor = null)
    {
        $this->task = $task;
        $this->actionType = $actionType;
        $this->title = $title;
        $this->message = $message;
        $this->actor = $actor;
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'task_id' => $this->task->id,
            'task_title' => $this->task->title,
            'project_id' => $this->task->project_id,
            'project_title' => $this->task->project ? $this->task->project->title : 'Project',
            'actor_id' => $this->actor ? $this->actor->id : null,
            'actor_name' => $this->actor ? $this->actor->name : 'System',
            'action_type' => $this->actionType,
            'title' => $this->title,
            'message' => $this->message,
        ];
    }
}
