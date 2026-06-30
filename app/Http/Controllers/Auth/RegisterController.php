<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Kendaraan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'nomor_hp' => 'required|string|max:20',
            'password' => 'required|min:8',
            'jenis_kendaraan' => 'required|in:motor,mobil',
            'nomor_polisi' => 'required|string|max:20|unique:kendaraan,nomor_polisi',
            'merk' => 'required|string|max:100',
            'warna' => 'required|string|max:50',
            'terms' => 'required',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'nomor_hp' => $request->nomor_hp,
            'password' => Hash::make($request->password),
            'role' => 'customer',
            'status_member' => 'biasa',
            'status_akun' => 'aktif',
        ]);

        Kendaraan::create([
            'user_id' => $user->id,
            'jenis_kendaraan' => $request->jenis_kendaraan,
            'nomor_polisi' => strtoupper($request->nomor_polisi),
            'merk' => $request->merk,
            'warna' => $request->warna,
        ]);

    
        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }
}