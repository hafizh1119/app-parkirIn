@extends('Admin.layouts.app')

@section('title', 'Membership & Poin')

@section('content')
<div class="space-y-6">
    <!-- Breadcrumb -->
    <nav class="flex items-center gap-2 text-sm text-gray-500">
        <span>Dashboard</span>
        <span class="material-symbols-outlined text-sm">chevron_right</span>
        <span class="text-[#5445cf] font-semibold">Membership & Poin</span>
    </nav>

    <!-- Alert Messages -->
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

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">

    <!-- Total Anggota -->
    <div class="bg-gradient-to-r from-[#5445cf] to-[#7c5cbf] p-6 rounded-xl text-white shadow-lg">
         <div class="flex items-center justify-between">
        <div>
            <p class="text-sm opacity-80">Total Anggota Aktif</p>
            <h2 class="text-3xl font-bold">{{ number_format($stats['active_members']) }}</h2>
        </div>
        <span class="material-symbols-outlined text-4xl opacity-80">group</span>
    </div>
    </div>

    <!-- Total Poin Terdistribusi -->
    <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">Total Poin Beredar</p>
                <h2 class="text-3xl font-bold text-gray-800">{{ number_format($stats['total_points'] ?? 0) }}</h2>
                <p class="text-xs text-gray-400 mt-1">Rata-rata {{ number_format($stats['avg_points'] ?? 0) }} poin/anggota</p>
            </div>
            <span class="material-symbols-outlined text-4xl text-amber-400">stars</span>
        </div>
    </div>

    <!-- Anggota Baru Bulan Ini -->
    <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">Anggota Baru</p>
                <h2 class="text-3xl font-bold text-gray-800">{{ number_format($stats['new_members_this_month'] ?? 0) }}</h2>
                <p class="text-xs text-gray-400 mt-1">Bulan ini</p>
            </div>
            <span class="material-symbols-outlined text-4xl text-green-500">person_add</span>
        </div>
    </div>
    </div>
    

    <!-- Member List Table -->
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-gray-200 flex flex-wrap justify-between items-center gap-4">
            <div>
                <h3 class="text-lg font-bold text-gray-800">Database Anggota</h3>
                <p class="text-sm text-gray-500">Mengelola total {{ number_format($stats['total_members']) }} akun loyalitas</p>
            </div>
            <div class="flex gap-2">
                <button class="flex items-center gap-1 px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg font-bold text-gray-600 hover:bg-gray-100 transition">
                    <span class="material-symbols-outlined text-sm">filter_list</span>
                    Filter
                </button>
                <a href="{{ route('admin.membership.export') }}" 
                   class="flex items-center gap-1 px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg font-bold text-gray-600 hover:bg-gray-100 transition">
                    <span class="material-symbols-outlined text-sm">download</span>
                    Ekspor Laporan
                </a>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gray-50 text-gray-600 border-b border-gray-200">
                        <th class="px-6 py-3 text-left font-semibold">Nama Anggota</th>
                        <th class="px-6 py-3 text-left font-semibold">Tingkatan</th>
                        <th class="px-6 py-3 text-left font-semibold">Total Poin</th>
                        <th class="px-6 py-3 text-left font-semibold">Transaksi Terakhir</th>
                        <th class="px-6 py-3 text-left font-semibold">Status</th>
                        <th class="px-6 py-3 text-left font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($members as $member)
                    <tr class="hover:bg-gray-50/50 transition">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="h-8 w-8 rounded-full bg-[#5445cf]/10 text-[#5445cf] flex items-center justify-center font-bold text-xs shrink-0">
                                    {{ strtoupper(substr($member->user->name ?? '-', 0, 1)) }}
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-800">{{ $member->user->name ?? '-' }}</p>
                                    <p class="text-xs text-gray-500">{{ $member->user->email ?? '-' }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase {{ $member->tier_label['class'] ?? 'bg-gray-100 text-gray-500' }}">
                                {{ $member->tier_label['label'] ?? ucfirst($member->tier) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 font-semibold text-sm">{{ number_format($member->computed_points ?? 0) }} poin</td>
                        <td class="px-6 py-4 text-sm">
                            {{ $member->latest_transaction_at ? \Carbon\Carbon::parse($member->latest_transaction_at)->diffForHumans() : '-' }}
                        </td>
                        <td class="px-6 py-4">
                            @php $isAktif = ($member->user->status_akun ?? 'nonaktif') == 'aktif'; @endphp
                            <span class="flex items-center gap-1.5 text-[11px] font-bold w-fit px-2 py-1 rounded-full {{ $isAktif ? 'bg-green-50 text-green-600' : 'bg-gray-100 text-gray-500' }}">
                                <span class="h-1.5 w-1.5 rounded-full {{ $isAktif ? 'bg-green-600' : 'bg-gray-400' }}"></span>
                                {{ $isAktif ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <a href="{{ route('admin.membership.detail', $member->id) }}" 
                               class="px-3 py-1.5 text-xs font-semibold text-[#5445cf] border border-[#5445cf] rounded-lg hover:bg-[#5445cf] hover:text-white transition">
                                Detail
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                            <span class="material-symbols-outlined text-4xl text-gray-300 block mb-2">group_off</span>
                            Belum ada anggota.
                            <span class="text-[#5445cf] font-semibold">Tunggu pengguna mendaftar</span>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="p-6 border-t border-gray-200 flex flex-wrap justify-between items-center gap-3">
            <p class="text-sm text-gray-500">
                Menampilkan {{ $members->firstItem() ?? 0 }} - {{ $members->lastItem() ?? 0 }} dari {{ $members->total() }} anggota
            </p>
            {{ $members->appends(request()->query())->links('pagination::tailwind') }}
        </div>
    </div>
</div>
@endsection