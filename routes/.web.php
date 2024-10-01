<?php

use App\Http\Middleware\isUser;
use App\Http\Middleware\pengecekan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoriesController;

Route::get('/home', function () {
    return view('welcome');
})->name('home')->middleware('auth');

Route::prefix('bukus')->middleware(['auth', pengecekan::class])->name('bukus.')->group(function () {
    Route::get('/', [BukuController::class, 'index'])->name('index');
    Route::get('/create', [BukuController::class, 'create'])->name('create');
    Route::post('/', [BukuController::class, 'store'])->name('store');
    Route::get('/{buku}/edit', [BukuController::class, 'edit'])->name('edit');
    Route::put('/{buku}', [BukuController::class, 'update'])->name('update');
    Route::delete('/{buku}', [BukuController::class, 'destroy'])->name('destroy');
});

Route::prefix('user')->middleware(['auth', pengecekan::class])->name('user.')->group(function () {
    Route::get('/', [AuthController::class, 'index'])->name('index');
    Route::get('/create', [AuthController::class, 'create'])->name('create');
    Route::post('/', [AuthController::class, 'store'])->name('store');
    Route::get('/{user}/edit', [AuthController::class, 'edit'])->name('edit');
    Route::put('/user/update', [BukuController::class, 'update'])->name('update');
    Route::delete('/{user}', [AuthController::class, 'destroy'])->name('destroy');
});


Route::get('/login', [AuthController::class, 'indexlogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/logout', [AuthController::class, 'actionlogout'])->name('logout');
Route::get('/register', [AuthController::class, 'indexregister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');