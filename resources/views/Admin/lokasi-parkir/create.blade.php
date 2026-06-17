@extends('admin.layouts.main')

@section('title', 'Edit Lokasi Parkir')
@section('bg-icon', 'edit_location')

@section('content')
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-xl">
    <div>
        <nav class="flex items-center gap-2 text-secondary mb-1">
            <a class="font-label-md text-label-md hover:text-primary" href="{{ route('admin.dashboard') }}">Dashboard</a>
            <span class="material-symbols-outlined text-[16px]">chevron_right</span>
            <a class="font-label-md text-label-md hover:text-primary" href="{{ route('admin.lokasi-parkir.index') }}">Lokasi Parkir</a>
            <span class="material-symbols-outlined text-[16px]">chevron_right</span>
            <span class="font-label-md text-label-md font-bold text-on-surface">Edit</span>
        </nav>
        <h2 class="font-headline-xl text-headline-xl text-on-surface">Edit Lokasi Parkir</h2>
    </div>
</div>

<div class="bg-white rounded-2xl shadow-elevation-1 p-xl border border-outline-variant/20">
    <form action="{{ route('admin.lokasi-parkir.update', $lokasi->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="font-label-md text-label-md text-on-surface font-bold block mb-2">Nama Lokasi <span class="text-error">*</span></label>
                <input type="text" name="nama" class="w-full px-4 py-2 border border-outline-variant rounded-lg focus:ring-1 focus:ring-primary focus:border-primary transition-all @error('nama') border-error @enderror" placeholder="Masukkan nama lokasi" value="{{ old('nama', $lokasi->nama) }}" required/>
                @error('nama')<p class="text-error text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="font-label-md text-label-md text-on-surface font-bold block mb-2">Alamat <span class="text-error">*</span></label>
                <input type="text" name="alamat" class="w-full px-4 py-2 border border-outline-variant rounded-lg focus:ring-1 focus:ring-primary focus:border-primary transition-all @error('alamat') border-error @enderror" placeholder="Masukkan alamat lengkap" value="{{ old('alamat', $lokasi->alamat) }}" required/>
                @error('alamat')<p class="text-error text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="font-label-md text-label-md text-on-surface font-bold block mb-2">Link Google Maps</label>
                <input type="url" name="link_maps" class="w-full px-4 py-2 border border-outline-variant rounded-lg focus:ring-1 focus:ring-primary focus:border-primary transition-all @error('link_maps') border-error @enderror" placeholder="https://maps.google.com/..." value="{{ old('link_maps', $lokasi->link_maps) }}"/>
                @error('link_maps')<p class="text-error text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="font-label-md text-label-md text-on-surface font-bold block mb-2">Gambar</label>
                @if($lokasi->gambar)
                    <div class="mb-2">
                        <img src="{{ asset($lokasi->gambar) }}" alt="{{ $lokasi->nama }}" class="w-32 h-32 object-cover rounded-lg"/>
                        <p class="text-secondary text-xs mt-1">Gambar saat ini</p>
                    </div>
                @endif
                <input type="file" name="gambar" accept="image/*" class="w-full px-4 py-2 border border-outline-variant rounded-lg focus:ring-1 focus:ring-primary focus:border-primary transition-all @error('gambar') border-error @enderror"/>
                <p class="text-secondary text-xs mt-1">Format: JPG, PNG, GIF. Maks: 2MB. Kosongkan jika tidak ingin mengganti gambar</p>
                @error('gambar')<p class="text-error text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="md:col-span-2">
                <label class="font-label-md text-label-md text-on-surface font-bold block mb-2">Deskripsi</label>
                <textarea name="deskripsi" rows="4" class="w-full px-4 py-2 border border-outline-variant rounded-lg focus:ring-1 focus:ring-primary focus:border-primary transition-all @error('deskripsi') border-error @enderror" placeholder="Masukkan deskripsi lokasi parkir">{{ old('deskripsi', $lokasi->deskripsi) }}</textarea>
                @error('deskripsi')<p class="text-error text-sm mt-1">{{ $message }}</p>@enderror
            </div>
        </div>

        <div class="flex items-center gap-3 mt-6 pt-6 border-t border-outline-variant/10">
            <button type="submit" class="bg-primary hover:bg-primary/90 text-white px-6 py-3 rounded-lg flex items-center gap-2 transition-all">
                <span class="material-symbols-outlined">save</span>
                <span class="font-label-md text-label-md font-bold">Update</span>
            </button>
            <a href="{{ route('admin.lokasi-parkir.index') }}" class="px-6 py-3 border border-outline-variant rounded-lg hover:bg-surface-container transition-all">
                <span class="font-label-md text-label-md">Batal</span>
            </a>
        </div>
    </form>
</div>
@endsection