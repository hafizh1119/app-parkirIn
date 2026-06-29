<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Customer\LokasiParkirController as CustomerLokasiController;
use App\Http\Controllers\Customer\ReservasiController;
use App\Http\Controllers\Customer\PembayaranController;
use App\Http\Controllers\Customer\RiwayatController;

<<<<<<< Updated upstream
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LokasiParkirController;
=======
// Admin
use App\Http\Controllers\Admin\LokasiParkirController as AdminLokasiParkirController;
use App\Http\Controllers\Admin\AreaParkirController;
use App\Http\Controllers\Admin\SlotParkirController;
use App\Http\Controllers\Admin\PembayaranController as AdminPembayaranController;
use App\Http\Controllers\Admin\ScanController;
use App\Http\Controllers\Admin\HistoryController;
use App\Http\Controllers\Admin\KelolaUserController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\MembershipController;
>>>>>>> Stashed changes

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

<<<<<<< Updated upstream
=======
Route::prefix('admin')->name('admin.')->group(function () {
    //Scan
    Route::get('/scan', [ScanController::class, 'index'])->name('scan.index');
    Route::post('/scan', [ScanController::class, 'scan'])->name('scan.process');
>>>>>>> Stashed changes


// ==================== ADMIN ROUTES ====================
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {

    
<<<<<<< Updated upstream
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
=======
    //kelola user
    Route::get('/kelola-user',[KelolaUserController::class, 'index'])->name('kelola-user.index');
    Route::get('/kelola-user/{user}',[KelolaUserController::class, 'show'])->name('kelola-user.show');
    Route::get('/kelola-user/{user}/edit',[KelolaUserController::class, 'edit'])->name('kelola-user.edit');
    Route::put('/kelola-user/{user}',[KelolaUserController::class, 'update'])->name('kelola-user.update');
    Route::get('/kelola-user/{user}/reset-password',[KelolaUserController::class, 'resetPasswordForm'])->name('kelola-user.reset-password');
    Route::put('/kelola-user/{user}/reset-password',[KelolaUserController::class, 'resetPassword'])->name('kelola-user.reset-password.update');
    Route::put('/kelola-user/{user}/toggle-status',[KelolaUserController::class, 'toggleStatus'])->name('kelola-user.toggle-status');

     // Event Management
    Route::resource('events', EventController::class);
    Route::post('/events/{event}/toggle-status', [EventController::class, 'toggleStatus'])->name('events.toggle-status');

      /// Membership & Points
    Route::get('/membership', [MembershipController::class, 'index'])->name('membership.index');
    Route::get('/membership/export', [MembershipController::class, 'export'])->name('membership.export');
    Route::get('/membership/{id}/detail', [MembershipController::class, 'detail'])->name('membership.detail');
    Route::put('/membership/{id}/tier', [MembershipController::class, 'updateTier'])->name('membership.update-tier');
    Route::post('/membership/{id}/toggle', [MembershipController::class, 'toggleStatus'])->name('membership.toggle');
    Route::post('/membership/{id}/add-points', [MembershipController::class, 'addPoints'])->name('membership.add-points');
    Route::post('/membership/{id}/redeem-points', [MembershipController::class, 'redeemPoints'])->name('membership.redeem-points');
    Route::put('/membership/point-settings', [MembershipController::class, 'updatePointSettings'])->name('membership.point-settings');
    Route::post('/membership/tier', [MembershipController::class, 'addTier'])->name('membership.add-tier');
    Route::delete('/membership/tier/{id}', [MembershipController::class, 'deleteTier'])->name('membership.delete-tier');
>>>>>>> Stashed changes

});