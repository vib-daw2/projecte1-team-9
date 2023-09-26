<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * @param User $user
     * @return bool
     */
    public function viewAny(User $user): bool
    {
        return $user->role === 'admin';
    }

    /**
     * @param User $user
     * @param User $target
     * @return bool
     */
    public function delete(User $user, User $target): Response
    {
        if ($target->role === 'user' && ($user->role === 'moderator' || $user->role === 'admin')) {
            return Response::allow();
        } else if ($target->role === 'moderator' && $user->role === 'admin') {
            return Response::allow();
        } else {
            return Response::deny('You do not have permission to delete this user.');
        }
    }

    public function update(User $user, User $target): Response
    {
        if ($target->role === 'user' && ($user->role === 'moderator' || $user->role === 'admin')) {
            return Response::allow();
        } else if ($target->role === 'moderator' && $user->role === 'admin') {
            return Response::allow();
        } else if ($target->id === $user->id) {
            return Response::allow();
        } else {
            return Response::deny('You do not have permission to edit this user.');
        }
    }
}
