<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Customer\LokasiParkirController;
use App\Http\Controllers\Customer\ReservasiController;
use App\Http\Controllers\Customer\PembayaranController;
use App\Http\Controllers\Customer\RiwayatController;

Route::view('/', 'dashboard')->name('dashboard');

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate']);
    Route::get('/register', [RegisterController::class, 'index'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);
});

Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');

Route::prefix('customer')->group(function () {

    Route::get('/cari-parkir', [LokasiParkirController::class, 'index'])->name('customer.cari-parkir');
    Route::get('/atur-jadwal/{id}', [LokasiParkirController::class, 'aturJadwal'])->name('customer.atur-jadwal');

});

Route::middleware(['auth', 'role:customer'])->prefix('customer')->group(function () {

    Route::get('/denah', [LokasiParkirController::class, 'denah'])->name('customer.denah');
    Route::get('/reservasi/{id}', [ReservasiController::class, 'show'])->name('customer.reservasi');
    Route::post('/reservasi', [ReservasiController::class, 'store'])->name('customer.reservasi.store');
    Route::get('/pembayaran/{id}', [PembayaranController::class, 'show'])->name('customer.pembayaran');
    Route::post('/pembayaran', [PembayaranController::class, 'store'])->name('customer.pembayaran.store');
    Route::get('/qr-muncul/{id}', [ReservasiController::class, 'tiket'])->name('customer.qr-muncul');
    Route::get('/riwayat', [RiwayatController::class, 'index'])->name('customer.riwayat');
    Route::view('/profil', 'customers.profil')->name('customer.profil');

});


// ==================== ADMIN MITRA ROUTES ====================
Route::prefix('AdminMitra')->name('adminmitra.')->group(function () {
    Route::view('/dashboard', 'AdminMitra.dashboard')->name('dashboard');
    // Route::view('/kelola-parkir', 'AdminMitra.kelola-parkir')->name('kelola-parkir');
    // Route::view('/laporan', 'AdminMitra.laporan')->name('laporan');

    Route::view('/cari-parkir', 'customers.cari-parkir');

    Route::view('/denah', 'customers.denah');

    Route::view('/reservasi', 'customers.reservasi');

    Route::view('/riwayat', 'customers.riwayat');

    Route::view('/profil', 'customers.profil');

    Route::view('/riwayat', 'customers.riwayat');

    Route::view('/profil', 'customers.profil');

});

// ==================== SUPER ADMIN ROUTES ====================
Route::prefix('SuperAdmin')->name('superadmin.')->group(function () {
    // Dashboard Super Admin
    Route::view('/dashboard', 'SuperAdmin.dashboard')->name('dashboard');
    
    // Kelola Mitra
    Route::view('/kelola-mitra', 'SuperAdmin.kelolamitra')->name('kelola-mitra');
    
    // Kelola User (Mitra)
    Route::view('/kelola-user-mitra', 'SuperAdmin.kelolauser-mitra')->name('kelola-user-mitra');
    
    // Keuangan
    Route::view('/keuangan', 'SuperAdmin.keuangan')->name('keuangan');
    
    // Laporan
    Route::view('/laporan', 'SuperAdmin.laporan')->name('laporan');
});