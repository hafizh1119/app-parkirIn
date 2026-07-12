@extends('admin.layouts.app')

@section('title', 'Edit Lokasi Parkir')
@section('bg-icon', 'edit_location')

@section('content')

<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">

    <div>
        <nav class="flex items-center gap-2 text-gray-500 text-sm mb-1">
            <a href="{{ route('admin.dashboard') }}" class="hover:text-primary">
                Dashboard
            </a>

            <span class="material-symbols-outlined text-[16px]">
                chevron_right
            </span>

            <a href="{{ route('admin.lokasi-parkir.index') }}" class="hover:text-primary">
                Lokasi Parkir
            </a>

            <span class="material-symbols-outlined text-[16px]">
                chevron_right
            </span>

            <span class="font-semibold text-gray-900">
                Edit
            </span>
        </nav>

        <h2 class="text-2xl font-bold text-gray-900">
            Edit Lokasi Parkir
        </h2>
    </div>

</div>

<div class="bg-white rounded-2xl shadow-sm border border-outline-variant/20 p-6">

    <form action="{{ route('admin.lokasi-parkir.update', $lokasi->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="space-y-6">

            {{-- Informasi Dasar --}}
            <div class="bg-gray-50 rounded-2xl p-6">

                <div class="flex items-center gap-2 mb-5">
                    <span class="material-symbols-outlined text-primary">
                        location_on
                    </span>

                    <h3 class="font-semibold text-lg text-gray-900">
                        Informasi Lokasi
                    </h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    {{-- Nama Lokasi --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Lokasi
                            <span class="text-red-500">*</span>
                        </label>

                        <input
                            type="text"
                            name="nama"
                            value="{{ old('nama', $lokasi->nama) }}"
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary @error('nama') border-red-500 @enderror">

                        @error('nama')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Alamat --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Alamat
                            <span class="text-red-500">*</span>
                        </label>

                        <input
                            type="text"
                            name="alamat"
                            value="{{ old('alamat', $lokasi->alamat) }}"
                            placeholder="Masukkan alamat lokasi"
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary @error('alamat') border-red-500 @enderror">

                        @error('alamat')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Link Maps --}}
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Link Google Maps
                        </label>

                        <input
                            type="url"
                            name="link_maps"
                            value="{{ old('link_maps', $lokasi->link_maps) }}"
                            placeholder="https://maps.google.com/..."
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary @error('link_maps') border-red-500 @enderror">

                        @error('link_maps')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

            </div>

            {{-- Upload Gambar --}}
            <div class="bg-gray-50 rounded-2xl p-6">

                <div class="flex items-center gap-2 mb-5">
                    <span class="material-symbols-outlined text-primary">
                        image
                    </span>

                    <h3 class="font-semibold text-lg text-gray-900">
                        Gambar Lokasi
                    </h3>
                </div>

                @if($lokasi->gambar)
                    <div class="flex items-center gap-4 mb-4 bg-white border border-gray-200 rounded-xl p-3">
                        <img
                            src="{{ asset($lokasi->gambar) }}"
                            alt="{{ $lokasi->nama }}"
                            class="w-20 h-20 object-cover rounded-lg border border-gray-200">

                        <div>
                            <p class="text-sm font-medium text-gray-700">
                                Gambar saat ini
                            </p>
                            <p class="text-xs text-gray-400">
                                Upload gambar baru untuk menggantinya
                            </p>
                        </div>
                    </div>
                @endif

                <label
                    for="gambar"
                    id="uploadBox"
                    class="flex flex-col items-center justify-center w-full h-48 border-2 border-dashed border-gray-300 rounded-2xl cursor-pointer hover:border-primary hover:bg-primary/5 transition-all overflow-hidden">

                    <div id="uploadPlaceholder" class="flex flex-col items-center justify-center">
                        <span class="material-symbols-outlined text-4xl text-primary mb-2">
                            cloud_upload
                        </span>

                        <p class="text-base font-semibold text-gray-700">
                            Klik untuk memilih gambar baru
                        </p>

                        <p class="text-xs text-gray-400 mt-1">
                            JPG, PNG, GIF • Maksimal 2 MB • Kosongkan jika tidak ingin mengganti
                        </p>
                    </div>

                    <div id="previewContainer" class="hidden w-full h-full relative">
                        <img id="previewImage" class="w-full h-full object-cover">

                        <div class="absolute bottom-0 left-0 right-0 bg-black/60 text-white p-3">
                            <p id="fileName" class="font-medium text-sm"></p>
                            <p class="text-xs opacity-80">
                                Gambar baru dipilih
                            </p>
                        </div>
                    </div>

                    <input
                        id="gambar"
                        name="gambar"
                        type="file"
                        accept="image/*"
                        class="hidden"
                        onchange="previewGambar(event)">

                </label>

                @error('gambar')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Deskripsi --}}
            <div class="bg-gray-50 rounded-2xl p-6">

                <div class="flex items-center gap-2 mb-5">
                    <span class="material-symbols-outlined text-primary">
                        description
                    </span>

                    <h3 class="font-semibold text-lg text-gray-900">
                        Deskripsi Lokasi
                    </h3>
                </div>

                <textarea
                    name="deskripsi"
                    rows="5"
                    class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary @error('deskripsi') border-red-500 @enderror"
                    placeholder="Masukkan deskripsi lokasi parkir...">{{ old('deskripsi', $lokasi->deskripsi) }}</textarea>

                @error('deskripsi')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

        </div>

        <div class="flex items-center gap-3 mt-6 pt-6 border-t border-gray-100">

            <button
                type="submit"
                class="bg-primary hover:opacity-90 text-white px-6 py-3 rounded-xl flex items-center gap-2">

                <span class="material-symbols-outlined">
                    save
                </span>

                <span>
                    Update Lokasi
                </span>
            </button>

            <a href="{{ route('admin.lokasi-parkir.index') }}"
               class="px-6 py-3 border border-gray-200 rounded-xl hover:bg-gray-50">
                Batal
            </a>

        </div>

    </form>

</div>

@push('scripts')
<script>
    function previewGambar(event) {

        const file = event.target.files[0];

        if (!file) return;

        const reader = new FileReader();

        reader.onload = function (e) {
            document.getElementById('previewImage').src = e.target.result;
            document.getElementById('fileName').innerText = file.name;
            document.getElementById('uploadPlaceholder').classList.add('hidden');
            document.getElementById('previewContainer').classList.remove('hidden');
            document.getElementById('uploadBox').classList.remove('border-gray-300');
            document.getElementById('uploadBox').classList.add('border-green-500');
        };

        reader.readAsDataURL(file);
    }
</script>
@endpush

@endsection