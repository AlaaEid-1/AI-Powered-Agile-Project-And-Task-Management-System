<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sprint extends Model
{
    protected $fillable = [
        'project_id',
        'name',
        'start_date',
        'end_date',
    ];

    // العلاقة مع المشروع
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    // العلاقة مع التاسكات
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
