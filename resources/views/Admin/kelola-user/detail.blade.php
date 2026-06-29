@extends('Admin.layouts.app')

@section('content')

<div class="mb-6 flex items-center justify-between">

    <div>
        <h2 class="text-2xl font-bold">
            Detail User
        </h2>

        <p class="text-gray-500 mt-1">
            Informasi lengkap pengguna
        </p>
    </div>

    <a href="{{ route('admin.kelola-user.index') }}"
        class="px-4 py-2 rounded-xl border border-gray-300 hover:bg-gray-50">

        Kembali

    </a>

</div>

<div class="grid grid-cols-1 xl:grid-cols-3 gap-6 mb-6">

    <div class="xl:col-span-2">

        <div class="bg-white rounded-2xl shadow overflow-hidden">

            <div class="px-6 py-4 border-b">
                <h3 class="font-semibold text-lg">
                    Informasi User
                </h3>
            </div>

            <div class="p-6">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div>
                        <label class="text-sm text-gray-500">
                            Nama
                        </label>

                        <div class="font-semibold mt-1">
                            {{ $user->name }}
                        </div>
                    </div>

                    <div>
                        <label class="text-sm text-gray-500">
                            Email
                        </label>

                        <div class="font-semibold mt-1">
                            {{ $user->email }}
                        </div>
                    </div>

                    <div>
                        <label class="text-sm text-gray-500">
                            No HP
                        </label>

                        <div class="font-semibold mt-1">
                            {{ $user->nomor_hp ?? '-' }}
                        </div>
                    </div>

                    <div>
                        <label class="text-sm text-gray-500">
                            Status Member
                        </label>

                        <div class="mt-2">

                            @if($user->status_member == 'member')

                                <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs">
                                    Member
                                </span>

                            @else

                                <span class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-xs">
                                    Biasa
                                </span>

                            @endif

                        </div>
                    </div>

                    <div>
                        <label class="text-sm text-gray-500">
                            Status Akun
                        </label>

                        <div class="mt-2">

                            @if($user->status_akun == 'aktif')

                                <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs">
                                    Aktif
                                </span>

                            @else

                                <span class="px-3 py-1 bg-red-100 text-red-700 rounded-full text-xs">
                                    Nonaktif
                                </span>

                            @endif

                        </div>

                    </div>

                    <div>
                        <label class="text-sm text-gray-500">
                            Tanggal Bergabung
                        </label>

                        <div class="font-semibold mt-1">
                            {{ $user->created_at->format('d M Y H:i') }}
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>

    <div>

        <div class="bg-white rounded-2xl shadow p-6">

            <div class="flex flex-col items-center">

                <div class="w-24 h-24 rounded-full bg-primary/10 flex items-center justify-center">

                    <span class="material-symbols-outlined text-primary text-5xl">
                        person
                    </span>

                </div>

                <h3 class="font-bold text-lg mt-4">
                    {{ $user->name }}
                </h3>

                <p class="text-gray-500 text-sm">
                    {{ $user->email }}
                </p>

            </div>

        </div>

    </div>

</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">

    <div class="bg-white rounded-2xl shadow-sm border-l-4 border-blue-500 p-6">

        <p class="text-sm text-gray-500">
            Total Kendaraan
        </p>

        <h3 class="text-3xl font-bold mt-2">
            {{ $user->kendaraan->count() }}
        </h3>

    </div>

    <div class="bg-white rounded-2xl shadow-sm border-l-4 border-green-500 p-6">

        <p class="text-sm text-gray-500">
            Total Reservasi
        </p>

        <h3 class="text-3xl font-bold mt-2">
            {{ $user->reservasi->count() }}
        </h3>

    </div>

    <div class="bg-white rounded-2xl shadow-sm border-l-4 border-purple-500 p-6">

        <p class="text-sm text-gray-500">
            Total Pengeluaran
        </p>

        <h3 class="text-2xl font-bold mt-2 text-primary">
            Rp {{ number_format($user->reservasi->sum('total_bayar'), 0, ',', '.') }}
        </h3>

    </div>

</div>

<div class="bg-white rounded-2xl shadow overflow-hidden">

    <div class="px-6 py-4 border-b">

        <h3 class="font-semibold text-lg">
            Daftar Kendaraan
        </h3>

    </div>

    <table class="w-full">

        <thead class="bg-gray-50">

            <tr>
                <th class="px-4 py-3 text-left">
                    Nomor Polisi
                </th>

                <th class="px-4 py-3 text-left">
                    Jenis Kendaraan
                </th>

                <th class="px-4 py-3 text-left">
                    Merk
                </th>

                <th class="px-4 py-3 text-left">
                    Warna
                </th>
            </tr>

        </thead>

        <tbody>

            @forelse($user->kendaraan as $kendaraan)

            <tr class="border-t">

                <td class="px-4 py-4 font-medium">
                    {{ $kendaraan->nomor_polisi }}
                </td>

                <td class="px-4 py-4">

                    @if($kendaraan->jenis_kendaraan == 'mobil')

                        <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs">
                            Mobil
                        </span>

                    @else

                        <span class="px-3 py-1 bg-orange-100 text-orange-700 rounded-full text-xs">
                            Motor
                        </span>

                    @endif

                </td>

                <td class="px-4 py-4">
                    {{ $kendaraan->merk }}
                </td>

                <td class="px-4 py-4">
                    {{ $kendaraan->warna }}
                </td>

            </tr>

            @empty

            <tr>

                <td colspan="4" class="text-center py-8 text-gray-500">

                    Belum ada kendaraan

                </td>

            </tr>

            @endforelse

        </tbody>

    </table>

</div>

@endsection