<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserFollowed;
use Illuminate\Support\Facades\Auth;

class UserManageController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $followedChannels = UserFollowed::where('user_id', $userId)
            ->with('channel')
            ->get();
        return view('user.manage', compact('followedChannels'));
    }
    public function unfollow($id)
    {
        $userId = Auth::id();
        $follow = UserFollowed::where('channel_id', $id)->where('user_id', $userId)->first();

        if ($follow) {
            $follow->delete();
            return response()->json(['success' => true, 'message' => 'Unfollowed successfully']);
        }

        return response()->json(['success' => false, 'message' => 'Channel not found or not followed'], 404);
    }
}
