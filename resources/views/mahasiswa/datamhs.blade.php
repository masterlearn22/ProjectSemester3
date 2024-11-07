@extends('index')

@section('content')
<h1>Data Mahasiswa</h1>

<a href="{{ route('mahasiswa.create') }}" class="btn btn-success">Tambah Mahasiswa</a>

@if ($message = Session::get('success'))
    <div class="alert alert-success">
        {{ $message }}
    </div>
@endif

<table class="table table-dark">
    <thead>
        <tr>
            <th> NIM </th>
            <th> Nama </th>
            <th> No Telepon </th>
            <th> Kelas Praktikum </th>
            <th> Aksi </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($mhs as $datamhs)
        <tr>
            <td> {{ $datamhs->nim }} </td>
            <td> {{ $datamhs->name }} </td>
            <td> {{ $datamhs->no_wa }} </td>
            <td> {{ $datamhs->kelas_praktikum }} </td>
            <td>
                <a href="{{ route('mahasiswa.edit', $datamhs->ID_USER) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('mahasiswa.destroy', $datamhs->ID_USER) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
        
    </tbody>
</table>
@endsection
