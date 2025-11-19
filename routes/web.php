<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController; // WAJIB DIIMPORT!
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\TransactionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Di sini tempat Anda bisa mendaftarkan rute web untuk aplikasi Anda.
| Rute-rute ini dimuat oleh RouteServiceProvider dan semuanya akan
| ditugaskan ke grup middleware "web". Buatlah sesuatu yang hebat!
|
*/

// ======================================================================
// 1. RUTE AUTENTIKASI (LOGIN & LOGOUT)
// ======================================================================

// Rute untuk Tamu (Guest) - Hanya bisa diakses saat belum login
Route::middleware('guest')->group(function () {
    // Menampilkan halaman login
    Route::get('login', [LoginController::class, 'create'])->name('login'); 
    
    // Menangani proses submit form login
    Route::post('login', [LoginController::class, 'store'])->name('login.store'); 

    // Rute lain yang bisa diakses publik (tanpa login)
    // Contoh: Halaman utama yang menampilkan daftar properti (katalog)
    Route::get('/', [PropertyController::class, 'index'])->name('properties.index');
    Route::get('/property/{property}', [PropertyController::class, 'show'])->name('properties.show');
});


// Rute untuk User yang Sudah Login - Hanya bisa diakses setelah login
Route::middleware('auth')->group(function () {
    
    // Rute Home/Dashboard setelah Login
    Route::get('/home', function () {
        // TODO: Anda bisa mengganti ini dengan Controller Dashboard Anda
        return view('home'); // Pastikan Anda memiliki resources/views/home.blade.php
    })->name('home');

    // Menangani proses logout
    Route::post('logout', [LoginController::class, 'destroy'])->name('logout'); 
    

    // ======================================================================
    // 2. RUTE ADMIN / MARKETING (Membutuhkan Login)
    // ======================================================================

    // Rute untuk menampilkan semua properti (Mungkin hanya untuk Admin/Marketing)
    // Route::get('/admin/properties', [PropertyController::class, 'indexAdmin'])->name('admin.properties.index');

    // Rute Transaksi (Contoh: Menangani submit transaksi)
    Route::post('/transaction/store', [TransactionController::class, 'store'])->name('transaction.store');
    
    // Rute Persetujuan Properti (Admin)
    // TODO: Ganti nama Controller sesuai struktur Anda (misalnya AdminController)
    Route::get('admin/pending', [PropertyController::class, 'pendingIndex'])->name('admin.pending');
    Route::post('admin/approve/{property}', [PropertyController::class, 'approve'])->name('admin.approve');
    Route::delete('admin/delete/{property}', [PropertyController::class, 'destroy'])->name('admin.delete');
    
    // Rute untuk Kontak Properti (Contoh)
    Route::post('/contact/{property}', [PropertyController::class, 'contact'])->name('contact.property');
    
    // Tambahkan rute lain yang memerlukan autentikasi di sini
});