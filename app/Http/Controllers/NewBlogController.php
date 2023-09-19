<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewBlogController extends Controller
{
    public function render(){
        return view('newblog');
    }
}
