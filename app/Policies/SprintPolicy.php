<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\Sprint;
use App\Models\User;

class SprintPolicy
{
    public function view(User $user, Sprint $sprint): bool
    {
        return $sprint->project && $sprint->project->hasMember($user);
    }

    public function create(User $user, Project $project): bool
    {
        return $project->hasMember($user);
    }

    public function update(User $user, Sprint $sprint): bool
    {
        return $sprint->project && $sprint->project->hasMember($user);
    }

    public function delete(User $user, Sprint $sprint): bool
    {
        return $sprint->project && $sprint->project->hasMember($user);
    }
}
