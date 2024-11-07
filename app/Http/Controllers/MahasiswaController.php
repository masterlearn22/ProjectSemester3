<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    // Show all mahasiswa
    public function index()
    {
        // Ambil semua user yang memiliki ID_JENIS_USER = 2 (mahasiswa)
        $mhs = User::where('ID_JENIS_USER', 2)->get();

        return view('mahasiswa.datamhs', compact('mhs'));
    }

    // Show form to create new mahasiswa
    public function create()
    {
        return view('mahasiswa.tambahmhs');
    }

    // Store new mahasiswa
    public function store(Request $request)
{
    $request->validate([
        'nim' => 'required|unique:mahasiswa,nim', // Validasi nim di tabel mahasiswa
        'nama' => 'required',
        'no_wa' => 'required',
        'kelas_praktikum' => 'required'
    ]);

    // Simpan mahasiswa di tabel mahasiswa
    Mahasiswa::create($request->all());

    return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil ditambahkan');
}

    // Show form to edit existing mahasiswa
    public function edit(User $mahasiswa)
    {
        return view('mahasiswa.editmhs', compact('mahasiswa'));
    }

    // Update mahasiswa
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $request->validate([
            'nim' => 'required|unique:mahasiswa,nim,' . $mahasiswa->id, // Pastikan validasi nim di tabel mahasiswa
            'nama' => 'required',
            'no_wa' => 'required',
            'kelas_praktikum' => 'required'
        ]);
    
        $mahasiswa->update($request->all());
    
        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil diperbarui');
    }


    // Delete mahasiswa
    public function destroy(User $mahasiswa)
    {
        $mahasiswa->delete();

        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil dihapus');
    }
}
