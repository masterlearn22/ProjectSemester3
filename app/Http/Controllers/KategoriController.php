<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\KoleksiBuku;

class KategoriController extends Controller
{
    // Menampilkan semua kategori dan buku yang terkait
    public function index()
    {
        $kategoris = Kategori::with('koleksiBukus')->get();
        return view('buku.kategori.kategori_index', compact('kategoris'));
    }

    // Menampilkan form untuk menambah kategori
    public function create()
    {
        return view('buku.kategori.kategori_form');
    }

    // Menyimpan kategori baru
    public function store(Request $request)
    {
        $request->validate([
            'jenis_kategori' => 'required|string|max:255',
        ]);

        Kategori::create([
            'jenis_kategori' => $request->jenis_kategori,
        ]);

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan!');
    }

    // Menampilkan form untuk mengedit kategori
    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('buku.kategori.kategori_form', compact('kategori'));
    }

    // Mengupdate kategori yang ada
    public function update(Request $request, $id)
    {
        $request->validate([
            'jenis_kategori' => 'required|string|max:255',
        ]);

        $kategori = Kategori::findOrFail($id);
        $kategori->update([
            'jenis_kategori' => $request->jenis_kategori,
        ]);

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diperbarui!');
    }

    // Menghapus kategori
    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus!');
    }

    public function showBooks($id)
    {
        // Debugging untuk memastikan parameter id diterima
        dd($id);
    
        // Ambil kategori berdasarkan id, termasuk buku-buku di dalamnya
        $kategori = Kategori::with('koleksiBukus')->findOrFail($id);
    
        // Tampilkan view buku.kategori.kategori_buku dengan data kategori dan buku-bukunya
        return view('buku.kategori.kategori_buku', compact('kategori'));
    }
    


}
