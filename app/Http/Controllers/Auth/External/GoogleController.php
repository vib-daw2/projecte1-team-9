<?php

namespace App\Http\Controllers\Auth\External;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function provider(): \Symfony\Component\HttpFoundation\RedirectResponse|\Illuminate\Http\RedirectResponse
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (Exception $e) {
            return redirect('/login')->with('error', 'Failed to authenticate with Google');
        }

        $user = User::updateOrCreate([
            'email' => $googleUser->email,
        ], [
            'username' => $googleUser->name,
            'email' => $googleUser->email,
            'password' => Hash::make(Str::random(24)),
        ]);

        Auth::login($user);

        return redirect('/');
    }
}
