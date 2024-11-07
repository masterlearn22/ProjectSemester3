<!DOCTYPE html>
<html>

<head>
    @include('layout.header')
    @include('layout.styleGlobal')
    @include('layout.stylePage')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    @include('layout.datatable')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
</head>

<body>
    @include('layout.navbar')
    <div class="container-fluid page-body-wrapper">
        @include('layout.sidebar')
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="container">
                    <h2 class="my-4">Dashboard Saham</h2>

                    <!-- Filter Bulan dan Tahun -->
                    <div class="mb-3">
                        <form id="filterForm" method="GET" action="{{ route('grafik.index') }}"
                            class="d-flex align-items-center">
                            <!-- Label Month and Year -->
                            <label for="month-year" class="me-2">Month and Year</label>

                            <!-- Input bulan -->
                            <input type="month" id="month-year" name="month" class="form-control me-2"
                                value="{{ $selectedMonth }}">

                            <!-- Tombol filter -->
                            <button type="submit" class="btn btn-primary">Filter</button>
                        </form>
                    </div>


                    <!-- Statistik Ringkas -->
                    <div class="mb-4 row">
                        <div class="col-md-3">
                            <div class="p-3 card">
                                <h4>Jumlah Emiten</h4>
                                <h5>{{ $jumlah_emiten }}</h5>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="p-3 card">
                                <h4>Volume Transaksi</h4>
                                <h5>{{ number_format($total_volume / 1e9, 1) }}B</h5>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="p-3 card">
                                <h4>Value Transaksi</h4>
                                <h5>{{ number_format($total_value / 1e12, 1) }}T</h5>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="p-3 card">
                                <h4>Jumlah Frekuensi</h4>
                                <h5>{{ number_format($total_frequency) }}</h5>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Kolom untuk Tabel Transaksi -->
                        <div class="col-md-12">
                            <button id="download">Download PDF</button>
                            <div class="card" id="content">
                                <table id="transaksiTable" class="table table-dark" >
                                    
                                    <h5 class="btn btn-dark">Tabel Transaksi Bulan {{ \Carbon\Carbon::createFromFormat('Y-m', $selectedMonth)->translatedFormat('F Y') }}</h5>
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
                                        @if ($transaksi_bulanan->isEmpty())
                                            <tr>
                                                <td colspan="5" class="text-center">No Data Available</td>
                                            </tr>
                                        @else
                                            @foreach ($transaksi_bulanan as $transaksi)
                                                <tr>
                                                    <td>{{ $transaksi->STOCK_CODE }}</td>
                                                    <td>{{ $transaksi->month }}</td>
                                                    <td>{{ number_format($transaksi->sum_volume) }}</td>
                                                    <td>{{ number_format($transaksi->sum_value) }}</td>
                                                    <td>{{ number_format($transaksi->sum_frequency) }}</td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            
                            </div>
                        </div>

                        <!-- Kolom untuk Grafik Pie -->


                        <div class="row">
                            <div class="mt-2 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5>Grafik Harga Close</h5>
                                        <canvas id="lineChart"></canvas>
                                    </div>
                                </div>
                            </div>

                            <!-- Frekuensi Bulanan -->
                            <div class="mt-2 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5>Frekuensi Bulanan</h5>
                                        <canvas id="barChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mt-2 col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <figure class="highcharts-figure">
                                            <div id="container"></div>
                                        </figure>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>

                <style>
                    .highcharts-figure,
                    .highcharts-data-table table {
                        min-width: 320px;
                        max-width: 800px;
                        margin: 1em auto;
                    }

                    .highcharts-data-table table {
                        font-family: Verdana, sans-serif;
                        border-collapse: collapse;
                        border: 1px solid #ebebeb;
                        margin: 10px auto;
                        text-align: center;
                        width: 100%;
                        max-width: 500px;
                    }

                    .highcharts-data-table caption {
                        padding: 1em 0;
                        font-size: 1.2em;
                        color: #555;
                    }

                    .highcharts-data-table th {
                        font-weight: 600;
                        padding: 0.5em;
                    }

                    .highcharts-data-table td,
                    .highcharts-data-table th,
                    .highcharts-data-table caption {
                        padding: 0.5em;
                    }

                    .highcharts-data-table thead tr,
                    .highcharts-data-table tr:nth-child(even) {
                        background: #f8f8f8;
                    }

                    .highcharts-data-table tr:hover {
                        background: #f1f7ff;
                    }

                    input[type="number"] {
                        min-width: 50px;
                    }

                    .highcharts-description {
                        margin: 0.3rem 10px;
                    }
                    .custom-margin {
        margin-top: 2rem; /* Adjust this value as needed for your layout */
    }
                </style>

                <script>
                    //Download laporan
                    document.getElementById('download').addEventListener('click', function () {
            var element = document.getElementById('content'); // Elemen yang akan dikonversi
            html2pdf()
                .from(element)
                .save(); // Menyimpan PDF dengan nama default
        });


                    $(document).ready(function() {
    $('#transaksiTable').DataTable({
        "paging": false, // Menghilangkan pagination
        "lengthChange": false, // Menghilangkan dropdown untuk jumlah record per halaman
        "searching": false, // Menghilangkan fitur pencarian global
        "ordering": true, // Mengaktifkan fitur pengurutan
        "info": false, // Menyembunyikan informasi jumlah data
        "order": [
            [1, "desc"]
        ], // Urutan default berdasarkan kolom ke-2 secara descending
        "language": {
            "paginate": {
                "previous": "", // Menghilangkan tombol previous
                "next": "" // Menghilangkan tombol next
            }
        },
        "columnDefs": [{
                "orderable": true,
                "targets": 0
            }, // Mengatur kolom pertama agar sortable
            {
                "orderable": true,
                "targets": 1
            }, // Mengatur kolom kedua agar sortable
            {
                "orderable": true,
                "targets": 2
            }, // Mengatur kolom ketiga agar sortable
            {
                "orderable": true,
                "targets": 3
            }, // Mengatur kolom keempat agar sortable
            {
                "orderable": true,
                "targets": 4
            } // Mengatur kolom kelima agar sortable
        ]
    });
});


                   // Data untuk Line Chart
