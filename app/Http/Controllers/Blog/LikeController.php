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

class LikeController extends Controller
{
    /**
     * Method to like or dislike a blog post
     * @param Request $request
     * @param string $id
     * @return JsonResponse
     */
    public function like(Request $request, string $id): JsonResponse
    {
        $blog = Blog::findOrFail($id);

        $this->validate($request, [
            'action' => 'required|in:like,dislike,remove'
        ]);

        $action = $request->input('action');

        if ($action == 'like') {
            Like::findOrCreate($blog->id, Auth::id(), true);
        } else if ($action == 'dislike') {
            Like::findOrCreate($blog->id, Auth::id(), false);
        } else if ($action == 'remove') {
            Like::where('blog_id', $blog->id)
                ->where('user_id', auth()->user()->id)
                ->delete();
        }

        return response()->json([], 200);
    }
}
