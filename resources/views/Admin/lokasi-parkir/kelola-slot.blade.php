@extends('admin.layouts.main')

@section('title', 'Kelola Slot Parkir')
@section('bg-icon', 'parking')

@section('content')
<!-- Header -->
<div class="flex justify-between items-center mb-6">
    <div>
        <div class="flex items-center gap-2 text-secondary text-sm mb-1">
            <a href="{{ route('admin.lokasi-parkir.index') }}" class="hover:text-primary">Lokasi Parkir</a>
            <span class="material-symbols-outlined text-[16px]">chevron_right</span>
            <a href="{{ route('admin.lokasi-parkir.show', $lokasi->id) }}" class="hover:text-primary">Area {{ $currentArea }}</a>
            <span class="material-symbols-outlined text-[16px]">chevron_right</span>
            <span class="text-on-surface font-bold">Kelola Slot</span>
        </div>
        <h2 class="text-3xl font-bold">Kelola Slot - {{ $currentArea }}</h2>
    </div>
    <a href="{{ route('admin.lokasi-parkir.show', $lokasi->id) }}" class="flex items-center gap-2 px-5 py-2.5 border border-gray-300 hover:bg-gray-50 rounded-lg font-medium transition-all">
        <span class="material-symbols-outlined text-[20px]">arrow_back</span>
        Kembali
    </a>
</div>

<!-- Alert -->
@if(session('success'))
<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4 flex items-center justify-between">
    <span>{{ session('success') }}</span>
    <button onclick="this.parentElement.remove()" class="text-green-700">
        <span class="material-symbols-outlined">close</span>
    </button>
</div>
@endif

@if(session('error'))
<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4 flex items-center justify-between">
    <span>{{ session('error') }}</span>
    <button onclick="this.parentElement.remove()" class="text-red-700">
        <span class="material-symbols-outlined">close</span>
    </button>
</div>
@endif

@if($errors->any())
<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4">
    <ul class="list-disc list-inside text-sm">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<!-- ========== TOOLBAR (SEARCH & FILTER) ========== -->
