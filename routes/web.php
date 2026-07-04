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
use App\Http\Controllers\Customer\KendaraanController;
use App\Http\Controllers\Customer\EventController as CustomerEventController;

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
    Route::get('/events', [CustomerEventController::class, 'index'])->name('customers.events');
});

Route::middleware(['auth', 'role:customer'])->prefix('customer')->group(function () {
    Route::get('/denah', [CustomerLokasiParkirController::class, 'denah'])->name('customer.denah');
    Route::post('/kendaraan',[KendaraanController::class, 'store'])->name('customer.kendaraan.store');
    Route::get('/reservasi/{id}', [ReservasiController::class, 'show'])->name('customer.reservasi');
    Route::post('/reservasi', [ReservasiController::class, 'store'])->name('customer.reservasi.store');
    Route::get('/reservasi/{reservasi}/download-ticket', [ReservasiController::class, 'downloadTicket'])->name('reservasi.download-ticket');
    Route::get('/pembayaran/{id}', [CustomerPembayaranController::class, 'show'])->name('customer.pembayaran');
    Route::post('/pembayaran/{id}/finish', [CustomerPembayaranController::class, 'finish'])->name('customer.finish');
    Route::post('/pembayaran', [CustomerPembayaranController::class, 'store'])->name('customer.pembayaran.store');
    Route::post('/pembayaran/{reservasi}/snap-token',[CustomerPembayaranController::class, 'getSnapToken'])->name('customer.midtrans.snap');
    Route::get('/qr-muncul/{id}', [ReservasiController::class, 'tiket'])->name('customer.qr-muncul');
    Route::get('/riwayat', [RiwayatController::class, 'index'])->name('customer.riwayat');
    Route::view('/profil', 'customers.profil')->name('customer.profil');
    
});

Route::prefix('admin')->name('admin.')->group(function () {

    //Scan
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

    //pembayaran
    Route::get('/pembayaran', [AdminPembayaranController::class, 'index'])->name('pembayaran.index');
    Route::post('/pembayaran/{id}/verifikasi', [AdminPembayaranController::class, 'verifikasi'])->name('pembayaran.verifikasi');
    Route::post('/pembayaran/{id}/tolak', [AdminPembayaranController::class, 'tolak'])->name('pembayaran.tolak');

    //history
    Route::get('/history',[HistoryController::class, 'index'])->name('history.index');
    
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

    // Membership & Points
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
});