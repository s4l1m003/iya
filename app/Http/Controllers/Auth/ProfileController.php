<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Menampilkan formulir edit profil pengguna.
     */
    public function edit(Request $request): View
    {
        // Controller akan mencari view di resources/views/profile/edit.blade.php
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Memperbarui informasi profil pengguna.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // Validasi data sudah dilakukan di ProfileUpdateRequest

        // Mengisi (fill) data yang tervalidasi ke objek user
        $request->user()->fill($request->validated());

        // Jika email diubah, set email_verified_at menjadi null agar user perlu verifikasi ulang
        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        // Simpan perubahan
        $request->user()->save();

        // Redirect kembali dengan pesan sukses
        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Menghapus akun pengguna.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Validasi bahwa password yang dimasukkan sesuai
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        // Logout user sebelum akun dihapus
        Auth::logout();

        // Hapus user dari database
        $user->delete();

        // Invalidasi sesi dan regenerasi token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect ke halaman utama
        return Redirect::to('/');
    }
}