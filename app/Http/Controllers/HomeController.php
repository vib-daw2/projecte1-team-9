<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function render(Request $request){
        $categories = ["Cat 0", "Cat 1", "Cat 2"];
        $selected = $request->input("category");
        return view('home', [
            "categories" => $categories,
            "selected" => $selected
        ]);
    }
}