const lineLabels = [];
const lineDatasets = [];

// Generate a random color for each dataset
function getRandomColor() {
    return 'rgba(' + 
        Math.floor(Math.random() * 256) + ',' + 
        Math.floor(Math.random() * 256) + ',' + 
        Math.floor(Math.random() * 256) + ', 1)'; // Full opacity
}

if (!@json($harga_close->isEmpty())) {
    @foreach ($harga_close as $stock_code => $data)
        lineLabels.push(@json($data->pluck('DATE_TRANSACTION')->toArray()));
        lineDatasets.push({
            label: "{{ $stock_code }}",
            data: @json($data->pluck('CLOSE')->toArray()),
            borderColor: getRandomColor(), // Use the random color
            fill: false,
        });
    @endforeach
}

// Inisialisasi Line Chart
const lineCtx = document.getElementById('lineChart').getContext('2d');
new Chart(lineCtx, {
    type: 'line',
    data: {
        labels: [...new Set(lineLabels.flat())],
        datasets: lineDatasets,
    },
    options: {
        responsive: true,
        scales: {
            x: {
                type: 'time',
                time: {
                    unit: 'day'
                }
            },
            y: {
                beginAtZero: true
            }
        }
    }
});


                   // Data untuk Bar Chart
const barData = @json($frekuensi_bulanan->isEmpty() ? [] : $frekuensi_bulanan);
const barLabels = barData.map(data => data.STOCK_CODE);
const barValues = barData.map(data => data.sum_frequency);

// Generate an array of colors for each bar
const barColors = barValues.map((value, index) => {
    // You can customize the colors here
    return `hsl(${(index * 360 / barValues.length)}, 100%, 50%)`; // Generates different colors based on index
});

// Inisialisasi Bar Chart
const barCtx = document.getElementById('barChart').getContext('2d');
new Chart(barCtx, {
    type: 'bar',
    data: {
        labels: barLabels,
        datasets: [{
            label: 'Sum of Frequency',
            data: barValues,
            backgroundColor: barColors // Use the array of colors
        }]
    }
});



                    $(document).ready(function() {
                        // Data untuk Pie Chart
                        const pieData = @json($pie_data);
                        const pieLabels = pieData.map(data => data.STOCK_CODE);
                        const pieValues = pieData.map(data => parseFloat(data.sum_value));

                        // Inisialisasi Pie Chart
                        Highcharts.chart('container', {
                            chart: {
                                type: 'pie'
                            },
                            title: {
                                text: 'Transaction Value Composition'
                            },
                            tooltip: {
                                pointFormat: '{point.name}: <b>{point.y} units</b> ({point.percentage:.1f}%)'
                            },
                            plotOptions: {
                                pie: {
                                    dataLabels: {
                                        enabled: true,
                                        format: '<b>{point.name}</b>:({point.percentage:.1f}%)'
                                    }
                                }
                            },
                            series: [{
                                name: 'Value',
                                colorByPoint: true,
                                data: pieLabels.map((label, index) => ({
                                    name: label,
                                    y: pieValues[index]
                                }))
                            }]
                        });
                    });
                </script>
</body>

</html>
