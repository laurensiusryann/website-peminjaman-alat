<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjaman = Peminjaman::latest()->get();
        return view('transaksi_peminjaman', compact('peminjaman'));
    }

    public function create()
    {
        return view('pinjam_barang');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_peminjam' => 'required',
            'tanggal_pinjam' => 'required|date',
            'nama_barang' => 'required',
            'jumlah' => 'required|integer|min:1',
            'tanggal_kembali' => 'required',
            'tujuan' => 'required',
        ]);

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