<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function render(string $id): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $posts_count = User::getPostsCount($id);
        $up_since = User::getUpSince($id);
        $likes = User::getTotalRecivedLikes($id);
        $user = DB::table('users')->where('id', $id)->first();

        return view('ProfileView',
            ['id' => $id,
            'posts_count' => $posts_count,
            'up_since' => $up_since,
            'likes' => $likes,
            'username' => $user->username,
            'email' => $user->email,
            ]);

    }
}
