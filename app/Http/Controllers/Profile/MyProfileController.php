<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Throwable;

class MyProfileController extends Controller
{
    public function render()
    {
        $user = Auth::user();

        if (!$user) {
<<<<<<< HEAD
            redirect('/login');
=======
            return redirect('/login', ['redirect' => 'me']);
>>>>>>> 1b6845455a23a669322d095ee18b83b56345531c
        }

        $profile_stats = $user->getProfileStats();

        return view('profiles/mine',
            ['id' => $user->id,
                'posts_count' => $profile_stats->posts_count,
                'up_since' => $profile_stats->up_since,
                'likes' => $profile_stats->likes,
                'username' => $user->username,
                'email' => $user->email,
            ]);
    }

    public function edit()
    {
        $user = Auth::user();

        try {
            $this->authorize('update', $user);
        } catch (Throwable $th) {
            abort(403, $th->getMessage());
        }

        try {
            $validated = $this->validate(request(), [
                'username' => 'required|min:3|max:255',
                'email' => 'required|email|max:255',
                'password1' => 'required|min:8|max:255'
            ]);
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        }

        //Check if the password is the current user password
        if (!Hash::check($validated['password1'], Auth::user()->password)) {
            return redirect()->back()->withErrors(['password' => 'Invalid password'])->withInput();
        }

        // Check if the username is already taken
        if (User::where('username', $validated['username'])->where('id', '!=', $user->id)->count() > 0) {
            return redirect()->back()->withErrors(['username' => 'Username already taken'])->withInput();
        }
        // Check if the email is already taken
        else if (User::where('email', $validated['email'])->where('id', '!=', $user->id)->count() > 0) {
            return redirect()->back()->withErrors(['email' => 'Email already taken'])->withInput();
        }

        $user->username = $validated['username'];
        $user->email = $validated['email'];

        $user->save();

        return redirect('/me');
    }
}
