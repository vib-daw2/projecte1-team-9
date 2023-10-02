<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Like;
use Exception;
use http\Env\Response;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LikeController extends Controller
{
    /**
     * Method to like or dislike a blog post
     * @param Request $request
     * @param string $id
     * @return string
     */
    public function like(Request $request, string $id): string
    {
        $blog = Blog::find($id);
        if ($blog->status != 'published') {
            abort(403);
        }

        try {
            $this->authorize('like', $blog);
        } catch (Exception $e) {
            abort(403);
        }

        $this->validate($request, [
            'action' => 'required|in:like,dislike'
        ]);

        $action = $request->input('action');

        // Get if the user had interacted with the blog before
        $like = Like::where('blog_id', $blog->id)
            ->where('user_id', Auth::id())
            ->first();

        if (!$like) {
            $like = new Like();
            $like->blog_id = $blog->id;
            $like->user_id = Auth::id();
            $like->type = $action;
        } else {
            if ($like->type == $action) {
                Like::destroy($like->id);
            } else {
                $like->type = $action;
            }
        }
        $like->save();

        return redirect()->back();
    }
}
