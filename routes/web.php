<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'dashboard')->name('dashboard');

// ==================== CUSTOMER ROUTES ====================
Route::view('/login', 'auth.login')->name('login');
Route::view('/register', 'auth.register')->name('register');

Route::prefix('customer')->group(function () {
    Route::view('/cari-parkir', 'customers.cari-parkir')->name('customer.cari-parkir');
    Route::view('/denah', 'customers.denah')->name('customer.denah');
    Route::view('/reservasi', 'customers.reservasi')->name('customer.reservasi');
    Route::view('/riwayat', 'customers.riwayat')->name('customer.riwayat');
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