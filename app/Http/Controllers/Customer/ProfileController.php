<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Kendaraan;
use App\Models\PointTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $kendaraans = Kendaraan::where('user_id', $user->id)->get();

        $totalPoint = PointTransaction::where('user_id', $user->id)
                            ->sum('points');

        return view('customers.profil', compact(
            'user',
            'kendaraans',
            'totalPoint'
        ));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'nomor_hp' => 'nullable|max:20',
        ]);

        Auth::user()->update([
            'name' => $request->name,
            'email' => $request->email,
            'nomor_hp' => $request->nomor_hp,
        ]);

        return back()->with('success', 'Informasi akun berhasil diperbarui.');
    }
}