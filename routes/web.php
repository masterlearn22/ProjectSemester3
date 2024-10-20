<?php

// use App\Http\Controllers\AuthController;
// use App\Http\Controllers\BukuController;
// use App\Http\Controllers\Halaman;
// use App\Http\Controllers\MahasiswaController;
// use App\Http\Controllers\MenuController;
// use App\Http\Controllers\ProfileController;
// use App\Http\Controllers\SidebarController;
// use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\Admin\UserController;

// //Default dibuka
// Route::get('/', function () {
//     return view('auth.login');
// });

// //AuthController
// Route::post('/simpanregist', [AuthController::class, 'Registrasi']);
// Route::get('/register', [AuthController::class, 'TampilanRegistrasi']);
// Route::post('/simpanlogin', [AuthController::class, 'login']);
// Route::get('/login', [AuthController::class, 'Tampilanlogin']);
// Route::post('/logout', [AuthController::class, 'logout']);


// //menu
// Route::get('/dashboard', [MenuController::class, 'dashboard'])->name('menu.dashboard');
// Route::get('/sidebar', [MenuController::class, 'sidebar']);
// Route::get('/tambahbuku', [BukuController::class, 'tambahbuku']);;
// Route::get('/bacabuku', [BukuController::class, 'bacabuku']);;
// Route::post('/simpanbuku', [BukuController::class, 'createbook']);
// Route::get('/tambahmhs', [MahasiswaController::class, 'tambahmhs'])->middleware('auth');
// Route::post('/simpanmhs', [MahasiswaController::class, 'createmhs']);
// Route::get('/datamhs', [MahasiswaController::class, 'datamhs'])->middleware('auth');
// Route::get('/menu', [MenuController::class, 'index']);
// Route::get('/sidebar', [SidebarController::class, 'index']);

// //Profile
// Route::get('/profile/edit', [ProfileController::class, 'edit'])->middleware('auth')->name('profile.edit');
// Route::post('/profile/edit', [ProfileController::class, 'update'])->middleware('auth')->name('profile.update');

// //menu admin
// Route::middleware(['auth', 'admin'])->group(function () {
//     Route::get('/admin', [UserController::class, 'index'])->name('admin.index');                            // Users management routes
//     Route::get('/admin/users/tambah_user', [UserController::class, 'tambah_user'])->name('admin.create');   // Create route: Menampilkan form untuk membuat user baru
//     Route::post('/admin/users/simpan_user', [UserController::class, 'simpan_user'])->name('admin.store');   // Store route: Menyimpan data user baru
//     Route::get('/admin/{user}/edit', [UserController::class, 'edit'])->name('admin.edit');                   // Edit route: Menampilkan form edit user
//     Route::put('/admin/{user}', [UserController::class, 'update'])->name('admin.update');                    // Update route: Memperbarui data user
//     Route::delete('/admin/{user}', [UserController::class, 'destroy'])->name('admin.destroy');               // Destroy route: Menghapus user
//     Route::get('/admin/{user}', [UserController::class, 'show'])->name('admin.show');                        // Show route (optional): Menampilkan detail user (jika diperlukan)
// });

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PostingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KomentarController;
use App\Http\Controllers\AksesMenuController;
use App\Http\Controllers\JenisUserController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\Admin\UserController;

// Default route untuk login
Route::get('/', function () {
    return view('auth.login');
});

// Route untuk AuthController (Login, Logout, Register,Profile)
Route::post('/simpanregist', [AuthController::class, 'Registrasi']);
Route::get('/register', [AuthController::class, 'TampilanRegistrasi']);
Route::post('/simpanlogin', [AuthController::class, 'login']);
Route::get('/login', [AuthController::class, 'Tampilanlogin']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::get('/profile', [ProfileController::class,'index'])->name('profile.index');
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

// Route yang bisa dibuka
Route::get('/dashboard', [MenuController::class, 'dashboard'])->name('menu.dashboard');
Route::get('/bacabuku', [BukuController::class, 'bacabuku']);


// Mengelola rute posting dengan resource
Route::middleware('auth')->group(function () {
    Route::resource('postings', PostingController::class);
});

// Mengelola rute komentar dengan resource (menghubungkan dengan postingan)
Route::middleware('auth')->group(function (){
Route::resource('comments', KomentarController::class)->only(['store', 'destroy']);
});
// Mengelola rute like dengan resource
Route::resource('likes', LikeController::class)->only(['store', 'destroy']);

Route::get('/infogempa', function () {
    return view('menu.infogempa');
});
Route::middleware('auth')->group(function () {
    Route::resource('chats', ChatController::class);
});
Route::resource('messages', MessageController::class);

// Route untuk Admin (akses hanya untuk admin)
Route::middleware(['auth','role:3,4'])->group(function () {
    Route::get('/admin', [UserController::class, 'index'])->name('admin.index');
    Route::get('/admin/users/tambah_user', [UserController::class, 'create'])->name('admin.create');
    Route::post('/admin/users/simpan_user', [UserController::class, 'store'])->name('admin.store');
    Route::get('/admin/{user}/edit', [UserController::class, 'edit'])->name('admin.edit');
    Route::put('/admin/{user}', [UserController::class, 'update'])->name('admin.update');
    Route::delete('/admin/{user}', [UserController::class, 'destroy'])->name('admin.destroy');
    Route::resource('mahasiswa', MahasiswaController::class);
    Route::post('mahasiswa/simpanmhs', [MahasiswaController::class, 'store'])->name('mahasiswa.store');
    Route::resource('kategori', KategoriController::class);
    Route::resource('jenis_user', JenisUserController::class);
    Route::get('/datamhs', [MahasiswaController::class, 'datamhs'])->name('datamhs');
    Route::resource('menu', MenuController::class);
    Route::resource('aksesMenu', AksesMenuController::class);
});

// Route untuk Mahasiswa (akses hanya untuk mahasiswa)
Route::middleware(['auth','role:2,4'])->group(function () {
    Route::get('/tambahbuku', [BukuController::class, 'tambahbuku']);
    
    Route::post('/simpanbuku', [BukuController::class, 'createbook']);
    
});



