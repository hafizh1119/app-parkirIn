@extends('Admin.layouts.app')

@section('title', 'Edit Event')

@section('content')
<div class="max-w-3xl">
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('admin.events.index') }}" class="text-gray-500 hover:text-[#5445cf] transition">
            <span class="material-symbols-outlined">arrow_back</span>
        </a>
        <h1 class="text-2xl font-bold text-gray-800">Edit Event</h1>
    </div>

    <form action="{{ route('admin.events.update', $event) }}" method="POST" enctype="multipart/form-data" 
          class="bg-white rounded-xl border border-gray-200 shadow-sm p-6 space-y-4">
        @csrf
        @method('PUT')

        <!-- Nama Event -->
        <div>
            <label class="block font-semibold text-gray-700 mb-1 text-sm">Nama Event <span class="text-red-500">*</span></label>
            <input type="text" name="name" value="{{ old('name', $event->name) }}" 
                   class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#5445cf] focus:border-[#5445cf] outline-none @error('name') border-red-400 @enderror" 
                   required>
            @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Deskripsi -->
        <div>
            <label class="block font-semibold text-gray-700 mb-1 text-sm">Deskripsi</label>
            <textarea name="description" rows="3" 
                      class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#5445cf] focus:border-[#5445cf] outline-none resize-none">{{ old('description', $event->description) }}</textarea>
        </div>

        <!-- ✅ DISKON UNTUK MEMBER -->
        <div class="border-t border-gray-200 pt-4">
            <h3 class="font-semibold text-gray-700 mb-3 text-sm">🎯 Pengaturan Diskon Member</h3>
            <div>
                <label class="block font-semibold text-gray-700 mb-1 text-sm">Diskon untuk Member <span class="text-red-500">*</span></label>
                <div class="flex items-center gap-3">
                    <input type="number" name="discount_percentage" value="{{ old('discount_percentage', $event->discount_percentage ?? 0) }}" 
                           class="w-32 px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#5445cf] focus:border-[#5445cf] outline-none @error('discount_percentage') border-red-400 @enderror" 
                           min="0" max="100" required>
                    <span class="text-gray-600 font-semibold">%</span>
                </div>
                <p class="text-xs text-gray-400 mt-1">Masukkan 0 jika tidak ada diskon</p>
                @error('discount_percentage') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <!-- Info Lokasi Parkir - Otomatis Semua (Readonly) -->
        <div class="bg-green-50 rounded-lg p-4 border border-green-200">
            <div class="flex items-center gap-2 mb-2">
                <span class="material-symbols-outlined text-green-600">check_circle</span>
                <span class="font-semibold text-green-700">Event terhubung dengan SEMUA lokasi parkir</span>
            </div>
            
            <div class="flex flex-wrap gap-2 mt-2">
                @foreach($lokasiParkirs as $lokasi)
                    <span class="bg-white px-3 py-1 rounded-full text-xs font-semibold text-gray-700 border border-green-200">
                        {{ $lokasi->nama }}
                    </span>
                @endforeach
            </div>
            <p class="text-xs text-gray-500 mt-2">
                Total {{ $lokasiParkirs->count() }} lokasi parkir terhubung
            </p>
        </div>

        <!-- Tanggal -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block font-semibold text-gray-700 mb-1 text-sm">Mulai <span class="text-red-500">*</span></label>
                <input type="datetime-local" name="start_date" 
                       value="{{ old('start_date', $event->start_date->format('Y-m-d\TH:i')) }}" 
                       class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#5445cf] focus:border-[#5445cf] outline-none @error('start_date') border-red-400 @enderror" 
                       required>
                @error('start_date') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block font-semibold text-gray-700 mb-1 text-sm">Selesai <span class="text-red-500">*</span></label>
                <input type="datetime-local" name="end_date" 
                       value="{{ old('end_date', $event->end_date->format('Y-m-d\TH:i')) }}" 
                       class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#5445cf] focus:border-[#5445cf] outline-none @error('end_date') border-red-400 @enderror" 
                       required>
                @error('end_date') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <!-- Status -->
        <div>
            <label class="block font-semibold text-gray-700 mb-1 text-sm">Status</label>
            <select name="status" class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#5445cf] focus:border-[#5445cf] outline-none bg-white">
                <option value="upcoming" {{ old('status', $event->status) == 'upcoming' ? 'selected' : '' }}>Akan Datang</option>
                <option value="active" {{ old('status', $event->status) == 'active' ? 'selected' : '' }}>Aktif</option>
                <option value="completed" {{ old('status', $event->status) == 'completed' ? 'selected' : '' }}>Selesai</option>
                <option value="waiting" {{ old('status', $event->status) == 'waiting' ? 'selected' : '' }}>Menunggu</option>
            </select>
        </div>

        <!-- Gambar -->
        <div>
            <label class="block font-semibold text-gray-700 mb-1 text-sm">Gambar Event</label>
            @if($event->image)
                <div class="mb-2">
                    <img src="{{ $event->image_url }}" alt="{{ $event->name }}" class="w-20 h-20 rounded-lg object-cover border border-gray-200">
                </div>
            @endif
            <input type="file" name="image" accept="image/*" 
                   class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#5445cf] focus:border-[#5445cf] outline-none file:mr-4 file:py-1.5 file:px-4 file:rounded-lg file:border-0 file:bg-[#5445cf]/10 file:text-[#5445cf] file:text-sm file:font-semibold hover:file:bg-[#5445cf]/20">
            <p class="text-xs text-gray-400 mt-1">Kosongkan jika tidak ingin mengubah gambar</p>
            @error('image') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Buttons -->
        <div class="flex gap-3 pt-4 border-t border-gray-200">
            <button type="submit" class="bg-[#5445cf] text-white px-6 py-2.5 rounded-lg font-semibold hover:bg-[#4538b5] transition shadow-sm">
                Update Event
            </button>
            <a href="{{ route('admin.events.index') }}" class="px-6 py-2.5 border border-gray-200 rounded-lg font-semibold text-gray-600 hover:bg-gray-50 transition">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection