<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return view('profile', [
            'full_name' => $user->name,
            'username' => $user->username,
        ]);
    }

    public function edit()
    {
        $user = Auth::user();
        return view('profile_edit', [
            'full_name' => $user->name,
            'username' => $user->username,
        ]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $user->name = $request->input('full_name');
        $user->username = $request->input('username');
        $user->save();

        return redirect()->route('profile')->with('success', 'Profile updated!');
    }
}