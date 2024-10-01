<?php

// app/Http/Controllers/UserController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{


    public function profile()
    {
        if (Auth::check()) {
            $user = Auth::user();
            return view('profile.show', compact('user'));
        } else {
            return redirect()->route('login');
        }
    }

    public function editProfile()
    {
        if (Auth::check()) {
            $user = Auth::user();
            return view('profile.edit', compact('user'));
        } else {
            return redirect()->route('login');
        }
    }

    public function updateProfile(Request $request)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $user->DB::update('update users set votes = 100 where name = ?', ['John']);($request->all());
            return redirect()->route('profile')->with('success', 'Profile updated successfully');
        } else {
            return redirect()->route('login');
        }
    }

    public function deleteAccount()
    {
        if (Auth::check()) {
            $user = Auth::user();
            // Implementasi untuk menghapus akun user
            // Contohnya: $user->delete();
            // Tambahkan logika untuk menghapus data tambahan seperti setting menu user
            // Contohnya: SettingMenuUser::where('id_jenis_user', $user->id_jenis_user)->delete();
            // Tambahkan logika untuk menghapus data lainnya jika perlu

            // Redirect ke halaman login setelah akun dihapus
            Auth::logout();
            return redirect()->route('login')->with('success', 'Akun telah dihapus');
        } else {
            return redirect()->route('login');
        }
    }

}
