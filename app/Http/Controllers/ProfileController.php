<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    /**
     * Menampilkan halaman profil pengguna.
     */
    public function index()
    {
        $user = Auth::user();
        return view('profile.index', compact('user'));
    }

    /**
     * Menampilkan halaman edit profil.
     */
    public function edit($id)
    {
        // Pastikan ID pengguna cocok dengan yang sedang login
        $user = Auth::user();
        if ($user->ID_USER != $id) {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk mengedit profil ini.');
        }

        // Menampilkan view edit profile dengan data pengguna
        return view('profile.edit', compact('user'));
    }

    /**
     * Memperbarui profil pengguna.
     */
    public function update(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);
            
            Log::info('User ID:', [
                'id_parameter' => $id,
                'user_id' => $user->ID_USER,
                'auth_id' => Auth::id(),
                'current_email' => $user->email,
                'new_email' => $request->email
            ]);
    
            // Validasi email secara terpisah
            if ($request->email !== $user->email) {
                $request->validate([
                    'email' => 'required|email|max:255|unique:users,email'
                ]);
            }
    
            // Validasi untuk field lainnya
            $request->validate([
                'name' => 'required|string|max:255',
                'username' => 'required|string|max:255|unique:users,username,'.$user->ID_USER.',ID_USER',
                'no_hp' => 'nullable|string|max:15',
                'wa' => 'nullable|string|max:15',
                'password' => 'nullable|confirmed|min:8',
                'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
    
            // Update data
            $user->name = $request->name;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->no_hp = $request->no_hp;
            $user->wa = $request->wa;
    
            // Handle password
            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }
    
            // Handle profile photo
            if ($request->hasFile('profile_photo')) {
                if ($user->profile_photo) {
                    Storage::disk('public')->delete($user->profile_photo);
                }
                $path = $request->file('profile_photo')->store('profile_photos', 'public');
                $user->profile_photo = $path;
            }
    
            $user->save();
    
            Log::info('Profile updated successfully', ['user_id' => $user->ID_USER]);
            return redirect()->route('profile.index')->with('success', 'Profile updated successfully');
    
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation error: ' . json_encode($e->errors()));
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput();
        } catch (\Exception $e) {
            Log::error('Error updating profile: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Failed to update profile: ' . $e->getMessage())
                ->withInput();
        }
    }
}