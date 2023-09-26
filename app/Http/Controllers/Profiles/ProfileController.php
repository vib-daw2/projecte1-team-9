<?php

namespace App\Http\Controllers\Profiles;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function render(Request $request, string $id): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $user = User::find($id);
        if (!$user) {
            abort(404);
        }
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
            ->where('blogs.user_id', '=', $id)
            ->where('blogs.status', '=', 'published')
            ->orderBy('views', 'desc')
            ->limit(10)->offset(($page - 1) * 10)
            ->get();

        $pagination = new \stdClass();
        $pagination->size = $page_size;
        $pagination->total_pages = ceil(Blog::where('status', '=', 'published')->count() / $pagination->size);

        return view('profiles/profile',
            ['id' => $id,
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
