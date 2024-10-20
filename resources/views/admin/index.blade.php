@extends('index')

@section('content')
    <h1>Users</h1>

    <a href="{{route('admin.create')}}" class="btn btn-primary">Create New User</a>
    
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Username</th>
                <th>Email</th>
                <th>Jenis User</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->jenisUser ? $user->jenisUser->JENIS_USER : 'belom ada' }}</td> <!-- Tampilkan Jenis User -->
                    <td>
                        <a href="{{ route('admin.edit', $user) }}" class="btn btn-light">Edit</a>
                        <form action="{{ route('admin.destroy', $user) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-dark">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
