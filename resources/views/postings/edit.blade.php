@extends('index')

@section('content')
<div class="container">
    <h1>Edit Postingan</h1>

    <form action="{{ route('postings.update', $post->posting_id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Nama Pengirim (hanya bisa dilihat) -->
        <div class="form-group">
            <label for="sender">Nama Pengirim:</label>
            <input type="text" name="sender" class="form-control" value="{{ $post->sender }}" disabled>
        </div>

        <!-- Isi Postingan -->
        <div class="form-group">
            <label for="message_text">Isi Postingan:</label>
            <textarea name="message_text" class="form-control" rows="3" required>{{ $post->message_text }}</textarea>
        </div>

        <!-- Pratinjau Gambar Sebelumnya -->
        <div class="form-group">
            <label for="existing_image">Gambar Sebelumnya:</label>
            @if($gambarPathArray)
                <div>
                    <!-- Loop untuk menampilkan setiap gambar -->
                    @foreach ($gambarPathArray as $gambar)
                        <div>
                            <img src="{{ asset('storage/' . $gambar) }}" alt="Gambar Postingan" class="img-fluid" style="max-width: 20%; height: auto; margin-bottom: 10px;">
                        </div>
                    @endforeach
                </div>
            @else
                <p>Tidak ada gambar sebelumnya.</p>
            @endif
        </div>

        <!-- Upload Gambar Baru -->
        <div class="form-group">
            <label for="message_gambar">Upload Gambar Baru (Opsional):</label>
            <input type="file" name="message_gambar[]" class="form-control" multiple> <!-- Tambahkan multiple jika ingin memungkinkan upload beberapa gambar -->
        </div>

        <!-- Tombol Update -->
        <button type="submit" class="btn btn-primary mt-2">Update Postingan</button>
    </form>
</div>
@endsection
