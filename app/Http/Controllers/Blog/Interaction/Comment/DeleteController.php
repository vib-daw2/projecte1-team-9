<?php

namespace App\Http\Controllers\Blog\Interaction\Comment;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Support\Facades\DB;
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

        try {
            $this->authorize('delete', $comment);
        } catch (Throwable $th) {
            abort(403);
        }

        $comment->children =
            DB::table('comments')
                ->select('*')
                ->whereIn('comments.id', DB::table('comments_relations')->select('comment_id')->where('parent_id', '=', $comment->id))
                ->get()
                ->toArray();

        foreach ($comment->children as $child) {
            Comment::destroy($child->id);
        }

        Comment::destroy($comment->id);



        return redirect()->back()->with('status', ['success' => true, 'title' => 'Comment deleted succesfully', 'message' => '']);
    }
}
