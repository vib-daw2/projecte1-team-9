<?php

namespace App\Http\Controllers\Profiles;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfilePostsController extends Controller
{
    public function render(){

        $user_id = Auth::id();
        $blogs = DB::table('blogs')->where('user_id', $user_id)->where('status', 'published')->get();

        return view('profiles/profile-posts', [
            'blogs' => $blogs,
        ]);
    }
}
