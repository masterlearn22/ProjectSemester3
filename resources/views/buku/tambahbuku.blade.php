@extends('index')

@section('content')
<h1 >Tambah Buku Baru</h1>
<form action="simpanbuku" method="POST">
    @csrf
    <div>
        <label for="kategori">Kategori:</label>
        <select name="id_kategori" required>
            @foreach($kategori as $kat)
                <option value="{{ $kat->id_kategori }}">{{ $kat->jenis_kategori }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="kode">Kode Buku:</label>
        <input type="text" name="kode" required>
    </div>

    <div>
        <label for="judul">Judul Buku:</label>
        <input type="text" name="judul" required>
    </div>

    <div>
        <label for="pengarang">Pengarang:</label>
        <input type="text" name="pengarang" required>
    </div>

    <button type="submit">Simpan Buku</button>
</form>

@endsection