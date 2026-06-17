@extends('admin.layouts.main')

@section('title', 'Kelola Slot Parkir')
@section('bg-icon', 'parking')

@section('content')
<!-- Header -->
<div class="flex justify-between items-center mb-6">
    <div>
        <div class="flex items-center gap-2 text-secondary text-sm mb-1">
            <a href="{{ route('admin.lokasi-parkir.index') }}" class="hover:text-primary">Lokasi Parkir</a>
            <span class="material-symbols-outlined text-[16px]">chevron_right</span>
            <a href="{{ route('admin.lokasi-parkir.show', $lokasi->id) }}" class="hover:text-primary">{{ $lokasi->nama }}</a>
            <span class="material-symbols-outlined text-[16px]">chevron_right</span>
            <span class="text-on-surface font-bold">Kelola Slot</span>
        </div>
        <h2 class="text-3xl font-bold">Kelola Slot - {{ $lokasi->nama }}</h2>
    </div>
    <a href="{{ route('admin.lokasi-parkir.show', $lokasi->id) }}" class="flex items-center gap-2 px-5 py-2.5 border border-gray-300 hover:bg-gray-50 rounded-lg font-medium transition-all">
        <span class="material-symbols-outlined text-[20px]">arrow_back</span>
        Kembali
    </a>
</div>

<!-- Alert -->
@if(session('success'))
<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4 flex items-center justify-between">
    <span>{{ session('success') }}</span>
    <button onclick="this.parentElement.remove()" class="text-green-700">
        <span class="material-symbols-outlined">close</span>
    </button>
</div>
@endif

@if(session('error'))
<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4 flex items-center justify-between">
    <span>{{ session('error') }}</span>
    <button onclick="this.parentElement.remove()" class="text-red-700">
        <span class="material-symbols-outlined">close</span>
    </button>
</div>
@endif

@if($errors->any())
<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4">
    <ul class="list-disc list-inside text-sm">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<!-- ========== TOOLBAR (SEARCH & FILTER) ========== -->
