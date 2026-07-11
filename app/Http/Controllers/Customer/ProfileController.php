<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Kendaraan;
use App\Models\PointTransaction;
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
}