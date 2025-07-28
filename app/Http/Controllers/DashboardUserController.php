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
        $totalPeminjaman = Peminjaman::where('status', 'Disetujui')->count();

        // Notifikasi: status Disetujui/Ditolak, urut terbaru, max 10, hanya yang belum dibaca
        $notifs = Peminjaman::where('nama_peminjam', $user->name)
            ->whereIn('status', ['Disetujui', 'Ditolak'])
            ->where('dibaca', false)
            ->orderBy('updated_at', 'desc')
            ->take(10)
            ->get();

        return view('dashboard_user', [
            'totalBarang' => $totalBarang,
            'totalPeminjaman' => $totalPeminjaman,
            'full_name' => $user->name,
            'notifs' => $notifs,
        ]);
    }

    // Tandai notifikasi telah dibaca dan redirect ke transaksi_peminjaman
    public function bacaNotifikasi($id)
    {
        $user = Auth::user();
        $notif = Peminjaman::where('id', $id)
            ->where('nama_peminjam', $user->name)
            ->firstOrFail();
        $notif->dibaca = true;
        $notif->save();
        return redirect()->route('transaksi_peminjaman');
    }
}