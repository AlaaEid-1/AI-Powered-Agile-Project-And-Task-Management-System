<?php

use App\Http\Controllers\Dashboard\NotificationController;
use App\Http\Controllers\Dashboard\ProjectController;
use App\Http\Controllers\Dashboard\SprintController;
use App\Http\Controllers\Dashboard\TaskController;
use App\Http\Controllers\Dashboard\TaskSearchController;
use App\Http\Middleware\PreventBackHistory;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::group([
    'as' => 'dashboard.',
    'prefix' => 'dashboard',
    'middleware' => ['auth', PreventBackHistory::class],
], function () {

    Route::get('search/tasks', TaskSearchController::class)->name('search.tasks');

    Route::resource('projects', ProjectController::class);

    Route::prefix('projects/{project}')->name('projects.')->group(function () {

        // MEMBERS MANAGEMENT
        Route::post('members', [ProjectController::class, 'addMember'])->name('members.add');
        Route::delete('members/{user}', [ProjectController::class, 'removeMember'])->name('members.remove');

        // TASKS
        Route::get('tasks', [TaskController::class, 'index'])->name('tasks.index');
        Route::get('tasks/create', [TaskController::class, 'create'])->name('tasks.create');
        Route::post('tasks', [TaskController::class, 'store'])->name('tasks.store');
        Route::get('tasks/{task}', [TaskController::class, 'show'])->name('tasks.show');
        Route::get('tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
        Route::put('tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
        Route::delete('tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');

        // AI SPRINT PLANNER
        Route::post('ai/generate', [\App\Http\Controllers\Dashboard\AIController::class, 'generate'])->name('ai.generate');

        // SPRINTS
        Route::get('sprints', [SprintController::class, 'index'])->name('sprints.index');
        Route::get('sprints/create', [SprintController::class, 'create'])->name('sprints.create');
        Route::post('sprints', [SprintController::class, 'store'])->name('sprints.store');
        Route::get('sprints/{sprint}', [SprintController::class, 'show'])->name('sprints.show');

        // Attach / Detach
        Route::post('sprints/{sprint}/tasks/{task}/attach', [SprintController::class, 'attachTask'])
            ->name('sprints.tasks.attach');

        Route::post('sprints/{sprint}/tasks/{task}/detach', [SprintController::class, 'detachTask'])
            ->name('sprints.tasks.detach');
    });

    // Drag & Drop Status
    Route::post('tasks/{task}/status', [TaskController::class, 'updateStatus'])
        ->name('tasks.status');

    // NOTIFICATIONS
    Route::post('notifications/{id}/read', [NotificationController::class, 'markAsRead'])
        ->name('notifications.read');
    Route::post('notifications/read-all', [NotificationController::class, 'markAllAsRead'])
        ->name('notifications.readAll');

});
