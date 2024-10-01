@extends('index')

@section('content')
<h1>Edit Mahasiswa</h1>

<form action="{{ route('mahasiswa.update', $mahasiswa->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="nim">NIM</label>
        <input type="text" class="form-control" id="nim" name="nim" value="{{ $mahasiswa->nim }}" required>
    </div>
    <div class="form-group">
        <label for="nama">Nama</label>
        <input type="text" class="form-control" id="nama" name="nama" value="{{ $mahasiswa->nama }}" required>
    </div>
    <div class="form-group">
        <label for="no_wa">No Telepon</label>
        <input type="text" class="form-control" id="no_wa" name="no_wa" value="{{ $mahasiswa->no_wa }}" required>
    </div>
    <div class="form-group">
        <label for="kelas_praktikum">Kelas Praktikum</label>
        <input type="text" class="form-control" id="kelas_praktikum" name="kelas_praktikum" value="{{ $mahasiswa->kelas_praktikum }}" required>
    </div>
    <button type="submit" class="btn btn-success">Update</button>
</form>
@endsection
