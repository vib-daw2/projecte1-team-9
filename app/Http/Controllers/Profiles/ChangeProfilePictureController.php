<?php

namespace App\Http\Controllers\Profiles;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChangeProfilePictureController extends Controller
{
    public function change(Request $request)
    {
        if (!Auth::check()) {
            abort(403);
        }

        $user = Auth::user();

        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $imageName = time() . $user->id . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $imageName);

        $user->image = $imageName;
        $user->save();

        return redirect()->back()->with('success', 'Profile picture changed successfully.');

    }
}
