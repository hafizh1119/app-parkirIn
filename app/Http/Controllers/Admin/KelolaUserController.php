<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class KelolaUserController extends Controller
{
    public function index()
{
    $users = User::query()
        ->where('role', 'customer')
        ->withCount([
            'kendaraan',
            'reservasi'
        ])
        ->latest()
        ->paginate(10);

    return view(
        'Admin.kelola-user.index',
        compact('users')
    );
}

    public function show(User $user)
{
    $user->load([
        'kendaraan',
        'reservasi'
    ]);

    return view(
        'Admin.kelola-user.detail',
        compact('user')
    );
}
    public function edit(User $user)
{
    return view(
        'Admin.kelola-user.edit',
        compact('user')
    );
}

    public function update(Request $request, User $user)
{
    $request->validate([
        'name' => 'required|max:255',
        'email' => 'required|email',
        'nomor_hp' => 'nullable|max:20',
        'status_member' => 'required'
    ]);

    $user->update([
        'name' => $request->name,
        'email' => $request->email,
        'nomor_hp' => $request->nomor_hp,
        'status_member' => $request->status_member,
    ]);

    if ($request->status_member === 'member') {
        $membership = \App\Models\Membership::firstOrNew(['user_id' => $user->id]);

        if (!$membership->exists) {
            $membership->tier = 'basic';
            $membership->total_points = 0;
            $membership->redeemed_points = 0;
            $membership->join_date = now();
        }

        $membership->is_active = true;
        $membership->save();
    } else {
        \App\Models\Membership::where('user_id', $user->id)->update(['is_active' => false]);
    }

    return redirect()
        ->route('admin.kelola-user.index')
        ->with('success', 'Data user berhasil diperbarui.');
}

    public function resetPasswordForm(User $user)
{
    return view(
        'Admin.kelola-user.reset-password',
        compact('user')
    );
}

    public function resetPassword(
    Request $request,
    User $user
) {

    $request->validate([
        'password' => 'required|min:8|confirmed'
    ]);

    $user->update([
        'password' => Hash::make(
            $request->password
        )
    ]);

    return redirect()
        ->route('admin.kelola-user.index')
        ->with(
            'success',
            'Password berhasil diperbarui.'
        );
}

    public function toggleStatus(User $user)
{
    $user->update([
        'status_akun' =>
            $user->status_akun == 'aktif'
                ? 'nonaktif'
                : 'aktif'
    ]);

    return back()->with(
        'success',
        'Status akun berhasil diperbarui.'
    );
}
}
