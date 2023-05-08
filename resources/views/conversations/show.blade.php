@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Conversation with {{ $friend->name }}</h1>

    <div class="d-flex flex-column gap-3">
        @foreach ($conversation->messages as $message)
            <div class="d-flex align-items-end {{ $message->user_id === auth()->user()->id ? 'justify-content-end' : '' }}">
                <div class="d-flex align-items-center justify-content-center rounded-circle bg-secondary text-light me-2" style="width: 40px; height: 40px; font-size: 18px;">
                    {{ strtoupper($message->user->name[0]) }}
                </div>
                <p class="p-2 rounded-3" style="background-color: {{ $message->user_id === auth()->user()->id ? 'lightblue' : 'lightgreen' }}; font-size: 16px;">{{ $message->content }}</p>
            </div>
        @endforeach
        @if ($conversation->messages->isEmpty())
            <p class="text-muted">No messages yet.</p>
        @endif
    </div>

    <form class="mt-4" action="{{ route('conversations.sendMessage', $friend) }}" method="POST">
        @csrf
        <div class="input-group">
            <input type="text" name="message" placeholder="Type your message" class="form-control">
            <button type="submit" class="btn btn-primary">Send</button>
        </div>
    </form>
</div>
@endsection

