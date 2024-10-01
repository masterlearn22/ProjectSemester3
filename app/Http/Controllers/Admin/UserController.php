<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        
        $users = User::with('jenisUser')->get();
        return view('admin.index', compact('users'));
    }

    public function create()
    {
        $roles = DB::table('JENIS_USER')->get(); // Mengambil data role dari tabel JENIS_USER
        return view('admin.create', compact('roles')); // Arahkan ke view tambah_user
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:60',
            'username' => 'required|string|max:60|unique:users',
            'no_hp' => 'required',
            'wa' => 'required',
            'pin' => 'required',
            'password' => 'required|string|min:8',
            'email' => 'required|email|max:60|unique:users',
            'ID_JENIS_USER' => 'required|exists:JENIS_USER,ID_JENIS_USER'
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'no_hp' => $request->no_hp,
            'wa' => $request->wa,
            'pin' => $request->wa,
            'password' => Hash::make($request->password), // Enkripsi password
            'email' => $request->email,
            'ID_JENIS_USER' => $request->ID_JENIS_USER // Menyimpan role yang dipilih
        ]);

        return redirect()->route('admin.index')->with('success', 'User berhasil ditambahkan.');
    
    }

    public function edit(User $user)
    {
        $role = DB::table('JENIS_USER')->get();
        return view('admin.edit', compact('user','role'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:60',
            'username' => 'required|string',
            'email' => 'required|string',
            'ID_JENIS_USER' => 'required|exists:JENIS_USER,ID_JENIS_USER' // Validasi untuk role
        ]);
    
        // Update user data             
        $user->update([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'ID_JENIS_USER' => $request->ID_JENIS_USER // Update role
        ]);
    
        return redirect()->route('admin.index')->with('success', 'User updated successfully.');
        
    }
    

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.index')->with('success', 'User deleted successfully.');
    }

}