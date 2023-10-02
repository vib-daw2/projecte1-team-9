<?php

namespace App\Http\Controllers\Auth\External;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
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
            return redirect('/login')->with('error', 'Failed to authenticate with GitHub');
        }

        $user = User::updateOrCreate([
            'email' => $githubUser->email,
        ], [
            'username' => $githubUser->nickname,
            'email' => $githubUser->email,
            'password' => Hash::make(Str::random(24)),
        ]);

        Auth::login($user);

        return redirect('/');
    }
}
