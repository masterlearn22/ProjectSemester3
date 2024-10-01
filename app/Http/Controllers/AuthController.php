<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function TampilanRegistrasi(){
        $role = DB::table('JENIS_USER')->get();
        return view('auth.register', compact('role'));
    }
    public function Registrasi(Request $request){
        $request->validate([
            'username' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'no_hp' => 'required',
            'wa' => 'required',
            'pin' => 'required',
            'ID_JENIS_USER' => 'required|exists:JENIS_USER,ID_JENIS_USER'
        ]);
        
        // Membuat pengguna baru
        $user = User::create([
            'username' => $request->username,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'no_hp' => $request->no_hp,
            'wa' => $request->wa,
            'pin' => $request->pin,
            'ID_JENIS_USER' => $request->ID_JENIS_USER
        ]);
    
        Auth::login($user);
    
        if ($user->save()) {
            // Mengambil nama JENIS_USER berdasarkan ID_JENIS_USER
            $jenisUser = DB::table('JENIS_USER')->where('ID_JENIS_USER', $user->ID_JENIS_USER)->value('jenis_user');
            
            // Menyimpan nama JENIS_USER ke dalam session
            session(['JENIS_USER' => $jenisUser]);
    
            return redirect()->intended('dashboard');
        } else {
            return back()->withErrors(['message' => 'Failed to create user']);
        }
    }
    

    public function TampilanLogin(){
        return view('auth.login');
    }

    public function login(Request $request){
        $credentials = $request->validate([
            'email' => ['required', 'string','email'],
            'password' => ['required', 'string'],
        ]);  
    
        if(Auth::attempt($credentials)){
            // Simpan session untuk 'name' dan 'JENIS_USER'
            session(['name' => Auth::user()->name]);
    
            // Mengambil nama JENIS_USER berdasarkan ID_JENIS_USER
            $jenisUser = DB::table('JENIS_USER')->where('ID_JENIS_USER', Auth::user()->ID_JENIS_USER)->value('jenis_user');
            
            // Menyimpan nama JENIS_USER ke dalam session
            session(['JENIS_USER' => $jenisUser]);
    
            // Regenerasi session ID untuk keamanan
            $request->session()->regenerate();
    
            return redirect()->route('menu.dashboard');
        } else {
            return back()->withErrors(['message' => 'Login failed']);
        }
    }
    

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('login');
    }
}
