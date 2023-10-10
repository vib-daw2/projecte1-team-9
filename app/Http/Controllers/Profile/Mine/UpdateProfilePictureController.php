<?php

namespace App\Http\Controllers\Profile\Mine;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class UpdateProfilePictureController extends Controller
{
    public function change()
    {
        $user = Auth::user();

        try {
            $validated = $this->validate(request(), [
                'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        }

        $imageName = time() . '.' . $user->username . '.' . $validated['profile_picture']->extension();
        $validated['profile_picture']->move(public_path('images'), $imageName);

        $user->profile_picture = $imageName;
        $user->save();

        return redirect()->back()->with('status', ['success' => true, 'title' => 'Your profile picture has been changed', 'message' => 'You look awesome!']);
        ;
    }
}