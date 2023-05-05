@extends('layouts.app')

@section('content')
    <h1>Conversations</h1>

    <ul>
        @foreach ($friends as $friend)
            <li>
                <a href="{{ route('conversations.show', $friend) }}">{{ $friend->name }}</a>
            </li>
        @endforeach
    </ul>
@endsection