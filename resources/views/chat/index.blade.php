@extends('index')

@section('content')
    <div class="container d-flex flex-column" style="height: 100vh;">
        <h1>Global Chat</h1>

        <!-- Daftar semua pesan chat -->
        <ul class="list-group flex-grow-1 overflow-auto mb-3">
            @foreach($chats as $chat)
                <li class="list-group-item">
                    <strong>{{ $chat->user->name }}:</strong> {{ $chat->message }}
                    @if($chat->user_id == auth()->id())
                        <a href="{{ route('chats.edit', $chat) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('chats.destroy', $chat) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    @endif
                </li>
            @endforeach
        </ul>

        <!-- Form untuk menambahkan pesan baru -->
        <form action="{{ route('chats.store') }}" method="POST" class="chat-footer d-flex">
            @csrf
            <div class="form-group flex-grow-1 mr-2">
                <textarea name="message" class="form-control" placeholder="Type your message"></textarea>
                @error('message')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Send</button>
        </form>
    </div>

    <style>
        .container {
            display: flex;
            flex-direction: column;
            padding-bottom: 20px; /* Memberi jarak pada container */
        }

        /* Agar daftar chat dapat scroll jika terlalu banyak */
        .list-group {
            overflow-y: auto;
            flex-grow: 1;
        }

        /* Menjaga form tetap berada di bagian bawah namun tidak terlalu mepet */
        .chat-footer {
            margin-top: auto;
            margin-bottom: 100px;
        }

        /* Flexbox untuk menata form dan tombol */
        .chat-footer {
            display: flex;
            align-items: center;
        }

        .form-group {
            margin-bottom: 0;
        }

        .form-group textarea {
            height: 60px;
            resize: none;
        }

        /* Jarak antara textarea dan tombol */
        .mr-2 {
            margin-right: 10px;
        }
    </style>
@endsection
