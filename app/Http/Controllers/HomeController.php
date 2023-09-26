<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function Psy\debug;

class HomeController extends Controller
{
    //
    public function render(Request $request)
    {
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
            ->where('blogs.status', '=', 'published')
            ->orderBy('views', 'desc')
            ->limit(10)->offset(($page - 1) * 10)
            ->get();

        $pagination = new \stdClass();
        $pagination->size = $page_size;
        $pagination->total_pages = ceil(Blog::where('status', '=', 'published')->count() / $pagination->size);

        return view('home', [
            "blogs" => $blogs,
            "pagination" => $pagination,
        ]);
    }
}
