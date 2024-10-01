<?php
namespace App\Http\Controllers;

use App\Models\Posting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostingController extends Controller
{
    public function index()
    {
        // Ambil semua postingan beserta user dan komentar (dengan user pada komentar)
        $posts = Posting::with(['user', 'komentar.user'])->where('delete_mark', '0')->get();

        return view('postings.index', compact('posts'));
    }

    public function create()
    {
        return view('postings.create');
    }

    public function store(Request $request)
    {
        // Validasi input termasuk validasi gambar
        $request->validate([
            'message_text' => 'required',
            'message_gambar.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi tipe file dan ukuran gambar
        ]);
    
        // Pastikan pengguna sudah login
        if (Auth::check()) {
            // Proses gambar
            $gambarPathArray = [];
            if ($request->hasFile('message_gambar')) {
                foreach ($request->file('message_gambar') as $file) {
                    // Simpan gambar ke storage/public/attachments dan simpan path
                    $gambarPath = $file->store('attachments', 'public');
                    $gambarPathArray[] = $gambarPath; // Tambahkan ke array path
                }
            }
    
            // Simpan data posting
            Posting::create([
                'posting_id' => Str::random(30), // ID unik
                'sender' => Auth::user()->ID_USER, // Ambil ID_USER dari Auth untuk kolom sender
                'message_text' => $request->message_text,
                'message_gambar' => json_encode($gambarPathArray), // Simpan path gambar dalam bentuk JSON
                'create_by' => Auth::user()->ID_USER, // Gunakan ID_USER untuk kolom create_by
                'create_date' => now(),
            ]);
    
            return redirect()->route('postings.index')->with('success', 'Posting berhasil dibuat.');
        } else {
            return redirect()->route('login')->with('error', 'Anda harus login untuk membuat posting.');
        }
    }
    

    public function edit($id)
    {
        // Ambil data posting berdasarkan ID
        $post = Posting::findOrFail($id);
    
        // Decode message_gambar jika disimpan dalam format JSON
        $gambarPathArray = json_decode($post->message_gambar, true) ?: [];
    
        return view('postings.edit', compact('post', 'gambarPathArray'));
    }
    

    public function update(Request $request, $id)
    {
        // Validasi input termasuk validasi gambar
        $request->validate([
            'message_text' => 'required',
            'message_gambar.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $post = Posting::findOrFail($id);
    
        // Proses gambar
        $gambarPathArray = json_decode($post->message_gambar, true) ?: [];
        if ($request->hasFile('message_gambar')) {
            foreach ($request->file('message_gambar') as $file) {
                $gambarPath = $file->store('attachments', 'public');
                $gambarPathArray[] = $gambarPath;
            }
        }
    
        // Update posting
        $post->update([
            'message_text' => $request->message_text,
            'message_gambar' => json_encode($gambarPathArray), // Simpan path gambar dalam bentuk JSON
            'update_by' => Auth::user()->ID_USER,
            'update_date' => now(),
        ]);
    
        return redirect()->route('postings.index')->with('success', 'Posting berhasil diupdate.');
    }
    

    public function destroy($id)
    {
        // Ambil data posting dan tandai sebagai dihapus
        $post = Posting::findOrFail($id);
        $post->update([
            'delete_mark' => '1',
            'update_by' => Auth::user()->ID_USER,
            'update_date' => now(),
        ]);

        return redirect()->route('postings.index')->with('success', 'Posting berhasil dihapus.');
    }
}
