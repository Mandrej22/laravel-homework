@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-5">Conversations</h1>

        <div class="list-group">
            @foreach ($friends as $friend)
                <a href="{{ route('conversations.show', $friend) }}" class="list-group-item list-group-item-action">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">{{ $friend->name }}</h5>
                        <small>{{ $friend->updated_at->format('Y-m-d H:i:s') }}</small>
                    </div>
                    <p class="mb-1">{{ $friend->messages->last()->content ?? 'No messages yet.' }}</p>
                </a>
            @endforeach
        </div>
    </div>
@endsection
    