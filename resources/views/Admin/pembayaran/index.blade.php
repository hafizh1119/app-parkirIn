@extends('Admin.layouts.app')

@section('title', 'Verifikasi Pembayaran')

@section('content')
<div class="space-y-6">
    <!-- Breadcrumb -->
    <nav class="flex items-center gap-2 text-sm text-gray-500">
        <span>Dashboard</span>
        <span class="material-symbols-outlined text-sm">chevron_right</span>
        <span class="text-[#5445cf] font-semibold">Verifikasi Pembayaran</span>
    </nav>

    <!-- Alert Messages -->
    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg flex items-center gap-2">
            <span class="material-symbols-outlined text-green-500">check_circle</span>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg flex items-center gap-2">
            <span class="material-symbols-outlined text-red-500">error</span>
            {{ session('error') }}
        </div>
    @endif

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-gradient-to-r from-[#5445cf] to-[#7c5cbf] p-6 rounded-xl text-white shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm opacity-80">Total Pendapatan</p>
                    <h2 class="text-2xl font-bold">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h2>
                </div>
                <span class="material-symbols-outlined text-4xl opacity-80">payments</span>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Total Transaksi</p>
                    <h2 class="text-3xl font-bold text-gray-800">{{ number_format($totalTransaksi) }}</h2>
                </div>
                <span class="material-symbols-outlined text-4xl text-[#5445cf]">receipt_long</span>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Parkir Mobil</p>
                    <h2 class="text-3xl font-bold text-gray-800">{{ number_format($parkirMobil) }}</h2>
                </div>
                <span class="material-symbols-outlined text-4xl text-blue-500">directions_car</span>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Parkir Motor</p>
                    <h2 class="text-3xl font-bold text-gray-800">{{ number_format($parkirMotor) }}</h2>
                </div>
                <span class="material-symbols-outlined text-4xl text-orange-500">two_wheeler</span>
            </div>
        </div>
    </div>

    <!-- Payment List Table -->
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-lg font-bold text-gray-800">Daftar Pembayaran</h3>
            <p class="text-sm text-gray-500">Riwayat pembayaran pelanggan</p>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gray-50 text-gray-600 border-b border-gray-200">
                        <th class="px-6 py-3 text-left font-semibold">Kode Reservasi</th>
                        <th class="px-6 py-3 text-left font-semibold">Pelanggan</th>
                        <th class="px-6 py-3 text-left font-semibold">Lokasi / Slot</th>
                        <th class="px-6 py-3 text-left font-semibold">Kendaraan</th>
                        <th class="px-6 py-3 text-left font-semibold">Total Bayar</th>
                        <th class="px-6 py-3 text-left font-semibold">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($pembayaran as $item)
                    <tr class="hover:bg-gray-50/50 transition">
                        <td class="px-6 py-4 font-semibold text-gray-800">
                            {{ $item->reservasi->kode_reservasi ?? '-' }}
                        </td>
                        <td class="px-6 py-4">
                            <p class="font-semibold text-gray-800">{{ $item->reservasi->user->name ?? '-' }}</p>
                            <p class="text-xs text-gray-500">{{ $item->reservasi->user->email ?? '-' }}</p>
                        </td>
                        <td class="px-6 py-4">
                            <p>{{ $item->reservasi->lokasiParkir->nama ?? '-' }}</p>
                            <p class="text-xs text-gray-500">{{ $item->reservasi->slotParkir->kode_slot ?? '-' }}</p>
                        </td>
                        <td class="px-6 py-4">
                            {{ $item->reservasi->kendaraan->jenis_kendaraan ?? '-' }}
                        </td>
                        <td class="px-6 py-4 font-semibold">
                            Rp {{ number_format($item->reservasi->total_bayar ?? 0, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4">
                            @php
                                $statusLabel = match($item->status) {
                                    'dibayar' => 'Dibayar',
                                    'ditolak' => 'Ditolak',
                                    'belum_bayar' => 'Belum Bayar',
                                    default => ucfirst(str_replace('_', ' ', $item->status)),
                                };
                                $statusClass = match($item->status) {
                                    'dibayar' => 'bg-green-50 text-green-600',
                                    'ditolak' => 'bg-red-50 text-red-600',
                                    default => 'bg-yellow-50 text-yellow-600',
                                };
                            @endphp
                            <span class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase {{ $statusClass }}">
                                {{ $statusLabel }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                            <span class="material-symbols-outlined text-4xl text-gray-300 block mb-2">receipt_long</span>
                            Belum ada data pembayaran.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection