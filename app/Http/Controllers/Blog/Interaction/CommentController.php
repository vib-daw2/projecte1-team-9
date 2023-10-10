<?php

namespace App\Http\Controllers\Blog\Interaction;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Comment;
use App\Models\Comment_Child;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function comment(Request $request, string $id): string
    {
        $blog = Blog::find($id);
        try {
            $this->authorize('view', $blog);
        } catch (\Throwable $th) {
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
            $comment= new Comment_Child();
            $comment->parent_id = $request->input('parent_id');
        } else {
            $comment = new Comment();
        }

        $comment->blog_id = $blog->id;
        $comment->user_id = Auth::id();
        $comment->body = $request->input('body');
        $comment->save();

        return redirect()->back();
    }

    public function delete(string $id): string
    {
        $comment = Comment::find($id);

        if (!$comment) {
            $comment = Comment_Child::find($id);
        }

        try {
            $this->authorize('delete', $comment);
        } catch (\Throwable $th) {
            abort(403);
        }

        Comment::destroy($comment->id);

        return redirect()->back();
    }
}
