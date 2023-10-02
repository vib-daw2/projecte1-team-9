<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MyLikesController extends Controller
{
    public function render()
    {
        $user = Auth::user();
        $profile_stats = $user->getProfileStats();

        $blogs = DB::table('blogs')
            ->select('blogs.*', 'users.username', 'users.id as owner_id', 'likes.type as liked')
            ->join('users', 'users.id', '=', 'blogs.user_id')
            ->where('blogs.status', '=', 'published')
            ->leftJoin('likes', function ($join) use ($user) { // Get if the user has liked or not the blog
                $join->on('likes.blog_id', '=', 'blogs.id')
                    ->where('likes.user_id', '=', $user->id);
            })
            ->where('likes.type', '=', 'like')
            ->where('likes.user_id', '=', $user->id)
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

        return view('profiles/my-likes',
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
