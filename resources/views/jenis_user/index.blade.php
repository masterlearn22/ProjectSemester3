<!-- resources/views/jenis_user/index.blade.php -->
@extends('index')

@section('content')
    <h1>Jenis User</h1>
    <a href="{{ route('jenis_user.create') }}" class="btn btn-success mb-3">Create New</a>

    <!-- Pembungkus tabel untuk memastikan tabel tetap di sebelah kiri -->
    <div class="table-responsive">
        <!-- Atur lebar tabel dengan properti width, tetapi biarkan di sisi kiri -->
        <table class="table table-dark" style="width: 40%;">
            <thead>
                <tr>
                    <th style="width: 10%;">ID</th> <!-- Atur lebar kolom ID -->
                    <th style="width: 50%;">Jenis User</th> <!-- Atur lebar kolom Jenis User -->
                    <th style="width: 40%;">Action</th> <!-- Atur lebar kolom Action -->
                </tr>
            </thead>
            <tbody>
                @foreach($jenisUsers as $jenisUser)
                    <tr>
                        <td>{{ $jenisUser->ID_JENIS_USER }}</td>
                        <td>{{ $jenisUser->JENIS_USER }}</td>
                        <td>
                            <a href="{{ route('jenis_user.edit', $jenisUser->ID_JENIS_USER) }}" class="btn btn-light btn-sm">Edit</a>
                            <form action="{{ route('jenis_user.destroy', $jenisUser->ID_JENIS_USER) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-dark btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
