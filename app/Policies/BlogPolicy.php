<?php

namespace App\Policies;

use App\Models\Blog;
use App\Models\User;

class BlogPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function view(User $user, Blog $blog): bool
    {
        if ($blog->status === 'published') {
            return true;
        }

        if ($user->id === $blog->user_id || $user->role === 'admin') {
            return true;
        }

        return false;
    }
}
