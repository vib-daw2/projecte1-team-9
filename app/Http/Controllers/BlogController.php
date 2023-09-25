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
    public function render(string $id): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $blog = Blog::find($id);
        if (!$blog) {
            abort(404);
        }

        try {
            $this->authorize('view', $blog);
        } catch (\Throwable $th) {
            abort(404);
        }

        $liked = $blog->liked();

        $likesAndDislikes = $blog->getLikesAndDislikes();

        return view('blog', [
            'blog' => $blog,
            'id' => $id,
            'liked' => $liked,
            'likes' => $likesAndDislikes->likes,
            'dislikes' => $likesAndDislikes->dislikes,
        ]);
    }

}
