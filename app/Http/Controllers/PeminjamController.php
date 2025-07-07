<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
<<<<<<< HEAD
use App\Models\User;
=======
use App\Models\Peminjam;
>>>>>>> main
use Illuminate\Support\Facades\Hash;

class PeminjamController extends Controller
{
    // Tampilkan daftar peminjam
    public function index()
    {
<<<<<<< HEAD
        $peminjams = User::where('role', 'user')->get();
=======
        $peminjams = Peminjam::all();
>>>>>>> main
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
<<<<<<< HEAD
            'name' => 'required',
            'npm' => 'required|unique:users',
            'password' => 'required|min:4',
        ]);

        User::create([
            'name' => $request->name,
            'npm' => $request->npm,
            'password' => Hash::make($request->password),
            'role' => 'user',
=======
            'nama' => 'required',
            'npm' => 'required|unique:peminjams',
            'password' => 'required|min:4',
        ]);

        Peminjam::create([
            'nama' => $request->nama,
            'npm' => $request->npm,
            'password' => Hash::make($request->password), // Simpan password terenkripsi
>>>>>>> main
        ]);

        return redirect()->route('data_peminjam')->with('success', 'Peminjam berhasil ditambahkan!');
    }
}