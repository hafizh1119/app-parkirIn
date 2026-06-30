<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Kendaraan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KendaraanController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nomor_polisi'    => 'required|unique:kendaraan,nomor_polisi',
            'merk'            => 'required',
            'warna'           => 'required',
            'jenis_kendaraan' => 'required',
        ]);

        Kendaraan::create([
            'user_id'          => Auth::id(),
            'nomor_polisi'     => strtoupper($request->nomor_polisi),
            'merk'             => $request->merk,
            'warna'            => $request->warna,
            'jenis_kendaraan'  => $request->jenis_kendaraan,
        ]);

        return back()->with(
            'success',
            'Kendaraan berhasil ditambahkan.'
        );
    }
}