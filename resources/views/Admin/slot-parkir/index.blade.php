@extends('admin.layouts.main')

@section('title', 'Detail Lokasi Parkir')
@section('bg-icon', 'location_on')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3">
        <div>
            <div class="flex items-center gap-2 text-sm text-gray-500 mb-1">
                <a href="{{ route('admin.lokasi-parkir.index') }}" class="hover:text-primary">Lokasi Parkir</a>
                <span class="material-symbols-outlined text-[16px]">chevron_right</span>
                <span class="text-gray-800 font-bold">{{ $lokasi->nama }}</span>
            </div>
            <h2 class="text-2xl font-bold">Detail Lokasi Parkir</h2>
        </div>
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('admin.lokasi-parkir.edit', $lokasi->id) }}" class="flex items-center gap-1.5 px-4 py-2 border border-primary text-primary hover:bg-primary/5 rounded-lg text-sm font-medium transition-all">
                <span class="material-symbols-outlined text-[18px]">edit</span>
                Edit
            </a>
            <a href="{{ route('admin.lokasi-parkir.kelola-slot', $lokasi->id) }}" class="flex items-center gap-1.5 px-4 py-2 bg-primary text-white hover:bg-primary/90 rounded-lg text-sm font-medium transition-all shadow-md">
                <span class="material-symbols-outlined text-[18px]">add_box</span>
                Kelola Slot
            </a>
        </div>
    </div>

    <!-- Info & Statistik -->
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-4">
        <div class="lg:col-span-3 bg-white rounded-xl shadow-sm border border-gray-100 p-4">
            <!-- sama seperti sebelumnya, hanya route yang diubah -->
        </div>
        <div class="grid grid-cols-2 gap-3">
            <!-- statistik -->
        </div>
    </div>

    <!-- Area Management -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-4 py-3 border-b border-gray-100 flex justify-between items-center">
            <h3 class="text-base font-bold">Daftar Area</h3>
            <span class="text-xs text-gray-400">{{ $areas->count() }} area</span>
        </div>
        
        <div class="overflow-x-auto overflow-y-auto" style="max-height: 400px;">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 sticky top-0">
                    <tr>
                        <th class="px-4 py-2.5 text-left text-gray-500 font-medium text-xs uppercase tracking-wider">Area</th>
                        <th class="px-4 py-2.5 text-left text-gray-500 font-medium text-xs uppercase tracking-wider">Jenis</th>
                        <th class="px-4 py-2.5 text-left text-gray-500 font-medium text-xs uppercase tracking-wider">Slot</th>
                        <th class="px-4 py-2.5 text-left text-gray-500 font-medium text-xs uppercase tracking-wider">Tarif</th>
                        <th class="px-4 py-2.5 text-left text-gray-500 font-medium text-xs uppercase tracking-wider">Status</th>
                        <th class="px-4 py-2.5 text-right text-gray-500 font-medium text-xs uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($areas as $area)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-4 py-2.5">
                            <div class="flex items-center gap-2">
                                <div class="w-7 h-7 bg-primary rounded-lg flex items-center justify-center text-white font-bold text-xs flex-shrink-0">
                                    {{ strtoupper(substr($area->area, 0, 1)) }}
                                </div>
                                <span class="font-medium text-sm">Area {{ $area->area }}</span>
                            </div>
                        </td>
                        <td class="px-4 py-2.5">
                            <span class="flex items-center gap-1 text-sm">
                                <span class="material-symbols-outlined text-gray-400 text-[16px]">
                                    {{ $area->jenis_kendaraan == 'mobil' ? 'directions_car' : 'two_wheeler' }}
                                </span>
                                {{ ucfirst($area->jenis_kendaraan) }}
                            </span>
                        </td>
                        <td class="px-4 py-2.5">
                            <div class="flex items-center gap-2">
                                <div class="w-16 bg-gray-200 rounded-full h-1.5 overflow-hidden">
                                    @php
                                        $total = $area->total_slot;
                                        $terisi = $area->terisi;
                                        $persen = $total > 0 ? round(($terisi / $total) * 100) : 0;
                                    @endphp
                                    <div class="bg-primary h-full" style="width: {{ min($persen, 100) }}%"></div>
                                </div>
                                <span class="text-xs text-gray-500">{{ $total }} ({{ $terisi }} terisi)</span>
                            </div>
                        </td>
                        <td class="px-4 py-2.5 font-medium text-sm">Rp {{ number_format($area->tarif_per_jam, 0, ',', '.') }}</td>
                        <td class="px-4 py-2.5">
                            <span class="px-2 py-0.5 bg-green-100 text-green-700 rounded-full text-xs font-medium">Aktif</span>
                        </td>
                        <td class="px-4 py-2.5 text-right">
                            <a href="{{ route('admin.lokasi-parkir.kelola-slot', $lokasi->id) }}" class="text-primary hover:bg-primary/10 p-1.5 rounded-lg inline-block" title="Kelola Slot">
                                <span class="material-symbols-outlined text-[18px]">grid_view</span>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-4 py-8 text-center text-gray-400">
                            <span class="material-symbols-outlined text-3xl block mb-1">inbox</span>
                            Belum ada area
                            <br>
                            <a href="{{ route('admin.lokasi-parkir.kelola-slot', $lokasi->id) }}" class="text-primary hover:underline text-sm">Tambah sekarang</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="px-4 py-2 border-t border-gray-100 bg-gray-50 flex justify-between items-center">
            <span class="text-xs text-gray-400">Total {{ $areas->count() }} area</span>
            <span class="text-xs text-gray-400">Scroll untuk melihat semua</span>
        </div>
    </div>

    <!-- Quick Insights -->
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
        <div class="bg-purple-50 border border-purple-200 p-4 rounded-xl flex items-start gap-3">
            <div class="p-2 bg-white rounded-lg shadow-sm flex-shrink-0">
                <span class="material-symbols-outlined text-purple-600 text-[24px]">analytics</span>
            </div>
            <div>
                <h4 class="font-semibold text-purple-700 text-sm">Okupansi Hari Ini</h4>
                <p class="text-sm text-gray-600">
                    @php
                        $total = $totalSlots ?? 0;
                        $terisi = $occupiedSlots ?? 0;
                        $persen = $total > 0 ? round(($terisi / $total) * 100) : 0;
                    @endphp
                    {{ $persen }}% slot terisi
                </p>
            </div>
        </div>
        <div class="bg-blue-50 border border-blue-200 p-4 rounded-xl flex items-start gap-3">
            <div class="p-2 bg-white rounded-lg shadow-sm flex-shrink-0">
                <span class="material-symbols-outlined text-blue-600 text-[24px]">account_balance_wallet</span>
            </div>
            <div>
                <h4 class="font-semibold text-blue-700 text-sm">Estimasi Pendapatan</h4>
                <p class="text-sm text-gray-600">
                    Rp {{ number_format(($totalSlots ?? 0) * 5000, 0, ',', '.') }}
                </p>
            </div>
        </div>
    </div>
</div>
@endsection