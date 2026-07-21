<?php

use App\Models\Project;
use App\Models\User;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('project.{projectId}', function (User $user, $projectId) {
    $project = Project::find($projectId);
    if (!$project) {
        return false;
    }

    return $project->hasMember($user);
});

