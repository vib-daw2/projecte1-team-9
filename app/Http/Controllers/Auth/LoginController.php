<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function render(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        if (auth()->check()) {
            return redirect('/');
        }
        return view('auth/login');
    }

    public function login(Request $request): RedirectResponse
    {
        try {
            $validated = request()->validate([
                'username' => 'required',
                'password' => 'required'
            ]);
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        }

        if (Auth::attempt($validated)) {
            if ($request->input('redirect')) {
                return redirect('/'.$request->input('redirect'));
            }
            return redirect('/');
        }


        return redirect()->back()->withErrors(['username' => 'Invalid username or password'])->withInput();
    }
}
