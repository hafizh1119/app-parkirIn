@extends('layouts.app')

@push('styles')
<style>
    .profile-container {
        padding-top: 76px;
        padding-bottom: 16px;
        background: #f4f6fb;
        height: calc(100vh - 76px);
        overflow-y: auto;
        display: flex;
        align-items: center;
    }
    
    .profile-container .container {
        padding: 0;
        max-width: 1100px;
    }
    
    .profile-card {
        background: #ffffff;
        border-radius: 20px;
        box-shadow: 0 2px 20px rgba(115, 103, 240, 0.08);
        border: none;
        height: 100%;
    }
    
    .profile-card .card-body {
        padding: 24px 28px;
    }
    
    .profile-avatar {
        width: 72px;
        height: 72px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #7367F0;
        flex-shrink: 0;
    }
    
    .stat-number {
        font-size: 2.2rem;
        font-weight: 800;
        color: #1a1a2e;
        line-height: 1;
    }
    
    .stat-label {
        font-size: 0.7rem;
        color: #8e8ea0;
        font-weight: 500;
        letter-spacing: 0.5px;
    }
    
    .menu-item-custom {
        display: flex;
        align-items: center;
        padding: 10px 0;
        color: #1a1a2e;
        text-decoration: none;
        transition: all 0.2s ease;
        border-bottom: 1px solid #f0f0f5;
        cursor: pointer;
        font-size: 0.9rem;
    }
    
    .menu-item-custom:last-of-type {
        border-bottom: none;
    }
    
    .menu-item-custom:hover {
        color: #7367F0;
    }
    
    .menu-item-custom .menu-icon {
        width: 36px;
        height: 36px;
        background: #f0f2ff;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 12px;
        color: #7367F0;
        flex-shrink: 0;
        font-size: 20px;
    }
    
    .menu-item-custom .menu-arrow {
        color: #c5c4d4;
        margin-left: auto;
        font-size: 18px;
    }
    
    .info-label-custom {
        font-size: 0.65rem;
        color: #9ca3af;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 2px;
    }
    
    .info-value-custom {
        font-size: 0.95rem;
        color: #1a1a2e;
        font-weight: 500;
        margin-bottom: 14px;
    }
    
    .info-value-custom:last-child {
        margin-bottom: 0;
    }
    
    .vehicle-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 12px 18px;
        background: #f8f9fc;
        border-radius: 12px;
        margin-bottom: 10px;
        transition: all 0.2s ease;
    }
    
    .vehicle-item:hover {
        background: #f0f2ff;
    }
    
    .vehicle-item:last-child {
        margin-bottom: 0;
    }
    
    .vehicle-icon-custom {
        width: 40px;
        height: 40px;
        background: #e8ecff;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #7367F0;
        margin-right: 12px;
        flex-shrink: 0;
        font-size: 22px;
    }
    
    .btn-edit-custom {
        color: #7367F0;
        font-weight: 600;
        font-size: 0.7rem;
        padding: 5px 18px;
        border-radius: 8px;
        background: #f0f2ff;
        transition: all 0.2s ease;
        text-decoration: none;
        border: none;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }
    
    .btn-edit-custom:hover {
        background: #7367F0;
        color: #fff;
        text-decoration: none;
    }
    
    .btn-add-custom {
        color: #7367F0;
        font-weight: 600;
        font-size: 0.75rem;
        padding: 5px 16px;
        border-radius: 8px;
        border: 1.5px dashed #7367F0;
        transition: all 0.2s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }
    
    .btn-add-custom:hover {
        background: #7367F0;
        color: #fff;
        text-decoration: none;
    }
    
    .btn-logout-custom {
        color: #ef4444;
        font-weight: 500;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 0;
        margin-top: 4px;
        border: none;
        background: none;
        width: 100%;
        transition: all 0.2s ease;
        border-top: 1px solid #f0f0f5;
    }
    
    .btn-logout-custom:hover {
        color: #dc2626;
    }
    
    .section-title {
        font-size: 1rem;
        font-weight: 700;
        color: #1a1a2e;
        margin-bottom: 0;
    }
    
    .row.g-4 {
        --bs-gutter-y: 1rem;
        --bs-gutter-x: 1rem;
    }
    
    .mb-4 {
        margin-bottom: 1rem !important;
    }
    
    .gap-3 {
        gap: 1rem !important;
    }
    
    /* Custom scrollbar */
    .profile-container::-webkit-scrollbar {
        width: 4px;
    }
    
    .profile-container::-webkit-scrollbar-thumb {
        background: #c8c4d6;
        border-radius: 10px;
    }
    
    /* ============ TABLET (max-width: 991px) ============ */
    @media (max-width: 991px) {
        .profile-container {
            padding-top: 70px;
            height: calc(100vh - 70px);
            align-items: flex-start;
            padding-bottom: 20px;
        }
        
        .profile-container .container {
            padding: 0 16px;
        }
        
        .profile-card {
            border-radius: 16px;
        }
        
        .profile-card .card-body {
            padding: 18px 20px;
        }
        
        .profile-avatar {
            width: 60px;
            height: 60px;
        }
        
        .stat-number {
            font-size: 1.8rem;
        }
        
        .row.g-4 {
            --bs-gutter-y: 0.75rem;
            --bs-gutter-x: 0.75rem;
        }
        
        .gap-4 {
            gap: 0.75rem !important;
        }
    }
    
    /* ============ MOBILE (max-width: 576px) ============ */
    @media (max-width: 576px) {
        .profile-container {
            padding-top: 96px;
            height: auto;
            min-height: calc(100vh - 96px);
            padding-bottom: 20px;
            align-items: flex-start;
            overflow-y: visible;
        }
        
        .profile-container .container {
            padding: 0 12px;
        }
        
        .profile-card {
            border-radius: 14px;
        }
        
        .profile-card .card-body {
            padding: 14px 14px;
        }
        
        .profile-avatar {
            width: 52px;
            height: 52px;
            border-width: 2.5px;
        }
        
        .stat-number {
            font-size: 1.6rem;
        }
        
        .stat-label {
            font-size: 0.6rem;
        }
        
        .menu-item-custom {
            font-size: 0.8rem;
            padding: 8px 0;
        }
        
        .menu-item-custom .menu-icon {
            width: 30px;
            height: 30px;
            font-size: 16px;
            margin-right: 10px;
        }
        
        .menu-item-custom .menu-arrow {
            font-size: 16px;
        }
        
        .info-label-custom {
            font-size: 0.55rem;
        }
        
        .info-value-custom {
            font-size: 0.85rem;
            margin-bottom: 10px;
        }
        
        .vehicle-item {
            padding: 10px 12px;
            border-radius: 10px;
            margin-bottom: 8px;
        }
        
        .vehicle-item:last-child {
            margin-bottom: 0;
        }
        
        .vehicle-icon-custom {
            width: 34px;
            height: 34px;
            font-size: 18px;
            margin-right: 10px;
        }
        
        .vehicle-item .fw-semibold {
            font-size: 0.85rem !important;
        }
        
        .vehicle-item .text-muted {
            font-size: 0.65rem !important;
        }
        
        .btn-edit-custom {
            font-size: 0.6rem;
            padding: 4px 12px;
        }
        
        .btn-add-custom {
            font-size: 0.65rem;
            padding: 4px 12px;
        }
        
        .btn-logout-custom {
            font-size: 0.8rem;
            padding: 8px 0;
        }
        
        .section-title {
            font-size: 0.9rem;
        }
        
        .row.g-4 {
            --bs-gutter-y: 0.5rem;
            --bs-gutter-x: 0.5rem;
        }
        
        .gap-4 {
            gap: 0.5rem !important;
        }
        
        /* Informasi Akun jadi full width di mobile */
        .profile-card .row .col-md-6 {
            width: 100%;
        }
        
        /* ===== MOBILE: Menu pindah ke bawah ===== */
        .profile-container .menu-section-mobile {
            display: block !important;
        }
        
        .profile-container .menu-section-desktop {
            display: none !important;
        }
    }
    
    /* ============ DESKTOP: Menu di kiri ============ */
    @media (min-width: 577px) {
        .profile-container .menu-section-mobile {
            display: none !important;
        }
        
        .profile-container .menu-section-desktop {
            display: flex !important;
        }
    }

    .vehicle-item{
    min-height:70px;
    margin-bottom:12px;
    }

    .vehicle-scroll{
        max-height:160px;
        overflow-y:auto;
        padding-right:6px;
    }

