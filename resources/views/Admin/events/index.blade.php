@extends('Admin.layouts.app')

@section('title', 'Kelola Event')

@section('content')
<div class="space-y-6">
    <!-- Breadcrumb -->
    <nav class="flex items-center gap-2 text-sm text-gray-500">
        <span>Dashboard</span>
        <span class="material-symbols-outlined text-sm">chevron_right</span>
        <span class="text-[#5445cf] font-semibold">Kelola Event</span>
    </nav>

    <!-- Header -->
    <div class="flex flex-wrap justify-between items-center gap-4">
        <h1 class="text-2xl font-bold text-gray-800">Kelola Event</h1>
        <a href="{{ route('admin.events.create') }}" 
           class="flex items-center gap-2 bg-[#5445cf] text-white px-5 py-2.5 rounded-lg font-semibold hover:bg-[#4538b5] transition-all shadow-sm hover:shadow-md">
            <span class="material-symbols-outlined text-sm">add</span>
            Tambah Event
        </a>
    </div>

    <!-- Alert Success -->
    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg flex items-center gap-2">
            <span class="material-symbols-outlined text-green-500">check_circle</span>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg flex items-center gap-2">
            <span class="material-symbols-outlined text-red-500">error</span>
            {{ session('error') }}
        </div>
    @endif

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white rounded-xl border border-gray-200 p-5 shadow-sm">
            <p class="text-sm text-gray-500">Total Event</p>
            <p class="text-2xl font-bold text-gray-800">{{ $stats['total'] }}</p>
        </div>
        <div class="bg-white rounded-xl border border-gray-200 p-5 shadow-sm">
            <p class="text-sm text-gray-500">Sedang Berlangsung</p>
            <p class="text-2xl font-bold text-green-600">{{ $stats['active'] }}</p>
        </div>
        <div class="bg-white rounded-xl border border-gray-200 p-5 shadow-sm">
            <p class="text-sm text-gray-500">Akan Datang</p>
            <p class="text-2xl font-bold text-blue-600">{{ $stats['upcoming'] }}</p>
        </div>
        <div class="bg-white rounded-xl border border-gray-200 p-5 shadow-sm">
            <p class="text-sm text-gray-500">Selesai</p>
            <p class="text-2xl font-bold text-gray-500">{{ $stats['completed'] }}</p>
        </div>
    </div>

    <!-- Event Banner -->
    <div class="relative overflow-hidden rounded-xl bg-gradient-to-r from-[#5445cf] to-[#7c5cbf] p-6 text-white shadow-lg">
        <div class="absolute top-0 right-0 w-48 h-48 bg-white/5 rounded-full -mr-16 -mt-16 blur-2xl"></div>
        <div class="absolute bottom-0 left-0 w-32 h-32 bg-white/5 rounded-full -ml-10 -mb-10 blur-2xl"></div>
        
        <div class="relative z-10 flex flex-wrap items-center justify-between gap-4">
            <div>
                <div class="inline-flex items-center gap-2 bg-white/20 backdrop-blur-sm px-3 py-1 rounded-full text-sm font-semibold">
                    <span>🎫</span>
                    Event Management
                </div>
                <h2 class="text-xl font-bold mt-2">Monitor & Atur Event</h2>
                <p class="text-white/80 text-sm">Kelola event parkir khusus untuk menghindari kemacetan</p>
            </div>
            <div class="flex gap-3">
                <div class="bg-white/10 backdrop-blur-sm border border-white/20 px-4 py-2 rounded-xl text-center min-w-[80px]">
                    <span class="material-symbols-outlined text-2xl">confirmation_number</span>
                    <p class="text-lg font-bold">{{ $stats['active'] }}</p>
                    <p class="text-[10px] uppercase tracking-wider">Active</p>
                </div>
                <div class="bg-white/10 backdrop-blur-sm border border-white/20 px-4 py-2 rounded-xl text-center min-w-[80px]">
                    <span class="material-symbols-outlined text-2xl">event_available</span>
                    <p class="text-lg font-bold">{{ $stats['upcoming'] }}</p>
                    <p class="text-[10px] uppercase tracking-wider">Upcoming</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
        <!-- Filter -->
        <div class="p-4 border-b border-gray-200 flex flex-wrap items-center justify-between gap-3">
            <form action="{{ route('admin.events.index') }}" method="GET" class="flex flex-wrap items-center gap-3">
                <div class="relative">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm">search</span>
                    <input type="text" name="search" value="{{ request('search') }}"
                           class="pl-9 pr-4 py-2 border border-gray-200 rounded-lg text-sm focus:ring-2 focus:ring-[#5445cf] focus:border-[#5445cf] outline-none w-56"
                           placeholder="Cari event...">
                </div>
                
                <select name="status" class="px-4 py-2 border border-gray-200 rounded-lg text-sm focus:ring-2 focus:ring-[#5445cf] focus:border-[#5445cf] outline-none bg-white">
                    <option value="">Semua Status</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Berlangsung</option>
                    <option value="upcoming" {{ request('status') == 'upcoming' ? 'selected' : '' }}>Akan Datang</option>
                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Selesai</option>
                    <option value="waiting" {{ request('status') == 'waiting' ? 'selected' : '' }}>Menunggu</option>
                </select>
                
                <button type="submit" class="bg-[#5445cf] text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-[#4538b5] transition">
                    Filter
                </button>
                
                @if(request()->hasAny(['search', 'status']))
                    <a href="{{ route('admin.events.index') }}" class="text-sm text-gray-500 hover:text-[#5445cf]">Reset</a>
                @endif
            </form>
        </div>

        <!-- Table Content -->
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-4 py-3 text-left font-semibold text-gray-600">Event</th>
                        <th class="px-4 py-3 text-left font-semibold text-gray-600">Lokasi Parkir</th>
                        <th class="px-4 py-3 text-left font-semibold text-gray-600">Tanggal</th>
                        <th class="px-4 py-3 text-left font-semibold text-gray-600">Kapasitas</th>
                        <th class="px-4 py-3 text-center font-semibold text-gray-600">Diskon</th> <!-- ✅ TAMBAH -->
                        <th class="px-4 py-3 text-center font-semibold text-gray-600">Status</th>
                        <th class="px-4 py-3 text-center font-semibold text-gray-600">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($events as $event)
                    <tr class="hover:bg-gray-50/50 transition">
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-3">
                                @if($event->image)
                                    <img src="{{ $event->image_url }}" alt="{{ $event->name }}" class="w-10 h-10 rounded-lg object-cover">
                                @else
                                    <div class="w-10 h-10 rounded-lg bg-[#5445cf]/10 flex items-center justify-center">
                                        <span class="material-symbols-outlined text-[#5445cf] text-sm">event</span>
                                    </div>
                                @endif
                                <div>
                                    <p class="font-semibold text-gray-800">{{ $event->name }}</p>
                                    <p class="text-xs text-gray-500">{{ Str::limit($event->description, 35) }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-gray-600">
                            @if($event->lokasiParkirs && $event->lokasiParkirs->count() > 0)
                                <div class="flex flex-wrap gap-1">
                                    @foreach($event->lokasiParkirs->take(2) as $lokasi)
                                        <span class="inline-flex items-center gap-0.5 bg-[#5445cf]/5 px-2 py-0.5 rounded-full text-xs">
                                            <span class="material-symbols-outlined text-[10px]">location_on</span>
                                            {{ $lokasi->nama }}
                                        </span>
                                    @endforeach
                                    @if($event->lokasiParkirs->count() > 2)
                                        <span class="text-xs text-gray-400">+{{ $event->lokasiParkirs->count() - 2 }} lagi</span>
                                    @endif
                                </div>
                                <p class="text-[10px] text-gray-400 mt-0.5">{{ $event->lokasiParkirs->count() }} lokasi terhubung</p>
                            @else
                                <span class="text-gray-400 text-xs">-</span>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            <p class="font-medium text-gray-800">{{ $event->formatted_date['start'] }}</p>
                            <p class="text-xs text-gray-500">{{ $event->formatted_date['start_time'] }} - {{ $event->formatted_date['end_time'] }}</p>
                        </td>
                        <td class="px-4 py-3 text-gray-600">
                            @if($event->max_capacity)
                                <div class="flex items-center gap-2">
                                    <span class="text-xs font-medium">{{ $event->current_participants ?? 0 }}/{{ $event->max_capacity }}</span>
                                    <div class="w-12 bg-gray-200 rounded-full h-1.5">
                                        @php
                                            $percentage = $event->max_capacity > 0 ? ($event->current_participants / $event->max_capacity) * 100 : 0;
                                        @endphp
                                        <div class="bg-[#5445cf] h-1.5 rounded-full" style="width: {{ min($percentage, 100) }}%"></div>
                                    </div>
                                </div>
                            @else
                                <span class="text-gray-400 text-xs">Unlimited</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-center">
                            @if($event->discount_percentage > 0)
                                <span class="inline-flex items-center gap-1 bg-red-50 text-red-600 px-2.5 py-1 rounded-full text-xs font-semibold">
                                    <span class="material-symbols-outlined text-sm">local_offer</span>
                                    {{ $event->discount_percentage }}%
                                </span>
                            @else
                                <span class="text-gray-400 text-xs">-</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-center">
                            <span class="px-2.5 py-1 rounded-full text-[10px] font-semibold {{ $event->status_badge['class'] }}">
                                {{ $event->status_badge['label'] }}
                            </span>
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center justify-center gap-1">
                                <a href="{{ route('admin.events.show', $event) }}" 
                                   class="p-1.5 text-[#5445cf] hover:bg-[#5445cf]/10 rounded-lg transition" title="Detail">
                                    <span class="material-symbols-outlined text-sm">visibility</span>
                                </a>
                                <a href="{{ route('admin.events.edit', $event) }}" 
                                   class="p-1.5 text-blue-600 hover:bg-blue-50 rounded-lg transition" title="Edit">
                                    <span class="material-symbols-outlined text-sm">edit</span>
                                </a>
                                <form action="{{ route('admin.events.destroy', $event) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" onclick="return confirm('Yakin ingin menghapus event ini?')" 
                                            class="p-1.5 text-red-500 hover:bg-red-50 rounded-lg transition" title="Hapus">
                                        <span class="material-symbols-outlined text-sm">delete</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-4 py-8 text-center text-gray-500">
                            <span class="material-symbols-outlined text-4xl text-gray-300 block mb-2">event_busy</span>
                            Belum ada event. 
                            <a href="{{ route('admin.events.create') }}" class="text-[#5445cf] font-semibold hover:underline">
                                Buat event pertama
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($events->hasPages())
        <div class="p-4 border-t border-gray-200 flex flex-wrap justify-between items-center gap-2">
            <p class="text-sm text-gray-500">
                Menampilkan {{ $events->firstItem() ?? 0 }} - {{ $events->lastItem() ?? 0 }} dari {{ $events->total() }} event
            </p>
            {{ $events->appends(request()->query())->links('pagination::tailwind') }}
        </div>
        @endif
    </div>
</div>
@endsection