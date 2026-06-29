@extends('Admin.layouts.app')

@section('content')

<div class="mb-6">

    <h2 class="text-2xl font-bold">
        History Parkir
    </h2>

</div>

<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-6">

    <div class="bg-white rounded-2xl shadow-sm border-l-4 border-blue-500 p-6">
    <div class="flex items-center justify-between">
        <div>
            <p class="text-sm text-gray-500">
                Total Parkir
            </p>
            <h3 class="text-3xl font-bold text-gray-800 mt-2">
                {{ $totalParkir }}
            </h3>
        </div>

        <span class="material-symbols-outlined text-blue-500 text-4xl">
            local_parking
        </span>
    </div>
</div>

<div class="bg-white rounded-2xl shadow-sm border-l-4 border-green-500 p-6">
    <div class="flex items-center justify-between">
        <div>
            <p class="text-sm text-gray-500">
                Parkir Mobil
            </p>
            <h3 class="text-3xl font-bold text-gray-800 mt-2">
                {{ $parkirMobil }}
            </h3>
        </div>

        <span class="material-symbols-outlined text-green-500 text-4xl">
            directions_car
        </span>
    </div>
</div>

<div class="bg-white rounded-2xl shadow-sm border-l-4 border-orange-500 p-6">
    <div class="flex items-center justify-between">
        <div>
            <p class="text-sm text-gray-500">
                Parkir Motor
            </p>
            <h3 class="text-3xl font-bold text-gray-800 mt-2">
                {{ $parkirMotor }}
            </h3>
        </div>

        <span class="material-symbols-outlined text-orange-500 text-4xl">
            two_wheeler
        </span>
    </div>
</div>

<div class="bg-white rounded-2xl shadow-sm border-l-4 border-primary p-6">
    <div class="flex items-center justify-between">
        <div>
            <p class="text-sm text-gray-500">
                Pendapatan
            </p>
            <h3 class="text-3xl font-bold text-primary mt-2">
                Rp {{ number_format($pendapatan, 0, ',', '.') }}
            </h3>
        </div>

        <span class="material-symbols-outlined text-primary text-4xl">
            payments
        </span>
    </div>
</div>

</div>

<div class="bg-white rounded-2xl shadow mb-6 p-6">

    <form method="GET" id="filterForm">

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

        <select
            name="lokasi_id"
            onchange="document.getElementById('filterForm').submit()"
            class="border rounded-xl px-4 py-3">

            <option value="">
                Semua Lokasi
            </option>

            @foreach($lokasi as $item)

            <option
                value="{{ $item->id }}"
                {{ request('lokasi_id') == $item->id ? 'selected' : '' }}>

                {{ $item->nama }}

            </option>

            @endforeach

        </select>

        <select
            name="jenis"
            onchange="document.getElementById('filterForm').submit()"
            class="border rounded-xl px-4 py-3">

            <option value="">
                Semua Kendaraan
            </option>

            <option
                value="Mobil"
                {{ request('jenis') == 'Mobil' ? 'selected' : '' }}>
                Mobil
            </option>

            <option
                value="Motor"
                {{ request('jenis') == 'Motor' ? 'selected' : '' }}>
                Motor
            </option>

        </select>

    </div>

</form>

</div>

<div class="bg-white rounded-2xl shadow overflow-hidden">

    <table class="w-full">

        <thead class="bg-gray-50">

            <tr>
                <th class="px-4 py-3 text-left">Kode Reservasi</th>
                <th class="px-4 py-3 text-left">Customer</th>
                <th class="px-4 py-3 text-left">Kendaraan</th>
                <th class="px-4 py-3 text-left">Lokasi</th>
                <th class="px-4 py-3 text-left">Slot</th>
                <th class="px-4 py-3 text-left">Check In</th>
                <th class="px-4 py-3 text-left">Check Out</th>
                <th class="px-4 py-3 text-left">Total Bayar</th>
                <th class="px-4 py-3 text-center">Status</th>
            </tr>

        </thead>

        <tbody>

            @forelse($history as $item)

            <tr class="border-t">

                <td class="px-4 py-4">
                    {{ $item->kode_reservasi }}
                </td>

                <td class="px-4 py-4">
                    {{ $item->user->name }}
                </td>

                <td class="px-4 py-4">
                    {{ $item->kendaraan->nomor_polisi }}
                </td>

                <td class="px-4 py-4">
                    {{ $item->lokasiParkir->nama }}
                </td>

                <td class="px-4 py-4">
                    {{ $item->slotParkir->kode_slot }}
                </td>

                <td class="px-4 py-4">
                    {{ $item->jam_masuk_aktual ?? '-' }}
                </td>

                <td class="px-4 py-4">
                    {{ $item->jam_keluar_aktual ?? '-' }}
                </td>

                <td class="px-4 py-4">
                    Rp {{ number_format($item->total_bayar,0,',','.') }}
                </td>

                <td class="px-4 py-4 text-center">
                    {{ ucfirst($item->status) }}
                </td>

            </tr>

            @empty

            <tr>

                <td colspan="9" class="text-center py-8">
                    Belum ada data history.
                </td>

            </tr>

            @endforelse

        </tbody>

    </table>

    <div class="p-5 border-t border-gray-100 flex flex-col md:flex-row items-center justify-between gap-4">

        <p class="text-gray-500">
            Menampilkan
            <span class="font-bold text-gray-900">
                {{ $history->firstItem() ?? 0 }}
            </span>
            -
            <span class="font-bold text-gray-900">
                {{ $history->lastItem() ?? 0 }}
            </span>
            dari
            <span class="font-bold text-gray-900">
                {{ $history->total() }}
            </span>
            data
        </p>

        <div>
            {{ $history->links() }}
        </div>

    </div>
</div>

<div class="mt-6">
    {{ $history->links() }}
</div>

@endsection