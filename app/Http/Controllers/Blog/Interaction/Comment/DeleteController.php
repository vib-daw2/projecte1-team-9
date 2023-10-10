<?php

namespace App\Http\Controllers\Blog\Interaction\Comment;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Comment_Child;
use Illuminate\Http\Request;
use Throwable;

class DeleteController extends Controller
{
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
