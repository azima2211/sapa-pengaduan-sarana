<?php

use App\Http\Controllers\AspirasiController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [AspirasiController::class, 'dashboard'])->name('dashboard');

    // Menu Pelapor
    Route::get('/aspirasi/kirim', [AspirasiController::class, 'create'])->name('aspirasi.create');
    Route::post('/aspirasi/kirim', [AspirasiController::class, 'store'])->name('aspirasi.store');
    Route::get('/aspirasi/riwayat', [AspirasiController::class, 'riwayat'])->name('aspirasi.riwayat');

    // Menu Administrator
    Route::get('/admin/aspirasi', [AspirasiController::class, 'indexAdmin'])->name('aspirasi.admin');
    Route::patch('/admin/aspirasi/{aspirasi}', [AspirasiController::class, 'updateStatus'])->name('aspirasi.update');
});