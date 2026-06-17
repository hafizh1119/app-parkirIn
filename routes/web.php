<?php

use Illuminate\Support\Facades\Route;
<<<<<<< Updated upstream

Route::get('/', function () {
    return view('welcome');
=======
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
>>>>>>> Stashed changes
});

// ==================== CUSTOMER ROUTES ====================
=======
Route::get('/customer/denah', function () {
    return view('customers.denah');
});

<<<<<<< Updated upstream
Route::prefix('customer')->group(function () {
    Route::view('/dashboard', 'customer.dashboard')->name('customer.dashboard');
    Route::view('/cari-parkir', 'customer.cari-parkir')->name('customer.cari-parkir');
    Route::view('/denah', 'customer.denah')->name('customer.denah');
    Route::view('/transaksi', 'customer.transaksi')->name('customer.transaksi');
    Route::view('/riwayat', 'customer.riwayat')->name('customer.riwayat');
    Route::view('/profil', 'customer.profil')->name('customer.profil');
});


// ==================== ADMIN MITRA ROUTES ====================
Route::prefix('AdminMitra')->name('adminmitra.')->group(function () {
    Route::view('/dashboard', 'AdminMitra.dashboard')->name('dashboard');
    // Tambahkan route lain untuk AdminMitra jika perlu
    // Route::view('/kelola-parkir', 'AdminMitra.kelola-parkir')->name('kelola-parkir');
    // Route::view('/laporan', 'AdminMitra.laporan')->name('laporan');

    Route::view('/cari-parkir', 'customers.cari-parkir');

    Route::view('/denah', 'customers.denah');

    Route::view('/transaksi', 'customers.transaksi');

    Route::view('/riwayat', 'customers.riwayat');

    Route::view('/profil', 'customers.profil');
=======
    Route::view('/riwayat', 'customer.riwayat');

    Route::view('/profil', 'customer.profil');

});

// ==================== SUPER ADMIN ROUTES ====================
Route::prefix('SuperAdmin')->name('superadmin.')->group(function () {
    // Dashboard Super Admin
    Route::view('/dashboard', 'SuperAdmin.dashboard')->name('dashboard');
=======
// ==================== CUSTOMER ROUTES ====================
// HANYA 1 GROUP CUSTOMER - GABUNG SEMUA
Route::prefix('customer')->name('customer.')->middleware(['auth', 'role:customer'])->group(function () {
    // Cari Parkir
    Route::get('/cari-parkir', [CustomerLokasiController::class, 'index'])->name('cari-parkir');
    Route::get('/atur-jadwal/{id}', [CustomerLokasiController::class, 'aturJadwal'])->name('atur-jadwal');
    
    // Denah
    Route::get('/denah', [CustomerLokasiController::class, 'denah'])->name('denah');
    
    // Reservasi
    Route::get('/reservasi/{id}', [ReservasiController::class, 'show'])->name('reservasi');
    Route::post('/reservasi', [ReservasiController::class, 'store'])->name('reservasi.store');
    Route::get('/qr-muncul/{id}', [ReservasiController::class, 'tiket'])->name('qr-muncul');
    
    // Pembayaran
    Route::get('/pembayaran/{id}', [PembayaranController::class, 'show'])->name('pembayaran');
    Route::post('/pembayaran', [PembayaranController::class, 'store'])->name('pembayaran.store');
    
    // Riwayat
    Route::get('/riwayat', [RiwayatController::class, 'index'])->name('riwayat');
    
    // Profil
    Route::view('/profil', 'customers.profil')->name('profil');
});

// ==================== ADMIN ROUTES ====================
// ==================== ADMIN ROUTES ====================
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
>>>>>>> Stashed changes
    
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