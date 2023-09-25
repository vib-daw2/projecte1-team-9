<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function render(string $id){
        return view('ProfileView', ['id' => $id]);
    }
}
