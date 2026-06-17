@extends('admin.layouts.main')

@section('title', 'Kelola Lokasi Parkir')
@section('bg-icon', 'local_parking')

@section('content')
<!-- Header -->
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-xl">
    <div>
        <nav class="flex items-center gap-2 text-secondary mb-1">
            <a class="font-label-md text-label-md hover:text-primary" href="{{ route('admin.dashboard') }}">Dashboard</a>
            <span class="material-symbols-outlined text-[16px]">chevron_right</span>
            <span class="font-label-md text-label-md font-bold text-on-surface">Lokasi Parkir</span>
        </nav>
        <h2 class="font-headline-xl text-headline-xl text-on-surface">Kelola Lokasi Parkir</h2>
    </div>
    <a href="{{ route('admin.lokasi-parkir.create') }}" class="bg-brand-purple hover:bg-brand-purple/90 text-white px-lg py-md rounded-lg flex items-center gap-2 shadow-lg shadow-brand-purple/20 transition-all transform active:scale-95">
        <span class="material-symbols-outlined">add</span>
        <span class="font-label-md text-label-md font-bold">+ Tambah Lokasi</span>
    </a>
</div>

<!-- Alert Success -->
@if(session('success'))
<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4 flex items-center justify-between">
    <span>{{ session('success') }}</span>
    <button onclick="this.parentElement.remove()" class="text-green-700">
        <span class="material-symbols-outlined">close</span>
    </button>
</div>
@endif

