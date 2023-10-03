<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CommentPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function delete(User $user, Comment $comment): Response
    {
        if ($user->id == $comment->user_id) {
            return Response::allow();
        } else if ($user->role == 'admin' || $user->role == 'moderator') {
            return Response::allow();
        } else if ($comment->blog()->user_id == $user->id) {
            return Response::allow();
        } else {
            return Response::deny();
        }
    }
}
