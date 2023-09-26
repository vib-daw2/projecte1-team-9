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
                'username' => 'required|min:3|max:255|unique:users,username,' . $user->id,
                'email' => 'required|email|max:255|unique:users,email,' . $user->id,
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

        $user->save();

        return redirect('/admin/users');
    }
}
