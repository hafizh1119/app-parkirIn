@extends('Admin.layouts.app')

@section('title', 'Tambah Area Parkir')

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
                <a href="{{ route('admin.slot-area.index') }}" class="hover:text-primary">
                    Parkir UDINUS
                </a>
                <span class="material-symbols-outlined text-sm">chevron_right</span>
                <span class="font-semibold text-gray-900">Tambah Area</span>
            </nav>
            <h2 class="text-2xl font-bold text-gray-900">Tambah Area Parkir</h2>
        </div>

        <a href="{{ route('admin.slot-area.index') }}"
            class="border border-gray-300 text-gray-600 hover:bg-gray-50 px-5 py-3 rounded-xl flex items-center gap-2 transition-all">
            <span class="material-symbols-outlined">arrow_back</span>
            <span>Kembali</span>
        </a>

    </div>

    {{-- Form Card --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Form Utama --}}
        <div class="lg:col-span-2">
            <section class="bg-white rounded-2xl border border-outline-variant/20 overflow-hidden" style="box-shadow: 0px 2px 10px 0px rgba(76,78,100,0.1);">

                <div class="p-5 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Informasi Area</h3>
                    <p class="text-sm text-gray-500 mt-1">Isi detail informasi area parkir yang akan ditambahkan</p>
                </div>

                <div class="p-6 space-y-5">

                    {{-- Kode Area --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Kode Area <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="text"
                            placeholder="Contoh: A"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary/10 focus:border-primary text-sm outline-none transition-all">
                        <p class="text-xs text-gray-400 mt-1">Kode singkat untuk identifikasi area (maks. 2 karakter)</p>
                    </div>

                    <div class="grid grid-cols-2 gap-3">

                    {{-- Mobil --}}
                    <label class="cursor-pointer">

                        <input
                            type="radio"
                            name="jenis_kendaraan"
                            value="mobil"
                            checked
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

                    {{-- Jumlah Slot --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Jumlah Slot <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="number"
                            min="1"
                            placeholder="Contoh: 20"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary/10 focus:border-primary text-sm outline-none transition-all">
                        <p class="text-xs text-gray-400 mt-1">Slot akan digenerate otomatis sesuai jumlah yang diisi</p>
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
                                min="0"
                                placeholder="5000"
                                class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary/10 focus:border-primary text-sm outline-none transition-all">
                        </div>
                    </div>

                </div>

                {{-- Form Actions --}}
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end gap-3">
                    <a href="{{ route('admin.slot-area.index') }}"
                        class="px-5 py-2.5 border border-gray-300 text-gray-600 rounded-xl hover:bg-gray-100 text-sm font-medium transition-all">
                        Batal
                    </a>
                    <button
                        class="px-5 py-2.5 bg-primary text-white rounded-xl hover:opacity-90 text-sm font-medium shadow-lg flex items-center gap-2 transition-all">
                        <span class="material-symbols-outlined text-[18px]">save</span>
                        Simpan Area
                    </button>
                </div>

            </section>
        </div>

        {{-- Sidebar Info --}}
        <div class="flex flex-col gap-5">

            {{-- Preview Card --}}
            <section class="bg-white rounded-2xl border border-outline-variant/20 overflow-hidden" style="box-shadow: 0px 2px 10px 0px rgba(76,78,100,0.1);">

                <div class="p-5 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Preview Area</h3>
                    <p class="text-sm text-gray-500 mt-1">Tampilan setelah area disimpan</p>
                </div>

                <div class="p-5">
                    <div class="flex items-center gap-3 p-4 border border-outline-variant/30 rounded-xl bg-surface-container-low/30">
                        <div class="w-10 h-10 rounded-lg flex items-center justify-center text-white font-bold flex-shrink-0" style="background: #5445cf;">
                            A
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="font-semibold text-gray-900 text-sm truncate">Area A - Basement</p>
                            <div class="flex items-center gap-1 text-gray-500 text-xs mt-0.5">
                                <span class="material-symbols-outlined text-[14px]">directions_car</span>
                                Mobil · 20 Slot
                            </div>
                        </div>
                        <span class="px-2 py-0.5 bg-green-100 text-green-700 rounded-full text-xs font-semibold flex-shrink-0">Aktif</span>
                    </div>

                    <div class="mt-4 space-y-2">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Tarif Per Jam</span>
                            <span class="font-semibold text-gray-900">Rp 5.000</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Total Slot</span>
                            <span class="font-semibold text-gray-900">20 Slot</span>
                        </div>
                        <div class="w-full bg-gray-100 rounded-full h-1.5 mt-3">
                            <div class="h-full rounded-full w-0" style="background: #5445cf;"></div>
                        </div>
                        <p class="text-xs text-gray-400">0% terisi (baru dibuat)</p>
                    </div>
                </div>

            </section>

            {{-- Tips Card --}}
            <section class="bg-primary/5 border border-primary/20 rounded-2xl p-5">
                <div class="flex items-start gap-3">
                    <span class="material-symbols-outlined text-primary text-[22px] flex-shrink-0">lightbulb</span>
                    <div>
                        <p class="text-sm font-semibold text-gray-900 mb-2">Tips Pengisian</p>
                        <ul class="text-xs text-gray-600 space-y-1.5">
                            <li class="flex items-start gap-1.5">
                                <span class="material-symbols-outlined text-primary text-[14px] mt-0.5">check_circle</span>
                                Gunakan kode area yang unik dan mudah diingat
                            </li>
                            <li class="flex items-start gap-1.5">
                                <span class="material-symbols-outlined text-primary text-[14px] mt-0.5">check_circle</span>
                                Slot akan digenerate otomatis dengan format [Kode]-[Nomor]
                            </li>
                            <li class="flex items-start gap-1.5">
                                <span class="material-symbols-outlined text-primary text-[14px] mt-0.5">check_circle</span>
                                Tarif dapat diubah kapan saja setelah area dibuat
                            </li>
                        </ul>
                    </div>
                </div>
            </section>

        </div>

    </div>

</div>

@endsection