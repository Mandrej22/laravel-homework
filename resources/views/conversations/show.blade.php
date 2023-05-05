@extends('layouts.app')

@section('content')
    <h1>Conversation with {{ $friend->name }}</h1>

    <div>
        @foreach ($conversation->messages as $message)
            <div>
                @if ($message->user_id === auth()->user()->id)
                    <p style="background-color: lightblue; text-align: right; padding: 5px;">{{ $message->content }}</p>
                @else
                    <p style="background-color: lightgreen; text-align: left; padding: 5px;">{{ $message->content }}</p>
                @endif
            </div>
        @endforeach
    </div>

    <form action="{{ route('conversations.sendMessage', $friend) }}" method="POST">
        @csrf
        <input type="text" name="message" placeholder="Type your message">
        <button type="submit">Send</button>
    </form>
@endsection