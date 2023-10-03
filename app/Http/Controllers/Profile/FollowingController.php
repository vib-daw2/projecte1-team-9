<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\Follow;
use App\Models\User;

class FollowingController extends Controller
{
    public function render()
    {
        $users = Follow::where('follower_id', auth()->id())
            ->join('users', 'users.id', '=', 'follows.followee_id')
            ->select('users.*')
            ->paginate(10);

        foreach ($users as $user) {
            $user->followers = User::find($user->id)->followers()->count();
            $user->follows = User::find($user->id)->followees()->count();
        }

        return view('profiles/following', ['users' => $users]);
    }
}
