@extends('index')
@section('content')
<div class="container mt-5">
    <h2>Daftar Kategori dan Buku</h2>

    <a href="{{ route('kategori.create') }}" class="mb-3 btn btn-success">Tambah Kategori</a>

    <!-- Tabel Kategori dan Buku -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Kategori</th>
                <th>Kode Buku</th>
                <th>Judul</th>
                <th>Pengarang</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp <!-- Inisialisasi penomoran -->
            @foreach($kategoris as $kategori)
                @foreach($kategori->koleksiBukus as $buku)
                    <tr>
                        <td>{{ $no++ }}</td> <!-- Penomoran manual -->
                        <td>{{ $kategori->jenis_kategori }}</td>
                        <td>{{ $buku->kode }}</td>
                        <td>{{ $buku->judul }}</td>
                        <td>{{ $buku->pengarang }}</td>
                    </tr>
                @endforeach

                @if ($kategori->koleksiBukus->isEmpty())
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $kategori->jenis_kategori }}</td>
                        <td colspan="3" class="text-center">Tidak ada buku di kategori ini</td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
</div>
@endsection
