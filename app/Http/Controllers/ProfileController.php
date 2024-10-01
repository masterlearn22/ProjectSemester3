<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Menampilkan halaman edit profil.
     */
    public function edit()
    {
        // Mengambil data pengguna yang sedang login
        $user = Auth::user();

        // Menampilkan view edit profile dengan data pengguna
        return view('profile.edit', compact('user'));
    }

    /**
     * Memperbarui profil pengguna.
     */
    public function update(Request $request)
    {
        // Mengambil data pengguna yang sedang login
        $user = Auth::user();
    
        // Memastikan pengguna terautentikasi
        if (!$user) {
            return redirect()->route('login')->with('error', 'Anda harus login untuk mengedit profil.');
        }
    
        // Validasi input form
        $validatedData = $request->validate([
            'name' => 'required',
            'username' => 'required',
            'email' => 'required',
            'no_hp' => 'nullable|string|max:15',
            'wa' => 'nullable|string|max:15',
            'password' => 'nullable|confirmed|min:8',
        ]);
    
        // Update data pengguna
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->no_hp = $request->no_hp;
        $user->wa = $request->wa;
    
        // Jika password diisi, lakukan hashing
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
    
        // Simpan perubahan ke database
        try {
            $user->save();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui profil: ' . $e->getMessage());
        }
    
        // Redirect setelah menyimpan
        return redirect()->intended('dashboard')->with('success', 'Profil berhasil diperbarui.');
    }


        
       
    }

