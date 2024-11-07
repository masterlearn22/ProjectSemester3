<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KoleksiBuku;
use Illuminate\Support\Facades\DB;

class BukuController extends Controller
{
    // Method untuk menampilkan daftar buku (index)
    public function index()
    {
        $bukus = DB::table('koleksi_bukus')
            ->join('kategori', 'koleksi_bukus.id_kategori', '=', 'kategori.id_kategori')
            ->select('koleksi_bukus.id_buku as id', 'koleksi_bukus.kode', 'koleksi_bukus.judul', 'koleksi_bukus.pengarang', 'kategori.jenis_kategori as kategori')
            ->get();
        $kategori = DB::table('kategori')->select('id_kategori', 'jenis_kategori')->get();

        // Mengirim data ke view 'buku.index'
        return view('buku.bacabuku', compact('bukus', 'kategori'));
    }

    // Method untuk menampilkan form tambah buku (create)
    public function create()
    {
        // Ambil data kategori untuk dropdown
        $kategori = DB::table('kategori')->select('id_kategori', 'jenis_kategori')->get();

        // Kirim data kategori ke view
        return view('buku.tambahbuku', compact('kategori'));
    }

    // Method untuk menyimpan data buku (store)
    public function store(Request $request)
    {
        $request->validate([
            'id_kategori' => 'required|exists:kategori,id_kategori', // Pastikan id_kategori ada di tabel kategori
            'kode' => 'required',
            'judul' => 'required',
            'pengarang' => 'required',
        ]);

        // Simpan data buku ke tabel koleksi_bukus
        KoleksiBuku::create([
            'id_kategori' => $request->id_kategori,  // Relasi kategori
            'kode' => $request->kode,
            'judul' => $request->judul,
            'pengarang' => $request->pengarang,
        ]);

        // Redirect ke halaman daftar buku setelah sukses
        return redirect()->route('buku.index');
    }
}
