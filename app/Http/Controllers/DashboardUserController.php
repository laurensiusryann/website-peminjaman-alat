<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\Auth;

class DashboardUserController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Total barang
        $totalBarang = Barang::count();

        // Peminjaman aktif (Disetujui, belum dikembalikan)
        $totalPeminjaman = Peminjaman::where('nama_peminjam', $user->name)
                                    ->where('status', 'Disetujui')
                                    ->whereNull('tanggal_kembali')
                                    ->count();

        return view('dashboard_user', compact('totalBarang', 'totalPeminjaman'));
    }
}
