<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        // Jika belum ada fitur notifikasi, kirim array kosong
        $notifs = []; // Ganti dengan query notifikasi jika sudah ada
        return view('profile', [
            'full_name' => $user->name,
            'notifs' => $notifs,
        ]);
    }

    public function edit()
    {
        $user = Auth::user();
        return view('profile_edit', [
            'full_name' => $user->name,
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
        ]);
        $user = Auth::user();
        $user->name = $request->input('full_name');
        $user->save();

        return redirect()->route('profile')->with('success', 'Profile updated!');
    }
}