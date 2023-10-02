<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function render(Request $request)
    {
        if (Auth::check()) {
            $blogs = DB::table('blogs')
                ->select('blogs.*', 'users.username', 'users.id as owner_id', 'likes.type as liked')
                ->join('users', 'users.id', '=', 'blogs.user_id')
                ->where('blogs.status', '=', 'published')
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
                ->leftJoin('likes', function ($join) {
                    $join->on('likes.blog_id', '=', 'blogs.id')
                        ->where('likes.user_id', '=', 0);
                })
                ->orderBy('views', 'desc')
                ->paginate(10);
        }
        foreach ($blogs as $blog) {
            $query = DB::table('likes')
                ->select(DB::raw('SUM(CASE WHEN type = "like" THEN 1 ELSE 0 END) as likes'), DB::raw('SUM(CASE WHEN type = "dislike" THEN 1 ELSE 0 END) as dislikes'))
                ->where('blog_id', $blog->id)
                ->first();
            $blog->likes = $query->likes;
            $blog->dislikes = $query->dislikes;
        }

        $title = $request->session()->get('title');
        $success = $request->session()->get('success');
        $message = $request->session()->get('message');

        return view('home', [
            "blogs" => $blogs,
            "toast" => [
                "title" => $title,
                "success" => $success,
                "message" => $message
            ]
        ]);
    }
}
