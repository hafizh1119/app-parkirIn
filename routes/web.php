<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/customer/denah', function () {
    return view('customers.denah');
});

Route::prefix('customer')->group(function () {

    Route::view('/cari-parkir', 'customers.cari-parkir');

    Route::view('/denah', 'customers.denah');

    Route::view('/transaksi', 'customers.transaksi');

    Route::view('/riwayat', 'customers.riwayat');

<<<<<<< HEAD
    Route::view('/profil', 'customers.profil');
=======
    Route::view('/riwayat', 'customer.riwayat');

    Route::view('/profil', 'customer.profil');
});
>>>>>>> 383011699f124a7fedfd44ceedc4bcb76c9d0676

Route::get('/AdminMitra/dashboard', function () {
    return view('AdminMitra.dashboard');
});