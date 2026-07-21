<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
   protected $fillable = [
    'user_id',
    'title',
    'description',
];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
public function sprints()
{
    return $this->hasMany(Sprint::class);
}

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'project_user')->withTimestamps();
    }

    public function isOwner(?User $user): bool
    {
        if (!$user) {
            return false;
        }
        return (int) $this->user_id === (int) $user->id;
    }

    public function hasMember(?User $user): bool
    {
        if (!$user) {
            return false;
        }
        if ($this->isOwner($user)) {
            return true;
        }
        return $this->users()->where('users.id', $user->id)->exists();
    }

    public function allMembers()
    {
        $members = $this->users;
        if ($this->user && !$members->contains('id', $this->user_id)) {
            $members->push($this->user);
        }
        return $members;
    }
}
