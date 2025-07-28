<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Barang;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    // Tampilkan daftar peminjaman untuk user (dengan search)
    public function index(Request $request)
    {
        $user = Auth::user();
        $q = $request->query('q');
        $peminjaman = Peminjaman::where('nama_peminjam', $user->name)
            ->when($q, function($query) use ($q) {
                $query->where('nama_barang', 'like', "%$q%")
                      ->orWhere('status', 'like', "%$q%");
            })
            ->orderBy('created_at', 'desc')
            ->get();

        // Notifikasi: status Disetujui/Ditolak, urut terbaru, max 10
        $notifs = Peminjaman::where('nama_peminjam', $user->name)
            ->whereIn('status', ['Disetujui', 'Ditolak'])
            ->orderBy('updated_at', 'desc')
            ->take(10)
            ->get();

        return view('transaksi_peminjaman', [
            'peminjaman' => $peminjaman,
            'full_name' => $user->name,
            'notifs' => $notifs,
            'q' => $q,
        ]);
    }

    // Tampilkan daftar peminjaman untuk admin
    public function indexAdmin()
    {
        $peminjaman = Peminjaman::latest()->get();
        return view('transaksi_peminjaman_admin', compact('peminjaman'));
    }

    // Tampilkan form pinjam barang
    public function create()
    {
        $barangs = Barang::all();
        return view('pinjam_barang', compact('barangs'));
    }

    // Proses simpan peminjaman baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_peminjam' => 'required',
            'tanggal_pinjam' => 'required|date',
            'nama_barang' => 'required',
            'jumlah' => 'required|integer|min:1',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
            'tujuan' => 'required',
        ]);

        Peminjaman::create([
            'nama_peminjam' => $request->nama_peminjam,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'nama_barang' => $request->nama_barang,
            'jumlah' => $request->jumlah,
            'tanggal_kembali' => $request->tanggal_kembali,
            'tujuan' => $request->tujuan,
            'status' => 'Menunggu Konfirmasi',
        ]);

        return redirect()->route('transaksi_peminjaman')->with('success', 'Peminjaman berhasil diajukan!');
    }

    // Setujui peminjaman (admin)
    public function approve($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        $barang = Barang::where('nama_barang', $peminjaman->nama_barang)->first();
        if (!$barang || $barang->unit < $peminjaman->jumlah) {
            return redirect()->route('transaksi_peminjaman_admin')->with('error', 'Stok barang tidak mencukupi!');
        }

        $barang->unit -= $peminjaman->jumlah;
        $barang->save();

        $peminjaman->status = 'Disetujui';
        $peminjaman->save();
        return redirect()->route('transaksi_peminjaman_admin')->with('success', 'Peminjaman disetujui.');
    }

    // Tolak peminjaman (admin)
    public function reject($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->status = 'Ditolak';
        $peminjaman->save();
        return redirect()->route('transaksi_peminjaman_admin')->with('success', 'Peminjaman ditolak.');
    }

    // Batalkan peminjaman (user)
    public function cancel($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        if ($peminjaman->status == 'Menunggu Konfirmasi') {
            $peminjaman->delete();
            return redirect()->route('transaksi_peminjaman')->with('success', 'Peminjaman berhasil dibatalkan.');
        }
        return redirect()->route('transaksi_peminjaman')->with('error', 'Peminjaman tidak dapat dibatalkan.');
    }

    // Tampilkan detail peminjaman (user)
    public function show($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $user = Auth::user();
        return view('detail_peminjaman', [
            'peminjaman' => $peminjaman,
            'full_name' => $user->name,
        ]);
    }
    
    // Laporan Pengembalian (Admin)
    public function laporanPengembalian()
    {
        $peminjaman = Peminjaman::where('status', 'Disetujui')->get();
        return view('laporan_pengembalian_admin', compact('peminjaman'));
    }

    // Konfirmasi Pengembalian
    public function konfirmasiPengembalian($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        $barang = Barang::where('nama_barang', $peminjaman->nama_barang)->first();
        if ($barang) {
            $barang->unit += $peminjaman->jumlah;
            $barang->save();
        }

        $peminjaman->status = 'Dikembalikan';
        $peminjaman->tanggal_kembali = now();
        $peminjaman->save();

        return redirect()->route('laporan_pengembalian_admin')->with('success', 'Pengembalian berhasil dikonfirmasi.');
    }
}