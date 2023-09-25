<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MyProfileController extends Controller
{
    public function render()
    {
        $user_id = Auth::id();

        $posts_count = User::getPostsCount($user_id);
        $up_since = User::getUpSince($user_id);
        $likes = User::getTotalRecivedLikes($user_id);

        $user = DB::table('users')->where('id', $user_id)->first();

        return view('ProfileView',
            ['id' => $user_id,
                'posts_count' => $posts_count,
                'up_since' => $up_since,
                'likes' => $likes,
                'username' => $user->username,
                'email' => $user->email,
            ]);
    }
}
