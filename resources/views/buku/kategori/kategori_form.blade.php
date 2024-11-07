@extends('index')

@section('content')
    <h2>{{ isset($kategori) ? 'Edit Kategori' : 'Buat Kategori Baru' }}</h2>

    <form action="{{ isset($kategori) ? route('kategori.update', $kategori->id_kategori) : route('kategori.store') }}" method="POST">
        @csrf
        @if(isset($kategori))
            @method('PUT')
        @endif

        <div class="form-group">
            <label for="jenis_kategori">Jenis Kategori</label>
            <input type="text" name="jenis_kategori" class="form-control" id="jenis_kategori" value="{{ isset($kategori) ? $kategori->jenis_kategori : '' }}" required>
        </div>

        <button type="submit" class="btn btn-primary">
            {{ isset($kategori) ? 'Update Kategori' : 'Tambah Kategori' }}
        </button>

        <a href="{{ route('kategori.index') }}" class="btn btn-secondary">Kembali</a>
    </form>

@endsection
