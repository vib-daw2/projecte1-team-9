<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfilePostsController extends Controller
{
    public function render(){
        return view('profile-posts');
    }
}
