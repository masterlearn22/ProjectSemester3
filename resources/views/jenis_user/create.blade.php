<!-- resources/views/jenis_user/create.blade.php -->
@extends('index')

@section('content')
    <h1>Create Jenis User</h1>

    <form action="{{ route('jenis_user.store') }}" method="POST" class="table table-dark p-3">
        @csrf
        <div class="form-group">
            <label for="ID_JENIS_USER">ID Jenis User:</label>
            <input type="text" name="ID_JENIS_USER" id="ID_JENIS_USER" class="form-control" placeholder="ID JENIS USER">
        </div>
        <div class="form-group">
            <label for="JENIS_USER">Jenis User:</label>
            <input type="text" name="JENIS_USER" id="JENIS_USER" class="form-control" placeholder="JENIS USER">
        </div>
        <button type="submit" class="btn btn-success mt-3">Submit</button>
        <a href="{{ route('jenis_user.index') }}" class="btn btn-secondary mt-3">Back</a>
    </form>
@endsection
