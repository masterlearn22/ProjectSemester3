@extends('layout.main')

@section('content')
<div class="container">
    <h2 class="my-4">Dashboard Saham</h2>
    
    <!-- Filter Bulan dan Tahun -->
    <div class="mb-3 d-flex align-items-center">
        <label for="month-year" class="me-2">Month and Year</label>
        <input type="text" id="month-year" class="form-control" value="January 2023" readonly>
    </div>

    <!-- Statistik Ringkas -->
    <div class="mb-4 row">
        <div class="col-md-3">
            <div class="p-3 card">
                <h4>Jumlah Emiten</h4>
                <h5>5</h5>
            </div>
        </div>
        <div class="col-md-3">
            <div class="p-3 card">
                <h4>Volume Transaksi</h4>
                <h5>71.8B</h5>
            </div>
        </div>
        <div class="col-md-3">
            <div class="p-3 card">
                <h4>Value Transaksi</h4>
                <h5>43.3T</h5>
            </div>
        </div>
        <div class="col-md-3">
            <div class="p-3 card">
                <h4>Jumlah Frekuensi</h4>
                <h5>1,833,506</h5>
            </div>
        </div>
    </div>

    <!-- Tabel Transaksi -->
    <div class="mb-4 card">
        <div class="card-body">
            <h5>Tabel Transaksi</h5>
            <table class="table">
                <thead>
                    <tr>
                        <th>Stock Code</th>
                        <th>Date Transaction</th>
                        <th>Sum of Volume</th>
                        <th>Sum of Value</th>
                        <th>Sum of Frequency</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Data Tabel Diisi dari Database -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- Grafik -->
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5>Pie Value Transaksi</h5>
                    <canvas id="pieChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5>Grafik Harga Close</h5>
                    <canvas id="lineChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Frekuensi Bulanan -->
    <div class="mt-4 card">
        <div class="card-body">
            <h5>Frekuensi Bulanan</h5>
            <canvas id="barChart"></canvas>
        </div>
    </div>
</div>

<script>
    const pieCtx = document.getElementById('pieChart').getContext('2d');
new Chart(pieCtx, {
    type: 'pie',
    data: {
        labels: ['ANTM', 'BBCA', 'BBRI', 'GOTO', 'BRIS'],
        datasets: [{
            data: [10.06, 35.67, 36.09, 15.77, 2.21],
            backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF']
        }]
    }
});

const lineCtx = document.getElementById('lineChart').getContext('2d');
new Chart(lineCtx, {
    type: 'line',
    data: {
        labels: Array.from({length: 31}, (_, i) => i + 1),
        datasets: [
            { label: 'ANTM', data: [/* data ANTM */], borderColor: '#FF6384' },
            { label: 'BBCA', data: [/* data BBCA */], borderColor: '#36A2EB' },
            { label: 'BBRI', data: [/* data BBRI */], borderColor: '#FFCE56' },
            { label: 'GOTO', data: [/* data GOTO */], borderColor: '#4BC0C0' },
            { label: 'BRIS', data: [/* data BRIS */], borderColor: '#9966FF' },
        ]
    }
});

const barCtx = document.getElementById('barChart').getContext('2d');
new Chart(barCtx, {
    type: 'bar',
    data: {
        labels: ['ANTM', 'BBCA', 'BBRI', 'BRIS', 'GOTO'],
        datasets: [{
            label: 'Frekuensi Bulanan',
            data: [272070, 398350, 461900, 146065, 555121],
            backgroundColor: '#4BC0C0'
        }]
    }
});
</script>
@endsection