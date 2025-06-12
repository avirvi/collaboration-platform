<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'title',
        'deadline',
        'status_id',
        'responsible_person',
        'project_id',
    ];

    public function taskStatus() {
        return $this->belongsTo(TaskStatus::class, 'status_id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'responsible_person');
    }

    public function project() {
        return $this->belongsTo(Project::class, 'project_id');
    }
}
