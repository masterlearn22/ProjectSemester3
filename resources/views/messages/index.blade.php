@extends('index')

@section('content')
    <h1>Daftar Pesan</h1>
    <a href="{{ route('messages.create') }}" class="btn btn-primary">Kirim Pesan Baru</a>

    <h2>Pesan Diterima</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Pengirim</th>
                <th>Subjek</th>
                <th>Status</th>
                <th>Aksi</th>
                <th>Detail Pesan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($receivedMessages as $message)
                <tr>
                    <td>{{ $message->sender }}</td>
                    <td>
                        <a href="{{ route('messages.show', $message->message_id) }}">
                            {{ $message->subject }}
                        </a>
                    </td>
                    <td>{{ $message->message_status }}</td>
                    <td>
                        <form action="{{ route('messages.destroy', $message->message_id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus pesan ini?');">Hapus</button>
                        </form>
                    </td>
                    <td>
                        <a href="{{ route('messages.show', $message->message_id) }}" class="btn btn-warning btn-sm">Buka</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Tidak ada pesan yang diterima.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <h2>Pesan Dikirim</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Penerima</th>
                <th>Subjek</th>
                <th>Status</th>
                <th>Aksi</th>
                <th>Detail Pesan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($sentMessages as $message)
                <tr>
                    <td>{{ $message->recipient_email }}</td>
                    <td>
                            {{ $message->subject }}
                    </td>
                    <td>{{ $message->message_status }}</td>
                    <td>
                        <a href="{{ route('messages.edit', $message->message_id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('messages.destroy', $message->message_id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus pesan ini?');">Hapus</button>
                        </form>
                    </td>
                    <td>
                        <a href="{{ route('messages.show', $message->message_id) }}" class="btn btn-warning btn-sm">Buka</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Tidak ada pesan yang dikirim.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
