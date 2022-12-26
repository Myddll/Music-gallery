<?php

namespace App\Policies;

use App\Models\Artist;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArtistPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Artist  $artist
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Artist $artist) : bool
    {
        return $user->id === $artist->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Artist  $artist
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Artist $artist) : bool
    {
        return $user->id === $artist->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Artist  $artist
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Artist $artist) : bool
    {
        return $user->id === $artist->user_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Artist  $artist
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Artist $artist) : bool
    {
        return $user->id === $artist->user_id;
    }
}
