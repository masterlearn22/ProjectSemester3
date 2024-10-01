<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Halaman extends Controller
{
    public function dasboard(){
        return view('dasboard');
    }

    public function haladmin(){
        return view('Admin');
    }
}
