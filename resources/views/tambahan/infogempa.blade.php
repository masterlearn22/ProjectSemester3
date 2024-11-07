@extends('index')

@section('content')

<button id="loadAutoGempa">Get Auto Gempa Information</button>
<button id="loadGempaTerkini">Get Gempa Terkini Information</button>
<div class="row">
    <div class="col-md-4">
<h1>Informasi Auto Gempa</h1>
<table class="table table-dark">
    <tbody id="autoGempaData">
        <tr>
            <th>Tanggal</th>
            <td id="tanggal"></td>
        </tr>
        <tr>
            <th>Jam</th>
            <td id="jam"></td>
        </tr>
        <tr>
            <th>Date Time</th>
            <td id="datetime"></td>
        </tr>
        <tr>
            <th>Coordinates</th>
            <td id="coordinates"></td>
        </tr>
        <tr>
            <th>Lintang</th>
            <td id="lintang"></td>
        </tr>
        <tr>
            <th>Bujur</th>
            <td id="bujur"></td>
        </tr>
        <tr>
            <th>Magnitude</th>
            <td id="magnitude"></td>
        </tr>
        <tr>
            <th>Kedalaman</th>
            <td id="kedalaman"></td>
        </tr>
        <tr>
            <th>Wilayah</th>
            <td id="wilayah"></td>
        </tr>
        <tr>
            <th>Potensi</th>
            <td id="potensi"></td>
        </tr>
        <tr>
            <th>Dirasakan</th>
            <td id="dirasakan"></td>
        </tr>
    </tbody>
</table>
</div>
<div class="col-md-8">
    <h1>Shakemap</h1>
    <div id="shakemap">
        <!-- Gambar shakemap akan dimuat di sini -->
    </div>
</div>
</div>
<h1>Informasi Gempa Terkini</h1>
<table class="table table-dark" id="gempaTerkiniTable">
    <thead>
        <tr>
            <th>Tanggal</th>
            <th>Jam</th>
            <th>Date Time</th>
            <th>Coordinates</th>
            <th>Lintang</th>
            <th>Bujur</th>
            <th>Magnitude</th>
            <th>Kedalaman</th>
            <th>Wilayah</th>
            <th>Potensi</th>
        </tr>
    </thead>
    <tbody id="gempaTerkiniData">
        <!-- Data gempa terkini akan dimasukkan di sini -->
    </tbody>
</table>

<style>
    .fullscreen {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%) scale(1.2);
        max-width: 90%;
        max-height: 90%;
        z-index: 1000;
        box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.5);
        cursor: zoom-out;
    }

    .overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.7);
        z-index: 999;
        display: none;
    }
          /* Atur gambar shakemap agar lebih besar dan responsif */
    .shakemap-img {
    max-width: 100%;
    height: 100%;
    border: 2px solid #ffffff;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
}

</style>

<div class="overlay"></div>

<script>
$(document).ready(function() {
    // Event handler untuk tombol "Get Auto Gempa Information"
    $('#loadAutoGempa').click(function() {
        $.ajax({
            url: 'https://data.bmkg.go.id/DataMKG/TEWS/autogempa.json',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                data = data.Infogempa.gempa;
                
                $('#tanggal').text(data.Tanggal);
                $('#jam').text(data.Jam);
                $('#datetime').text(data.DateTime);
                $('#coordinates').text(data.Coordinates);
                $('#lintang').text(data.Lintang);
                $('#bujur').text(data.Bujur);
                $('#magnitude').text(data.Magnitude);
                $('#kedalaman').text(data.Kedalaman);
                $('#wilayah').text(data.Wilayah);
                $('#potensi').text(data.Potensi);
                $('#dirasakan').text(data.Dirasakan);
                $('#shakemap').html(`<img src="https://static.bmkg.go.id/${data.Shakemap}" alt="Shakemap" width="100" class="shakemap-img">`);
            },
            error: function() {
                $('#autoGempaData').html('<tr><td colspan="2">Terjadi kesalahan dalam memuat data Auto Gempa</td></tr>');
            }
        });
    });

    // Event handler untuk tombol "Get Gempa Terkini Information"
    $('#loadGempaTerkini').click(function() {
        $.ajax({
            url: 'https://data.bmkg.go.id/DataMKG/TEWS/gempaterkini.json',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                data = data.Infogempa.gempa;
                let gempaTerkiniRows = '';
                
                // Loop untuk menampilkan beberapa data gempa terkini
                $.each(data, function(index, gempa) {
                    gempaTerkiniRows += `<tr>
                        <td>${gempa.Tanggal}</td>
                        <td>${gempa.Jam}</td>
                        <td>${gempa.DateTime}</td>
                        <td>${gempa.Coordinates}</td>
                        <td>${gempa.Lintang}</td>
                        <td>${gempa.Bujur}</td>
                        <td>${gempa.Magnitude}</td>
                        <td>${gempa.Kedalaman}</td>
                        <td>${gempa.Wilayah}</td>
                        <td>${gempa.Potensi}</td>
                    </tr>`;
                });

                $('#gempaTerkiniData').html(gempaTerkiniRows);
            },
            error: function() {
                $('#gempaTerkiniData').html('<tr><td colspan="12">Terjadi kesalahan dalam memuat data Gempa Terkini</td></tr>');
            }
        });
    });

    // Fungsi untuk memperbesar gambar saat diklik
    $(document).on('click', '.shakemap-img', function() {
        $(this).toggleClass('fullscreen');
        if ($(this).hasClass('fullscreen')) {
            $('.overlay').fadeIn(); // Tampilkan overlay
        } else {
            $('.overlay').fadeOut(); // Sembunyikan overlay
        }
    });

    // Event handler untuk klik di luar gambar agar gambar kembali ke ukuran semula
    $('.overlay').click(function() {
        $('.shakemap-img').removeClass('fullscreen'); // Hapus kelas fullscreen dari gambar
        $('.overlay').fadeOut(); // Sembunyikan overlay
    });
});
</script>

@endsection