<!-- Main Content -->
<section class="bg-white rounded-2xl shadow-elevation-1 overflow-hidden border border-outline-variant/20">
    <!-- Toolbar -->
    <div class="p-lg flex flex-col md:flex-row items-center justify-between gap-md border-b border-outline-variant/10">
        <div class="relative w-full md:w-80">
            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline">search</span>
            <input id="searchInput" class="w-full pl-10 pr-4 py-2 border border-outline-variant rounded-lg focus:ring-1 focus:ring-primary focus:border-primary transition-all font-body-md text-body-md" placeholder="Cari nama lokasi..." type="text"/>
        </div>
        <div class="flex items-center gap-sm w-full md:w-auto">
            <select id="statusFilter" class="pl-md pr-xl py-2 border border-outline-variant rounded-lg focus:ring-1 focus:ring-primary focus:border-primary transition-all font-label-md text-label-md bg-white">
                <option value="">Semua Status</option>
                <option value="aktif">Aktif</option>
                <option value="non-aktif">Non-Aktif</option>
            </select>
            <button class="flex items-center gap-2 px-md py-2 border border-outline-variant rounded-lg hover:bg-surface-container transition-colors text-on-surface-variant font-label-md">
                <span class="material-symbols-outlined text-[20px]">ios_share</span>
                Export
            </button>
        </div>
    </div>

    <!-- Data Table -->
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-surface-container/50 border-b border-outline-variant/20">
                    <th class="p-lg w-12">
                        <input class="rounded border-outline-variant text-primary focus:ring-primary h-4 w-4" type="checkbox"/>
                    </th>
                    <th class="p-lg font-label-md text-label-md text-secondary uppercase tracking-wider">Nama Lokasi</th>
                    <th class="p-lg font-label-md text-label-md text-secondary uppercase tracking-wider">Alamat</th>
                    <th class="p-lg font-label-md text-label-md text-secondary uppercase tracking-wider">Total Slot</th>
                    <th class="p-lg font-label-md text-label-md text-secondary uppercase tracking-wider">Status</th>
                    <th class="p-lg font-label-md text-label-md text-secondary uppercase tracking-wider text-center">Aksi</th>
                </tr>
            </thead>
            <tbody id="tableBody" class="divide-y divide-outline-variant/10">
                @forelse($lokasiParkir as $item)
                <tr class="hover:bg-primary/5 transition-colors group" data-name="{{ strtolower($item->nama) }}" data-status="{{ $item->status ?? 'aktif' }}">
                    <td class="p-lg">
                        <input class="rounded border-outline-variant text-primary focus:ring-primary h-4 w-4" type="checkbox"/>
                    </td>
                    <td class="p-lg">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg bg-primary-container/20 flex items-center justify-center text-primary overflow-hidden">
                                @if($item->gambar)
                                    <img src="{{ asset($item->gambar) }}" alt="{{ $item->nama }}" class="w-full h-full object-cover"/>
                                @else
                                    <span class="material-symbols-outlined">apartment</span>
                                @endif
                            </div>
                            <span class="font-body-md text-body-md font-bold text-on-surface">{{ $item->nama }}</span>
                        </div>
                    </td>
                    <td class="p-lg font-body-md text-body-md text-on-surface-variant max-w-xs truncate">{{ $item->alamat }}</td>
                    <td class="p-lg font-body-md text-body-md text-on-surface-variant">{{ $item->slot_parkir_count ?? 0 }} Slot</td>
                    <td class="p-lg">
                        <span class="inline-flex items-center px-3 py-1 rounded-full bg-green-100 text-green-700 font-label-sm text-label-sm border border-green-200">
                            <span class="w-1.5 h-1.5 rounded-full bg-green-500 mr-2"></span>
                            Aktif
                        </span>
                    </td>
                    <td class="p-lg">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('admin.lokasi-parkir.kelola-slot', $item->id) }}" class="p-2 rounded-lg text-secondary hover:bg-primary-container/20 hover:text-primary transition-all" title="Kelola Slot">
                                <span class="material-symbols-outlined text-[20px]">settings_accessibility</span>
                            </a>
                            <a href="{{ route('admin.lokasi-parkir.show', $item->id) }}" class="p-2 rounded-lg text-secondary hover:bg-primary-container/20 hover:text-primary transition-all" title="Detail">
                                <span class="material-symbols-outlined text-[20px]">visibility</span>
                            </a>
                            <a href="{{ route('admin.lokasi-parkir.edit', $item->id) }}" class="p-2 rounded-lg text-secondary hover:bg-primary-container/20 hover:text-primary transition-all" title="Edit">
                                <span class="material-symbols-outlined text-[20px]">edit</span>
                            </a>
                            <form action="{{ route('admin.lokasi-parkir.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus lokasi parkir ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 rounded-lg text-secondary hover:bg-error/10 hover:text-error transition-all" title="Hapus">
                                    <span class="material-symbols-outlined text-[20px]">delete</span>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="p-lg text-center text-secondary py-8">
                        <span class="material-symbols-outlined text-4xl block mb-2">inbox</span>
                        Belum ada data lokasi parkir
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="p-lg border-t border-outline-variant/10 flex flex-col md:flex-row items-center justify-between gap-md">
        <p class="font-label-md text-label-md text-secondary">
            Menampilkan <span class="text-on-surface font-bold">{{ $lokasiParkir->firstItem() ?? 0 }} - {{ $lokasiParkir->lastItem() ?? 0 }}</span> dari <span class="text-on-surface font-bold">{{ $lokasiParkir->total() }}</span> lokasi
        </p>
        <div class="flex items-center gap-sm">
            {{ $lokasiParkir->links() }}
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    // Search
    document.getElementById('searchInput')?.addEventListener('input', function(e) {
        const query = e.target.value.toLowerCase();
        document.querySelectorAll('#tableBody tr').forEach(row => {
            const name = row.dataset.name || '';
            if (name.includes(query)) {
                row.style.display = 'table-row';
            } else {
                row.style.display = 'none';
            }
        });
    });

    // Status Filter
    document.getElementById('statusFilter')?.addEventListener('change', function(e) {
        const selectedStatus = e.target.value.toLowerCase();
        document.querySelectorAll('#tableBody tr').forEach(row => {
            const status = row.dataset.status || '';
            if (selectedStatus === '' || status === selectedStatus) {
                row.style.display = 'table-row';
            } else {
                row.style.display = 'none';
            }
        });
    });
</script>
@endpush