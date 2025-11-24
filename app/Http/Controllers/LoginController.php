<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Tampilkan formulir login.
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        // PENTING: Mengganti 'auth.login' menjadi 'auth.halaman_masuk'
        // File view yang dicari adalah: resources/views/auth/halaman_masuk.blade.php
        return view('halaman_masuk'); 
    }

    /**
     * Handle proses login.
     * ... (sisanya sama)
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard')->with('success', 'Berhasil login!');
        }

        return back()->withErrors([
            'email' => 'Email atau Password salah.',
        ])->onlyInput('email');
    }
    
    // ... (Fungsi logout)
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}