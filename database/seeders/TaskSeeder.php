<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskSeeder extends Seeder
{
    public function run(): void
    {
        Task::create([
            'user_id' =>  Auth::user(),
            'title' => 'First Task',
            'description' => 'This is the first task description',
            'status' => 'completed',
            'priority' => 'high',
            'due_date' => now(),
            'cover_image' => null,
        ]);
        Task::create([
            'user_id' =>  Auth::user(),
            'title' => 'Second Task',
            'description' => 'Another task example for testing',
            'status' => 'completed',
            'priority' => 'medium',
            'due_date' => now(),
            'cover_image' => null,
        ]);

        Task::create([
            'user_id' =>  Auth::user(),
            'title' => 'Design Landing Page',
            'description' => 'Create modern UI landing page',
            'status' => 'not_completed',
            'priority' => 'low',
            'due_date' => now(),
            'cover_image' => null,
        ]);
    }
}
