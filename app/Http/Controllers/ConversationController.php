<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Conversation;
use App\Models\User;
use Illuminate\Http\Request;

class ConversationController extends Controller
{
    public function index()
    {
        $friends = auth()->user()->friends;

        return view('conversations.index', compact('friends'));
    }

    public function show(User $friend)
    {
        $conversation = Conversation::whereHas('users', function ($query) use ($friend) {
            $query->where('id', auth()->user()->id);
            $query->where('id', $friend->id);
        })->first();

        return view('conversations.show', compact('friend', 'conversation'));
    }

    public function sendMessage(Request $request, User $friend)
    {
        $conversation = Conversation::whereHas('users', function ($query) use ($friend) {
            $query->where('id', auth()->user()->id);
            $query->where('id', $friend->id);
        })->first();

        $conversation->messages()->create([
            'user_id' => auth()->user()->id,
            'content' => $request->input('message'),
        ]);

        return back();
    }
}
