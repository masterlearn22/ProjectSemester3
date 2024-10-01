<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JenisUser;

class JenisUserController extends Controller
{
    public function index()
    {
        $jenisUsers = JenisUser::all();
        return view('jenis_user.index', compact('jenisUsers'));
    }

    public function create()
    {
        $jenisUser = JenisUser::all();
        return view('jenis_user.create', compact('jenisUser'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ID_JENIS_USER' => 'required|unique:jenis_user',
            'JENIS_USER' => 'required',
        ]);

        JenisUser::create([
            'ID_JENIS_USER' => $request->ID_JENIS_USER,
            'JENIS_USER' => $request->JENIS_USER,
            'CREATE_BY' => auth()->user()->name ?? 'system',
            'CREATE_DATE' => now(),
        ]);

        return redirect()->route('jenis_user.index')->with('success', 'Jenis User created successfully.');
    }

    public function edit($id)
    {
        $jenisUser = JenisUser::findOrFail($id);
        return view('jenis_user.edit', compact('jenisUser'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'JENIS_USER' => 'required',
        ]);

        $jenisUser = JenisUser::findOrFail($id);
        $jenisUser->update([
            'JENIS_USER' => $request->JENIS_USER,
            'UPDATE_BY' => auth()->user()->name ?? 'system',
            'UPDATE_DATE' => now(),
        ]);

        return redirect()->route('jenis_user.index')->with('success', 'Jenis User updated successfully.');
    }

    public function destroy($id)
    {
        $jenisUser = JenisUser::findOrFail($id);
        $jenisUser->update(['DELETE_MARK' => 'Y']);
        $jenisUser->delete();

        return redirect()->route('jenis_user.index')->with('success', 'Jenis User deleted successfully.');
    }
}
