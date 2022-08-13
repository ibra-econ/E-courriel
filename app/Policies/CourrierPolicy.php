<?php

namespace App\Policies;

use App\Models\Courrier;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CourrierPolicy
{
    use HandlesAuthorization;

    public function before(User $user, $ability){
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Courrier  $courrier
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Courrier $courrier)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Courrier  $courrier
     * @return \Illuminate\Auth\Access\Response|bool
     */

    public function edit(User $user, Courrier $courrier)
    {
        return $user->isSuperuser();

        // return $user->id === $courrier->user_id;
    }

    public function update(User $user, Courrier $courrier)
    {
        return $user->isSuperuser();
        // dd($user->isSecretaire());
        // return $user->isSecretaire();
        // return $user->isSuperuser();
        // return $user->id == $courrier->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Courrier  $courrier
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Courrier $courrier)
    {

        return $user->isSuperuser();
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Courrier  $courrier
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Courrier $courrier)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Courrier  $courrier
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Courrier $courrier)
    {
        return $user->isAdmin();
    }
}
