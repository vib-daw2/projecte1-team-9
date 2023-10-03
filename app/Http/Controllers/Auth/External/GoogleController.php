<?php

namespace App\Http\Controllers\Auth\External;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Database\UniqueConstraintViolationException;
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

        $existingUser = User::where('auth_provider_id', $googleUser->getId())->first();
        if ($existingUser) {
            Auth::login($existingUser);
            return redirect('/blog');
        }

        try {
            $user = new User();
            $user->username = $googleUser->getName();
            $user->email = $googleUser->getEmail();
            $user->password = Hash::make(Str::random(24));
            $user->auth_provider = 'google';
            $user->auth_provider_id = $googleUser->getId();
            $user->save();
            Auth::login($user);
        } catch (UniqueConstraintViolationException $e) {
            return redirect('/login')->with('error', 'Failed to authenticate with Google');
        }

        return redirect('/blog');
    }
}
