<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Customer\LokasiParkirController as CustomerLokasiController;
use App\Http\Controllers\Customer\ReservasiController;
use App\Http\Controllers\Customer\PembayaranController;
use App\Http\Controllers\Customer\RiwayatController;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LokasiParkirController;

Route::view('/', 'dashboard')->name('dashboard');

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate']);
    Route::get('/register', [RegisterController::class, 'index'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);
});

Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');

Route::prefix('customer')->group(function () {

    Route::get('/cari-parkir',[CustomerLokasiController::class, 'index'])->name('customer.cari-parkir');
    Route::get('/atur-jadwal/{id}',[CustomerLokasiController::class, 'aturJadwal'])->name('customer.atur-jadwal');

});

Route::middleware(['auth', 'role:customer'])->prefix('customer')->group(function () {

    Route::get('/denah',[CustomerLokasiController::class, 'denah'])->name('customer.denah');
    Route::get('/reservasi/{id}', [ReservasiController::class, 'show'])->name('customer.reservasi');
    Route::post('/reservasi', [ReservasiController::class, 'store'])->name('customer.reservasi.store');
    Route::get('/pembayaran/{id}', [PembayaranController::class, 'show'])->name('customer.pembayaran');
    Route::post('/pembayaran', [PembayaranController::class, 'store'])->name('customer.pembayaran.store');
    Route::get('/qr-muncul/{id}', [ReservasiController::class, 'tiket'])->name('customer.qr-muncul');
    Route::get('/riwayat', [RiwayatController::class, 'index'])->name('customer.riwayat');
    Route::view('/profil', 'customers.profil')->name('customer.profil');

});

// ==================== ADMIN ROUTES ====================
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {

    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    
    // ========== LOKASI PARKIR ==========
    Route::resource('lokasi-parkir', LokasiParkirController::class);
    
    // Slot Parkir
    Route::get('lokasi-parkir/{id}/kelola-slot', [LokasiParkirController::class, 'kelolaSlot'])->name('lokasi-parkir.kelola-slot');
    Route::post('lokasi-parkir/{id}/slot', [LokasiParkirController::class, 'storeSlot'])->name('lokasi-parkir.store-slot');
    Route::delete('lokasi-parkir/{id}/slot/{slotId}', [LokasiParkirController::class, 'destroySlot'])->name('lokasi-parkir.destroy-slot');
    Route::put('lokasi-parkir/{id}/slot/{slotId}/status', [LokasiParkirController::class, 'updateSlotStatus'])->name('lokasi-parkir.update-slot-status');
    
    // BULK CREATE SLOT
    Route::post('lokasi-parkir/{id}/slot/bulk', [LokasiParkirController::class, 'bulkStoreSlot'])->name('lokasi-parkir.bulk-store-slot');
    
    // TOGGLE STATUS SLOT (TAMBAHKAN INI!)
    Route::put('lokasi-parkir/{id}/slot/{slotId}/toggle-status', [LokasiParkirController::class, 'toggleSlotStatus'])->name('lokasi-parkir.toggle-slot-status');
    
    // Create Area
    Route::get('lokasi-parkir/{id}/create-area', [LokasiParkirController::class, 'createArea'])->name('lokasi-parkir.create-area');
    Route::post('lokasi-parkir/{id}/store-area', [LokasiParkirController::class, 'storeArea'])->name('lokasi-parkir.store-area');

});