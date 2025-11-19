<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Menampilkan form login.
     */
    public function create()
    {
        // View ini akan merujuk ke resources/views/auth/login.blade.php
        return view('auth.login');
    }

    /**
     * Menangani permintaan autentikasi (login).
     */
    public function store(Request $request)
    {
        // 1. Validasi input
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 2. Coba proses login
        if (Auth::attempt($credentials)) {
            // Jika login berhasil, regenerasi session dan arahkan ke halaman home/dashboard
            $request->session()->regenerate();
            
            // TODO: Ganti 'home' dengan nama rute dashboard Anda
            return redirect()->intended('/home')->with('success', 'Selamat datang kembali!');
        }

        // 3. Jika login gagal, kembalikan dengan error
        return back()->withErrors([
            'email' => 'Kredensial yang diberikan tidak cocok dengan catatan kami.',
        ])->onlyInput('email');
    }

    /**
     * Menangani proses logout.
     */
    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        // Redirect ke halaman login setelah logout
        return redirect('/login')->with('success', 'Anda telah berhasil keluar.');
    }
}