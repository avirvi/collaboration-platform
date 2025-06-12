<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title',
        'description',
    ];

    public function participation() {
        return $this->hasMany(Participation::class, 'project_id');
    }

    public function task() {
        return $this->hasMany(Task::class, 'project_id');
    }
}
