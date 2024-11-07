<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\JenisUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AksesMenuController extends Controller
{
    public function index()
    {
        $menus = Menu::all();
        $menu = Menu::whereNull('DELETE_MARK')->get(); // Menampilkan semua data yang belum dihapus
        $jenis_user = JenisUser::all(); // Ambil semua data jenis user
        $allMenu = Menu::all();         // Ambil semua data menu
        
        // Ambil data akses menu dari tabel SETTING_MENU_USER
        $aksesMenu = DB::table('SETTING_MENU_USER')->get();

        return view('menu.index', compact('menu','menus','jenis_user', 'allMenu', 'aksesMenu'));
    }
    /**
     * Simpan data akses menu baru.
     */
    public function store(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'ID_JENIS_USER' => 'required|exists:JENIS_USER,ID_JENIS_USER',
            'MENU_ID' => 'required|exists:menu,MENU_ID',
        ]);

        // Cek apakah akses sudah ada di tabel SETTING_MENU_USER
        $existingAccess = DB::table('SETTING_MENU_USER')
            ->where('ID_JENIS_USER', $request->ID_JENIS_USER)
            ->where('MENU_ID', $request->MENU_ID)
            ->first();

        if ($existingAccess) {
            return redirect()->back()->with('error', 'Akses sudah ada untuk user dan menu tersebut.');
        }

        // Simpan akses baru ke tabel SETTING_MENU_USER
        DB::table('SETTING_MENU_USER')->insert([
            'MENU_ID' => $request->MENU_ID,
            'ID_JENIS_USER' => $request->ID_JENIS_USER,
            'NO_SETTING' => uniqid(), // Generate primary key untuk NO_SETTING
            'CREATE_BY' => Auth::user()->ID_USER, // ID user yang membuat
            'CREATE_DATE' => now(), // Tanggal pembuatan
            'DELETE_MARK' => '0', // Menandakan data aktif
        ]);

        return redirect()->back()->with('success', 'Akses menu berhasil ditambahkan.');
    }

    /**
     * Hapus akses menu.
     */
    public function destroy($id)
    {
        // Cari data di tabel SETTING_MENU_USER berdasarkan NO_SETTING
        $roleMenu = DB::table('SETTING_MENU_USER')->where('NO_SETTING', $id)->first();

        if ($roleMenu) {
            // Hapus data akses menu
            DB::table('SETTING_MENU_USER')->where('NO_SETTING', $id)->delete();
            return redirect()->back()->with('success', 'Akses menu berhasil dihapus.');
        }

        return redirect()->back()->with('error', 'Akses menu tidak ditemukan.');
    }
}
