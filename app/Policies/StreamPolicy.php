<?php

namespace App\Policies;

use App\Models\Stream;
use App\Models\User;

class StreamPolicy
{
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
    public function view(User $user, Stream $stream): bool
    {
        return $user->id === $stream->user_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Stream $stream)
    {
        return $user->id === $stream->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Stream $stream)
    {
        return $user->id === $stream->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Stream $stream): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Stream $stream): bool
    {
        return false;
    }
}
