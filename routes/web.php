<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');

Route::prefix('customer')->group(function () {

    Route::view('/dashboard', 'customer.dashboard');

    Route::view('/cari-parkir', 'customer.cari-parkir');

    Route::view('/denah', 'customer.denah');

    Route::view('/transaksi', 'customer.transaksi');

    Route::view('/riwayat', 'customer.riwayat');

    Route::view('/profil', 'customer.profil');

});
