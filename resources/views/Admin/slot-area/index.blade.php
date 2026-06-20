@extends('Admin.layouts.app')

@section('title', 'Area Parkir - Parkir UDINUS')

@section('content')

<div class="p-6 flex-1 overflow-y-auto">

    {{-- Header Section --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">

        <div>
            <nav class="flex items-center gap-2 text-gray-500 text-sm mb-1">
                <a href="{{ route('admin.lokasi-parkir.index') }}" class="hover:text-primary">
                    Lokasi Parkir
                </a>
                <span class="material-symbols-outlined text-sm">chevron_right</span>
                <span class="font-semibold text-gray-900">
                    Semua Area Parkir
                </span>
            </nav>
            <h2 class="text-2xl font-bold text-gray-900">Area Parkir</h2>
        </div>

        <div class="flex items-center gap-3">
            <a href="{{ route('admin.slot-area.create', $lokasi->id) }}"
            class="bg-primary hover:opacity-90 text-white px-5 py-3 rounded-xl flex items-center gap-2 shadow-lg">
                <span class="material-symbols-outlined">add</span>
                <span>Tambah Area</span>
            </a>
        </div>

    </div>

    {{-- Main Content Card --}}
    <section class="bg-white rounded-2xl shadow-elevation-1 overflow-hidden border border-outline-variant/20">

        {{-- Toolbar --}}
        <div class="p-5 flex flex-col md:flex-row items-center justify-between gap-4 border-b border-gray-200">

            <div class="relative w-full md:w-80">
                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">search</span>
                <input
                    type="text"
                    placeholder="Cari nama area..."
                    class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary/10 focus:border-primary">
            </div>

            <div class="flex items-center gap-3">
                <select class="px-4 py-2 border border-gray-300 rounded-xl">
                    <option>Semua Status</option>
                    <option>Aktif</option>
                    <option>Non Aktif</option>
                </select>
                <button class="flex items-center gap-2 px-4 py-2 border border-gray-300 rounded-xl hover:bg-gray-50">
                    <span class="material-symbols-outlined text-sm">ios_share</span>
                    Export
                </button>
            </div>

        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-50 border-b">
                        <th class="p-4 text-left">Area</th>
                        <th class="p-4 text-left">Jenis Kendaraan</th>
                        <th class="p-4 text-left">Jumlah Slot</th>
                        <th class="p-4 text-left">Tarif Per Jam</th>
                        <th class="p-4 text-left">Status</th>
                        <th class="p-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>

                    @forelse($areas as $area)

                    <tr class="border-b hover:bg-gray-50">

                        <td class="p-4">

                            <div class="flex items-center gap-3">

                                <div
                                    class="w-8 h-8 rounded-lg flex items-center justify-center text-white font-bold text-sm flex-shrink-0"
                                    style="background: #5445cf;">

                                    {{ strtoupper(substr($area->nama_area, -1)) }}

                                </div>

                                <span class="font-semibold text-primary">
                                    {{ $area->nama_area }}
                                </span>

                            </div>

                        </td>

                        <td class="p-4">

                            <span class="bg-primary/10 text-primary px-2 py-1 rounded-lg text-xs font-semibold">

                                {{ strtoupper($area->jenis_kendaraan) }}

                            </span>

                        </td>

                        <td class="p-4">

                            <span class="font-semibold">

                                {{ $area->slotParkir->count() }} Slot

                            </span>

                        </td>

                        <td class="p-4">

                            <span class="font-semibold text-green-600">

                                Rp {{ number_format($area->tarif_per_jam,0,',','.') }}

                            </span>

                        </td>

                        <td class="p-4">

                            @if($area->status == 'aktif')

                                <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm">
                                    Aktif
                                </span>

                            @else

                                <span class="px-3 py-1 bg-red-100 text-red-700 rounded-full text-sm">
                                    Nonaktif
                                </span>

                            @endif

                        </td>

                        <td class="p-4">

                            <div class="flex justify-center gap-2">

                                {{-- Kelola Slot --}}
                                <a
                                    href="{{ route('admin.slot-parkir.index', $area->id) }}"
                                    class="p-2 rounded-lg hover:bg-blue-100 text-primary"
                                    title="Kelola Slot">

                                    <span class="material-symbols-outlined">
                                        grid_view
                                    </span>

                                </a>

                                {{-- Edit --}}
                                <a
                                    href="{{ route('admin.slot-area.edit', [$lokasi->id, $area->id]) }}"
                                    class="p-2 rounded-lg hover:bg-yellow-100 text-yellow-600"
                                    title="Edit Area">

                                    <span class="material-symbols-outlined">
                                        edit
                                    </span>

                                </a>

                                {{-- Hapus --}}
                                <form
                                    action="{{ route('admin.slot-area.destroy', [$lokasi->id, $area->id]) }}"
                                    method="POST">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        onclick="return confirm('Yakin ingin menghapus area ini?')"
                                        class="p-2 rounded-lg hover:bg-red-100 text-red-500"
                                        title="Hapus Area">

                                        <span class="material-symbols-outlined">
                                            delete
                                        </span>

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="6" class="p-8 text-center text-gray-500">

                            Belum ada area parkir

                        </td>

                    </tr>

                    @endforelse

                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="p-5 border-t border-outline-variant/10 flex flex-col md:flex-row items-center justify-between gap-4">

            <p class="text-secondary">
                Menampilkan
                <span class="font-bold text-on-surface">
                    {{ $areas->count() }}
                </span>
                area parkir
            </p>

            <div class="flex items-center gap-2">
                <button
                    class="w-10 h-10 flex items-center justify-center rounded-lg border border-outline-variant/30 text-secondary hover:bg-surface-container transition-colors disabled:opacity-50"
                    disabled>
                    <span class="material-symbols-outlined">chevron_left</span>
                </button>
                <button
                    class="w-10 h-10 flex items-center justify-center rounded-lg bg-primary text-white font-bold shadow-md shadow-primary/20">
                    1
                </button>
                <button
                    class="w-10 h-10 flex items-center justify-center rounded-lg border border-outline-variant/30 disabled:opacity-50"
                    disabled>
                    <span class="material-symbols-outlined">chevron_right</span>
                </button>
            </div>

        </div>

    </section>

</div>

@endsection