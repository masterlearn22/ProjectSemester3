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


                <h1>Transaksi Harian</h1>
                <a href="{{ route('admin.create') }}" class="btn btn-primary">Create New User</a>
                <!-- Tabel Data Warga -->
                <table id="myTable" class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Stock Code</th>
                                <th>Date Transaction</th>
                                <th>Open</th>
                                <th>High</th>
                                <th>Low</th>
                                <th>Close</th>
                                <th>Change</th>
                                <th>Volume</th>
                                <th>Value</th>
                                <th>Frequency</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transaksi as $data)
                                <tr>
                                    <td>{{ $data->NO_RECORDS }}</td>
                                    <td>{{ $data->STOCK_CODE }}</td>
                                    <td>{{ $data->DATE_TRANSACTION }}</td>
                                    <td>{{ $data->OPEN }}</td>
                                    <td>{{ $data->HIGH }}</td>
                                    <td>{{ $data->LOW }}</td>
                                    <td>{{ $data->CLOSE }}</td>
                                    <td>{{ $data->CHANGE }}</td>
                                    <td>{{ $data->VOLUME }}</td>
                                    <td>{{ $data->VALUE }}</td>
                                    <td>{{ $data->FREQUENCY }}</td>
                                    <td>
                                        <a href="{{ route('transaksi_harian.edit', $data->NO_RECORDS) }}" class="btn btn-light">Edit</a>
                                        <form action="{{ route('transaksi_harian.destroy', $data->NO_RECORDS) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-dark" >Hapus</button>
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
