<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Barang;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjaman = Peminjaman::latest()->get();
        return view('transaksi_peminjaman', compact('peminjaman'));
    }

    public function create()
    {
        // Ambil semua barang yang sudah ditambahkan admin
        $barangs = Barang::all();
        return view('pinjam_barang', compact('barangs'));
    }

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

        // Cari barang berdasarkan nama_barang
        $barang = Barang::where('nama_barang', $request->nama_barang)->first();

        // Cek stok cukup
        if (!$barang || $barang->unit < $request->jumlah) {
            return back()->withErrors(['jumlah' => 'Stok barang tidak mencukupi!']);
        }

        // Kurangi stok barang
        $barang->unit -= $request->jumlah;
        $barang->save();

        // Simpan peminjaman
        Peminjaman::create([
            'nama_peminjam' => $request->nama_peminjam,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'nama_barang' => $request->nama_barang,
            'jumlah' => $request->jumlah,
            'tanggal_kembali' => $request->tanggal_kembali,
            'tujuan' => $request->tujuan,
            'status' => 'Dipinjam',
        ]);

        return redirect()->route('transaksi_peminjaman')->with('success', 'Peminjaman berhasil ditambahkan!');
    }
}