<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 mb-6">
    <form action="{{ route('admin.lokasi-parkir.kelola-slot', $lokasi->id) }}" method="GET" class="flex flex-wrap items-center gap-3">
        <div class="relative flex-1 min-w-[200px]">
            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-[18px]">search</span>
            <input type="text" name="search" value="{{ request('search') }}" 
                   class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary text-sm"
                   placeholder="Cari kode slot atau area...">
        </div>
        <select name="jenis" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary text-sm">
            <option value="">Semua Jenis</option>
            <option value="mobil" {{ request('jenis') == 'mobil' ? 'selected' : '' }}>Mobil</option>
            <option value="motor" {{ request('jenis') == 'motor' ? 'selected' : '' }}>Motor</option>
        </select>
        <select name="status_filter" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary text-sm">
            <option value="">Semua Status</option>
            <option value="tersedia" {{ request('status_filter') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
            <option value="terisi" {{ request('status_filter') == 'terisi' ? 'selected' : '' }}>Terisi</option>
        </select>
        <button type="submit" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary/90 transition-all flex items-center gap-2 text-sm">
            <span class="material-symbols-outlined text-[18px]">filter_list</span>
            Filter
        </button>
        @if(request('search') || request('jenis') || request('status_filter'))
        <a href="{{ route('admin.lokasi-parkir.kelola-slot', $lokasi->id) }}" class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition-all text-sm">
            Reset
        </a>
        @endif
    </form>
</div>

<!-- ========== BULK CREATE SLOT ========== -->
<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 mb-6">
    <div class="flex items-center justify-between">
        <div>
            <h3 class="text-lg font-bold">⚡ Buat Banyak Slot Sekaligus</h3>
            <p class="text-sm text-gray-500">Buat puluhan slot parkir dalam satu kali klik</p>
        </div>
        <button onclick="toggleBulkForm()" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary/90 transition-all flex items-center gap-2">
            <span class="material-symbols-outlined text-[18px]">add</span>
            Buat Banyak Slot
        </button>
    </div>

    <div id="bulkForm" style="display: none;" class="mt-4 pt-4 border-t border-gray-200">
        <form action="{{ route('admin.lokasi-parkir.bulk-store-slot', $lokasi->id) }}" method="POST">
            @csrf
            <div class="grid grid-cols-12 gap-4">
                <div class="col-span-3">
                    <label class="text-sm text-gray-600 block mb-1">Prefix Kode Slot</label>
                    <input type="text" name="prefix" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary text-sm" placeholder="Contoh: A" value="A" required>
                    <small class="text-xs text-gray-400">Akan menjadi A1, A2, A3, ...</small>
                </div>
                <div class="col-span-2">
                    <label class="text-sm text-gray-600 block mb-1">Mulai Dari</label>
                    <input type="number" name="start_from" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary text-sm" placeholder="1" value="1" required>
                </div>
                <div class="col-span-2">
                    <label class="text-sm text-gray-600 block mb-1">Jumlah Slot</label>
                    <input type="number" name="jumlah" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary text-sm" placeholder="20" value="20" required>
                    <small class="text-xs text-gray-400">Maksimal 50 slot</small>
                </div>
                <div class="col-span-2">
                    <label class="text-sm text-gray-600 block mb-1">Area</label>
                    <input type="text" name="area" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary text-sm" placeholder="Area" value="A" required>
                </div>
                <div class="col-span-3">
                    <label class="text-sm text-gray-600 block mb-1">Jenis Kendaraan</label>
                    <select name="jenis_kendaraan" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary text-sm" required>
                        <option value="mobil">Mobil</option>
                        <option value="motor">Motor</option>
                    </select>
                </div>
                <div class="col-span-3">
                    <label class="text-sm text-gray-600 block mb-1">Tarif / Jam</label>
                    <input type="number" name="tarif_per_jam" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary text-sm" placeholder="5000" value="5000" required>
                </div>
                <div class="col-span-3">
                    <label class="text-sm text-gray-600 block mb-1">Status</label>
                    <select name="status" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary text-sm" required>
                        <option value="tersedia">Tersedia</option>
                        <option value="terisi">Terisi</option>
                    </select>
                </div>
                <div class="col-span-3 flex items-end">
                    <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white py-2.5 rounded-lg flex items-center justify-center gap-2 transition-all font-medium">
                        <span class="material-symbols-outlined text-[18px]">bolt</span>
                        Buat Slot Massal
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="grid grid-cols-12 gap-6">
    <!-- Form Tambah Slot (Satu-satu) -->
    <div class="col-span-3">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
            <h3 class="text-lg font-bold mb-4">Tambah Slot</h3>
            <form action="{{ route('admin.lokasi-parkir.store-slot', $lokasi->id) }}" method="POST">
                @csrf
                <div class="space-y-3">
                    <div>
                        <label class="text-sm text-gray-600 block mb-1">Kode Slot <span class="text-red-500">*</span></label>
                        <input type="text" name="kode_slot" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary text-sm @error('kode_slot') border-red-500 @enderror" placeholder="Contoh: A1" value="{{ old('kode_slot') }}" required/>
                        @error('kode_slot')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="text-sm text-gray-600 block mb-1">Area <span class="text-red-500">*</span></label>
                        <input type="text" name="area" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary text-sm @error('area') border-red-500 @enderror" placeholder="Contoh: A" value="{{ old('area') }}" required/>
                        @error('area')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="text-sm text-gray-600 block mb-1">Jenis Kendaraan <span class="text-red-500">*</span></label>
                        <select name="jenis_kendaraan" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary text-sm @error('jenis_kendaraan') border-red-500 @enderror" required>
                            <option value="mobil" {{ old('jenis_kendaraan') == 'mobil' ? 'selected' : '' }}>Mobil</option>
                            <option value="motor" {{ old('jenis_kendaraan') == 'motor' ? 'selected' : '' }}>Motor</option>
                        </select>
                        @error('jenis_kendaraan')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="text-sm text-gray-600 block mb-1">Tarif / Jam <span class="text-red-500">*</span></label>
                        <input type="number" name="tarif_per_jam" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary text-sm @error('tarif_per_jam') border-red-500 @enderror" placeholder="5000" step="1000" value="{{ old('tarif_per_jam', 5000) }}" required/>
                        @error('tarif_per_jam')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="text-sm text-gray-600 block mb-1">Status <span class="text-red-500">*</span></label>
                        <select name="status" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary text-sm @error('status') border-red-500 @enderror" required>
                            <option value="tersedia" {{ old('status') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                            <option value="terisi" {{ old('status') == 'terisi' ? 'selected' : '' }}>Terisi</option>
                        </select>
                        @error('status')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit" class="w-full bg-primary hover:bg-primary/90 text-white py-2.5 rounded-lg flex items-center justify-center gap-2 transition-all font-medium">
                        <span class="material-symbols-outlined text-[18px]">add</span>
                        Tambah Slot
                    </button>
                </div>
            </form>

            <div class="mt-4 p-3 bg-yellow-50 border border-yellow-200 rounded-lg">
                <div class="flex items-start gap-2">
                    <span class="material-symbols-outlined text-yellow-600 text-[18px]">info</span>
                    <div>
                        <p class="text-xs text-yellow-700 font-medium">Info</p>
                        <p class="text-xs text-yellow-600">Kode slot tidak boleh sama dalam satu lokasi parkir.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Daftar Slot -->
    <div class="col-span-9">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-5 py-3 border-b border-gray-100 flex justify-between items-center">
                <h3 class="text-lg font-bold">Daftar Slot</h3>
                <span class="text-sm text-gray-400">Total: {{ $slots->total() }} slot</span>
            </div>
            
            <div style="max-height: 500px; overflow-y: auto; overflow-x: auto;">
                <table class="w-full text-sm">
                    <thead style="position: sticky; top: 0; z-index: 10; background: white;">
                        <tr class="bg-gray-50 border-b border-gray-200">
                            <th class="px-4 py-3 text-left text-gray-500 font-medium text-xs uppercase tracking-wider">Kode</th>
                            <th class="px-4 py-3 text-left text-gray-500 font-medium text-xs uppercase tracking-wider">Area</th>
                            <th class="px-4 py-3 text-left text-gray-500 font-medium text-xs uppercase tracking-wider">Jenis</th>
                            <th class="px-4 py-3 text-left text-gray-500 font-medium text-xs uppercase tracking-wider">Tarif</th>
                            <th class="px-4 py-3 text-left text-gray-500 font-medium text-xs uppercase tracking-wider">Status</th>
                            <th class="px-4 py-3 text-right text-gray-500 font-medium text-xs uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($slots as $slot)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-4 py-3 font-medium">{{ $slot->kode_slot }}</td>
                            <td class="px-4 py-3">{{ $slot->area }}</td>
                            <td class="px-4 py-3">
                                <span class="flex items-center gap-1">
                                    <span class="material-symbols-outlined text-gray-400 text-[16px]">
                                        {{ $slot->jenis_kendaraan == 'mobil' ? 'directions_car' : 'two_wheeler' }}
                                    </span>
                                    {{ ucfirst($slot->jenis_kendaraan) }}
                                </span>
                            </td>
                            <td class="px-4 py-3 font-medium">Rp {{ number_format($slot->tarif_per_jam, 0, ',', '.') }}</td>
                            <td class="px-4 py-3">
                                <span class="px-2.5 py-0.5 rounded-full text-xs font-medium {{ $slot->status == 'tersedia' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                    {{ $slot->status == 'tersedia' ? 'Tersedia' : 'Terisi' }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-right">
                                <div class="flex items-center justify-end gap-1">
                                    <!-- TOMBOL TOGGLE STATUS (PENSIKEL) -->
                                    <form action="{{ route('admin.lokasi-parkir.toggle-slot-status', [$lokasi->id, $slot->id]) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" 
                                                class="text-gray-400 hover:text-blue-500 p-1 rounded-lg hover:bg-blue-50 transition-all" 
                                                title="Ubah status menjadi {{ $slot->status == 'tersedia' ? 'Terisi' : 'Tersedia' }}">
                                            <span class="material-symbols-outlined text-[18px]">edit</span>
                                        </button>
                                    </form>
                                    
                                    <!-- TOMBOL HAPUS (SAMPAH) -->
                                    <form action="{{ route('admin.lokasi-parkir.destroy-slot', [$lokasi->id, $slot->id]) }}" method="POST" onsubmit="return confirm('Yakin hapus slot {{ $slot->kode_slot }}?')" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-gray-400 hover:text-red-500 p-1 rounded-lg hover:bg-red-50 transition-all" title="Hapus Slot {{ $slot->kode_slot }}">
                                            <span class="material-symbols-outlined text-[18px]">delete</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-4 py-8 text-center text-gray-400">
                                <span class="material-symbols-outlined text-4xl block mb-2">inbox</span>
                                @if(request('search') || request('jenis') || request('status_filter'))
                                    Tidak ada slot yang cocok dengan filter
                                    <br>
                                    <a href="{{ route('admin.lokasi-parkir.kelola-slot', $lokasi->id) }}" class="text-primary hover:underline text-sm">Reset filter</a>
                                @else
                                    Belum ada slot parkir
                                @endif
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="px-5 py-3 border-t border-gray-100 bg-gray-50 flex justify-between items-center">
                <span class="text-sm text-gray-500">
                    Menampilkan {{ $slots->firstItem() ?? 0 }} - {{ $slots->lastItem() ?? 0 }} dari {{ $slots->total() }} slot
                </span>
                <div>
                    {{ $slots->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function toggleBulkForm() {
        const form = document.getElementById('bulkForm');
        if (form.style.display === 'none') {
            form.style.display = 'block';
        } else {
            form.style.display = 'none';
        }
    }
</script>
@endpush

@push('styles')
<style>
    .sticky {
        position: sticky;
        top: 0;
        z-index: 10;
        background: white;
    }
</style>
@endpush