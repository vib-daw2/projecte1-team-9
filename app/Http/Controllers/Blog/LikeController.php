<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Like;
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
        $blog = Blog::findOrFail($id);
        if ($blog->status != 'published') {
            abort(403);
        }

        $this->validate($request, [
            'action' => 'required|in:like,dislike,remove'
        ]);

        $action = $request->input('action');

        if ($action == 'remove'){
            DB::table('likes')->where([
                'blog_id' => $blog->id,
                'user_id' => Auth::id()
            ])->delete();
        } else {
            DB::table('likes')->updateOrInsert([
                'blog_id' => $blog->id,
                'user_id' => Auth::id()
            ], [
                'blog_id' => $blog->id,
                'user_id' => Auth::id(),
                'type' => $action
            ]);
        }

        return redirect()->back();
    }
}
