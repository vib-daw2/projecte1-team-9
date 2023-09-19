<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function render(string $id){
        return view('blog', ['id' => $id]);
    }
}
