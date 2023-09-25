<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use stdClass;

class BlogController extends Controller
{
    public function render(string $id): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $blog = $this->getBlog($id);

        $liked = DB::table('likes')
            ->where('blog_id', $id)
            ->where('user_id', auth()->id())
            ->first();

        $blog->liked = $liked?->liked; // Get if the user liked or disliked the blog (or did anything)

        $likesAndDislikes = $this->getLikesAndDislikes($id);
        $likes = $likesAndDislikes->likes;
        $dislikes = $likesAndDislikes->dislikes;

        return view('blog',
            ['blog' => $blog, // Title, subtitle, body, created_at, username (author)
                'id' => $id,
                'liked' => $blog->liked, // True liked, False disliked, null not interacted
                'likes' => $likes,
                'dislikes' => $dislikes,
            ]);
    }


    /**
     * @param string $id
     * @return Builder|null
     */
    private function getBlog(string $id): stdClass|null
    {
        $blog = DB::table('blogs')->where('id', $id)->first();
        if (!$blog) {
            abort(404);
        }
        $blog->username = DB::table('users')->where('id', $blog->user_id)->first()->username;
        return $blog;
    }

    /**
     * @param string $id
     * @return stdClass|null
     */
    public function getLikesAndDislikes(string $id): stdClass|null
    {
        // Usamos raw para solo tener que hacer una query
        return DB::table('likes')
            ->select(DB::raw('SUM(liked = true) as likes, SUM(liked = false) as dislikes'))
            ->where('blog_id', $id)
            ->first();
    }
}
