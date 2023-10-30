<?php

namespace App\Http\Controllers\Profile\Mine;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UpdatePasswordController extends Controller
{
    /**
     * Used to render the change password page
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function render(): \Illuminate\Contracts\View\View|Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse
    {
        $user = Auth::user();
        if (Auth::user()->auth_provider == null) {
            return view('profiles.change-password');
        }
        return redirect('/me')->with('status', ['success' => false, 'title' => 'You cannot change your password', 'message' => 'You are using an external authentication provider']);
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

        if (!Hash::check($data['old_password'], auth()->user()->password)) {
            return back()->withErrors([
                'current_password' => 'The current password is incorrect'
            ]);
        }

        if ($data['password1'] !== $data['password2']) {
            return back()->withErrors([
                'password2' => 'The passwords do not match'
            ]);
        }

        Auth::user()->password = Hash::make($data['password1']);
        Auth::user()->save();

        return redirect('/profile')->with('status', ['success' => true, 'title' => 'Your password has been changed', 'message' => 'Dont forget it again!']);

    }
}