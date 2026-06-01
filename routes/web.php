<?php

use App\Http\Controllers\Dashboard\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::group([
    'as' => 'dashboard.',
    'prefix' => 'dashboard',
], function () {

    Route::resource('tasks', TaskController::class);
});
