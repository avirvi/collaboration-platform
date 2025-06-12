<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskStatus extends Model
{
    protected $fillable = [
        'status',
    ];

    public function taskStatus() {
        return $this->hasMany(Task::class, 'status_id');
    }
}
