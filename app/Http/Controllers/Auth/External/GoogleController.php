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
            return redirect('/login')->with('status', ['success' => false, 'title' => 'Failed to authenticate', 'message' => "An external error has ocurred. Please try again later"]);
        }

        $existingUser = User::where('auth_provider_id', $googleUser->getId())->first();
        if ($existingUser) {
            Auth::login($existingUser);
            return redirect('/blog')->with('status', ['success' => true, 'title' => 'Login successful', 'message' => 'Welcome back!']);
        }

        try {
            $user = new User();
            $user->username = str_replace(' ', '', $googleUser->getName());
            $user->email = $googleUser->getEmail();
            $user->password = Hash::make(Str::random(24));
            $user->auth_provider = 'google';
            $user->auth_provider_id = $googleUser->getId();
            $user->profile_picture = $googleUser->getAvatar();
            $user->save();
            Auth::login($user);
        } catch (UniqueConstraintViolationException $e) {
            return redirect('/login')->with('status', ['success' => true, 'title' => 'Login successful', 'message' => 'Welcome back!']);
        }

        return redirect('/blog')->with('status', ['success' => true, 'title' => 'Login successful', 'message' => 'Welcome back!']);
    }
}