<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use stdClass;

class ProfilePostsController extends Controller
{
    public function render(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $user = Auth::user();
        $profile_stats = $user->getProfileStats();

        $blogs = DB::table('blogs')
            ->select('blogs.*', 'users.username', 'users.id as owner_id', 'likes.type as liked')
            ->join('users', 'users.id', '=', 'blogs.user_id')
            ->where('blogs.status', '=', 'published')
            ->leftJoin('likes', function ($join) use ($user) {
                $join->on('likes.blog_id', '=', 'blogs.id')
                    ->where('likes.user_id', '=', $user->id);
            })
            ->where('blogs.user_id', '=', $user->id)
            ->orderBy('views', 'desc')
            ->paginate(10);

        foreach ($blogs as $blog) {
            $query = DB::table('likes')
                ->select(DB::raw('SUM(CASE WHEN type = "like" THEN 1 ELSE 0 END) as likes'), DB::raw('SUM(CASE WHEN type = "dislike" THEN 1 ELSE 0 END) as dislikes'))
                ->where('blog_id', $blog->id)
                ->first();
            $blog->likes = $query->likes;
            $blog->dislikes = $query->dislikes;
        }

        return view('profiles/profile-posts',
            ['id' => $user->id,
                'posts_count' => $profile_stats->posts_count,
                'up_since' => $profile_stats->up_since,
                'likes' => $profile_stats->likes,
                'username' => $user->username,
                'email' => $user->email,
                'blogs' => $blogs,
            ]);

    }
}
