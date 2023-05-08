@extends('layouts.app')

@section('content')
<div class="container">    
<h1>Friends</h1>

    <ul class="list-group">
        @foreach ($users as $user)
            <li class="list-group-item">
                {{ $user->name }}
                <form action="{{ route('friendships.sendRequest', $user) }}" method="POST" class="float-end">
                    @csrf
                    <button type="submit" class="btn btn-primary">Send Request</button>
                </form>
            </li>
        @endforeach
    </ul>

    @if($friendRequests->count())
        <div class="notification mt-4">
            <h2>Friend Requests</h2>
            <ul class="list-group">
                @foreach($friendRequests as $request)
                    <li class="list-group-item">{{ $request->name }} wants to be a friend.
                        <div class="float-end">
                            <form action="{{ route('friendships.acceptRequest', $request) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-success">Accept</button>
                            </form>
                            <form action="{{ route('friendships.rejectRequest', $request) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-danger">Reject</button>
                            </form>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif  

    @if($users->count())
        <div class="mt-4">
            <h2>Firends</h2>
            <ul class="list-group">
                @foreach($users as $friend)
                    <li class="list-group-item">{{ $friend->name }}
                        <form action="{{ route('conversations.show', $friend) }}" method="GET" class="float-end">
                            <button type="submit" class="btn btn-primary">Message</button>
                        </form>
                    </li>
                @endforeach
            </ul>
        </div>
</div>
    @endif
@endsection

