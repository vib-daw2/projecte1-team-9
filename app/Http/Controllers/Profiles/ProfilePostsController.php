<?php

namespace App\Http\Controllers\Profiles;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use stdClass;

class ProfilePostsController extends Controller
{
    public function render(Request $request): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $user = Auth::user();
        $profile_stats = $user->getProfileStats();

        $page = $request->query('page');
        if (!$page) {
            $page = 1;
        }

        $page_size = $request->query('page_size');
        if (!$page_size) {
            $page_size = 10;
        }

        $blogs = DB::table('blogs')
            ->select('blogs.*', 'users.username', 'users.id as owner_id')
            ->join('users', 'users.id', '=', 'blogs.user_id')
            ->where('blogs.user_id', '=', $user->id)
            ->orderBy('views', 'desc')
            ->limit(10)->offset(($page - 1) * 10)
            ->get();

        $pagination = new stdClass();
        $pagination->size = $page_size;
        $pagination->total_pages = Blog::where('user_id', '=', $user->id)->count() / $pagination->size;

        return view('profiles/profile-posts',
            ['id' => $user->id,
                'posts_count' => $profile_stats->posts_count,
                'up_since' => $profile_stats->up_since,
                'likes' => $profile_stats->likes,
                'username' => $user->username,
                'email' => $user->email,
                'blogs' => $blogs,
                'pagination' => $pagination,
            ]);

    }
}
