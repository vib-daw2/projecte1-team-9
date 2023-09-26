<?php

namespace App\Http\Controllers\Admin;

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

class EditUserController extends Controller
{
    public function render(string $id): Factory|\Illuminate\Foundation\Application|View|Redirector|Application|RedirectResponse
    {
        $user = User::find($id);
        try{
            $this->authorize('update', $user);
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
            $this->authorize('update', $user);
        } catch (Throwable $th) {
            abort(403, $th->getMessage());
        }

        try {
            $validated = $this->validate(request(), [
                'username' => 'required|min:3|max:255',
                'email' => 'required|email|max:255',
                'password' => 'required|min:8|max:255'
            ]);
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        }

        //Check if the password is the current user password
        if (!Hash::check($validated['password'], Auth::user()->password)) {
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

        return redirect('/admin/users');
    }
}
