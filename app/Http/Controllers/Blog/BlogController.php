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

        $liked = $blog->liked(); // Check if the user liked the blog
        $likesAndDislikes = $blog->getLikesAndDislikes(); // Get the likes and dislikes
        $blog->username = $blog->user->username;
        $blog->userId = $blog->user->id;

        return view('blog/blog', [
            'blog' => $blog,
            'id' => $id,
            'liked' => $liked, // If the user has liked the blog or not
            'likes' => $likesAndDislikes->likes,
            'dislikes' => $likesAndDislikes->dislikes,
        ]);
    }

}
