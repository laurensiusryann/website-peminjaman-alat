<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class PeminjamController extends Controller
{
    // Tampilkan daftar peminjam
    public function index()
    {
        $peminjams = User::where('role', 'user')->get();
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
            'name' => 'required',
            'npm' => 'required|unique:users',
            'password' => 'required|min:4',
        ]);

        User::create([
            'name' => $request->name,
            'npm' => $request->npm,
            'password' => Hash::make($request->password),
            'role' => 'user',
        ]);

        return redirect()->route('data_peminjam')->with('success', 'Peminjam berhasil ditambahkan!');
    }
}