<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Throwable;

class EditUserController extends Controller
{
    public function render(string $id): Factory|\Illuminate\Foundation\Application|View|Redirector|Application|RedirectResponse
    {
        // TODO The admin user edit view
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
        $original_username = $user->username;
        $original_email = $user->email;

        try {
            $this->authorize('update', $user);
        } catch (Throwable $th) {
            abort(403, $th->getMessage());
        }

        try {
            $validated = $this->validate(request(), [
                'username' => 'required|min:3|max:255',
                'email' => 'required|email',
                'password' => 'required|min:8|max:255'
            ]);
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
        
        //Check if the password is the current user password
        if (!Hash::check($validated['password'], $user->password)) {
            return redirect()->back()->withErrors(['password' => 'Invalid password'])->withInput();
        }

        $user->username = $validated['username'];
        $user->email = $validated['email'];

        // Check if the username or email are used in the database except the current user
        if (User::where('username', $user->username)->where('username', '!=', $original_username)->exists()) {
            return redirect()->back()->withErrors(['username' => 'Username already exists'])->withInput();
        } elseif (User::where('email', $user->email)->where('email', '!=', $original_email)->exists()) {
            return redirect()->back()->withErrors(['email' => 'Email already exists'])->withInput();
        }

        $user->save();

        return redirect('/admin/users');
    }
}
