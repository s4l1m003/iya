<?php

namespace App\Http\Controllers; // <-- PASTIKAN LOKASI FILE ADALAH app/Http/Controllers/LoginController.php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Menampilkan form login.
     * Dipanggil oleh Route::get('/login', [LoginController::class, 'create'])
     */
    public function create()
    {
        // View ini akan merujuk ke resources/views/halaman_masuk.blade.php
        return view('halaman_masuk'); // <-- Pastikan view ini ada!
    }

    /**
     * Menangani permintaan autentikasi (login).
     * Dipanggil oleh Route::post('/login', [LoginController::class, 'store'])
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
            
            // Arahkan ke rute dengan nama 'home' (sesuai yang Anda tulis)
            return redirect()->intended('/home')->with('success', 'Selamat datang kembali!');
        }

        // 3. Jika login gagal, kembalikan dengan error
        return back()->withErrors([
            'email' => 'Kredensial yang diberikan tidak cocok dengan catatan kami.',
        ])->onlyInput('email');
    }

    /**
     * Menangani proses logout.
     * Dipanggil oleh Route::post('/logout', [LoginController::class, 'destroy'])
     */
    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        // Redirect ke halaman utama ('/') setelah logout
        return redirect('/')->with('success', 'Anda telah berhasil keluar.');
    }
}