.sheet-handle {
    width: 55px;
    height: 6px;
    background: #d9d9d9;
    border-radius: 20px;
    margin: 12px auto 6px;
}

.vehicle-item {
    border: 1px solid #ebeef2;
    border-radius: 16px;
    padding: 16px;
    margin-bottom: 14px;
    cursor: pointer;
    transition: .25s;
    background: #fff;
}
.vehicle-item:hover {
    border-color: #7367F0;
    background: #f8f8ff;
}

@media (max-width: 768px) {
    .modal.fade .modal-dialog.modal-bottom-sheet {
        transform: translateY(100%);
        transition: transform .35s ease;
        margin: 0;
    }
    .modal.show .modal-dialog.modal-bottom-sheet {
        transform: translateY(0);
    }
    .modal-bottom-sheet {
        position: fixed;
        left: 0; right: 0; bottom: 0;
        width: 100%; max-width: 100%;
        margin: 0;
        display: flex;
        align-items: flex-end;
    }
    .modal-bottom-sheet .modal-content {
        width: 100%;
        border: 0;
        border-radius: 28px 28px 0 0;
        min-height: 50vh;
        max-height: 85vh;
        overflow: hidden;
        overflow-y: auto;
        box-shadow: 0 -10px 40px rgba(0,0,0,.18);
        animation: sheetUp .35s ease;
    }
    .modal-backdrop.show {
        opacity: .45;
        backdrop-filter: blur(2px);
    }
}

