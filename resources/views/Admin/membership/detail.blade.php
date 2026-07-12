@extends('Admin.layouts.app')

@section('title', 'Detail Anggota')

@section('content')
<div class="space-y-6">
    <!-- Breadcrumb -->
    <nav class="flex items-center gap-2 text-sm text-gray-500">
        <span>Dashboard</span>
        <span class="material-symbols-outlined text-sm">chevron_right</span>
        <a href="{{ route('admin.membership.index') }}" class="hover:text-[#5445cf]">Membership & Poin</a>
        <span class="material-symbols-outlined text-sm">chevron_right</span>
        <span class="text-[#5445cf] font-semibold">Detail Anggota</span>
    </nav>

    <!-- Tombol Kembali -->
    <a href="{{ route('admin.membership.index') }}" 
       class="inline-flex items-center gap-1 text-sm font-semibold text-gray-600 hover:text-[#5445cf] transition">
        <span class="material-symbols-outlined text-sm">arrow_back</span>
        Kembali ke Database Anggota
    </a>

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

    <!-- Profil Ringkas -->
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">

            <div class="flex items-center gap-4">
                <div class="h-16 w-16 rounded-full bg-[#5445cf]/10 text-[#5445cf] flex items-center justify-center font-bold text-2xl shrink-0">
                    {{ strtoupper(substr($member->user->name ?? '-', 0, 1)) }}
                </div>
                <div>
                    <h2 class="text-xl font-bold text-gray-800">{{ $member->user->name ?? '-' }}</h2>
                    <p class="text-sm text-gray-500">{{ $member->user->email ?? '-' }}</p>
                    <div class="flex items-center gap-2 mt-2">
                        <span class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase {{ $member->tier_label['class'] ?? 'bg-gray-100 text-gray-500' }}">
                            {{ $member->tier_label['label'] ?? ucfirst($member->tier) }}
                        </span>
                        @php $isAktif = ($member->user->status_akun ?? 'nonaktif') == 'aktif'; @endphp
                        <span class="flex items-center gap-1.5 text-[11px] font-bold w-fit px-2 py-1 rounded-full {{ $isAktif ? 'bg-green-50 text-green-600' : 'bg-gray-100 text-gray-500' }}">
                            <span class="h-1.5 w-1.5 rounded-full {{ $isAktif ? 'bg-green-600' : 'bg-gray-400' }}"></span>
                            {{ $isAktif ? 'Aktif' : 'Nonaktif' }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-3 gap-3">
                <div class="bg-[#5445cf]/5 border-2 border-dashed border-[#5445cf]/30 rounded-xl p-4 text-center min-w-[120px]">
                    <p class="text-xs text-gray-500 mb-1">Total Poin</p>
                    <p class="text-lg font-bold text-[#5445cf]">{{ number_format($totalPoint) }}</p>
                </div>
                <div class="bg-orange-50 border-2 border-dashed border-orange-200 rounded-xl p-4 text-center min-w-[120px]">
                    <p class="text-xs text-gray-500 mb-1">Poin Masuk</p>
                    <p class="text-lg font-bold text-green-600">+{{ number_format($pointMasuk) }}</p>
                </div>
                <div class="bg-green-50 border-2 border-dashed border-green-200 rounded-xl p-4 text-center min-w-[120px]">
                    <p class="text-xs text-gray-500 mb-1">Poin Terpakai</p>
                    <p class="text-lg font-bold text-red-500">-{{ number_format($pointKeluar) }}</p>
                </div>
            </div>

        </div>
    </div>

    <!-- Riwayat Transaksi Poin -->
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-lg font-bold text-gray-800">Riwayat Transaksi Poin</h3>
            <p class="text-sm text-gray-500">Semua aktivitas poin masuk dan keluar milik anggota ini</p>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gray-50 text-gray-600 border-b border-gray-200">
                        <th class="px-6 py-3 text-left font-semibold">Tanggal</th>
                        <th class="px-6 py-3 text-left font-semibold">Keterangan</th>
                        <th class="px-6 py-3 text-right font-semibold">Poin</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($pointTransactions as $trx)
                    <tr class="hover:bg-gray-50/50 transition">
                        <td class="px-6 py-4 text-gray-700 whitespace-nowrap">
                            {{ $trx->created_at->translatedFormat('d M Y, H:i') }}
                        </td>
                        <td class="px-6 py-4 text-gray-700">
                            {{ $trx->description ?? '-' }}
                        </td>
                        <td class="px-6 py-4 text-right font-semibold whitespace-nowrap {{ $trx->points < 0 ? 'text-red-500' : 'text-green-600' }}">
                            {{ $trx->points > 0 ? '+' : '' }}{{ number_format($trx->points) }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-6 py-8 text-center text-gray-500">
                            <span class="material-symbols-outlined text-4xl text-gray-300 block mb-2">receipt_long</span>
                            Belum ada riwayat transaksi poin
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection