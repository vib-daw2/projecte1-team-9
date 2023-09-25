<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MyProfileController extends Controller
{
    public function render()
    {
        $user_id = Auth::id();

        $posts_count = DB::table('blogs')->where('user_id', $user_id)->where('status', 'published')->count();
        $up_since = DB::table('users')->where('id', $user_id)->value('created_at');

        $likes = DB::table('likes')
            ->where('blog_id', DB::table('blogs')
                ->where('user_id', $user_id)->value('id'))
            ->where('liked', true)->count(); // Calculate the number of likes for the user's posts

        $user = DB::table('users')->where('id', $user_id)->first();

        return view('MyProfile', [
            'posts_count' => $posts_count,
            'up_since' => $up_since,
            'likes' => $likes,
            'email' => $user->email,
            'username' => $user->username,
        ]);
    }
}
