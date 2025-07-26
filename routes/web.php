<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\PeminjamController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardUserController;
use App\Http\Controllers\DashboardAdminController;

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
    Route::get('/dashboard_user', [DashboardUserController::class, 'index'])->name('dashboard_user');

    // Dashboard Admin
    Route::get('/dashboard_admin', [DashboardAdminController::class, 'index'])->name('dashboard_admin');

    // Profile (User & Admin)
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    // Data Barang untuk User
    Route::get('/data_barang', [BarangController::class, 'indexUser'])->name('data_barang');

    // Data Barang untuk Admin
    Route::get('/data_barang_admin', [BarangController::class, 'index'])->name('data_barang_admin');
    Route::get('/tambah_barang', [BarangController::class, 'create'])->name('tambah_barang');
    Route::post('/tambah_barang', [BarangController::class, 'store'])->name('tambah_barang.store');
    Route::get('/barang/{id}/edit', [BarangController::class, 'edit'])->name('barang.edit');
    Route::put('/barang/{id}', [BarangController::class, 'update'])->name('barang.update');
    Route::delete('/barang/{id}', [BarangController::class, 'destroy'])->name('barang.destroy');

    // Data Peminjam (Admin)
    Route::get('/data_peminjam', [PeminjamController::class, 'index'])->name('data_peminjam');
    Route::get('/tambah_peminjam', [PeminjamController::class, 'create'])->name('tambah_peminjam');
    Route::post('/tambah_peminjam', [PeminjamController::class, 'store'])->name('tambah_peminjam.store');

    // Daftar transaksi peminjaman (User)
    Route::get('/transaksi_peminjaman', [PeminjamanController::class, 'index'])->name('transaksi_peminjaman');
    Route::get('/pinjam_barang', [PeminjamanController::class, 'create'])->name('pinjam_barang');
    Route::post('/pinjam_barang', [PeminjamanController::class, 'store'])->name('pinjam_barang.store');
    Route::delete('/peminjaman/{id}/cancel', [PeminjamanController::class, 'cancel'])->name('peminjaman.cancel');
    Route::get('/peminjaman/{id}/detail', [PeminjamanController::class, 'show'])->name('peminjaman.detail');

    // Transaksi Peminjaman Admin (daftar & aksi setujui/tolak)
    Route::get('/transaksi_peminjaman_admin', [PeminjamanController::class, 'indexAdmin'])->name('transaksi_peminjaman_admin');
    Route::post('/peminjaman/{id}/approve', [PeminjamanController::class, 'approve'])->name('peminjaman.approve');
    Route::post('/peminjaman/{id}/reject', [PeminjamanController::class, 'reject'])->name('peminjaman.reject');

    // Laporan Peminjaman
    Route::get('/laporan_peminjaman', function () {
        return view('laporan_peminjaman');
    })->name('laporan_peminjaman');

    // Laporan Pengembalian
    Route::get('/laporan_pengembalian', function () {
        return view('laporan_pengembalian');
    })->name('laporan_pengembalian');

    // Laporan Pengembalian Admin
    Route::get('/laporan_pengembalian_admin', [PeminjamanController::class, 'laporanPengembalian'])->name('laporan_pengembalian_admin');
    Route::post('/pengembalian/{id}/konfirmasi', [PeminjamanController::class, 'konfirmasiPengembalian'])->name('pengembalian.konfirmasi');

});