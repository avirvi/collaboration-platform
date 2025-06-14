<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isRegularUser()
    {
        return $this->role === 'user';
    }

    public function isModerator(Project $project)
    {
        return ('moderator' === (DB::table('participations')->where('project_id', '=', $project->id, 'and', 'user_id', '=', $this->id))->value('user_project_role'));
    }

    public function isParticipant(Project $project)
    {
        return ('participant' === (DB::table('participations')->where('project_id', '=', $project->id, 'and', 'user_id', '=', $this->id))->value('user_project_role'));
    }

    public function isResponsible(Task $task)
    {
        return ($this->id === $task->responsible_person);
    }
}
