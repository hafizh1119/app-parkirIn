<?php

use Illuminate\Support\Facades\Route;

Route::get('/AdminMitra/dashboard', function () {
    return view('AdminMitra.dashboard');
});