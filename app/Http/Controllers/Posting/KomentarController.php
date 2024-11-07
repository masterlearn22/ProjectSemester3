<?php

namespace App\Http\Controllers\Posting;

use App\Http\Controllers\Controller;

use App\Models\Posting;
use App\Models\PostingKomentar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class KomentarController extends Controller
{
    public function store(Request $request) {
        
        // Validasi input
        $request->validate([
            'posting_id' => 'required|exists:posting,posting_id',
            'komentar_text' => 'required',
        ]);
    
        // Simpan komentar
        PostingKomentar::create([
            'komen_id' => Str::random(30),  
            'posting_id' => $request->posting_id,
            'id_user' => Auth::user()->ID_USER, // Ambil ID_USER dari user yang login
            'komentar_text' => $request->komentar_text,
            'komentar_gambar' => $request->komentar_gambar ?? 'no',
            'create_by' => Auth::user()->name,
            'create_date' => now(), // Menggunakan create_date untuk kolom tanggal
        ]);        
    
        // Redirect setelah berhasil menyimpan komentar
        return redirect()->route('postings.index');
    }

    public function destroy($id) {
        // Cari komentar berdasarkan komen_id
        $comment = PostingKomentar::where('komen_id', $id)->first();
        $comment->update(['delete_mark' => '1']);

        return redirect()->route('postings.index')->with('success', 'Komentar berhasil dihapus!');
    }
}
