<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Message;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\MessageCategory;
use App\Models\MessageDocument;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index()
    {
        // Ambil pesan yang diterima
        $receivedMessages = Message::where('recipient_email', Auth::user()->email)->get();
        
        // Ambil pesan yang dikirim
        $sentMessages = Message::where('sender', Auth::user()->email)->get();
        
        return view('messages.index', compact('receivedMessages', 'sentMessages'));
    }
    
    

    public function create()
    {
        $categories = MessageCategory::all();
        $users = User::all(); 
        return view('messages.create', compact('categories','users'));
    }
    // Validasi data input
    public function store(Request $request)
    {
        
        try {
            // Validasi data input
            $validated = $request->validate([
                'sender' => 'required|string|max:30',
                'subject' => 'required|string|max:300',
                'message_text' => 'required',
                'message_status' => 'required|string',
                'no_mk' => 'required',
                'create_by' => 'required|string',
                'message_reference' => 'nullable|string',
                'recipient_email' => 'required|exists:users,email', // Periksa email penerima
                'file.*' => 'mimes:jpg,jpeg,png,pdf,doc,docx,zip' // Batasi tipe file dan ukuran file
            ]);
    
            // Buat message baru
            $message = Message::create([
                'message_id' => Str::random(10),
                'sender' => Auth::user()->email,
                'subject' => $validated['subject'],
                'message_text' => $validated['message_text'],
                'message_status' => $validated['message_status'],
                'no_mk' => $validated['no_mk'],
                'create_date' => now(),
                'message_reference' => $validated['message_reference'] ?? null,
                'recipient_email' => $validated['recipient_email'],
                'update_by' => Auth::user()->email,
                'updated_at' => now(),
            ]);
    
            // Simpan lampiran jika ada
            if ($request->hasFile('file')) {
                foreach ($request->file('file') as $file) {
                    // Simpan file ke direktori public/storage atau sesuai kebutuhan
                    $filePath = $file->store('message_documents', 'public'); // Simpan di folder 'message_documents'
    
                    // Simpan data lampiran ke tabel message_documents
                    MessageDocument::create([
                        'no_mdok' => Str::random(10), // Buat ID dokumen
                        'file' => $filePath,
                        'description' => $file->getClientOriginalName(), // Nama asli file
                        'message_id' => $message->message_id, // Gunakan message_id dari pesan yang baru disimpan
                        'create_by' => Auth::user()->name, // Pengguna yang membuat
                        'create_date' => now(),
                        'update_by' => Auth::user()->name,
                    ]);
                }
            }
    
            return redirect()->route('messages.index')->with('success', 'Pesan berhasil dikirim dengan lampiran!');
        } catch (\Exception $e) {
            
            dd($e->getMessage()); // Debugging
        }
    }



    public function show($id)
    {
        // Ambil pesan beserta kategori dan dokumen
        $message = Message::with('category', 'documents')->find($id);
    
        // Cek apakah pengguna yang sedang login adalah pengirim atau penerima
        if ($message->sender !== Auth::user()->email && $message->recipient_email !== Auth::user()->email) {
            abort(403, 'Unauthorized action.');
        }
    
        return view('messages.show', compact('message'));
    }
    
    

    public function edit($id)
    {
        $message = Message::find($id);
        $categories = MessageCategory::all();
        return view('messages.edit', compact('message', 'categories'));
    }

    public function update(Request $request, $id)
{
    $message = Message::find($id);

    // Update pesan
    $message->update($request->all());

    // Proses pembaruan file
    if ($request->hasFile('file')) {
        foreach ($request->file('file') as $file) {
            // Simpan file ke direktori public/storage atau sesuai kebutuhan
            $filePath = $file->store('message_documents', 'public'); // Simpan di folder 'message_documents'
            
            // Simpan data lampiran ke tabel message_documents
            MessageDocument::create([
                'no_mdok' => Str::random(10), // Buat ID dokumen
                'file' => $filePath,
                'description' => $file->getClientOriginalName(), // Nama asli file
                'message_id' => $message->message_id, // Gunakan message_id dari pesan yang baru disimpan
                'create_by' => Auth::user()->name, // Pengguna yang membuat
                'create_date' => now(),
                'update_by' => Auth::user()->name,
            ]);
        }
    }

    return redirect()->route('messages.index')->with('success', 'Pesan berhasil diperbarui dengan lampiran!');
}



    public function destroy($id)
    {
        $message = Message::find($id);
        $message->delete();
        return redirect()->route('messages.index');
    }
}
