<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Peminjaman;

class DashboardUserController extends Controller
{
    public function index()
    {
        $totalBarang = Barang::count();
        $totalPeminjaman = Peminjaman::count();

        return view('dashboard_user', compact('totalBarang', 'totalPeminjaman'));
    }
}
