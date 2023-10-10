<?php

namespace App\Http\Controllers\Blog\Interaction\Comment;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Comment;
use App\Models\Comment_Child;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Throwable;

class CommentController extends Controller
{
    /**
     * @param string $id
     * @return string
     */
    public function getBlogComments(string $id): string
    {
        $blog = Blog::find($id);
        try {
            $this->authorize('view', $blog);
        } catch (Throwable $th) {
            abort(403);
        }

        $comments = $blog->comments()
            ->orderBy('created_at', 'desc')
            ->get();

        foreach ($comments as $comment) {
            $comment->username = $comment->user->username;
            $comment->children = Comment_Child::where('parent_id', $comment->id)
                ->orderBy('created_at', 'desc')
                ->get();
            foreach ($comment->children as $child) {
                $child->username = $child->user->username;
            }
        }

        return $comments->toJson();
    }


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

        return redirect()->back();
    }

    /**
     * @param string $id
     * @return string
     */
    public function delete(string $id): string
    {
        $comment = Comment::find($id);

        if (!$comment) {
            $comment = Comment_Child::find($id);
        }

        try {
            $this->authorize('delete', $comment);
        } catch (Throwable $th) {
            abort(403);
        }

        Comment::destroy($comment->id);

        return redirect()->back();
    }
}
