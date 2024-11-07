<!DOCTYPE html>
<html lang="en">
<head>
    @include('layout.header')
    @include('layout.styleGlobal')
    @include('layout.stylePage')
    
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css"> 
    <!-- jQuery & DataTables JS -->
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    
    <!-- CSS untuk mengatur text-align ke tengah -->
    <style>
        .tengah {
            text-align: center;
            vertical-align: middle; /* Agar konten berada di tengah secara vertikal juga */
        }
    </style>
</head>
<body>
    <h1>Data User</h1>
    <a href="{{route('admin.index')}}" class="btn btn-primary">Kembali Ke Index</a>
    <a href="{{route('admin.create')}}" class="btn btn-primary">Create New User</a>
    <!-- Tabel Data Warga -->
    <table id="myTable" class="display">
        <thead>
            <tr>
                <th>ID</th>
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
                <td>{{$user->ID_USER}}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->username }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->jenisUser ? $user->jenisUser->JENIS_USER : 'belom ada' }}</td> <!-- Tampilkan Jenis User -->
                <td>
                    <a href="{{ route('admin.edit', $user->ID_USER) }}" class="btn btn-light">Edit</a>
                    <form action="{{ route('admin.destroy', $user->ID_USER) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-dark">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Inisialisasi DataTables -->
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable({
                "paging": true,     // Menampilkan pagination
                "searching": true,  // Menampilkan kotak pencarian
                "ordering": true,   // Mengaktifkan pengurutan kolom
                "info": true,       // Menampilkan informasi jumlah data
            });
        });
    </script>

</body>
</html>
