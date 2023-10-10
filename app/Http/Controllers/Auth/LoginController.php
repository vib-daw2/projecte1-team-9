<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function render(): View|Application|Factory|Redirector|RedirectResponse
    {
        if (auth()->check()) {
            return redirect('/blog');
        }
        return view('auth/login');
    }

    public function login(Request $request): RedirectResponse
    {
        try {
            $validated = request()->validate([
                'username' => 'required',
                'password' => 'required',
                'remember' => 'nullable|boolean',
            ]);
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        }

        if (!isset($validated['remember'])) {
            $remember = false;
        } else {
            $remember = $validated['remember'];
        }

        if (Auth::attempt($validated, $remember)) {
            if ($request->input('redirect')) {
                return redirect('/' . $request->input('redirect'), 302)->with('status', ['success' => true, 'title' => 'Login successful', 'message' => 'Welcome back!']);
            }
            return redirect('/blog')->with('status', ['success' => true, 'title' => 'Login successful', 'message' => 'Welcome back!']);
        }

        return redirect()->back()->withErrors(['username' => 'Invalid username or password'])->withInput();
    }
}