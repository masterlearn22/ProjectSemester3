@extends('index')

@section('content')
<h1>Daftar Buku</h1>


<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <th>Kategori</th>
        <th>Kode</th>
        <th>Judul</th>
        <th>Pengarang</th>
    </tr>
    @foreach ($bukus as $buku)
    <tr>
        <td>{{ $buku->id }}</td> <!-- Mengambil ID Buku -->
        <td>{{ $buku->kategori }}</td> <!-- Mengambil kategori yang sudah di-join dari query -->
        <td>{{ $buku->kode }}</td>
        <td>{{ $buku->judul }}</td>
        <td>{{ $buku->pengarang }}</td>
    </tr>
    @endforeach
</table>


@endsection
