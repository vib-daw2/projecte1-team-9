<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Scout\Searchable;
use stdClass;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Searchable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function getProfileStats(): stdClass
    {
        $totalReceivedLikes = DB::table('likes')
            ->where('blog_id', DB::table('blogs')
                ->where('user_id', $this->id)->value('id'))
            ->where('type', 'like')->count();

        $postsCount = DB::table('blogs')
            ->where('user_id', $this->id)
            ->where('status', 'published')->count();

        $upSince = DB::table('users')->where('id', $this->id)->value('created_at');

        $follows = DB::table('follows')
            ->where('follower_id', $this->id)
            ->count();

        $followers = DB::table('follows')
            ->where('followee_id', $this->id)
            ->count();

        $return = new stdClass();
        $return->likes = $totalReceivedLikes;
        $return->posts_count = $postsCount;
        $return->up_since = $upSince;
        $return->follows = $follows;
        $return->followers = $followers;
        return $return;
    }

    /**
     * Function to validate the user
     * @return string[]
     */
    public static function validate(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
        ];
    }

    public function followers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'follows', 'followee_id', 'follower_id');
    }

    public function followees(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'follows', 'follower_id', 'followee_id');
    }
}
