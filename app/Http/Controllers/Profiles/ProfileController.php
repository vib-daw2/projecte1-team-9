<?php

namespace App\Http\Controllers\Profiles;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function render(Request $request, string $id): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $user = User::find($id);
        if (!$user) {
            abort(404);
        }
        $profile_stats = $user->getProfileStats();

        $blogs = DB::table('blogs')
            ->select('blogs.*', 'users.username', 'users.id as owner_id')
            ->join('users', 'users.id', '=', 'blogs.user_id')
            ->where('blogs.user_id', '=', $id)
            ->where('blogs.status', '=', 'published')
            ->orderBy('views', 'desc')
            ->paginate(10);

        return view('profiles/profile',
            ['id' => $id,
            'posts_count' => $profile_stats->posts_count,
            'up_since' => $profile_stats->up_since,
            'likes' => $profile_stats->likes,
            'username' => $user->username,
            'email' => $user->email,
            'blogs' => $blogs,
            ]);

    }
}
