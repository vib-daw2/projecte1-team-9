<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    function search(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $query = request()->query('s');

        $blogs = Blog::search($query)->paginate(10);

        foreach ($blogs as $blog) {
            $query = $blog->getLikesAndDislikes();
            $blog->likes = $query->likes;
            $blog->dislikes = $query->dislikes;
            $blog->username = $blog->user->username;
        }

        return view('blog/search', ['blogs' => $blogs]);
    }
}
