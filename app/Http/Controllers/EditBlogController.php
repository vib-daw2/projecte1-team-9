<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EditBlogController extends Controller
{
    public function render(string $id){
        return view('editblog', ['id' => $id]);
    }
}
