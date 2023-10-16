<?php

namespace App\Http\Controllers\Profile\Interaction;

use App\Http\Controllers\Controller;
use App\Models\Follow;
use App\Models\User;
use Exception;
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
            $this->authorize('follow', $user);
        } catch (Exception $e) {
            abort(403);
        }

        $follow = Follow::where('follower_id', Auth::id())
            ->where('followee_id', $user->id)
            ->first();

        if ($follow) {
            $follow->delete();
            return redirect()->back()->with('status', ['success' => true, 'title' => 'You have unfollowed ' . $user->username, 'message' => 'They will miss you!']);
        } else {
            Follow::create([
                'follower_id' => Auth::id(),
                'followee_id' => $user->id
            ]);
            return redirect()->back()->with('status', ['success' => true, 'title' => "You're now following " . $user->username, 'message' => 'Enjoy his content!']);

        }

    }
}