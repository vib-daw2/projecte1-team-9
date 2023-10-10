<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;
use Laravel\Scout\Searchable;

class Blog extends Model
{
    use HasFactory, Searchable;

    protected $table = 'blogs';

    protected $fillable = [
        'title',
        'subtitle',
        'body',
        'user_id',
        'published',
    ];

    public function likes(): HasMany
    {
        return $this->hasMany(Like::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Function to know if the user liked or disliked the blog
     * @return bool|null
     */
    public function liked(): string|null
    {
        $liked = DB::table('likes')
            ->where('blog_id', $this->id)
            ->where('user_id', auth()->id())
            ->first()->type ?? null;

        return $liked ? $liked : null;
    }

    public function getLikesAndDislikes(): object
    {
        // Usamos raw para solo tener que hacer una query
        return DB::table('likes')
            ->select(DB::raw('SUM(CASE WHEN type = "like" THEN 1 ELSE 0 END) as likes'), DB::raw('SUM(CASE WHEN type = "dislike" THEN 1 ELSE 0 END) as dislikes'))
            ->where('blog_id', $this->id)
            ->first();
    }

    /**
     * Function to validate the blog
     * @return string[]
     */
    public static function validate(): array
    {
        return [
            'title' => 'required|min:3|max:255',
            'subtitle' => 'required|min:3|max:255',
            'body' => 'required|min:3',
            'status' => 'required|in:draft,published',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];
    }

    /**
     * Determine whether the blog should be indexed.
     *
     * @return bool
     */
    public function shouldBeSearchable(): bool
    {
        return $this->status === 'published';
    }

    public function getComments()
    {
        $blog = Blog::find($this->id);
        // try {
        //     $this->authorize('view', $blog);
        // } catch (Throwable $th) {
        //     abort(403);
        // }

        $comments = $blog->comments()
            ->orderBy('created_at', 'desc')
            ->get();

        foreach ($comments as $comment) {
            $comment->children = Comment_Child::where('parent_id', $comment->id)
                ->orderBy('created_at', 'desc')
                ->get();
        }

        return $comments;
    }
}
