<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Validation\ValidationException;
use Throwable;

class EditUserController extends Controller
{
    public function render(): Factory|\Illuminate\Foundation\Application|View|Redirector|Application|RedirectResponse
    {
        // TODO The admin user edit view

        return view('admin/users');
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
            $validated = $this->validate(request(), User::validate());
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        }

        $user->username = $validated['username'];
        $user->email = $validated['email'];
        $user->save();

        return redirect('/admin/users');
    }
}
