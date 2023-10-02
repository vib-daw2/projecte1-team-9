<?php

namespace App\Http\Controllers\Profiles;

use App\Http\Controllers\Controller;

class MyLikesController extends Controller
{
    public function render()
    {
        return view('profiles/my-likes');
    }
}