<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 mb-6">
    <form action="{{ route('admin.lokasi-parkir.kelola-slot', $lokasi->id) }}" method="GET" class="flex flex-wrap items-center gap-3">
        <div class="relative flex-1 min-w-[200px]">
            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-[18px]">search</span>
            <input type="text" name="search" value="{{ request('search') }}" 
                   class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary text-sm"
                   placeholder="Cari kode slot atau area...">
        </div>
        <select name="jenis" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary text-sm">
            <option value="">Semua Jenis</option>
            <option value="mobil" {{ request('jenis') == 'mobil' ? 'selected' : '' }}>Mobil</option>
            <option value="motor" {{ request('jenis') == 'motor' ? 'selected' : '' }}>Motor</option>
        </select>
        <select name="status_filter" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary text-sm">
            <option value="">Semua Status</option>
            <option value="tersedia" {{ request('status_filter') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
            <option value="terisi" {{ request('status_filter') == 'terisi' ? 'selected' : '' }}>Terisi</option>
        </select>
        <button type="submit" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary/90 transition-all flex items-center gap-2 text-sm">
            <span class="material-symbols-outlined text-[18px]">filter_list</span>
            Filter
        </button>
        @if(request('search') || request('jenis') || request('status_filter'))
        <a href="{{ route('admin.lokasi-parkir.kelola-slot', $lokasi->id) }}" class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition-all text-sm">
            Reset
        </a>
        @endif
    </form>
</div>

<!-- ========== BULK CREATE SLOT ========== -->
<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 mb-6">
    <div class="flex items-center justify-between">
        <div>
            <h3 class="text-lg font-bold">⚡ Buat Banyak Slot Sekaligus</h3>
            <p class="text-sm text-gray-500">Buat puluhan slot parkir dalam satu kali klik</p>
        </div>
        <button onclick="toggleBulkForm()" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary/90 transition-all flex items-center gap-2">
            <span class="material-symbols-outlined text-[18px]">add</span>
            Buat Banyak Slot
        </button>
    </div>

    <div id="bulkForm" style="display: none;" class="mt-4 pt-4 border-t border-gray-200">
        <form action="{{ route('admin.lokasi-parkir.bulk-store-slot', $lokasi->id) }}" method="POST">
            @csrf
            <div class="grid grid-cols-12 gap-4">
                <div class="col-span-3">
                    <label class="text-sm text-gray-600 block mb-1">Prefix Kode Slot</label>
                    <input type="text" name="prefix" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary text-sm" placeholder="Contoh: A" value="A" required>
                    <small class="text-xs text-gray-400">Akan menjadi A1, A2, A3, ...</small>
                </div>
                <div class="col-span-2">
                    <label class="text-sm text-gray-600 block mb-1">Mulai Dari</label>
                    <input type="number" name="start_from" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary text-sm" placeholder="1" value="1" required>
                </div>
                <div class="col-span-2">
                    <label class="text-sm text-gray-600 block mb-1">Jumlah Slot</label>
                    <input type="number" name="jumlah" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary text-sm" placeholder="20" value="20" required>
                    <small class="text-xs text-gray-400">Maksimal 50 slot</small>
                </div>
                <div class="col-span-2">
                    <label class="text-sm text-gray-600 block mb-1">Area</label>
                    <input type="text" name="area" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary text-sm" placeholder="Area" value="A" required>
                </div>
                <div class="col-span-3">
                    <label class="text-sm text-gray-600 block mb-1">Jenis Kendaraan</label>
                    <select name="jenis_kendaraan" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary text-sm" required>
                        <option value="mobil">Mobil</option>
                        <option value="motor">Motor</option>
                    </select>
                </div>
                <div class="col-span-3">
                    <label class="text-sm text-gray-600 block mb-1">Tarif / Jam</label>
                    <input type="number" name="tarif_per_jam" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary text-sm" placeholder="5000" value="5000" required>
                </div>
                <div class="col-span-3">
                    <label class="text-sm text-gray-600 block mb-1">Status</label>
                    <select name="status" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary text-sm" required>
                        <option value="tersedia">Tersedia</option>
                        <option value="terisi">Terisi</option>
                    </select>
                </div>
                <div class="col-span-3 flex items-end">
                    <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white py-2.5 rounded-lg flex items-center justify-center gap-2 transition-all font-medium">
                        <span class="material-symbols-outlined text-[18px]">bolt</span>
                        Buat Slot Massal
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

@php
$totalSlot = $slots->total();

$slotTerisi = collect($slots->items())
    ->where('status', 'terisi')
    ->count();

$slotTersedia = collect($slots->items())
    ->where('status', 'tersedia')
    ->count();

$persen = $totalSlot > 0
    ? round(($slotTerisi / $totalSlot) * 100)
    : 0;
@endphp

<div class="grid grid-cols-12 gap-6">

    {{-- INFORMASI AREA --}}
    <div class="col-span-12 lg:col-span-4 space-y-6">

        <div class="bg-white rounded-2xl shadow-sm border p-6">

            <h3 class="text-lg font-bold mb-4">
                Informasi Area
            </h3>

            <div class="space-y-4">

                <div class="flex justify-between">
                    <span class="text-gray-500">Nama Area</span>
                    <span class="font-bold text-primary">
                        {{ $lokasi->nama }}
                    </span>
                </div>

                <div class="flex justify-between">
                    <span class="text-gray-500">Total Slot</span>
                    <span class="font-bold">
                        {{ $totalSlot }}
                    </span>
                </div>

                <div class="flex justify-between">
                    <span class="text-gray-500">Slot Tersedia</span>
                    <span class="font-bold text-green-600">
                        {{ $slotTersedia }}
                    </span>
                </div>

            </div>

        </div>

        {{-- KAPASITAS --}}
        <div class="bg-primary text-white rounded-2xl p-6">

            <p class="text-sm opacity-80">
                Kapasitas Saat Ini
            </p>

            <h2 class="text-5xl font-black">
                {{ $persen }}%
            </h2>

            <div class="mt-4 h-2 bg-white/20 rounded-full">
                <div
                    class="h-2 bg-white rounded-full"
                    style="width: {{ $persen }}%">
                </div>
            </div>

            <p class="text-sm mt-3">
                {{ $slotTerisi }} dari {{ $totalSlot }} slot terisi
            </p>

        </div>

    </div>

    {{-- VISUAL SLOT --}}
    <div class="col-span-12 lg:col-span-8">

        <div class="bg-white rounded-2xl shadow-sm border p-6">

            <div class="flex justify-between mb-6">

                <h3 class="text-lg font-bold">
                    Layout Visual Slot
                </h3>

                <button
                    onclick="toggleBulkForm()"
                    class="px-4 py-2 bg-primary text-white rounded-lg">

                    Tambah Slot

                </button>

            </div>

            <div class="grid grid-cols-5 gap-4">

                @foreach($slots as $slot)

                <div
                    class="aspect-square rounded-xl flex flex-col items-center justify-center

                    @if($slot->status == 'tersedia')
                        bg-green-100 border-2 border-green-500 text-green-600
                    @elseif($slot->status == 'terisi')
                        bg-red-500 text-white
                    @else
                        bg-gray-200 text-gray-500
                    @endif">

                    <span class="font-bold text-lg">
                        {{ $slot->kode_slot }}
                    </span>

                    <span class="text-[10px] uppercase">
                        {{ $slot->status }}
                    </span>

                </div>

                @endforeach

            </div>

        </div>

    </div>

    <div class="col-span-12">

```
<div class="bg-white rounded-2xl shadow-sm border overflow-hidden">

    <div class="px-5 py-4 border-b flex items-center justify-between">

        <div>
            <h3 class="font-bold text-lg">
                Daftar Slot & Manajemen
            </h3>

            <p class="text-sm text-gray-500">
                Monitoring kondisi slot parkir
            </p>
        </div>

        <span class="text-sm text-gray-500">
            Total {{ $slots->total() }} Slot
        </span>

    </div>

    <div class="overflow-x-auto">

        <table class="w-full">

            <thead>

                <tr class="bg-gray-50">

                    <th class="px-4 py-3 text-left">
                        Kode Slot
                    </th>

                    <th class="px-4 py-3 text-left">
                        Status
                    </th>

                    <th class="px-4 py-3 text-left">
                        No Reservasi
                    </th>

                    <th class="px-4 py-3 text-left">
                        Plat Kendaraan
                    </th>

                    <th class="px-4 py-3 text-right">
                        Aksi
                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse($slots as $slot)

                @php

                    $reservasiAktif = \App\Models\Reservasi::with('kendaraan')
                        ->where('slot_parkir_id', $slot->id)
                        ->whereIn('status', ['aktif','pending'])
                        ->latest()
                        ->first();

                @endphp

                <tr class="border-b hover:bg-gray-50">

                    <td class="px-4 py-4 font-semibold">
                        {{ $slot->kode_slot }}
                    </td>

                    <td class="px-4 py-4">

                        @if($slot->status == 'tersedia')

                            <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-medium">
                                🟢 Tersedia
                            </span>

                        @else

                            <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 text-xs font-medium">
                                🔴 Terisi
                            </span>

                        @endif

                    </td>

                    <td class="px-4 py-4">

                        @if($reservasiAktif)

                            {{ $reservasiAktif->kode_reservasi }}

                        @else

                            -

                        @endif

                    </td>

                    <td class="px-4 py-4">

                        @if($reservasiAktif && $reservasiAktif->kendaraan)

                            {{ $reservasiAktif->kendaraan->plat_nomor }}

                        @else

                            -

                        @endif

                    </td>

                    <td class="px-4 py-4 text-right">

                        <div class="flex justify-end gap-2">

                            @if($slot->status == 'tersedia')

                                <button
                                    class="px-3 py-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100">

                                    Reservasi Manual

                                </button>

                            @else

                                <button
                                    class="px-3 py-2 bg-green-50 text-green-600 rounded-lg hover:bg-green-100">

                                    Detail

                                </button>

                            @endif

                            <form
                                action="{{ route('admin.lokasi-parkir.destroy-slot', [$lokasi->id, $slot->id]) }}"
                                method="POST">

                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="px-3 py-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100">

                                    Hapus

                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="5" class="text-center py-8 text-gray-400">

                        Belum ada slot parkir

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    <div class="p-4 border-t">
        {{ $slots->links() }}
    </div>

</div>

</div>


</div>
@endsection

@push('scripts')
<script>
    function toggleBulkForm() {
        const form = document.getElementById('bulkForm');
        if (form.style.display === 'none') {
            form.style.display = 'block';
        } else {
            form.style.display = 'none';
        }
    }
</script>
@endpush

@push('styles')
<style>
    .sticky {
        position: sticky;
        top: 0;
        z-index: 10;
        background: white;
    }
</style>
@endpush