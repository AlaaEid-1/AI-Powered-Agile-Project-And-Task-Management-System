<?php

namespace App\Listeners;

use App\Events\TaskCreated;
use App\Events\TaskUpdated;
use App\Notifications\TaskActivityNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SendTaskActivityNotification implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(object $event): void
    {
        $task = $event->task;
        $actor = $event->actor;
        $project = $task->project;

        if (!$project) {
            return;
        }

        // Collect all members (owner + pivot members) except actor
        $recipients = $project->allMembers()->reject(function ($member) use ($actor) {
            return $actor && (int) $member->id === (int) $actor->id;
        });

        if ($recipients->isEmpty()) {
            return;
        }

        if ($event instanceof TaskCreated) {
            $title = 'New Task Created';
            $message = ($actor ? $actor->name : 'Someone') . " created task \"{$task->title}\" in project \"{$project->title}\"";
            $actionType = 'created';
        } elseif ($event instanceof TaskUpdated) {
            $actionType = $event->actionType;
            $title = match ($actionType) {
                'status_changed' => 'Task Status Changed',
                'sprint_moved' => 'Task Sprint Assignment Changed',
                default => 'Task Updated',
            };
            $message = ($actor ? $actor->name : 'Someone') . " {$event->description} on task \"{$task->title}\"";
        } else {
            return;
        }

        Notification::send($recipients, new TaskActivityNotification($task, $actionType, $title, $message, $actor));
    }
}
