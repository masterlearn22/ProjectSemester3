<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use App\Models\Emiten;
use Illuminate\Http\Request;

class EmitenController extends Controller
{
    public function index()
    {
        $emitens = Emiten::all();
        return view('transaksi_saham.emiten.index', compact('emitens'));
    }

    public function destroy(Emiten $emiten)
    {
        $emiten->delete();
        return redirect()->route('transaksi_saham.emiten.index')->with('success', 'Emiten berhasil dihapus');
    }
}
