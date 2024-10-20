<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Menampilkan halaman edit profil.
     */

    public function index()
     {
         $user = Auth::user();
         return view('profile.index', compact('user'));
     }
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
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Anda harus login untuk mengedit profil.');
        }

        $validatedData = $request->validate([
            'name' => 'required',
            'username' => 'required',
            'email' => 'required|email',
            'no_hp' => 'nullable|string|max:15',
            'wa' => 'nullable|string|max:15',
            'password' => 'nullable|confirmed|min:8',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->no_hp = $request->no_hp;
        $user->wa = $request->wa;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        if ($request->hasFile('profile_photo')) {
            // Hapus foto lama jika ada
            if ($user->profile_photo) {
                Storage::disk('public')->delete($user->profile_photo);
            }

            // Upload foto baru
            $path = $request->file('profile_photo')->store('profile_photos', 'public');
            $user->profile_photo = $path;
        }

        try {
            $user->save();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui profil: ' . $e->getMessage());
        }

        return redirect()->intended('dashboard')->with('success', 'Profil berhasil diperbarui.');
    }
       
    }

