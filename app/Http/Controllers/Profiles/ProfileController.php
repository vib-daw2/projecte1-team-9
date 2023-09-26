<?php

namespace App\Http\Controllers\Profiles;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function render(Request $request, string $id): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $user = User::find($id);
        if (!$user) {
            abort(404);
        }
        $profile_stats = $user->getProfileStats();


        if (Auth::check()) {
            $blogs = DB::table('blogs')
                ->select('blogs.*', 'users.username', 'users.id as owner_id', 'likes.type as liked')
                ->join('users', 'users.id', '=', 'blogs.user_id')
                ->where('blogs.status', '=', 'published')
                ->where('blogs.user_id', '=', $id)
                ->leftJoin('likes', function ($join) {
                    $join->on('likes.blog_id', '=', 'blogs.id')
                        ->where('likes.user_id', '=', Auth::id());
                })
                ->orderBy('views', 'desc')
                ->paginate(10);
        } else {
            $blogs = DB::table('blogs')
                ->select('blogs.*', 'users.username', 'users.id as owner_id', 'likes.type as liked')
                ->join('users', 'users.id', '=', 'blogs.user_id')
                ->where('blogs.status', '=', 'published')
                ->where('blogs.user_id', '=', $id)
                ->leftJoin('likes', function ($join) {
                    $join->on('likes.blog_id', '=', 'blogs.id')
                        ->where('likes.user_id', '=', 0);
                })
                ->orderBy('views', 'desc')
                ->paginate(10);
        }

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
