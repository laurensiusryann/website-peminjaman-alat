<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Peminjaman;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();

        $notifs = Peminjaman::where('nama_peminjam', $user->name)
            ->whereIn('status', ['Disetujui', 'Ditolak'])
            ->where('dibaca', false)
            ->orderBy('updated_at', 'desc')
            ->take(10)
            ->get();

        return view('profile', [
            'full_name' => $user->name,
            'notifs' => $notifs,
        ]);
    }

    public function edit()
    {
        $user = Auth::user();

        $notifs = Peminjaman::where('nama_peminjam', $user->name)
            ->whereIn('status', ['Disetujui', 'Ditolak'])
            ->where('dibaca', false)
            ->orderBy('updated_at', 'desc')
            ->take(10)
            ->get();

        return view('profile_edit', [
            'full_name' => $user->name,
            'notifs' => $notifs,
        ]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $user->name = $request->input('full_name');
        $user->save();

        return redirect()->route('profile')->with('success', 'Profile updated!');
    }
}