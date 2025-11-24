<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\MarketingController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\RegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- 1. HALAMAN PUBLIK (Tidak Perlu Login) ---

Route::get('/', [PropertyController::class, 'index'])->name('properties.index');
Route::get('/property/{property}', [PropertyController::class, 'show'])->name('properties.show');
Route::post('/contact/{property}', [ContactController::class, 'store'])->name('contact.store');

// --- 2. AUTHENTIKASI (LOGIN & LOGOUT) ---

// Hanya gunakan LoginController yang Anda buat
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.store');

// Route Logout (membutuhkan login)
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');
Route::group(['middleware' => 'guest'], function () {
    
    // LOGIN
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.store');

    // REGISTER (Perbaikan: Pastikan RegisterController di-import di atas)
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.store');
});

// --- 3. KELOMPOK ROUTE YANG MEMBUTUHKAN LOGIN ('auth' middleware) ---
Route::middleware('auth')->group(function () {
    
    // Dashboard Default
    Route::get('/dashboard', function () {
        // Logika redirect sesuai role
        if (Auth::user()->hasRole('admin')) {
            return redirect()->route('admin.pending');
        } elseif (Auth::user()->hasRole('marketing')) {
            return redirect()->route('marketing.properties.index');
        }
        // Jika hanya user biasa, arahkan ke dashboard/home
        return view('welcome'); 
    })->name('dashboard');

    // --- A. ROUTE KHUSUS MARKETING ---
    // Pastikan Gate 'isMarketing' sudah didaftarkan di AuthServiceProvider
    Route::middleware('can:isMarketing')->prefix('marketing')->name('marketing.')->group(function () {
        Route::get('/', [MarketingController::class, 'index'])->name('properties.index');
        Route::get('/create', [MarketingController::class, 'create'])->name('create');
        Route::post('/', [MarketingController::class, 'store'])->name('store');
        Route::delete('/{property}', [MarketingController::class, 'destroy'])->name('destroy');
    });
    
    // --- B. ROUTE KHUSUS ADMIN ---
    // Pastikan Gate 'isAdmin' sudah didaftarkan di AuthServiceProvider
    Route::middleware('can:isAdmin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/pending', [AdminController::class, 'pendingProperties'])->name('pending');
        Route::post('/approve/{property}', [AdminController::class, 'approve'])->name('approve');
        Route::post('/reject/{property}', [AdminController::class, 'reject'])->name('reject');
        
        // ROUTE TRANSAKSI
        Route::get('/transaction/create/{property}', [TransactionController::class, 'create'])->name('transactions.create');
        Route::post('/transaction/{property}', [TransactionController::class, 'store'])->name('transactions.store');
    });

    // HAPUS SEMUA ROUTE YANG MERUJUK KE CONTROLLER BAWAAN LARAVEL DI SINI!
});