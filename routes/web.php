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

    Route::view('/profil', 'customers.profil');

});