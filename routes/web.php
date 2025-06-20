<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\BarangController;

Route::get('/', function () {
    return view('login');
});

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

// PROTECTED ROUTES (hanya untuk user login & admin)
Route::middleware('auth')->group(function () {
    // Dashboard User
    Route::get('/dashboard_user', function () {
        return view('dashboard_user');
    })->name('dashboard_user');

    // Dashboard Admin
    Route::get('/dashboard_admin', function () {
        return view('dashboard_admin');
    })->name('dashboard_admin');

    // Data Barang untuk User
    Route::get('/data_barang', function () {
        return view('data_barang');
    })->name('data_barang');

    // Data Barang untuk Admin
    Route::get('/data_barang_admin', [BarangController::class, 'index'])->name('data_barang_admin');
    Route::get('/tambah_barang', [BarangController::class, 'create'])->name('tambah_barang');
    Route::post('/tambah_barang', [BarangController::class, 'store'])->name('tambah_barang.store');
    Route::get('/barang/{id}/edit', [BarangController::class, 'edit'])->name('barang.edit');
    Route::put('/barang/{id}', [BarangController::class, 'update'])->name('barang.update');
    Route::delete('/barang/{id}', [BarangController::class, 'destroy'])->name('barang.destroy');

    // Form tambah barang (Admin)
    Route::get('/tambah_barang', function () {
        return view('tambah_barang');
    })->name('tambah_barang');

    // Daftar transaksi peminjaman
    Route::get('/transaksi_peminjaman', [PeminjamanController::class, 'index'])->name('transaksi_peminjaman');
    // Form pinjam barang
    Route::get('/pinjam_barang', [PeminjamanController::class, 'create'])->name('pinjam_barang');
    // Proses simpan pinjam barang
    Route::post('/pinjam_barang', [PeminjamanController::class, 'store'])->name('pinjam_barang.store');
});