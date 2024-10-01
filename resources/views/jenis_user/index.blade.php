<!-- resources/views/jenis_user/index.blade.php -->
@extends('index')

@section('content')
    <h1>Jenis User</h1>
    <a href="{{ route('jenis_user.create') }}" class="btn btn-primary mb-3">Create New</a>
    <table class="table table-dark">
        <thead>
            <tr>
                <th>ID</th>
                <th>Jenis User</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jenisUsers as $jenisUser)
                <tr>
                    <td>{{ $jenisUser->ID_JENIS_USER }}</td>
                    <td>{{ $jenisUser->JENIS_USER }}</td>
                    <td>
                        <a href="{{ route('jenis_user.edit', $jenisUser->ID_JENIS_USER) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('jenis_user.destroy', $jenisUser->ID_JENIS_USER) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
