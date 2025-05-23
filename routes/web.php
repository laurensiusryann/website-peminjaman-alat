<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PeminjamanController;

// AUTH ROUTES
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

Route::get('/forgot_password', [AuthController::class, 'showForgot'])->name('password.request');
Route::post('/forgot_password', [AuthController::class, 'forgotPassword'])->name('password.forgot');

Route::get('/reset_password', [AuthController::class, 'showReset'])->name('password.reset');
Route::post('/reset_password', [AuthController::class, 'resetPassword'])->name('password.update');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// PROTECTED ROUTES (hanya untuk user login)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard_user', function () {
        return view('dashboard_user');
    })->name('dashboard_user');

    Route::get('/data_barang', function () {
        return view('data_barang');
    })->name('data_barang');

    // Daftar transaksi peminjaman
    Route::get('/transaksi_peminjaman', [PeminjamanController::class, 'index'])->name('transaksi_peminjaman');
    // Form pinjam barang
    Route::get('/pinjam_barang', [PeminjamanController::class, 'create'])->name('pinjam_barang');
    // Proses simpan pinjam barang
    Route::post('/pinjam_barang', [PeminjamanController::class, 'store'])->name('pinjam_barang.store');
});