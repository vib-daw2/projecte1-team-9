<?php

namespace App\Http\Controllers\Blog;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class EditBlogController extends Controller
{
    public function render(string $id){
        $blog = DB::table('blogs')->where('id', $id)->first();
        $blog->username = DB::table('users')->where('id', $blog->user_id)->first()->username;
        return view('editblog', ['blog' => $blog, 'id' => $id]);
    }
}
