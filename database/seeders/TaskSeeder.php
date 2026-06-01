<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Task;

class TaskSeeder extends Seeder
{
    public function run(): void
    {
        Task::create([
            'user_id' => 1,
            'title' => 'First Task',
            'description' => 'This is the first task description',
            'status' => 'completed',
            'priority' => 'high',
            'due_date' => now(),
            'cover_image' => null,
        ]);
        Task::create([
            'user_id' => 1,
            'title' => 'Second Task',
            'description' => 'Another task example for testing',
            'status' => 'completed',
            'priority' => 'medium',
            'due_date' => now(),
            'cover_image' => null,
        ]);

        Task::create([
            'user_id' => 2,
            'title' => 'Design Landing Page',
            'description' => 'Create modern UI landing page',
            'status' => 'not_completed',
            'priority' => 'low',
            'due_date' => now(),
            'cover_image' => null,
        ]);
    }
}
