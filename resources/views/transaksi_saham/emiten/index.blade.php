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


                <h1>Data Emiten</h1>
                <a href="{{ route('admin.create') }}" class="btn btn-primary">Create New User</a>
                <!-- Tabel Data Warga -->
                <table id="myTable" class="table">
                    <thead>
                        <tr>
                            <th>Stock Code</th>
                            <th>Nama Perusahaan</th>
                            <th>Shared</th>
                            <th>Sektor</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($emitens as $emiten)
                            <tr>
                                <td>{{ $emiten->STOCK_CODE }}</td>
                                <td>{{ $emiten->NAMA_PERUSAHAAN }}</td>
                                <td>{{ $emiten->SHARED }}</td>
                                <td>{{ $emiten->SEKTOR }}</td>
                                <td>
                                    <a href="{{ route('emiten.edit', $emiten->STOCK_CODE) }}"  class="btn btn-light" >Edit</a>
                                    <form action="{{ route('emiten.destroy', $emiten->STOCK_CODE) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-dark">Hapus</button>
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
