<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\User;

class SearchController extends Controller
{
    function search(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $query = request()->query('s');

        $blogs = Blog::search($query)
            ->paginate(25)->withQueryString();

        $users = User::search($query)
            ->paginate(25)->withQueryString();

        foreach ($blogs as $blog) {
            $query = $blog->getLikesAndDislikes();
            $blog->likes = $query->likes;
            $blog->dislikes = $query->dislikes;
            $blog->username = $blog->user->username;
        }

        foreach ($users as $user) {
            $user->followers = $user->followers()->count();
            $user->follows = $user->followees()->count();
        }

        return view('blog/search', ['blogs' => $blogs, 'users' => $users]);
    }
}
