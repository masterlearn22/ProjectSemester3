<?php

namespace App\Http\Controllers\Transaksi;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Validasi input bulan
        $request->validate([
            'month' => 'nullable|date_format:Y-m',
        ]);

        // Ambil bulan dan tahun yang dipilih dari request atau set ke Januari 2023 jika tidak ada
        $selectedMonth = $request->input('month', '2023-01');

        // Statistik
        $totals = DB::table('t_transaksi_harian')
            ->selectRaw('SUM(VOLUME) as total_volume, SUM(VALUE) as total_value, SUM(FREQUENCY) as total_frequency')
            ->whereYear('DATE_TRANSACTION', date('Y', strtotime($selectedMonth)))
            ->whereMonth('DATE_TRANSACTION', date('m', strtotime($selectedMonth)))
            ->first();

        $jumlah_emiten = DB::table('emiten')->count();
        $total_volume = $totals->total_volume ?? 0;
        $total_value = $totals->total_value ?? 0;
        $total_frequency = $totals->total_frequency ?? 0;

        // Data untuk Tabel Transaksi Bulanan
        $transaksi_bulanan = DB::table('t_transaksi_harian')
            ->selectRaw('STOCK_CODE, DATE_FORMAT(DATE_TRANSACTION, "%M %Y") as month, SUM(VOLUME) as sum_volume, SUM(VALUE) as sum_value, SUM(FREQUENCY) as sum_frequency')
            ->whereYear('DATE_TRANSACTION', date('Y', strtotime($selectedMonth)))
            ->whereMonth('DATE_TRANSACTION', date('m', strtotime($selectedMonth)))
            // ->whereDay('DATE_TRANSACTION', date('D', strtotime($selectedMonth)))
            ->groupBy('STOCK_CODE', 'month')
            ->get();

        // Data untuk Grafik Pie
        $pie_data = DB::table('t_transaksi_harian')
            ->select('STOCK_CODE', DB::raw('SUM(VALUE) as sum_value'))
            ->whereYear('DATE_TRANSACTION', date('Y', strtotime($selectedMonth)))
            ->whereMonth('DATE_TRANSACTION', date('m', strtotime($selectedMonth)))
            ->groupBy('STOCK_CODE')
            ->get();

        // Data untuk Grafik Frekuensi Bulanan
        $frekuensi_bulanan = DB::table('t_transaksi_harian')
            ->select('STOCK_CODE', DB::raw('SUM(FREQUENCY) as sum_frequency'))
            ->whereYear('DATE_TRANSACTION', date('Y', strtotime($selectedMonth)))
            ->whereMonth('DATE_TRANSACTION', date('m', strtotime($selectedMonth)))
            ->groupBy('STOCK_CODE')
            ->get();

        // Data untuk Grafik Harga Close
        $harga_close = DB::table('t_transaksi_harian')
            ->select('STOCK_CODE', 'DATE_TRANSACTION', 'CLOSE')
            ->whereYear('DATE_TRANSACTION', date('Y', strtotime($selectedMonth)))
            ->whereMonth('DATE_TRANSACTION', date('m', strtotime($selectedMonth)))
            ->orderBy('DATE_TRANSACTION')
            ->get()
            ->groupBy('STOCK_CODE');

        // Kembalikan view dengan data yang sudah dipersiapkan
        return view('transaksi_saham.grafik', compact(
            'jumlah_emiten',
            'total_volume',
            'total_value',
            'total_frequency',
            'transaksi_bulanan',
            'pie_data',
            'frekuensi_bulanan',
            'harga_close',
            'selectedMonth'
        ));
    }
}
