@extends('Admin.layouts.app')

@section('title', 'Detail Event')

@section('content')
<div class="max-w-4xl">
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('admin.events.index') }}" class="text-gray-500 hover:text-[#5445cf] transition">
            <span class="material-symbols-outlined">arrow_back</span>
        </a>
        <h1 class="text-2xl font-bold text-gray-800">Detail Event</h1>
    </div>

    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
        @if($event->image)
            <img src="{{ $event->image_url }}" alt="{{ $event->name }}" class="w-full h-64 object-cover">
        @endif
        
        <div class="p-6 space-y-4">
            <div class="flex flex-wrap justify-between items-start gap-3">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">{{ $event->name }}</h2>
                    <span class="inline-block mt-1 px-3 py-1 rounded-full text-xs font-semibold {{ $event->status_badge['class'] }}">
                        {{ $event->status_badge['label'] }}
                    </span>
                </div>
                <div class="flex gap-2">
                    <a href="{{ route('admin.events.edit', $event) }}" 
                       class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-semibold hover:bg-blue-700 transition">
                        Edit Event
                    </a>
                </div>
            </div>

            @if($event->description)
                <div class="border-t border-gray-100 pt-4">
                    <p class="text-gray-600">{{ $event->description }}</p>
                </div>
            @endif

            <!-- Grid Informasi Detail -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-4 border-t border-gray-100">
                <div>
                    <p class="text-sm text-gray-500">Tanggal Mulai</p>
                    <p class="font-semibold text-gray-800">{{ $event->formatted_date['start'] }} {{ $event->formatted_date['start_time'] }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Tanggal Selesai</p>
                    <p class="font-semibold text-gray-800">{{ $event->formatted_date['end'] }} {{ $event->formatted_date['end_time'] }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Kapasitas</p>
                    <p class="font-semibold text-gray-800">
                        @if($event->max_capacity)
                            {{ $event->current_participants ?? 0 }} / {{ $event->max_capacity }}
                        @else
                            Unlimited
                        @endif
                    </p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Diskon Member</p>
                    <p class="font-semibold">
                        @if($event->discount_percentage > 0)
                            <span class="text-red-600">{{ $event->discount_percentage }}%</span>
                        @else
                            <span class="text-gray-400">Tidak ada diskon</span>
                        @endif
                    </p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Status</p>
                    <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $event->status_badge['class'] }}">
                        {{ $event->status_badge['label'] }}
                    </span>
                </div>
            </div>

            <!-- Lokasi Parkir Terhubung -->
            <div class="pt-4 border-t border-gray-100">
                <p class="text-sm text-gray-500 mb-2">Lokasi Parkir Terhubung</p>
                <div class="flex flex-wrap gap-2">
                    @forelse($event->lokasiParkirs as $lokasi)
                        <span class="bg-[#5445cf]/10 px-3 py-1.5 rounded-full text-xs font-semibold text-[#5445cf] flex items-center gap-1">
                            <span class="material-symbols-outlined text-sm">location_on</span>
                            {{ $lokasi->nama }}
                        </span>
                    @empty
                        <span class="text-sm text-gray-400">Tidak ada lokasi parkir terhubung</span>
                    @endforelse
                </div>
                <p class="text-xs text-gray-400 mt-2">Total {{ $event->lokasiParkirs->count() }} lokasi terhubung</p>
            </div>

            <!-- Progress Bar Kapasitas -->
            @if($event->max_capacity)
                <div class="pt-4 border-t border-gray-100">
                    <div class="flex justify-between items-center mb-1">
                        <p class="text-sm text-gray-500">Progres Partisipan</p>
                        <p class="text-sm font-semibold text-gray-700">
                            {{ $event->current_participants ?? 0 }}/{{ $event->max_capacity }}
                        </p>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                        @php
                            $percentage = $event->max_capacity > 0 ? ($event->current_participants / $event->max_capacity) * 100 : 0;
                        @endphp
                        <div class="bg-[#5445cf] h-2.5 rounded-full transition-all duration-500" 
                             style="width: {{ min($percentage, 100) }}%">
                        </div>
                    </div>
                    <p class="text-xs text-gray-400 mt-1">{{ round($percentage, 1) }}% terisi</p>
                </div>
            @endif

            <!-- Tombol Aksi -->
            <div class="flex gap-3 pt-4 border-t border-gray-200">
                <a href="{{ route('admin.events.index') }}" 
                   class="px-4 py-2 border border-gray-200 rounded-lg text-sm font-semibold text-gray-600 hover:bg-gray-50 transition">
                    Kembali
                </a>
                <form action="{{ route('admin.events.destroy', $event) }}" method="POST" class="inline">
                    @csrf @method('DELETE')
                    <button type="submit" onclick="return confirm('Yakin ingin menghapus event ini?')" 
                            class="px-4 py-2 bg-red-500 text-white rounded-lg text-sm font-semibold hover:bg-red-600 transition">
                        Hapus Event
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection