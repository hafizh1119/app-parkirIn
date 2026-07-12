@extends('Admin.layouts.app')

@section('title', 'Kelola Lokasi Parkir')

@section('content')

<div class="p-6 flex-1 overflow-y-auto">

<!-- Header Section -->
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">

    <div>
        <nav class="flex items-center gap-2 text-gray-500 text-sm mb-1">
            <a href="{{ route('admin.dashboard') }}" class="hover:text-primary">
                Dashboard
            </a>

            <span class="material-symbols-outlined text-sm">
                chevron_right
            </span>

            <span class="font-semibold text-gray-900">
                Lokasi Parkir
            </span>
        </nav>

        <h2 class="text-2xl font-bold text-gray-900">
            Kelola Lokasi Parkir
        </h2>
    </div>

    <a href="{{ route('admin.lokasi-parkir.create') }}"
        class="bg-primary hover:opacity-90 text-white px-5 py-3 rounded-xl flex items-center gap-2 shadow-lg">

        <span class="material-symbols-outlined">
            add
        </span>

        <span>
            Tambah Lokasi
        </span>

    </a>

</div>

<!-- Main Content Card -->
<section class="bg-white rounded-2xl shadow-elevation-1 overflow-hidden border border-outline-variant/20">
    <!-- Toolbar -->
    <div class="p-5 flex flex-col md:flex-row items-center justify-between gap-4 border-b border-gray-200">

        <div class="relative w-full md:w-80">

            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                search
            </span>

            <input
                type="text"
                placeholder="Cari nama lokasi..."
                class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary/10 focus:border-primary">

        </div>

        <div class="flex items-center gap-3">

            <select class="px-4 py-2 border border-gray-300 rounded-xl">
                <option>Semua Status</option>
                <option>Aktif</option>
                <option>Non Aktif</option>
            </select>

            <button class="flex items-center gap-2 px-4 py-2 border border-gray-300 rounded-xl hover:bg-gray-50">
                <span class="material-symbols-outlined text-sm">
                    ios_share
                </span>
                Export
            </button>

        </div>

    </div>

    <!-- Table -->
    <div class="overflow-x-auto">

        <table class="w-full">

            <thead>

                <tr class="bg-gray-50 border-b">

                    <th class="p-4 text-left">Gambar</th>
                    <th class="p-4 text-left">Nama Lokasi</th>
                    <th class="p-4 text-left">Jumlah Area</th>
                    <th class="p-4 text-left">Total Slot</th>
                    <th class="p-4 text-left">Deskripsi</th>
                    <th class="p-4 text-center">Aksi</th>

                </tr>

            </thead>

            <tbody>

                @forelse($lokasiParkir as $lokasi)

                    <tr class="border-b hover:bg-gray-50 transition">

                        {{-- Gambar --}}
                        <td class="p-4">

                            @if(!empty($lokasi->gambar))

                                <img
                                    src="{{ asset($lokasi->gambar) }}"
                                    alt="{{ $lokasi->nama }}"
                                    class="w-20 h-20 object-cover rounded-xl border border-gray-200 shadow-sm">

                            @else

                                <div
                                    class="w-20 h-20 rounded-xl bg-gray-100 border border-gray-200 flex items-center justify-center">

                                    <span class="material-symbols-outlined text-gray-400 text-3xl">
                                        image
                                    </span>

                                </div>

                            @endif

                        </td>

                        {{-- Nama Lokasi --}}
                        <td class="p-4">

                            <div>

                                <p class="font-semibold text-gray-900">
                                    {{ $lokasi->nama }}
                                </p>

                                <p class="text-sm text-gray-500 mt-1">
                                    {{ $lokasi->alamat }}
                                </p>

                            </div>

                        </td>

                        <td class="p-4">
                            <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-sm whitespace-nowrap">
                                {{ $lokasi->area_parkir_count }} Area
                            </span>
                        </td>

                        <td class="p-4">
                            <span class="px-3 py-1 bg-purple-100 text-purple-700 rounded-full text-sm whitespace-nowrap">
                                {{ $lokasi->slot_parkir_count ?? 0 }} Slot
                            </span>
                        </td>

                        <td class="p-4 max-w-xs">

                            <p class="line-clamp-2 text-gray-600">
                                {{ $lokasi->deskripsi ?? '-' }}
                            </p>

                        </td>

                        <td class="p-4">

                            <div class="flex items-center justify-center gap-2">

                                {{-- Kelola Area --}}
                                <a
                                    href="{{ route('admin.slot-area.index', $lokasi->id)}}"
                                    class="w-9 h-9 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-100 flex items-center justify-center"
                                    title="Kelola Area">

                                    <span class="material-symbols-outlined text-[18px]">
                                        grid_view
                                    </span>

                                </a>

                                {{-- Edit --}}
                               <a href="{{ route('admin.lokasi-parkir.edit', $lokasi->id) }}"
                                    class="w-9 h-9 rounded-lg bg-amber-50 text-amber-600 hover:bg-amber-100 flex items-center justify-center"
                                    title="Edit Lokasi">

                                    <span class="material-symbols-outlined text-[18px]">
                                        edit
                                    </span>

                                </a>

                                {{-- Hapus --}}
                                <form
                                    action="{{ route('admin.lokasi-parkir.destroy', $lokasi->id) }}"
                                    method="POST">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="w-9 h-9 rounded-lg bg-red-50 text-red-600 hover:bg-red-100 flex items-center justify-center"
                                        title="Hapus Lokasi">

                                        <span class="material-symbols-outlined text-[18px]">
                                            delete
                                        </span>

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="5" class="p-10 text-center text-gray-500">

                            Belum ada data lokasi parkir

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    <!-- Pagination -->
        <div class="p-5 border-t border-outline-variant/10 flex flex-col md:flex-row items-center justify-between gap-4">

            <p class="text-secondary">
                Menampilkan
                <span class="font-bold text-on-surface">{{ $lokasiParkir->firstItem() ?? 0 }} - {{ $lokasiParkir->lastItem() ?? 0 }}</span>
                dari
                <span class="font-bold text-on-surface">{{ $lokasiParkir->total() }}</span>
                lokasi
            </p>

            {{ $lokasiParkir->links() }}

        </div>
</section>


</div>

@endsection
