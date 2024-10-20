<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    // Menampilkan semua chat
    public function index()
    {
        $chats = Chat::with('user')->orderBy('created_at', 'asc')->get();
        return view('chat.index', compact('chats'));
    }

    // Menyimpan pesan baru
    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required',
        ]);

        Chat::create([
            'message' => $request->message,
            'ID_USER' => Auth::user()->ID_USER,
        ]);

        return redirect()->back();
    }

    // Mengedit pesan
    public function edit(Chat $chat)
    {
        return view('chat.edit', compact('chat'));
    }

    // Update pesan
    public function update(Request $request, Chat $chat)
    {
        $request->validate([
            'message' => 'required',
        ]);

        if ($chat->user_id == Auth::user()->ID_USER) {
            $chat->update([
                'message' => $request->message,
            ]);
        }

        return redirect()->route('chats.index');
    }

    // Menghapus pesan
    public function destroy(Chat $chat)
    {
        if ($chat->user_id == Auth::user()->ID_USER) {
            $chat->delete();
        }

        return redirect()->route('chats.index');
    }
}
