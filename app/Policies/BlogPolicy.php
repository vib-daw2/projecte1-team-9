<?php

namespace App\Policies;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class BlogPolicy
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
     * @param Blog $blog
     * @return Response
     */
    public function view(User $user, Blog $blog): Response
    {
        // If published, show to everyone
        if ($blog->status === 'published') {
            return Response::allow();
        }

        // Handle if the user is the owner of the blog or admin
        if ($user && ($user->id === $blog->user_id || $user->role === 'admin')) {
            return Response::allow();
        }

        return Response::deny('You must be logged in to view this blog');
    }

    /**
     * @param User|null $user
     * @param Blog $blog
     * @return Response
     */
    public function update(?User $user, Blog $blog): Response
    {
        if ($user && ($user->id === $blog->user_id)) {
            return Response::allow();
        }

        return Response::deny('You must be logged in to update a blog');
    }
}
