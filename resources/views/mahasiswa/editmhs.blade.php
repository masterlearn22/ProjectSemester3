@extends('index')

@section('content')
<h1>Edit Mahasiswa</h1>

<form action="{{ route('mahasiswa.update', $mahasiswa->ID_USER) }}" method="POST">
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
    <div class="mb-3 row">
        <select class="mb-3 form-select" aria-label="Default select example" name="kelas_praktikum" id="kelas_praktikum">
          <option selected>Kelas Praktikum</option>
          <option value="1">B1</option>
          <option value="2">B2</option>
          <option value="3">B3</option>
          <option value="4">B4</option>
          <option value="5">B5</option>
          <option value="6">B6</option>
          <option value="7">B7</option>
          <option value="8">B8</option>
        </select>
      </div>
    <button type="submit" class="btn btn-success">Update</button>
</form>
@endsection
