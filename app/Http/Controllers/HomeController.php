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
                ->select('blogs.*', 'users.username', 'users.id as owner_id', 'liked')
                ->join('users', 'users.id', '=', 'blogs.user_id')
                ->where('blogs.status', '=', 'published')
                ->leftJoin('likes', function ($join) use ($request) {
                    $join->on('likes.blog_id', '=', 'blogs.id')
                        ->where('likes.user_id', '=', Auth::id());
                })
                ->orderBy('views', 'desc')
                ->paginate(10);
        } else {
            $blogs = DB::table('blogs')
                ->select('blogs.*', 'users.username', 'users.id as owner_id')
                ->join('users', 'users.id', '=', 'blogs.user_id')
                ->where('blogs.status', '=', 'published')
                ->orderBy('views', 'desc')
                ->paginate(10);
        }

        return view('home', [
            "blogs" => $blogs
        ]);
    }
}
