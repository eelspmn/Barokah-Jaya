<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PakaianController;
use App\Http\Controllers\BerandaController;
use App\Http\Middleware\CheckRole;

Route::get('/', function () {
    return redirect('/login');
});

// AUTENTIKASI MANUAL
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// AUTENTIKASI GOOGLE (SOCIALITE)
Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback']);

// BERANDA UTAMA & CHECKOUT (Bisa diakses User & Owner yang sudah login)
Route::middleware(['auth'])->group(function () {
    Route::get('/beranda', [BerandaController::class, 'index'])->name('beranda.index');
    Route::get('/beranda/{id}', [BerandaController::class, 'show'])->name('beranda.show');
    // Rute Baru untuk Checkout:
    Route::get('/checkout/{id}', [BerandaController::class, 'checkout'])->name('beranda.checkout');
});

// ==========================================
// AREA KHUSUS OWNER
// ==========================================
Route::middleware([CheckRole::class . ':owner'])->group(function () {
    // RUTE DASHBOARD
    Route::get('/owner/dashboard', function () {
        $total_produk = \App\Models\Pakaian::count();
        $total_stok = \App\Models\Pakaian::sum('stok');
        $stok_menipis = \App\Models\Pakaian::where('stok', '<=', 5)->count();
        
        return view('owner.dashboard', compact('total_produk', 'total_stok', 'stok_menipis'));
    })->name('owner.dashboard');
    
    // RUTE CRUD PAKAIAN
    Route::resource('owner/pakaian', PakaianController::class)->names('pakaian');
});

// ==========================================
// AREA KHUSUS USER
// ==========================================
Route::middleware([CheckRole::class . ':user'])->group(function () {
    Route::get('/user/katalog', function () {
        return redirect()->route('beranda.index');
    })->name('user.katalog');
});