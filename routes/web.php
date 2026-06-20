<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;

// Customer
use App\Http\Controllers\Customer\LokasiParkirController as CustomerLokasiParkirController;
use App\Http\Controllers\Customer\ReservasiController;
use App\Http\Controllers\Customer\PembayaranController as CustomerPembayaranController;
use App\Http\Controllers\Customer\RiwayatController;
use App\Http\Controllers\Customer\DokuController;

// Admin
use App\Http\Controllers\Admin\LokasiParkirController as AdminLokasiParkirController;
use App\Http\Controllers\Admin\AreaParkirController;
use App\Http\Controllers\Admin\SlotParkirController;
use App\Http\Controllers\Admin\PembayaranController as AdminPembayaranController;
use App\Http\Controllers\Admin\ScanController;


Route::get('/', [HomeController::class, 'index'])->name('dashboard');

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate']);
    Route::get('/register', [RegisterController::class, 'index'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);
});

Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');

Route::prefix('customer')->group(function () {
    Route::get('/cari-parkir', [CustomerLokasiParkirController::class, 'index'])->name('customer.cari-parkir');
    Route::get('/atur-jadwal/{id}', [CustomerLokasiParkirController::class, 'aturJadwal'])->name('customer.atur-jadwal');
});

Route::middleware(['auth', 'role:customer'])->prefix('customer')->group(function () {
    Route::get('/denah', [CustomerLokasiParkirController::class, 'denah'])->name('customer.denah');
    Route::get('/reservasi/{id}', [ReservasiController::class, 'show'])->name('customer.reservasi');
    Route::post('/reservasi', [ReservasiController::class, 'store'])->name('customer.reservasi.store');
    Route::get('/pembayaran/{id}', [CustomerPembayaranController::class, 'show'])->name('customer.pembayaran');
    Route::post('/pembayaran', [CustomerPembayaranController::class, 'store'])->name('customer.pembayaran.store');
    Route::get('/qr-muncul/{id}', [ReservasiController::class, 'tiket'])->name('customer.qr-muncul');
    Route::get('/riwayat', [RiwayatController::class, 'index'])->name('customer.riwayat');
    Route::view('/profil', 'customers.profil')->name('customer.profil');
    Route::get('/reservasi/{reservasi}/bayar',[DokuController::class, 'createPayment'])->name('doku.pay');
});

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/scan', [ScanController::class, 'index'])->name('scan.index');
    Route::post('/scan', [ScanController::class, 'scan'])->name('scan.process');

    // Dashboard
    Route::view('/dashboard', 'Admin.dashboard.index')->name('dashboard');

    // Lokasi Parkir
    Route::resource('lokasi-parkir', AdminLokasiParkirController::class);

    // Slot Area
    Route::get('/slot-area/{lokasi}',             [AreaParkirController::class, 'index'])->name('slot-area.index');
    Route::get('/slot-area/{lokasi}/create',      [AreaParkirController::class, 'create'])->name('slot-area.create');
    Route::post('/slot-area/{lokasi}',            [AreaParkirController::class, 'store'])->name('slot-area.store');
    Route::get('/slot-area/{lokasi}/{area}/edit', [AreaParkirController::class, 'edit'])->name('slot-area.edit');
    Route::put('/slot-area/{lokasi}/{area}',      [AreaParkirController::class, 'update'])->name('slot-area.update');
    Route::delete('/slot-area/{lokasi}/{area}',   [AreaParkirController::class, 'destroy'])->name('slot-area.destroy');

    // Slot Parkir
    Route::get('/slot-parkir/{area}',           [SlotParkirController::class, 'index'])->name('slot-parkir.index');
    Route::post('/slot-parkir/{area}',          [SlotParkirController::class, 'store'])->name('slot-parkir.store');
    Route::put('/slot-parkir/{area}/{slot}',    [SlotParkirController::class, 'update'])->name('slot-parkir.update');
    Route::delete('/slot-parkir/{area}/{slot}', [SlotParkirController::class, 'destroy'])->name('slot-parkir.destroy');

    Route::get('/pembayaran', [AdminPembayaranController::class, 'index'])->name('pembayaran.index');
    Route::post('/pembayaran/{id}/verifikasi', [AdminPembayaranController::class, 'verifikasi'])->name('pembayaran.verifikasi');
    Route::post('/pembayaran/{id}/tolak', [AdminPembayaranController::class, 'tolak'])->name('pembayaran.tolak');

    //Scan

    //Pembayaran
    
});