<x-layouts.main-layout title="Create Task">
        @include('dashboard.tasks._form', [
                'task' => $task,
                'project' => $project,
                'title' => 'Create Task'
        ])
</x-layouts.main-layout>
