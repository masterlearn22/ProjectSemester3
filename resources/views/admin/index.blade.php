<!DOCTYPE html>
<html lang="en">

<head>
    @include('layout.header')
    @include('layout.styleGlobal')
    @include('layout.stylePage')
    @include('layout.datatable')
</head>

<body>
    @include('layout.navbar')
    <div class="container-fluid page-body-wrapper">
        @include('layout.sidebar')
        <div class="main-panel">
            <div class="content-wrapper">


                <h1>Data User</h1>
                <a href="{{ route('admin.create') }}" class="btn btn-primary">Create New User</a>
                <!-- Tabel Data Warga -->
                <table id="myTable" class="table">
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
                                <td>{{ $user->ID_USER }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->jenisUser ? $user->jenisUser->JENIS_USER : 'belom ada' }}</td>
                                <!-- Tampilkan Jenis User -->
                                <td>
                                    <a href="{{ route('admin.edit', $user->ID_USER) }}" class="btn btn-light">Edit</a>
                                    <form action="{{ route('admin.destroy', $user->ID_USER) }}" method="POST"
                                        style="display:inline;">
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


            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                "paging": true, // Menampilkan pagination
                "searching": true, // Menampilkan kotak pencarian
                "ordering": true, // Mengaktifkan pengurutan kolom
                "info": true, // Menampilkan informasi jumlah data
            });
        });
    </script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
