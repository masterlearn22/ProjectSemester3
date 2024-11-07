<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\User;
use App\Models\Kategori;
use App\Models\JenisUser;
use App\Models\KoleksiBuku;
use Illuminate\Http\Request;
use App\Models\SETTING_MENU_USER;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::all();
        $menu = Menu::with('settings.jenisUser')
                ->whereNull('DELETE_MARK')
                ->get(); // Menampilkan semua data menu yang belum dihapus
        $jenis_user = JenisUser::all(); // Ambil semua data jenis user
        $allMenu = Menu::all();         // Ambil semua data menu
        
        // Ambil data akses menu dari tabel SETTING_MENU_USER
        $aksesMenu = DB::table('SETTING_MENU_USER')->get();
        return view('menu.index', compact('menu','menus','jenis_user', 'allMenu', 'aksesMenu'));
    }


    public function dashboard(){
        return view('menu.dashboard');
    }

    public function create()
{
    $roles = JenisUser::all(); // Mengambil semua roles
    $selectedRoles = []; // Tidak ada role yang dipilih saat membuat menu baru
    $routes = collect(Route::getRoutes())->filter(function ($route) {
        return in_array('GET', $route->methods()); // Hanya menampilkan routes dengan metode GET
    })->map(function ($route) {
        return $route->uri();
    })->toArray();
    
    return view('menu.create', compact('roles', 'selectedRoles', 'routes'));
}

public function store(Request $request)
{
    $menu = Menu::create([
        'MENU_NAME' => $request->MENU_NAME,
        'MENU_LINK' => $request->MENU_LINK,
        'MENU_ICON' => $request->MENU_ICON,
        'CREATE_BY' => Auth::user()->name,
        'CREATE_DATE' => now(),
    ]);

    // Simpan roles yang dipilih
    $roles = $request->input('roles', []);
    foreach ($roles as $roleId) {
        SETTING_MENU_USER::create([
            'NO_SETTING' => uniqid(),
            'MENU_ID' => $menu->MENU_ID,
            'ID_JENIS_USER' => $roleId,
        ]);
    }
    

    return redirect()->route('menu.index')->with('success', 'Menu berhasil ditambahkan.');
}


    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        $roles = JenisUser::all(); // Mengambil semua roles
        $routes = collect(Route::getRoutes())->filter(function ($route) {
            return in_array('GET', $route->methods()); // Hanya menampilkan routes dengan metode GET
        })->map(function ($route) {
            return $route->uri();
        })->toArray();
        $selectedRoles = $menu->roles->pluck('ID_JENIS_USER')->toArray(); // Role yang saat ini terkait dengan menu
    
        return view('menu.edit', compact('menu', 'roles', 'selectedRoles','routes'));
    }
    

    public function update(Request $request, $id)
{
    $menu = Menu::findOrFail($id);
    
    // Simpan menu
    $menu->update($request->all());

    // Update roles yang terkait dengan menu
    $roles = $request->input('roles', []);

    // Hapus roles yang lama
    SETTING_MENU_USER::where('MENU_ID', $menu->MENU_ID)->delete();

    // Masukkan roles baru dengan NO_SETTING yang di-generate
    foreach ($roles as $roleId) {
        SETTING_MENU_USER::create([
            'NO_SETTING' => uniqid(20), // Buat NO_SETTING unik (atau gunakan mekanisme lain)
            'ID_JENIS_USER' => $roleId,
            'MENU_ID' => $menu->MENU_ID,
        ]);
    }

    return redirect()->route('menu.index')->with('success', 'Menu updated successfully.');
}


    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);
        $menu->update([
            'DELETE_MARK' => 'Y',
            'UPDATE_BY' => Auth::user()->ID_USER,
            'UPDATE_DATE' => now(),
        ]);

        return redirect()->route('menu.index')->with('success', 'Menu berhasil dihapus.');
    }
}
