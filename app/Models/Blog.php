<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Blog extends Model
{
    use HasFactory;

    protected $table = 'blogs';

    protected $fillable = [
        'title',
        'subtitle',
        'body',
        'user_id',
        'published',
    ];

    public function likes(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Like::class);
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Function to know if the user liked or disliked the blog
     * @return bool|null
     */
    public function liked(): bool|null
    {
       $liked = DB::table('likes')
           ->where('blog_id', $this->id)
           ->where('user_id', auth()->id())
           ->first();
        return $liked->liked ?? null;
    }

    public function getLikesAndDislikes(): \stdClass|null
    {
        // Usamos raw para solo tener que hacer una query
        return DB::table('likes')
            ->select(DB::raw('SUM(liked = true) as likes, SUM(liked = false) as dislikes'))
            ->where('blog_id', $this->id)
            ->first();
    }
}
