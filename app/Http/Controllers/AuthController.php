<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // Tampilkan form login
    public function showLogin() {
        return view('login');
    }

    // Proses login
    public function login(Request $request) {
        $request->validate([
            'npm' => 'required',
            'password' => 'required',
            'role' => 'required|in:user,admin',
        ]);
        $user = User::where('npm', $request->npm)
            ->where('role', $request->role)
            ->first();
        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);
            // Redirect sesuai role
            if ($user->role === 'admin') {
                return redirect()->route('dashboard_admin');
            }
            return redirect()->route('dashboard_user');
        }
        return back()->withErrors(['npm' => 'NPM, password, atau role salah']);
    }

    // Tampilkan form register
    public function showRegister() {
        return view('register');
    }

    // Proses register
    public function register(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'npm' => 'required|string|max:255',
            'password' => 'required|string|confirmed|min:6',
            // tambahkan validasi lain jika perlu
        ]);

        $user = User::create([
            'name' => $request->name,
            'npm' => $request->npm,
            'password' => Hash::make($request->password),
            'plain_password' => $request->password, // Simpan password asli
            'role' => $request->role,
        ]);

        // login otomatis atau redirect
        auth()->login($user);
        return redirect()->route('dashboard_user');
    }

    // Logout
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    // Tampilkan form lupa password
    public function showForgot() {
        return view('forgot_password');
    }

    // Proses lupa password (cek NPM, simpan ke session, redirect ke reset)
    public function forgotPassword(Request $request) {
        $request->validate([
            'npm' => 'required|exists:users,npm',
        ]);
        session(['reset_npm' => $request->npm]);
        return redirect()->route('password.reset');
    }

    // Tampilkan form reset password
    public function showReset(Request $request) {
        // Pastikan sudah ada session reset_npm
        if (!session('reset_npm')) {
            return redirect()->route('password.request');
        }
        return view('reset_password');
    }

    // Proses reset password
    public function resetPassword(Request $request) {
        $request->validate([
            'password' => 'required|confirmed|min:6',
        ]);
        $npm = session('reset_npm');
        if (!$npm) {
            return redirect()->route('password.request');
        }
        $user = User::where('npm', $npm)->first();
        if ($user) {
            $user->password = Hash::make($request->password);
            $user->plain_password = $request->password; // Update password asli
            $user->save();
            session()->forget('reset_npm');
            return redirect()->route('login')->with('success', 'Password berhasil direset. Silakan login.');
        }
        return redirect()->route('password.request')->withErrors(['npm' => 'NPM tidak ditemukan']);
    }
}