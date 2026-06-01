<x-layouts.main-layout title="Edit Task">
    @include('dashboard.tasks._form', [
    'task' => $task,
    'action' => route('dashboard.tasks.update', $task->id),
    'method' => 'PUT',
    'title' => 'Edit Task',
    ])
</x-layouts.main-layout>
