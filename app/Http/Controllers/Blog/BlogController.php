<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class BlogController extends Controller
{
    public function render(string $id): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $blog = Blog::find($id);
        if (!$blog) {
            abort(404);
        }

        try {
            $this->authorize('view', $blog);
        } catch (\Throwable $th) {
            if ($blog->status !== 'published') {
                abort(403);
            }
        }

        if (auth()->check()) {
            $liked = $blog->liked(); // Get if the user liked or disliked the blog
        } else {
            $liked = null;
        }

        $likesAndDislikes = $blog->getLikesAndDislikes(); // Get the likes and dislikes
        $blog->username = $blog->user->username;
        $blog->userId = $blog->user->id;

        return view('blog/blog', [
            'blog' => $blog,
            'id' => $id,
            'liked' => $liked, // If the user has liked the blog or not (null if not logged in, True if liked, False if disliked)
            'likes' => $likesAndDislikes->likes,
            'dislikes' => $likesAndDislikes->dislikes,
        ]);
    }

}
