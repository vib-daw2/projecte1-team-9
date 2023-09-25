<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use stdClass;

class BlogController extends Controller
{
    public function render(Request $request, string $id): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $blog = Blog::find($id);
        if (!$blog) {
            abort(404);
        } elseif ($request->user()->cannot('view', $blog)) {
            abort(403);
        }

        $liked = $blog->liked();

        $likesAndDislikes = $blog->getLikesAndDislikes();

        return view('blog',
            ['blog' => $blog, // Title, subtitle, body, created_at, username (author), draft/published
                'id' => $id,
                'liked' => $liked, // True liked, False disliked, null not interacted
                'likes' => $likesAndDislikes->likes,
                'dislikes' => $likesAndDislikes->dislikes,
            ]);
    }

}
