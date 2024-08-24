@extends('layout.navbar')

@section('title', 'Request')
@section('activeRequest', 'active')

@section('content')
    @if (session('success'))
        <div class="success-message">{{ session('success') }}</div>
    @endif
    {{-- {{ dd($friendRequest) }} --}}
    <div class="container">
        <div class="row">
            @foreach ($friendRequest as $user)
            <div class="card mb-3" style="max-width: 100%;">
                <div class="row g-0">
                    <div class="col-md-2">
                        <img src="{{ asset('storage/' . $user->profile_path) }}" style="width: 10rem; height: 10rem;">
                    </div>
                    <div class="col-md-10">
                        <div class="card-body">
                            <h5 class="card-title">{{ $user->name }}</h5>
                            <p class="card-text">{{ $user->fields_of_work }}</p>
                            <form method="POST" action="{{route("friend.store")}}">
                                @csrf
                                <input type="hidden" name="request_id" value="{{ $user->request_id }}">
                                <input type="hidden" name="friend_id" value="{{ $user->id }}">
                                <button type="submit" class="btn btn-primary">Accept</button>
                            </form>
                            <form method="POST" action="{{route("friend.destroy", $user->request_id)}}">
                                @method('delete')
                                @csrf
                                <input type="hidden" value={{$user->request_id}} name ="friend_request">
                                <button type="submit" class="btn btn-danger">Decline</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
                
            @endforeach
        </div>
    </div>
@endsection