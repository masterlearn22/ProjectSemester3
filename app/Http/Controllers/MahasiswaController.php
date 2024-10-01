<?php

namespace App\Http\Controllers;

use App\Models\mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    // Show all mahasiswa
    public function index()
    {
        $mhs = mahasiswa::all();
        return view('menu.datamhs', compact('mhs'));
    }

    // Show form to create new mahasiswa
    public function create()
    {
        return view('menu.tambahmhs');
    }

    // Store new mahasiswa
    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required|unique:mahasiswa',
            'nama' => 'required',
            'no_wa' => 'required',
            'kelas_praktikum' => 'required'
        ]);

        mahasiswa::create($request->all());

        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil ditambahkan');
    }

    // Show form to edit existing mahasiswa
    public function edit(mahasiswa $mahasiswa)
    {
        return view('menu.editmhs', compact('mahasiswa'));
    }

    // Update mahasiswa
    public function update(Request $request, mahasiswa $mahasiswa)
    {
        $request->validate([
            'nim' => 'required|unique:mahasiswa,nim,'.$mahasiswa->id,
            'nama' => 'required',
            'no_wa' => 'required',
            'kelas_praktikum' => 'required'
        ]);

        $mahasiswa->update($request->all());

        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil diperbarui');
    }

    // Delete mahasiswa
    public function destroy(mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();

        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil dihapus');
    }
}
