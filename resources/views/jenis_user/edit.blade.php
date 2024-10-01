<!-- resources/views/jenis_user/edit.blade.php -->
@extends('index')

@section('content')
    <h1>Edit Jenis User</h1>

    <form action="{{ route('jenis_user.update', $jenisUser->ID_JENIS_USER) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="JENIS_USER">Jenis User:</label>
        <input type="text" name="JENIS_USER" id="JENIS_USER" value="{{ $jenisUser->JENIS_USER }}">
        <button type="submit">Update</button>
    </form>
@endsection
