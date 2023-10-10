<?php

namespace App\Http\Controllers\Blog\Interaction\Comment;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Comment;
use App\Models\Comment_Child;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Throwable;

class NewController extends Controller
{
    /**
     * @param Request $request
     * @param string $id
     * @return string
     * @throws ValidationException
     */
    public function comment(Request $request, string $id): string
    {
        $blog = Blog::find($id);
        try {
            $this->authorize('view', $blog);
        } catch (Throwable $th) {
            abort(403);
        }

        $this->validate($request, [
            'body' => 'required',
            'parent_id' => 'nullable|exists:comments,id'
        ]);

        if ($request->input('parent_id')) {
            $parent = Comment::find($request->input('parent_id'));
            if ($parent->parent_id) {
                abort(403);
            }
        }

        if (isset($parent)) {
            $comment = new Comment_Child();
            $comment->parent_id = $request->input('parent_id');
        } else {
            $comment = new Comment();
        }

        $comment->blog_id = $blog->id;
        $comment->user_id = Auth::id();
        $comment->body = $request->input('body');
        $comment->save();

        return redirect()->back()->with('status', ['success' => true, 'title' => 'Comment created succesfully', 'message' => 'Your comment has been published']);
    }
}