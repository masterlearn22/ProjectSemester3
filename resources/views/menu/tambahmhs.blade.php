@extends('index')

@section('content')
<h1>Tambah Data Mahasiswa</h1>
<form action="{{ route('mahasiswa.store') }}" method="POST">

    @csrf
      <div class="p-3 my-3 rounded shadow-sm bg-body">
          <div class="mb-3 row">
              <label for="nim" class="col-sm-2 col-form-label">NIM</label>
              <div class="col-sm-10">
                  <input type="number" class="form-control" name='nim' id="nim">
              </div>
          </div>
          <div class="mb-3 row">
              <label for="nama" class="col-sm-2 col-form-label">Nama</label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" name='nama' id="nama">
              </div>
          </div>
          <div class="mb-3 row">
            <label for="nama" class="col-sm-2 col-form-label">No. Telepon</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='no_wa' id="nama">
            </div>
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
          <div class="mb-3 row">
              <label for="kelas_praktikum" class="col-sm-2 col-form-label"></label>
              <div class="col-sm-10"><button type="submit" class="btn btn-primary" name="submit">SIMPAN</button></div>
          </div>
        </form>
@endsection