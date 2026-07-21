<?php

namespace App\Listeners;

use App\Events\TaskCreated;
use App\Events\TaskUpdated;
use App\Models\TaskActivity;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogTaskActivity implements ShouldQueue
{
    use InteractsWithQueue;
    public function handle(object $event): void
    {
        if ($event instanceof TaskCreated) {
            TaskActivity::create([
                'task_id' => $event->task->id,
                'user_id' => $event->actor ? $event->actor->id : null,
                'type' => 'created',
                'description' => 'created this task',
            ]);
        } elseif ($event instanceof TaskUpdated) {
            TaskActivity::create([
                'task_id' => $event->task->id,
                'user_id' => $event->actor ? $event->actor->id : null,
                'type' => $event->actionType,
                'description' => $event->description,
            ]);
        }
    }
}
