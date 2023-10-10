<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Throwable;

class UpdateController extends Controller
{
    public function render(string $id): Factory|\Illuminate\Foundation\Application|View|Redirector|Application|RedirectResponse
    {
        $user = User::find($id);
        try {
            $this->authorize('updateAny', $user);
        } catch (Throwable $th) {
            abort(403, $th->getMessage());
        }

        return view('admin/edit-user', [
            'user' => $user
        ]);
    }

    public function edit(string $id): Factory|\Illuminate\Foundation\Application|View|Redirector|Application|RedirectResponse
    {
        $user = User::find($id);

        try {
            $this->authorize('updateAny', $user);
        } catch (Throwable $th) {
            abort(403, $th->getMessage());
        }

        try {
            $validated = $this->validate(request(), [
                'username' => 'required|min:3|max:255',
                'email' => 'required|email|max:255',
                'role' => 'required|in:admin,user,moderator',
                'password' => Auth::user()->auth_provider == null ? 'required|min:8|max:255' : ''
            ]);
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        }

        $authUser = Auth::user();
        //Check if the password is the current user password
        if (Auth::user()->auth_provider == null && !Hash::check($validated['password'], User::find(Auth::id())->password)) {
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
        $user->role = $validated['role'];

        $user->save();

        return redirect('/admin/users')->with('status', ['success' => true, 'title' => 'User has been updated', 'message' => ""]);
    }
}