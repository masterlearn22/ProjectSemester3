@extends('index')

@section('content')
<div class="container">
    <h1>Buat Postingan Baru</h1>

    <form action="{{ route('postings.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="message_text">Isi Postingan:</label>
            <textarea name="message_text" class="form-control" rows="3" required></textarea>
        </div>

        <div class="form-group">
            <label for="file">Gambar</label>
            <input type="file" name="message_gambar[]" class="form-control" multiple>
        </div>

        <button type="submit" class="btn btn-primary mt-2">Buat Postingan</button>
    </form>
</div>
@endsection
