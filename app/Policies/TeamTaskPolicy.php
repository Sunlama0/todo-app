<?php

namespace App\Policies;

use App\Models\TeamTask;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TeamTaskPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any team tasks.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return true; // ou toute autre logique nécessaire
    }

    /**
     * Determine whether the user can view the team task.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TeamTask  $teamTask
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, TeamTask $teamTask)
    {
        return $user->teams->contains($teamTask->team_id);
    }

    /**
     * Determine whether the user can create team tasks.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return true; // ou toute autre logique nécessaire
    }

    /**
     * Determine whether the user can update the team task.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TeamTask  $teamTask
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, TeamTask $teamTask)
    {
        return $user->teams->contains($teamTask->team_id);
    }

    /**
     * Determine whether the user can delete the team task.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TeamTask  $teamTask
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, TeamTask $teamTask)
    {
        return $user->teams->contains($teamTask->team_id);
    }
}
