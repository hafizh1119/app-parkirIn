@extends('Admin.layouts.app')

@section('title', 'Kelola Slot Parkir')

@section('content')

<div class="space-y-6">

    {{-- Breadcrumb --}}
    <div>
        <nav class="flex items-center gap-2 text-gray-500 text-sm mb-2">
            <a href="{{ route('admin.dashboard') }}" class="hover:text-primary">Dashboard</a>
            <span class="material-symbols-outlined text-sm">chevron_right</span>
            <a href="{{ route('admin.lokasi-parkir.index') }}" class="hover:text-primary">Lokasi Parkir</a>
            <span class="material-symbols-outlined text-sm">chevron_right</span>
            <a href="{{ route('admin.slot-area.index', $area->lokasi_parkir_id) }}" class="hover:text-primary">
                {{ $area->nama_area }}
            </a>
            <span class="material-symbols-outlined text-sm">chevron_right</span>
            <span class="font-semibold text-gray-900">Kelola Slot</span>
        </nav>

        <h2 class="text-2xl font-bold text-gray-900">
            Kelola Slot {{ $area->nama_area }}
        </h2>
    </div>

    {{-- Grid --}}
    <div class="grid grid-cols-12 gap-6">

        {{-- Informasi Area --}}
        <div class="col-span-12 lg:col-span-4">

            <div class="bg-white rounded-2xl border border-outline-variant/20 p-6 shadow-sm">

                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-semibold text-lg">Informasi Area</h3>
                    <span class="material-symbols-outlined text-primary">info</span>
                </div>

                <div class="space-y-4">

                    <div class="flex justify-between">
                        <span class="text-gray-500">Nama Area</span>
                        <span class="font-semibold text-primary">{{ $area->nama_area }}</span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-gray-500">Jenis Kendaraan</span>
                        <span class="bg-primary/10 text-primary px-2 py-1 rounded-lg text-xs font-semibold">
                            {{ strtoupper($area->jenis_kendaraan) }}
                        </span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-gray-500">Total Slot</span>
                        <span class="font-semibold">{{ $totalSlot }} Slot</span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-gray-500">Tarif</span>
                        <span class="font-semibold text-green-600">
                            Rp {{ number_format($area->tarif_per_jam, 0, ',', '.') }}
                        </span>
                    </div>

                </div>

            </div>

            {{-- Kapasitas --}}
            <div class="bg-primary text-white rounded-2xl p-6 mt-6">

                <p class="text-sm opacity-80">Kapasitas Saat Ini</p>

                <h3 class="text-4xl font-bold mt-2">{{ $kapasitas }}%</h3>

                <div class="w-full bg-white/20 rounded-full h-2 mt-4">
                    <div class="bg-white h-2 rounded-full" style="width: {{ $kapasitas }}%"></div>
                </div>

                <p class="text-sm mt-3">{{ $slotTerisi }} dari {{ $totalSlot }} slot terisi</p>

            </div>

        </div>

        {{-- Visual Slot --}}
        <div class="col-span-12 lg:col-span-8">

            <div class="bg-white rounded-2xl border border-outline-variant/20 p-6 shadow-sm">

                <div class="flex justify-between items-center mb-6">

                    <h3 class="font-semibold text-lg">Layout Visual Slot</h3>

                    <div class="flex items-center gap-4 text-sm">
                        <div class="flex items-center gap-2">
                            <span class="w-3 h-3 rounded-full bg-green-500"></span>
                            <span>Kosong</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="w-3 h-3 rounded-full bg-red-500"></span>
                            <span>Terisi</span>
                        </div>
                    </div>

                </div>

                <div class="grid grid-cols-5 gap-4">

                    @forelse($slots as $slot)

                        @if($slot->status == 'tersedia')
                            <div class="h-24 rounded-xl border-2 border-green-500 bg-green-50 flex flex-col items-center justify-center hover:bg-green-100 transition cursor-pointer">
                                <span class="font-bold text-xl">{{ $slot->kode_slot }}</span>
                                <span class="text-sm text-green-600 font-medium">TERSEDIA</span>
                            </div>
                        @else
                            <div class="h-24 rounded-xl bg-red-500 text-white flex flex-col items-center justify-center hover:opacity-90 transition cursor-pointer">
                                <span class="font-bold text-xl">{{ $slot->kode_slot }}</span>
                                <span class="text-sm font-medium">TERISI</span>
                            </div>
                        @endif

                    @empty
                        <div class="col-span-5 text-center text-gray-400 py-8">
                            Belum ada slot
                        </div>
                    @endforelse

                </div>

            </div>

        </div>

        {{-- Tabel Slot --}}
        <div class="col-span-12">

            <div class="bg-white rounded-2xl border border-outline-variant/20 overflow-hidden shadow-sm">

                <div class="p-6 flex justify-between items-center">
                    <h3 class="font-semibold text-lg">Daftar Slot</h3>
                </div>

                <table class="w-full">

                    <thead class="bg-gray-50">
                        <tr>
                            <th class="p-4 text-left">Kode Slot</th>
                            <th class="p-4 text-left">Status</th>
                            <th class="p-4 text-left">Reservasi</th>
                            <th class="p-4 text-left">Nomor Polisi</th>
                            <th class="p-4 text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($slots as $slot)
                        <tr class="border-t hover:bg-gray-50">

                            <td class="p-4 font-semibold">{{ $slot->kode_slot }}</td>

                            <td class="p-4">
                                @if($slot->status == 'tersedia')
                                    <span class="bg-green-100 text-green-700 px-2 py-1 rounded-full text-xs">TERSEDIA</span>
                                @else
                                    <span class="bg-red-100 text-red-700 px-2 py-1 rounded-full text-xs">TERISI</span>
                                @endif
                            </td>

                            @php $reservasiAktif = $slot->reservasi->first(); @endphp

                            <td class="p-4">
                                @if($reservasiAktif)
                                    <span class="font-semibold text-primary">{{ $reservasiAktif->kode_reservasi }}</span>
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>

                            <td class="p-4">
                                @if($reservasiAktif && $reservasiAktif->kendaraan)
                                    <div class="flex flex-col">
                                        <span class="font-semibold">{{ $reservasiAktif->kendaraan->nomor_polisi }}</span>
                                        <span class="text-xs text-gray-500">{{ $reservasiAktif->kendaraan->merk }} - {{ $reservasiAktif->kendaraan->warna }}</span>
                                    </div>
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>

                            <td class="p-4 text-center">
                                <div class="flex justify-center gap-2">
                                    <form action="{{ route('admin.slot-parkir.destroy', [$area->id, $slot->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            type="submit"
                                            onclick="return confirm('Yakin ingin menghapus slot ini?')"
                                            class="p-2 rounded-lg hover:bg-red-100 text-red-500"
                                            title="Hapus Slot">
                                            <span class="material-symbols-outlined">delete</span>
                                        </button>
                                    </form>
                                </div>
                            </td>

                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="p-8 text-center text-gray-500">Belum ada slot parkir</td>
                        </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection