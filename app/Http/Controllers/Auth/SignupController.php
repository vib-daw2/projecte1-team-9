<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class SignupController extends Controller
{
    public function render(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        if (auth()->check()) {
            return redirect('/blog');
        }
        return view('auth/signup');
    }

    public function signup(): RedirectResponse
    {
        try {
            $validated = $this->validate(request(), [
                'username' => 'required|min:3|max:255|unique:users,username',
                'email' => 'required|email|unique:users,email',
                'password1' => 'required|min:8|max:255',
                'password2' => 'required|same:password1',
            ]);
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        }

        $user = new User();
        $user->username = $validated['username'];
        $user->email = $validated['email'];
        $user->password = Hash::make($validated['password1']);
        $user->save();

        return redirect('/login');
    }
}
