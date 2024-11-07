<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\AksesMenuController;
use App\Http\Controllers\JenisUserController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Posting\LikeController;
use App\Http\Controllers\Posting\PostingController;
use App\Http\Controllers\Posting\KomentarController;
use App\Http\Controllers\Transaksi\EmitenController;
use App\Http\Controllers\Transaksi\DashboardController;
use App\Http\Controllers\Transaksi\TransaksiHarianController;

 // Alias untuk EmitenController

// Route untuk AuthController (Login, Logout, Register)
Route::post('/simpanregist', [AuthController::class, 'Registrasi']);
Route::get('/register', [AuthController::class, 'TampilanRegistrasi']);
Route::post('/simpanlogin', [AuthController::class, 'login']);
Route::get('/', [AuthController::class, 'Tampilanlogin']);
Route::get('/login', [AuthController::class, 'Tampilanlogin']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [MenuController::class, 'dashboard'])->name('menu.dashboard');
    Route::resource('chats', ChatController::class);
    Route::resource('messages', MessageController::class);
    Route::resource('admin', UserController::class);
    Route::resource('kategori', KategoriController::class);
    Route::resource('jenis_user', JenisUserController::class);
    Route::resource('menu', MenuController::class);
    Route::resource('profile', ProfileController::class);
    Route::resource('aksesMenu', AksesMenuController::class);
    Route::resource('postings', PostingController::class);
    Route::resource('likes', LikeController::class)->only(['store', 'destroy']);
    Route::resource('comments', KomentarController::class)->only(['store', 'destroy']);
    Route::resource('mahasiswa', MahasiswaController::class);
    Route::resource('buku', BukuController::class);
    Route::resource('emiten', EmitenController::class);
    Route::resource('transaksi_harian', TransaksiHarianController::class);
    Route::get('/grafik', [DashboardController::class, 'index'])->name('grafik.index');

});
Route::get('/infogempa', function () {
    return view('tambahan.infogempa');
});
Route::get('/admintest', [UserController::class, 'test']);



