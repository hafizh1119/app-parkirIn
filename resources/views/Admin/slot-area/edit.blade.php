@extends('Admin.layouts.app')

@section('title', 'Edit Area Parkir')

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
                <a href="{{ route('admin.slot-area.index', $lokasi->id) }}" class="hover:text-primary">
                    Parkir UDINUS
                </a>
                <span class="material-symbols-outlined text-sm">chevron_right</span>
                <span class="font-semibold text-gray-900">Edit Area</span>
            </nav>
            <h2 class="text-2xl font-bold text-gray-900">Edit Area Parkir</h2>
        </div>

        <a href="{{ route('admin.slot-area.index', $lokasi->id) }}"
            class="border border-gray-300 text-gray-600 hover:bg-gray-50 px-5 py-3 rounded-xl flex items-center gap-2 transition-all">
            <span class="material-symbols-outlined">arrow_back</span>
            <span>Kembali</span>
        </a>

    </div>

    {{-- Form Card --}}
    <div class="max-w-3xl">

        <form action="{{ route('admin.slot-area.update', [$lokasi->id, $area->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="status" value="{{ old('status', $area->status) }}">

            <section class="bg-white rounded-2xl border border-outline-variant/20 overflow-hidden" style="box-shadow: 0px 2px 10px 0px rgba(76,78,100,0.1);">

                <div class="p-5 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Informasi Area</h3>
                    <p class="text-sm text-gray-500 mt-1">Perbarui detail informasi area parkir</p>
                </div>

                <div class="p-6 space-y-5">

                    {{-- Nama Area --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Kode Area <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="text"
                            name="nama_area"
                            value="{{ old('nama_area', $area->nama_area) }}"
                            placeholder="Contoh: A"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary/10 focus:border-primary text-sm outline-none transition-all @error('nama_area') border-red-500 @enderror">
                        <p class="text-xs text-gray-400 mt-1">Kode singkat untuk identifikasi area (maks. 2 karakter)</p>
                        @error('nama_area')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-3">

                    {{-- Mobil --}}
                    <label class="cursor-pointer">

                        <input
                            type="radio"
                            name="jenis_kendaraan"
                            value="mobil"
                            {{ old('jenis_kendaraan', $area->jenis_kendaraan) == 'mobil' ? 'checked' : '' }}
                            class="peer hidden">

                        <div class="flex items-center gap-3 p-4 border-2 border-gray-200 rounded-xl transition-all
                                    peer-checked:border-primary
                                    peer-checked:bg-primary/5">

                            <span class="material-symbols-outlined text-[22px]
                                        text-gray-400
                                        peer-checked:text-primary">
                                directions_car
                            </span>

                            <div>
                                <p class="text-sm font-semibold text-gray-900">
                                    Mobil
                                </p>

                                <p class="text-xs text-gray-400">
                                    Kendaraan roda 4
                                </p>
                            </div>

                        </div>

                    </label>

                    {{-- Motor --}}
                    <label class="cursor-pointer">

                        <input
                            type="radio"
                            name="jenis_kendaraan"
                            value="motor"
                            {{ old('jenis_kendaraan', $area->jenis_kendaraan) == 'motor' ? 'checked' : '' }}
                            class="peer hidden">

                        <div class="flex items-center gap-3 p-4 border-2 border-gray-200 rounded-xl transition-all
                                    peer-checked:border-primary
                                    peer-checked:bg-primary/5">

                            <span class="material-symbols-outlined text-[22px]
                                        text-gray-400
                                        peer-checked:text-primary">
                                two_wheeler
                            </span>

                            <div>
                                <p class="text-sm font-semibold text-gray-900">
                                    Motor
                                </p>

                                <p class="text-xs text-gray-400">
                                    Kendaraan roda 2
                                </p>
                            </div>

                        </div>

                    </label>

                </div>

                    {{-- Kapasitas / Jumlah Slot --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Jumlah Slot <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="number"
                            name="kapasitas"
                            value="{{ old('kapasitas', $area->kapasitas) }}"
                            min="1"
                            placeholder="Contoh: 20"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary/10 focus:border-primary text-sm outline-none transition-all @error('kapasitas') border-red-500 @enderror">
                        <p class="text-xs text-gray-400 mt-1">Mengubah jumlah slot tidak otomatis menyesuaikan slot yang sudah ada</p>
                        @error('kapasitas')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Tarif Per Jam --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Tarif Per Jam <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-sm text-gray-500 font-medium">Rp</span>
                            <input
                                type="number"
                                name="tarif_per_jam"
                                value="{{ old('tarif_per_jam', $area->tarif_per_jam) }}"
                                min="0"
                                placeholder="5000"
                                class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary/10 focus:border-primary text-sm outline-none transition-all @error('tarif_per_jam') border-red-500 @enderror">
                        </div>
                        @error('tarif_per_jam')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Deskripsi --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Deskripsi
                        </label>
                        <textarea
                            name="deskripsi"
                            rows="3"
                            placeholder="Deskripsi area (opsional)"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary/10 focus:border-primary text-sm outline-none transition-all @error('deskripsi') border-red-500 @enderror">{{ old('deskripsi', $area->deskripsi) }}</textarea>
                        @error('deskripsi')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                {{-- Form Actions --}}
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end gap-3">
                    <a href="{{ route('admin.slot-area.index', $lokasi->id) }}"
                        class="px-5 py-2.5 border border-gray-300 text-gray-600 rounded-xl hover:bg-gray-100 text-sm font-medium transition-all">
                        Batal
                    </a>
                    <button
                        type="submit"
                        class="px-5 py-2.5 bg-primary text-white rounded-xl hover:opacity-90 text-sm font-medium shadow-lg flex items-center gap-2 transition-all">
                        <span class="material-symbols-outlined text-[18px]">save</span>
                        Update Area
                    </button>
                </div>

            </section>

        </form>

    </div>

</div>

@endsection