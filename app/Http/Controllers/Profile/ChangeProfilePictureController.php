<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class ChangeProfilePictureController extends Controller
{
    public function change() {
        $user = Auth::user();

        try {
            $validated = $this->validate(request(), [
                'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        }

        $imageName = time().'.'.$validated['profile_picture']->extension();

        $validated['profile_picture']->move(public_path('images'), $imageName);

        $user->profile_picture = $imageName;
        $user->save();

        return redirect()->back();
    }
}
