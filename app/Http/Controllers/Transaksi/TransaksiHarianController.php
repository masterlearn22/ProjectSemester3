<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;

use App\Models\TransaksiHarian;
use App\Models\Emiten;
use Illuminate\Http\Request;

class TransaksiHarianController extends Controller
{
    public function index()
    {
        $transaksi = TransaksiHarian::all();
        return view('transaksi_saham.transaksi_harian.index', compact('transaksi'));
    }

    public function destroy(TransaksiHarian $transaksi)
    {
        $transaksi->delete();
        return redirect()->route('transaksi_saham.transaksi_harian.index')->with('success', 'Data transaksi berhasil dihapus');
    }
}
