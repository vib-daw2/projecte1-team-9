<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class UserAdminController extends Controller
{
    //

    public function render(){
        return view('admin/users');
    }
}
