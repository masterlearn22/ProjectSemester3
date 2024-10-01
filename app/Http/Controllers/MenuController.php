<?php

namespace App\Http\Controllers;

use App\Models\JenisUser;
use App\Models\Kategori;
use App\Models\KoleksiBuku;
use App\Models\Menu;
use App\Models\SETTING_MENU_USER;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        return view('menu.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'MENU_ID'=>'required',
            'MENU_NAME' => 'required',
            'MENU_LINK' => 'required',
            'MENU_ICON' => 'required',
        ]);

        Menu::create([
            'MENU_ID'=> $request->MENU_ID,
            'MENU_NAME' => $request->MENU_NAME,
            'MENU_LINK' => $request->MENU_LINK,
            'MENU_ICON' => $request->MENU_ICON,
            'CREATE_BY' => auth()->user()->id,
            'CREATE_DATE' => now(),
        ]);

        return redirect()->route('menu.index')->with('success', 'Menu berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        return view('menu.edit', compact('menu'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'MENU_NAME' => 'required',
            'MENU_LINK' => 'required',
            'MENU_ICON' => 'required',
        ]);

        $menu = Menu::findOrFail($id);
        $menu->update([
            'MENU_NAME' => $request->MENU_NAME,
            'MENU_LINK' => $request->MENU_LINK,
            'MENU_ICON' => $request->MENU_ICON,
            'UPDATE_BY' => auth()->user()->id,
            'UPDATE_DATE' => now(),
        ]);

        return redirect()->route('menu.index')->with('success', 'Menu berhasil diupdate.');
    }

    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);
        $menu->update([
            'DELETE_MARK' => 'Y',
            'UPDATE_BY' => auth()->user()->id,
            'UPDATE_DATE' => now(),
        ]);

        return redirect()->route('menu.index')->with('success', 'Menu berhasil dihapus.');
    }
}
