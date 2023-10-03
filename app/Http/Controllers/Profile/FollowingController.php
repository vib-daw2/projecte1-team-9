<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\Follow;

class FollowingController extends Controller
{
    public function render()
    {
        $users = Follow::where('follower_id', auth()->id())
            ->join('users', 'users.id', '=', 'follows.followee_id')
            ->select('users.*')
            ->paginate(10);

        return view('profiles/following', ['users' => $users]);
    }
}
