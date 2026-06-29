@extends('Admin.layouts.app')

@section('content')

<div class="mb-6">
    <h2 class="text-2xl font-bold">
        Kelola User
    </h2>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-6">

    <div class="bg-white rounded-2xl shadow-sm border-l-4 border-blue-500 p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">
                    Total User
                </p>
                <h3 class="text-3xl font-bold mt-2">
                    {{ $users->total() }}
                </h3>
            </div>

            <span class="material-symbols-outlined text-blue-500 text-4xl">
                group
            </span>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border-l-4 border-green-500 p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">
                    Member
                </p>
                <h3 class="text-3xl font-bold mt-2">
                    {{ $users->where('status_member','member')->count() }}
                </h3>
            </div>

            <span class="material-symbols-outlined text-green-500 text-4xl">
                workspace_premium
            </span>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border-l-4 border-purple-500 p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">
                    User Aktif
                </p>
                <h3 class="text-3xl font-bold mt-2">
                    {{ $users->where('status_akun','aktif')->count() }}
                </h3>
            </div>

            <span class="material-symbols-outlined text-purple-500 text-4xl">
                verified_user
            </span>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border-l-4 border-orange-500 p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">
                    Total Kendaraan
                </p>
                <h3 class="text-3xl font-bold mt-2">
                    {{ $users->sum('kendaraan_count') }}
                </h3>
            </div>

            <span class="material-symbols-outlined text-orange-500 text-4xl">
                directions_car
            </span>
        </div>
    </div>

</div>

<div class="bg-white rounded-2xl shadow overflow-hidden">

    <table class="w-full">

        <thead class="bg-gray-50">
            <tr>
                <th class="px-4 py-3 text-left">Nama</th>
                <th class="px-4 py-3 text-left">Email</th>
                <th class="px-4 py-3 text-left">No HP</th>
                <th class="px-4 py-3 text-center">Kendaraan</th>
                <th class="px-4 py-3 text-center">Member</th>
                <th class="px-4 py-3 text-center">Status</th>
                <th class="px-4 py-3 text-center">Aksi</th>
            </tr>
        </thead>

        <tbody>

            @forelse($users as $user)

            <tr class="border-t hover:bg-gray-50">

                <td class="px-4 py-4 font-medium">
                    {{ $user->name }}
                </td>

                <td class="px-4 py-4">
                    {{ $user->email }}
                </td>

                <td class="px-4 py-4">
                    {{ $user->nomor_hp ?? '-' }}
                </td>

                <td class="px-4 py-4 text-center">
                    <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-lg text-xs">
                        {{ $user->kendaraan_count }} Kendaraan
                    </span>
                </td>

                <td class="px-4 py-4 text-center">

                    @if($user->status_member == 'member')
                        <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs">
                            Member
                        </span>
                    @else
                        <span class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-xs">
                            Biasa
                        </span>
                    @endif

                </td>

                <td class="px-4 py-4 text-center">

                    @if($user->status_akun == 'aktif')
                        <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs">
                            Aktif
                        </span>
                    @else
                        <span class="px-3 py-1 bg-red-100 text-red-700 rounded-full text-xs">
                            Nonaktif
                        </span>
                    @endif

                </td>

                <td class="px-4 py-4">

                    <div class="flex justify-center gap-2">

                        <a href="{{ route('admin.kelola-user.show', $user->id) }}"
                            class="px-3 py-2 bg-blue-600 text-white rounded-lg">
                            Detail
                        </a>

                        <a href="{{ route('admin.kelola-user.edit', $user->id) }}"
                            class="px-3 py-2 bg-yellow-500 text-white rounded-lg">
                            Edit
                        </a>

                        <a href="{{ route('admin.kelola-user.reset-password', $user->id) }}"
                            class="px-3 py-2 bg-purple-600 text-white rounded-lg">
                            Password
                        </a>

                    </div>

                </td>

            </tr>

            @empty

            <tr>
                <td colspan="7" class="text-center py-10 text-gray-500">
                    Belum ada data user.
                </td>
            </tr>

            @endforelse

        </tbody>

    </table>

    <div class="p-5 border-t">
        {{ $users->links() }}
    </div>

</div>

@endsection