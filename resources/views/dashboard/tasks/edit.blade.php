<x-layouts.main-layout title="Edit Task">
    @include('dashboard.tasks._form', [
        'task' => $task,
        'project' => $project,
        'action' => route('dashboard.projects.tasks.update', [$project, $task]),
        'method' => 'PUT',
        'title' => 'Edit Task',
    ])
</x-layouts.main-layout>
