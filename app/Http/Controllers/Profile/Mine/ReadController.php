<?php

namespace App\Http\Controllers\Profile\Mine;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Throwable;

class ReadController extends Controller
{
    public function render()
    {
        $user = Auth::user();

        $profile_stats = $user->getProfileStats();

        return view('profiles/mine',
            ['id' => $user->id,
                'posts_count' => $profile_stats->posts_count,
                'up_since' => $profile_stats->up_since,
                'likes' => $profile_stats->likes,
                'username' => $user->username,
                'email' => $user->email,
                'profile_picture' => $user->profile_picture,
            ]);
    }
}
