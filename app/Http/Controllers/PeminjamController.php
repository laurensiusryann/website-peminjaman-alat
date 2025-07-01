<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjam;
use Illuminate\Support\Facades\Hash;

class PeminjamController extends Controller
{
    // Tampilkan daftar peminjam
    public function index()
    {
        $peminjams = Peminjam::all();
        return view('data_peminjam', compact('peminjams'));
    }

    // Tampilkan form tambah peminjam
    public function create()
    {
        return view('tambah_peminjam');
    }

    // Proses simpan peminjam baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'npm' => 'required|unique:peminjams',
            'password' => 'required|min:4',
        ]);

        Peminjam::create([
            'nama' => $request->nama,
            'npm' => $request->npm,
            'password' => Hash::make($request->password), // Simpan password terenkripsi
        ]);

        return redirect()->route('data_peminjam')->with('success', 'Peminjam berhasil ditambahkan!');
    }
}