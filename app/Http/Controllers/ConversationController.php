<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Conversation;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Message;


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
            $query->where('users.id', auth()->user()->id);
            $query->where('users.id', $friend->id);
        })->first();

        if ($conversation) {
            $latestMessage = $conversation->messages()->orderBy('created_at', 'desc')->first();
            return view('conversations.show', compact('friend', 'conversation', 'latestMessage'));
        } else {
            $conversation = Conversation::create();
            $conversation->users()->attach([auth()->user()->id, $friend->id]);
            return view('conversations.show', compact('friend', 'conversation'));
        }
    }



    public function sendMessage(Request $request, User $friend)
    {
        $conversation = Conversation::whereHas('users', function ($query) use ($friend) {
            $query->where('users.id', auth()->user()->id)
                ->orWhere('users.id', $friend->id);
        })->first();

        if (!$conversation) {
            $conversation = new Conversation();
            $conversation->save();
            $conversation->users()->attach(auth()->user()->id);
            $conversation->users()->attach($friend->id);
        }

        $message = new Message();
        $message->content = $request->input('message');
        $message->user_id = auth()->user()->id;
        $message->conversation_id = $conversation->id;
        $message->save();

        $conversation = Conversation::with('messages')->find($conversation->id);

        return view('conversations.show', compact('friend', 'conversation'));
    }



}