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
                abort(404);
            }
        }

        $liked = $blog->liked();
        $likesAndDislikes = $blog->getLikesAndDislikes();
        $blog->username = $blog->user->username;

        return view('blog', [
            'blog' => $blog,
            'id' => $id,
            'liked' => $liked,
            'likes' => $likesAndDislikes->likes,
            'dislikes' => $likesAndDislikes->dislikes,
        ]);
    }

}
