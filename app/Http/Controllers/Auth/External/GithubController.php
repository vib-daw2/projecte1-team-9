<?php

namespace App\Http\Controllers\Auth\External;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class GithubController extends Controller
{
    public function provider(): \Symfony\Component\HttpFoundation\RedirectResponse|\Illuminate\Http\RedirectResponse
    {
        return Socialite::driver('github')->redirect();
    }

    public function callback()
    {
        try {
            $githubUser = Socialite::driver('github')->user();
        } catch (Exception $e) {
            return redirect('/login')->with('status', ['success' => false, 'title' => 'Failed to authenticate', 'message' => "An external error has ocurred. Please try again later"]);
        }

        $existingUser = User::where('auth_provider_id', $githubUser->getId())->first();
        if ($existingUser) {
            Auth::login($existingUser);
            return redirect('/blog')->with(['success' => false, 'title', 'Failed to authenticate with Google']);
        }

        try {
            $user = new User();
            $user->username = $githubUser->getNickname();
            $user->email = $githubUser->getEmail();
            $user->password = Hash::make(Str::random(24));
            $user->auth_provider = 'github';
            $user->auth_provider_id = $githubUser->getId();
            $user->profile_picture = $githubUser->getAvatar();
            $user->save();
            Auth::login($user);
        } catch (UniqueConstraintViolationException $e) {
            return redirect('/login')->with('status', ['success' => false, 'title' => 'Failed to authentica', 'message' => "An account with this email or username already exists"]);
        }

        return redirect('/blog')->with('status', ['success' => true, 'title' => 'Login successful', 'message' => 'Welcome back!']);
    }
}