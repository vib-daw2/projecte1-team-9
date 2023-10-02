<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\Follow;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    /**
     * Function to follow-unfollow a user
     * @param string $id
     * @return string
     */
    public function follow(string $id): string
    {
        $user = User::find($id);

        try {
            $this->authorize('like', $user);
        } catch (Exception $e) {
            abort(403);
        }

        $follow = Follow::where('follower_id', Auth::id())
            ->where('followee_id', $user->id)
            ->first();

        if ($follow) {
            $follow->delete();
        } else {
            Follow::create([
                'follower_id' => Auth::id(),
                'followee_id' => $user->id,
            ]);
        }

        return redirect()->back();
    }
}
