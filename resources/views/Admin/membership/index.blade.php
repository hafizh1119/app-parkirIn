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

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-gradient-to-r from-[#5445cf] to-[#7c5cbf] p-6 rounded-xl text-white shadow-lg">
            <p class="text-sm opacity-80">Total Anggota</p>
            <h2 class="text-3xl font-bold">{{ number_format($stats['total_members']) }}</h2>
            <p class="text-xs opacity-70 mt-1">+14.2% bulan ini</p>
        </div>
        <div class="bg-white rounded-xl border border-gray-200 p-6 shadow-sm">
            <p class="text-sm text-gray-500">Poin Terdistribusi</p>
            <h2 class="text-3xl font-bold text-[#5445cf]">{{ number_format($stats['total_points']) }}</h2>
            <p class="text-xs text-gray-400 mt-1">Total nilai transaksi</p>
        </div>
        <div class="bg-white rounded-xl border border-gray-200 p-6 shadow-sm">
            <p class="text-sm text-gray-500">Program Aktif</p>
            <h2 class="text-3xl font-bold text-[#942276]">{{ $tiers->count() }} Loyalitas</h2>
            <div class="flex gap-1 mt-1">
                <span class="px-2 py-0.5 bg-blue-50 text-blue-600 text-[10px] font-bold rounded">Hari Member</span>
                <span class="px-2 py-0.5 bg-green-50 text-green-600 text-[10px] font-bold rounded">Pengguna Baru</span>
            </div>
        </div>
        <div class="bg-white rounded-xl border border-gray-200 p-6 shadow-sm">
            <p class="text-sm text-gray-500">Hadiah Poin</p>
            <h2 class="text-3xl font-bold text-[#5445cf]">{{ number_format($pointSettings->redeem_points ?? 6000) }} <span class="text-sm font-normal text-gray-500">poin</span></h2>
            <p class="text-xs text-[#942276] mt-1">Voucher Parkir Gratis</p>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        <!-- Point Configuration -->
        <div class="lg:col-span-4">
            <div class="bg-white rounded-xl border border-gray-200 p-6 shadow-sm">
                <div class="flex justify-between items-start mb-4">
                    <h3 class="text-lg font-bold text-[#5445cf]">Aturan Poin</h3>
                    <button onclick="document.getElementById('editSettingsModal').classList.remove('hidden')" 
                            class="p-2 hover:bg-gray-100 rounded-lg transition">
                        <span class="material-symbols-outlined">edit</span>
                    </button>
                </div>
                
                <div class="bg-[#5445cf]/5 border-2 border-dashed border-[#5445cf]/30 rounded-xl p-4 text-center mb-4">
                    <p class="text-sm text-gray-600 mb-1">Rasio Saat Ini</p>
                    <p class="text-xl font-bold text-[#5445cf]">
                        {{ $pointSettings->points_per_rupiah ?? 10 }} Poin 
                        <span class="text-sm font-normal text-gray-500">untuk setiap transaksi</span>
                    </p>
                    <p class="text-xs text-gray-400 mt-1">Minimal Rp {{ number_format($pointSettings->min_transaction ?? 10000, 0, ',', '.') }}</p>
                </div>
                
                <div class="bg-[#942276]/5 border-2 border-dashed border-[#942276]/30 rounded-xl p-4 text-center mb-4">
                    <p class="text-sm text-gray-600 mb-1">Penukaran</p>
                    <p class="text-xl font-bold text-[#942276]">
                        {{ number_format($pointSettings->redeem_points ?? 6000) }} Poin 
                        <span class="text-sm font-normal text-gray-500">= Parkir Gratis</span>
                    </p>
                </div>
                
                <p class="text-sm text-gray-500 mb-4">Minimal pembelanjaan untuk mendapatkan poin adalah Rp10.000. Berlaku untuk semua jenis kendaraan.</p>
                
                <button onclick="document.getElementById('editSettingsModal').classList.remove('hidden')" 
                        class="w-full py-2.5 border-2 border-[#5445cf] text-[#5445cf] font-bold rounded-lg hover:bg-[#5445cf]/5 transition-all">
                    Perbarui Kebijakan
                </button>
            </div>
        </div>

        <!-- Membership Tiers -->
        <div class="lg:col-span-8">
            <div class="bg-white rounded-xl border border-gray-200 p-6 shadow-sm">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-bold text-gray-800">Tingkatan Keanggotaan</h3>
                    <button onclick="document.getElementById('addTierModal').classList.remove('hidden')" 
                            class="flex items-center gap-2 bg-[#5445cf] text-white px-4 py-2 rounded-lg font-bold hover:bg-[#4538b5] transition">
                        <span class="material-symbols-outlined text-sm">add_circle</span>
                        Tambah Tingkatan Baru
                    </button>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    @forelse($tiers as $tier)
                    <div class="border rounded-xl p-4 {{ $tier->slug == 'premium' ? 'border-2 border-[#5445cf] bg-[#5445cf]/5 relative' : 'border-gray-200 hover:border-[#5445cf] transition' }}">
                        @if($tier->slug == 'premium')
                            <div class="absolute top-0 right-0 bg-[#5445cf] text-[10px] text-white px-2 py-1 rounded-bl-lg rounded-tr-lg font-bold uppercase">Populer</div>
                        @endif
                        
                        <div class="flex items-center gap-2 mb-2 {{ $tier->slug == 'gold' ? 'text-[#942276]' : ($tier->slug == 'premium' ? 'text-[#5445cf]' : 'text-gray-500') }}">
                            <span class="material-symbols-outlined {{ $tier->slug == 'gold' ? 'text-[#942276]' : ($tier->slug == 'premium' ? 'text-[#5445cf]' : 'text-gray-500') }}"> 
                                {{ $tier->slug == 'gold' ? 'workspace_premium' : ($tier->slug == 'premium' ? 'stars' : 'verified') }}
                            </span>
                            <span class="font-bold">{{ $tier->name }}</span>
                        </div>
                        
                        <div class="mb-3">
                            <p class="text-xs text-gray-500">{{ $tier->slug == 'basic' ? 'Level awal' : ($tier->slug == 'premium' ? 'Level menengah' : 'Level teratas') }}</p>
                            <p class="text-sm font-semibold">
                                {{ number_format($tier->min_points) }} - {{ $tier->max_points ? number_format($tier->max_points) : '∞' }} Poin
                            </p>
                        </div>
                        
                        <ul class="space-y-1.5 mb-3">
                            @foreach($tier->benefits_array as $benefit)
                                <li class="flex items-start gap-1.5 text-xs">
                                    <span class="material-symbols-outlined text-sm text-green-500">check_circle</span>
                                    {{ $benefit }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    @empty
                    <div class="col-span-3 text-center py-8 text-gray-500">
                        Belum ada tingkatan. <a href="#" onclick="document.getElementById('addTierModal').classList.remove('hidden')" class="text-[#5445cf] font-semibold">Buat tingkatan pertama</a>
                    </div>
                    @endforelse
                </div>
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
                                <img class="h-8 w-8 rounded-full object-cover" 
                                     src="{{ $member->user->foto_profil ?? asset('images/default-avatar.png') }}" 
                                     alt="{{ $member->user->name }}">
                                <div>
                                    <p class="font-semibold text-gray-800">{{ $member->user->name }}</p>
                                    <p class="text-xs text-gray-500">{{ $member->user->email }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase {{ $member->tier_label['class'] }}">
                                {{ $member->tier_label['label'] }}
                            </span>
                        </td>
                        <td class="px-6 py-4 font-semibold text-sm">{{ number_format($member->total_points) }} poin</td>
                        <td class="px-6 py-4 text-sm">
                            {{ $member->updated_at->diffForHumans() }}
                        </td>
                        <td class="px-6 py-4">
                            <span class="flex items-center gap-1.5 text-[11px] font-bold w-fit px-2 py-1 rounded-full {{ $member->status_badge['class'] }}">
                                <span class="h-1.5 w-1.5 rounded-full {{ $member->is_active ? 'bg-green-600' : 'bg-gray-400' }}"></span>
                                {{ $member->status_badge['label'] }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-1">
                                <form action="{{ route('admin.membership.update-tier', $member->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PUT')
                                    <select name="tier" onchange="this.form.submit()" 
                                            class="text-xs border border-gray-200 rounded-lg px-2 py-1 focus:ring-2 focus:ring-[#5445cf] outline-none bg-white">
                                        <option value="basic" {{ $member->tier == 'basic' ? 'selected' : '' }}>Basic</option>
                                        <option value="premium" {{ $member->tier == 'premium' ? 'selected' : '' }}>Premium</option>
                                        <option value="gold" {{ $member->tier == 'gold' ? 'selected' : '' }}>Gold</option>
                                    </select>
                                </form>
                                <a href="{{ route('admin.membership.detail', $member->id) }}" 
                                   class="p-1.5 text-blue-500 hover:bg-blue-50 rounded-lg transition" title="Detail">
                                    <span class="material-symbols-outlined text-sm">visibility</span>
                                </a>
                                <form action="{{ route('admin.membership.toggle', $member->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('POST')
                                    <button type="submit" class="p-1.5 hover:bg-gray-100 rounded-lg transition" 
                                            title="{{ $member->is_active ? 'Nonaktifkan' : 'Aktifkan' }}">
                                        <span class="material-symbols-outlined text-sm {{ $member->is_active ? 'text-green-500' : 'text-gray-400' }}">
                                            {{ $member->is_active ? 'toggle_on' : 'toggle_off' }}
                                        </span>
                                    </button>
                                </form>
                            </div>
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

<!-- Modal Edit Settings -->
<div id="editSettingsModal" class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-xl max-w-lg w-full mx-4 p-6 shadow-2xl">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-bold text-gray-800">Edit Aturan Poin</h3>
            <button onclick="document.getElementById('editSettingsModal').classList.add('hidden')" 
                    class="p-2 hover:bg-gray-100 rounded-lg transition">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        <form action="{{ route('admin.membership.point-settings') }}" method="POST">
            @csrf
            @method('PUT')
            <div class="space-y-4">
                <div>
                    <label class="block font-semibold text-gray-700 text-sm mb-1">Poin per Transaksi</label>
                    <input type="number" name="points_per_rupiah" value="{{ $pointSettings->points_per_rupiah ?? 10 }}" 
                           class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#5445cf] outline-none" 
                           min="1" required>
                    <p class="text-xs text-gray-400 mt-1">Poin yang didapat per Rp 10.000 transaksi</p>
                </div>
                <div>
                    <label class="block font-semibold text-gray-700 text-sm mb-1">Minimal Transaksi (Rp)</label>
                    <input type="number" name="min_transaction" value="{{ $pointSettings->min_transaction ?? 10000 }}" 
                           class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#5445cf] outline-none" 
                           min="1000" step="1000" required>
                    <p class="text-xs text-gray-400 mt-1">Minimal transaksi untuk mendapat poin</p>
                </div>
                <div>
                    <label class="block font-semibold text-gray-700 text-sm mb-1">Poin Tukar Parkir Gratis</label>
                    <input type="number" name="redeem_points" value="{{ $pointSettings->redeem_points ?? 6000 }}" 
                           class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#5445cf] outline-none" 
                           min="100" step="100" required>
                    <p class="text-xs text-gray-400 mt-1">Jumlah poin yang dibutuhkan untuk parkir gratis</p>
                </div>
            </div>
            <div class="flex gap-3 mt-6 pt-4 border-t border-gray-200">
                <button type="submit" class="bg-[#5445cf] text-white px-6 py-2.5 rounded-lg font-semibold hover:bg-[#4538b5] transition">
                    Simpan Perubahan
                </button>
                <button type="button" onclick="document.getElementById('editSettingsModal').classList.add('hidden')" 
                        class="px-6 py-2.5 border border-gray-200 rounded-lg font-semibold text-gray-600 hover:bg-gray-50 transition">
                    Batal
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Add Tier -->
<div id="addTierModal" class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-xl max-w-lg w-full mx-4 p-6 shadow-2xl">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-bold text-gray-800">Tambah Tingkatan Baru</h3>
            <button onclick="document.getElementById('addTierModal').classList.add('hidden')" 
                    class="p-2 hover:bg-gray-100 rounded-lg transition">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        <form action="{{ route('admin.membership.add-tier') }}" method="POST">
            @csrf
            <div class="space-y-4">
                <div>
                    <label class="block font-semibold text-gray-700 text-sm mb-1">Nama Tingkatan</label>
                    <input type="text" name="name" class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#5445cf] outline-none" 
                           placeholder="Contoh: Platinum" required>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block font-semibold text-gray-700 text-sm mb-1">Min Poin</label>
                        <input type="number" name="min_points" class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#5445cf] outline-none" 
                               placeholder="0" required>
                    </div>
                    <div>
                        <label class="block font-semibold text-gray-700 text-sm mb-1">Max Poin</label>
                        <input type="number" name="max_points" class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#5445cf] outline-none" 
                               placeholder="Kosongkan jika unlimited">
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block font-semibold text-gray-700 text-sm mb-1">Diskon (%)</label>
                        <input type="number" name="discount_percentage" class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#5445cf] outline-none" 
                               value="0" min="0" max="100" required>
                    </div>
                    <div>
                        <label class="block font-semibold text-gray-700 text-sm mb-1">Multiplier Poin</label>
                        <input type="number" name="point_multiplier" class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#5445cf] outline-none" 
                               value="1" min="1" step="0.1" required>
                    </div>
                </div>
                <div>
                    <label class="block font-semibold text-gray-700 text-sm mb-1">Keuntungan (pisahkan dengan koma)</label>
                    <input type="text" name="benefits" class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#5445cf] outline-none" 
                           placeholder="Diskon 10%, Akses Prioritas, dll">
                    <p class="text-xs text-gray-400 mt-1">Pisahkan setiap keuntungan dengan koma</p>
                </div>
            </div>
            <div class="flex gap-3 mt-6 pt-4 border-t border-gray-200">
                <button type="submit" class="bg-[#5445cf] text-white px-6 py-2.5 rounded-lg font-semibold hover:bg-[#4538b5] transition">
                    Tambah Tingkatan
                </button>
                <button type="button" onclick="document.getElementById('addTierModal').classList.add('hidden')" 
                        class="px-6 py-2.5 border border-gray-200 rounded-lg font-semibold text-gray-600 hover:bg-gray-50 transition">
                    Batal
                </button>
            </div>
        </form>
    </div>
</div>
@endsection