@keyframes sheetUp {
    from { transform: translateY(80px); opacity: .4; }
    to { transform: translateY(0); opacity: 1; }
}
</style>
@endpush

@section('content')
<div class="profile-container">
    <div class="container">
        <div class="row g-4">

            <!-- ============ KOLOM KIRI ============ -->
            <div class="col-lg-4 d-flex flex-column gap-4">
                <!-- Profile Header -->
                <div class="profile-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center gap-3">
                            <img
                                class="profile-avatar"
                                src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=7367F0&color=fff&size=128"
                                alt="{{ $user->name }}">
                            <div class="flex-grow-1 min-width-0">
                                <h6 class="fw-bold mb-0 text-truncate" style="color: #1a1a2e; font-size: 1rem;">{{ $user->name }}</h6>
                                <p class="text-muted mb-0 text-truncate" style="font-size: 0.8rem;">{{ $user->email }}</p>
                                <p class="text-muted mt-1 mb-0" style="font-size: 0.65rem;">Bergabung sejak {{ $user->created_at->format('M Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Statistik - Point Saya -->
                <div class="profile-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-3">
                                <div class="rounded-circle" style="width: 52px; height: 52px; background: linear-gradient(135deg, #7367F0 0%, #a78bfa 100%); display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 16px rgba(115, 103, 240, 0.3);">
                                    <i class="mdi mdi-star-four-points" style="font-size: 28px; color: #fff;"></i>
                                </div>
                                <div>
                                    <div class="stat-number" style="font-size: 1.8rem; line-height: 1.2;">{{ number_format($totalPoint) }}</div>
                                    <div class="stat-label" style="font-size: 0.7rem; color: #8e8ea0; font-weight: 500; letter-spacing: 0.5px;">POINT SAYA</div>
                                </div>
                            </div>
                            <div style="background: #f0f2ff; padding: 4px 12px; border-radius: 20px;">
                                <span style="font-size: 0.6rem; color: #7367F0; font-weight: 600;">+250 bulan ini</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Menu Desktop (di kiri) -->
                <div class="profile-card flex-grow-1 menu-section-desktop">
                    <div class="card-body d-flex flex-column">
                        <a href="{{ route('customer.reservasi.mine') }}" class="menu-item-custom">
                            <span class="menu-icon"><i class="mdi mdi-calendar-clock"></i></span>
                            <span>Reservasi Saya</span>
                            <span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span>
                        </a>
                        <a href="{{ route('customer.riwayat') }}" class="menu-item-custom">
                            <span class="menu-icon"><i class="mdi mdi-history"></i></span>
                            <span>Riwayat Parkir</span>
                            <span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span>
                        </a>
                        <a href="#" class="menu-item-custom">
                            <span class="menu-icon"><i class="mdi mdi-credit-card"></i></span>
                            <span>Metode Pembayaran</span>
                            <span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span>
                        </a>
                        <form action="{{ route('logout') }}" method="POST" class="mt-auto">
                            @csrf
                            <button type="submit" class="btn-logout-custom">
                                <i class="mdi mdi-logout"></i> Keluar
                            </button>
                        </form>
                    </div>
                </div>

            </div>

            <!-- ============ KOLOM KANAN ============ -->
            <div class="col-lg-8 d-flex flex-column gap-4">

                <!-- Informasi Akun -->
                <div class="profile-card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="section-title">Informasi Akun</h5>
                            <button type="button" class="btn-edit-custom" data-bs-toggle="modal" data-bs-target="#modalEditAkun">
                                <i class="mdi mdi-pencil"></i> Edit
                            </button>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="info-label-custom">Nama Lengkap</div>
                                <div class="info-value-custom">{{ $user->name }}</div>

                                <div class="info-label-custom">Email</div>
                                <div class="info-value-custom">{{ $user->email }}</div>

                                <div class="info-label-custom">Telepon</div>
                                <div class="info-value-custom">{{ $user->nomor_hp ?? '-' }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Kendaraan Terdaftar -->
                <div class="profile-card flex-grow-1">
                    <div class="card-body d-flex flex-column">

                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="section-title">Kendaraan Terdaftar</h5>
                            <button type="button" class="btn-add-custom" data-bs-toggle="modal" data-bs-target="#modalTambahKendaraan">
                                <i class="mdi mdi-plus"></i> Tambah
                            </button>
                        </div>

                        {{-- List Kendaraan --}}
                        <div class="vehicle-scroll">

                            @forelse($kendaraans as $kendaraan)

                                <div class="vehicle-item">

                                    <div class="d-flex align-items-center">

                                        <div class="vehicle-icon-custom">
                                            @if($kendaraan->jenis_kendaraan == 'mobil')
                                                <i class="mdi mdi-car"></i>
                                            @else
                                                <i class="mdi mdi-motorbike"></i>
                                            @endif
                                        </div>

                                        <div>
                                            <div class="fw-semibold" style="color:#1a1a2e;font-size:.95rem">
                                                {{ $kendaraan->merk }}
                                            </div>
                                            <div style="color:#8e8ea0;font-size:.75rem">
                                                {{ $kendaraan->nomor_polisi }}
                                                @if($kendaraan->warna)
                                                    - {{ $kendaraan->warna }}
                                                @endif
                                            </div>
                                        </div>

                                    </div>

                                    <div class="d-flex gap-2">
                                        <a href="#" onclick="editKendaraan({{ $kendaraan->id }}, '{{ $kendaraan->jenis_kendaraan }}', '{{ $kendaraan->nomor_polisi }}', '{{ $kendaraan->merk }}', '{{ $kendaraan->warna }}'); return false;">
                                            <i class="mdi mdi-pencil"></i>
                                        </a>
                                        <form action="{{ route('customer.kendaraan.destroy', $kendaraan->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus kendaraan ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-danger border-0 bg-transparent p-0">
                                                <i class="mdi mdi-delete"></i>
                                            </button>
                                        </form>
                                    </div>

                                </div>

                            @empty

                                <div class="text-center py-5">
                                    <i class="mdi mdi-car-off" style="font-size:45px;color:#bdbdbd"></i>
                                    <p class="mt-2 text-muted">Belum ada kendaraan.</p>
                                </div>

                            @endforelse

                        </div>

                    </div>
                </div>

                <!-- Menu Mobile (di bawah kendaraan) -->
                <div class="profile-card menu-section-mobile">
                    <div class="card-body d-flex flex-column">
                        <a href="{{ route('customer.reservasi.mine') }}" class="menu-item-custom">
                            <span class="menu-icon"><i class="mdi mdi-calendar-clock"></i></span>
                            <span>Reservasi Saya</span>
                            <span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span>
                        </a>
                        <a href="{{ route('customer.riwayat') }}" class="menu-item-custom">
                            <span class="menu-icon"><i class="mdi mdi-history"></i></span>
                            <span>Riwayat Parkir</span>
                            <span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span>
                        </a>
                        <a href="#" class="menu-item-custom">
                            <span class="menu-icon"><i class="mdi mdi-credit-card"></i></span>
                            <span>Metode Pembayaran</span>
                            <span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span>
                        </a>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn-logout-custom">
                                <i class="mdi mdi-logout"></i> Keluar
                            </button>
                        </form>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>

<!-- ============ SEMUA MODAL DITARUH DI SINI, DI LUAR STRUKTUR CARD ============ -->

<!-- Modal Edit Informasi Akun -->
<div class="modal fade" id="modalEditAkun" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-bottom-sheet">
        <div class="modal-content">
            <div class="sheet-handle"></div>
            <div class="modal-header border-0 pb-2">
                <h5 class="modal-title fw-bold">Edit Informasi Akun</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('customer.profil.update') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nomor Telepon</label>
                        <input type="text" name="nomor_hp" class="form-control" value="{{ old('nomor_hp', $user->nomor_hp) }}">
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Tambah Kendaraan -->
<div class="modal fade" id="modalTambahKendaraan" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-bottom-sheet">
        <div class="modal-content">
            <div class="sheet-handle"></div>
            <div class="modal-header border-0 pb-2">
                <h5 class="modal-title fw-bold">Tambah Kendaraan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('customer.kendaraan.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Jenis Kendaraan</label>
                        <select name="jenis_kendaraan" class="form-select" required>
                            <option value="">Pilih</option>
                            <option value="mobil">Mobil</option>
                            <option value="motor">Motor</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nomor Polisi</label>
                        <input type="text" name="nomor_polisi" class="form-control" placeholder="Contoh: B 1234 ABC" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Merk Kendaraan</label>
                        <input type="text" name="merk" class="form-control" placeholder="Contoh: Honda Beat" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Warna</label>
                        <input type="text" name="warna" class="form-control" placeholder="Contoh: Hitam" required>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Kendaraan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Kendaraan (SATU AJA, DI LUAR LOOP) -->
<div class="modal fade" id="modalEditKendaraan" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-bottom-sheet">
        <div class="modal-content">
            <div class="sheet-handle"></div>
            <div class="modal-header border-0 pb-2">
                <h5 class="modal-title fw-bold">Edit Kendaraan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="formEditKendaraan" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Jenis Kendaraan</label>
                        <select name="jenis_kendaraan" id="editJenisKendaraan" class="form-select" required>
                            <option value="mobil">Mobil</option>
                            <option value="motor">Motor</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nomor Polisi</label>
                        <input type="text" name="nomor_polisi" id="editNomorPolisi" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Merk Kendaraan</label>
                        <input type="text" name="merk" id="editMerk" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Warna</label>
                        <input type="text" name="warna" id="editWarna" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
function editKendaraan(id, jenis, nopol, merk, warna) {
    document.getElementById('formEditKendaraan').action = `/customer/kendaraan/${id}`;
    document.getElementById('editJenisKendaraan').value = jenis;
    document.getElementById('editNomorPolisi').value = nopol;
    document.getElementById('editMerk').value = merk;
    document.getElementById('editWarna').value = warna;

    var modal = new bootstrap.Modal(document.getElementById('modalEditKendaraan'));
    modal.show();
}
</script>
@endpush
@endsection