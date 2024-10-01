@extends('index')
@section('content')
<div class="container mt-5">
    <h2>Daftar Kategori</h2>

    <a href="{{ route('kategori.create') }}" class="mb-3 btn btn-success">Tambah Kategori</a>

    <!-- Tabel Kategori -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID Kategori</th>
                <th>Jenis Kategori</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kategoris as $kategori)
                <tr>
                    <td>{{ $kategori->id_kategori }}</td>
                    <td>{{ $kategori->jenis_kategori }}</td>
                    <td>
                        <a href="{{ route('kategori.buku', $kategori->id_kategori) }}" class="btn btn-primary btn-sm">Lihat Buku</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
