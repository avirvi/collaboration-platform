<?php

namespace App\Policies;

use App\Models\Participation;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use App\Models\Project;

class ParticipationPolicy
{
    public function before(User $user, string $ability)
    {
        if ($user->isAdmin()) {
            return true;
        }
    }

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Participation $participation): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, Project $project): bool
    {
        return $user->isModerator($project);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Participation $participation): bool
    {
        return $user->isModerator($participation->project);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Participation $participation): bool
    {
        return $user->isModerator($participation->project);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Participation $participation): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Participation $participation): bool
    {
        return false;
    }
}
