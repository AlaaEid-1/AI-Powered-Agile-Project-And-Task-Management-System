<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'user_id',
        'project_id',
        'sprint_id',
        'title',
        'description',
        'status',
        'priority',
        'due_date',
        'cover_image',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
    public function sprint()
    {
        return $this->belongsTo(Sprint::class);
    }

    public function activities()
    {
        return $this->hasMany(TaskActivity::class)->latest();
    }

    public function latestActivity()
    {
        return $this->hasOne(TaskActivity::class)->latestOfMany();
    }
}
