<?php

namespace App\Http\Controllers;

use App\Models\Posting;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PostingController extends Controller
{
    public function index()
    {
        // Menggunakan select kolom yang diperlukan untuk optimasi
        $posts = Posting::with(['user:ID_USER,name,profile_photo,name,name', 'komentar' => function ($query) {
            $query->orderBy('create_date', 'desc');
        }, 'komentar.user:ID_USER,name'])
        ->where('delete_mark', '0')
        ->orderBy('create_date', 'desc')
        ->paginate(10, ['posting_id', 'message_text', 'message_gambar', 'create_date', 'sender']);
        
    
        $user = Auth::user();
    
        return view('postings.index', compact('posts', 'user'));
    }
    

    public function create()
    {
        return view('postings.create');
    }
    
    public function store(Request $request)
    {
        Log::info('Memulai proses store');
        Log::info('Request data:', $request->all());
        Log::info('Files:', $request->allFiles());

        // Menggunakan validate bawaan Laravel untuk validasi input
        $request->validate([
            'message_text' => 'required',
            'message_gambar' => 'nullable|array|max:10',
            'message_gambar.*' => 'image|mimes:jpeg,png,jpg,gif',
        ]);

        if (Auth::check()) {
            DB::beginTransaction();

            try {
                $gambarPathArray = [];
                if ($request->hasFile('message_gambar')) {
                    foreach ($request->file('message_gambar') as $file) {
                        // Simpan gambar ke folder attachments di storage public
                        $gambarPath = $file->store('attachments', 'public');
                        $gambarPathArray[] = $gambarPath;
                    }
                }

                // Simpan posting baru
                $posting = Posting::create([
                    'posting_id' => Str::random(30),
                    'sender' => Auth::id(),
                    'message_text' => $request->message_text,
                    'message_gambar' => !empty($gambarPathArray) ? json_encode($gambarPathArray) : null, // Simpan gambar sebagai JSON
                    'create_by' => Auth::id(),
                    'create_date' => now(),
                ]);

                DB::commit();
                Log::info('Posting berhasil dibuat: ', $posting->toArray());
                return redirect()->route('postings.index')->with('success', 'Posting berhasil dibuat.');
            } catch (\Throwable $e) {
                DB::rollBack();
                Log::error('Gagal membuat posting: ' . $e->getMessage());
                Log::error('Stack trace: ' . $e->getTraceAsString());
                return back()->with('error', 'Terjadi kesalahan saat membuat posting: ' . $e->getMessage());
            }
        }
        
        return back();
    }

    public function edit($id)
    {
        $post = Posting::findOrFail($id);

        // Authorization: hanya pemilik posting yang bisa mengedit
        if ((int)$post->sender !== Auth::user()->ID_USER) {
            return redirect()->route('postings.index')->with('error', 'Anda tidak memiliki izin untuk mengedit posting ini.');
        }

        // Decode gambar untuk ditampilkan pada view
        $gambarPathArray = json_decode($post->message_gambar, true);

        return view('postings.edit', compact('post', 'gambarPathArray'));
    }

    public function update(Request $request, $id)
    {
        $post = Posting::findOrFail($id);

        // Authorization: hanya pemilik posting yang bisa mengedit
        if ((int)$post->sender !== Auth::user()->ID_USER) {
            return redirect()->route('postings.index')->with('error', 'Anda tidak memiliki izin untuk mengedit posting ini.');
        }

        // Validasi input
        $request->validate([
            'message_text' => 'required',
            'message_gambar' => 'nullable|array|max:10',
            'message_gambar.*' => 'image|mimes:jpeg,png,jpg,gif',
        ]);

        try {
            // Mendapatkan gambar yang sudah ada
            $gambarPathArray = json_decode($post->message_gambar, true) ?? [];

            // Hapus gambar yang dipilih
            if ($request->has('delete_gambar') && !empty($request->input('delete_gambar'))) {
                foreach ($request->input('delete_gambar') as $gambar) {
                    if (Storage::exists('public/' . $gambar)) {
                        Storage::delete('public/' . $gambar);
                        $gambarPathArray = array_diff($gambarPathArray, [$gambar]);
                    }
                }
            }

            // Unggah gambar baru
            if ($request->hasFile('message_gambar')) {
                foreach ($request->file('message_gambar') as $file) {
                    $gambarPath = $file->store('attachments', 'public');
                    $gambarPathArray[] = $gambarPath;
                }
            }

            // Update posting
            $post->update([
                'message_text' => $request->message_text,
                'message_gambar' => !empty($gambarPathArray) ? json_encode($gambarPathArray) : null,
                'update_by' => Auth::id(),
                'update_date' => now(),
            ]);

            return redirect()->route('postings.index')->with('success', 'Posting berhasil diperbarui.');
        } catch (\Throwable $e) {
            return back()->with('error', 'Terjadi kesalahan saat memperbarui posting: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $post = Posting::findOrFail($id);

        // Authorization: hanya pemilik posting yang bisa menghapus
        if ((int)$post->sender !== Auth::user()->ID_USER) {
            return redirect()->route('postings.index')->with('error', 'Anda tidak memiliki izin untuk menghapus posting ini.');
        }

        try {
            $post->update([
                'delete_mark' => '1',
                'update_by' => Auth::id(),
                'update_date' => now(),
            ]);

            Log::info('Posting berhasil dihapus');
            return redirect()->route('postings.index')->with('success', 'Posting berhasil dihapus.');
        } catch (\Throwable $e) {
            Log::error('Gagal menghapus posting: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat menghapus posting.');
        }
    }
}
