@extends('index')

@section('content')
    <div class="container">
        <h1>Edit Chat</h1>

        <form action="{{ route('chats.update', $chat) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <textarea name="message" class="form-control">{{ $chat->message }}</textarea>
                @error('message')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary mt-2">Update</button>
        </form>
    </div>
@endsection
