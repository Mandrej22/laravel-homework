<?php

namespace App\Http\Controllers;

use App\Models\Friendship;
use App\Models\User;
use Illuminate\Http\Request;

class FriendshipController extends Controller
{
    public function index()
    {
        $users = auth()->user()->friends;
        $friendRequests = auth()->user()->friendRequests;
        $sentRequests = auth()->user()->sentRequests;

        return view('friends.index', compact('users', 'friendRequests', "sentRequests"));
    }

    public function sendRequest(Request $request, User $user)
    {
        Friendship::create([
            'user_id' => auth()->user()->id,
            'friend_id' => $user->id,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Friend request sent successfully.');
    }

    public function acceptRequest(Request $request, User $user)
    {
        $friendship = Friendship::where('user_id', $user->id)
            ->where('friend_id', auth()->user()->id)
            ->where('status', 'pending')
            ->firstOrFail();

        $friendship->update(['status' => 'accepted']);

        return back()->with('success', 'Friend request accepted successfully.');
    }

    public function rejectRequest(Request $request, User $user)
    {
        $friendship = Friendship::where('user_id', $user->id)
            ->where('friend_id', auth()->user()->id)
            ->where('status', 'pending')
            ->firstOrFail();

        $friendship->update(['status' => 'rejected']);

        return back()->with('success', 'Friend request rejected successfully.');
    }

}