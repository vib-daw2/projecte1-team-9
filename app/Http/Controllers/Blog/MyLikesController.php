<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MyLikesController extends Controller
{
    public function render()
    {
        return view('profiles/my-likes');
    }
}
