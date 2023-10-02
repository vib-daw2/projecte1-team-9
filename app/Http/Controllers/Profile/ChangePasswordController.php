<?php

namespace App\Http\Controllers\Profile;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    /**
     * Used to render the change password page
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function render(): \Illuminate\Contracts\View\View|Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('profiles.change-password');
    }

    /**
     * Used to handle form submission to change the password
     * @return Application|Redirector|\Illuminate\Contracts\Foundation\Application|RedirectResponse
     */
    public function changePassword(): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse
    {
        $data = request()->validate([
            'old_password' => 'required',
            'password1' => 'required|min:8|max:255',
            'password2' => 'required|same:password1'
        ]);

        if(!Hash::check($data['old_password'], auth()->user()->password)){
            return back()->withErrors([
                'current_password' => 'The current password is incorrect'
            ]);
        }

        if($data['password1'] !== $data['password2']){
            return back()->withErrors([
                'password2' => 'The passwords do not match'
            ]);
        }

        Auth::user()->password = Hash::make($data['password1']);
        Auth::user()->save();

        return redirect('/profile');
    }
}
