@extends('layouts.app')

@section('content')
    <h1>Users</h1>

    <ul>
        @foreach ($users as $user)
            <li>
                {{ $user->name }}
                <form action="{{ route('friendships.sendRequest', $user) }}" method="POST">
                    @csrf
                    <button type="submit">Send Request</button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection