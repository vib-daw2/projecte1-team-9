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

        $blogs = DB::table('blogs')
            ->select('blogs.*', 'users.username', 'users.id as owner_id')
            ->join('users', 'users.id', '=', 'blogs.user_id')
            ->where('blogs.status', '=', 'published')
            ->orderBy('views', 'desc')
            ->limit(10)->offset(($page - 1) * 10)
            ->get();

        return view('home', [
            "blogs" => $blogs,
        ]);
    }
}
