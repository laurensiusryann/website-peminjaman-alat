<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Peminjaman;
use App\Models\User;

class DashboardAdminController extends Controller
{
    public function index()
    {
        $totalBarang = Barang::count();
        $totalPeminjaman = Peminjaman::where('status', 'Disetujui')->count();
        $totalPengembalian = Peminjaman::where('status', 'Disetujui')
                                        ->whereNotNull('tanggal_kembali')
                                        ->count();
        $totalAkun = User::count();

        return view('dashboard_admin', compact('totalBarang', 'totalPeminjaman', 'totalPengembalian', 'totalAkun'));
    }
}
