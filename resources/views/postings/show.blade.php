@extends('index')

@section('content')
<div class="container">
    <h1>Detail Postingan</h1>

    <div class="card mt-3">
        <div class="card-header">
            <h3>{{ $post->sender }}</h3>
        </div>
        <div class="card-body">
            <p>{{ $post->message_text }}</p>
            @if($post->message_gambar !== 'no')
                <img src="{{ $post->message_gambar }}" alt="Gambar Postingan" class="img-fluid">
            @endif
        </div>
        <div class="card-footer">
            <small>Diposting oleh {{ $post->create_by }} pada {{ $post->create_date }}</small>
        </div>
    </div>

    <a href="{{ route('postings.index') }}" class="btn btn-secondary mt-3">Kembali ke Daftar Postingan</a>
</div>
@endsection
