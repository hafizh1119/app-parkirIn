@extends('layouts.app')

@section('content')

<div class="reservasi-container">
    <div class="container">

        <div class="d-flex align-items-center justify-content-between mb-4 reservasi-header">
            <div>
                <h4 class="fw-bold mb-1" style="color:#1a1a2e;">Reservasi Saya</h4>
                <p class="text-muted mb-0" style="font-size:.85rem;">
                    Reservasi yang sedang berjalan
                </p>
            </div>
            <a href="{{ route('customer.cari-parkir') }}" class="btn-add-custom">
                <i class="mdi mdi-plus"></i> Reservasi Baru
            </a>
        </div>

        @forelse($reservasiList as $reservasi)

            @php
                $statusConfig = [
                    'pending'   => ['badge' => 'bg-label-warning', 'label' => 'Menunggu Pembayaran'],
                    'dibayar'   => ['badge' => 'bg-label-info',    'label' => 'Dibayar'],
                    'checkin'   => ['badge' => 'bg-label-primary', 'label' => 'Sedang Parkir'],
                ];
                $st = $statusConfig[$reservasi->status] ?? ['badge' => 'bg-label-secondary', 'label' => ucfirst($reservasi->status)];
            @endphp

            <div class="reservasi-card">

                <div class="reservasi-thumb">
                    <img
                        src="{{ asset($reservasi->lokasiParkir->gambar) }}"
                        alt="{{ $reservasi->lokasiParkir->nama }}"
                        loading="lazy">
                </div>

                <div class="reservasi-body">

                    <div class="reservasi-top">
                        <div class="min-width-0">
                            <h5 class="fw-bold mb-1 text-truncate">
                                {{ $reservasi->lokasiParkir->nama ?? '-' }}
                            </h5>
                            <small class="text-muted">
                                <i class="mdi mdi-map-marker-outline"></i>
                                {{ $reservasi->slotParkir->kode_slot ?? '-' }}
                            </small>
                        </div>

                        <span class="status-badge {{ $st['badge'] }}">{{ $st['label'] }}</span>
                    </div>

                    <div class="reservasi-detail-grid">

                        <div class="detail-item">
                            <small class="text-muted d-block">Kendaraan</small>
                            <p class="mb-0 fw-semibold">
                                {{ ucfirst($reservasi->kendaraan->jenis_kendaraan ?? '-') }}
                            </p>
                        </div>

                        <div class="detail-item">
                            <small class="text-muted d-block">No. Polisi</small>
                            <p class="mb-0 fw-semibold">
                                {{ $reservasi->kendaraan->nomor_polisi ?? '-' }}
                            </p>
                        </div>

                        <div class="detail-item">
                            <small class="text-muted d-block">Tanggal</small>
                            <p class="mb-0 fw-semibold">
                                {{ \Carbon\Carbon::parse($reservasi->tanggal_masuk)->translatedFormat('d M Y') }}
                            </p>
                        </div>

                        <div class="detail-item">
                            <small class="text-muted d-block">Jam Masuk</small>
                            <p class="mb-0 fw-semibold">
                                {{ \Carbon\Carbon::parse($reservasi->jam_masuk)->format('H:i') }} WIB
                            </p>
                        </div>

                    </div>

                    <div class="reservasi-footer">

                        <div>
                            <small class="text-muted d-block">Total Bayar</small>
                            <h6 class="text-primary fw-bold mb-0">
                                Rp {{ number_format($reservasi->total_bayar,0,',','.') }}
                            </h6>
                        </div>

                        <div class="d-flex gap-2 reservasi-actions">

                            @if($reservasi->status == 'pending')

                                <a href="{{ route('customer.pembayaran', $reservasi->id) }}" class="btn btn-primary btn-sm-custom">
                                    Lanjutkan Pembayaran
                                </a>

                            @else

                                <a href="{{ route('customer.qr-muncul', $reservasi->id) }}" class="btn btn-primary btn-sm-custom">
                                    <i class="mdi mdi-qrcode"></i> Lihat QR
                                </a>

                            @endif

                        </div>

                    </div>

                </div>

            </div>

        @empty

            <div class="text-center py-5 reservasi-empty">

                <i class="mdi mdi-calendar-remove" style="font-size:56px;color:#bdbdbd;"></i>

                <h5 class="fw-bold mb-2 mt-3">
                    Tidak Ada Reservasi Aktif
                </h5>

                <p class="text-muted mb-3">
                    Kamu tidak sedang memiliki reservasi yang berjalan.
                </p>

                <a href="{{ route('customer.cari-parkir') }}" class="btn-add-custom">
                    <i class="mdi mdi-plus"></i> Buat Reservasi
                </a>

            </div>

        @endforelse

    </div>
</div>

@push('styles')
<style>
    .reservasi-container {
        padding: 24px 0 40px;
        background: #f4f6fb;
        min-height: 100vh;
    }

    .reservasi-header h4 {
        color: #1a1a2e;
    }

    .reservasi-container .container {
        max-width: 1200px;
    }

    .reservasi-card {
        background: #fff;
        border-radius: 18px;
        box-shadow: 0 2px 16px rgba(115, 103, 240, .07);
        overflow: hidden;
        margin-bottom: 20px;
        display: flex;
        transition: transform .2s ease, box-shadow .2s ease;
    }

    .reservasi-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(115, 103, 240, .12);
    }

    .reservasi-thumb {
        flex: 0 0 220px;
        max-width: 220px;
        overflow: hidden;
    }

    .reservasi-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        min-height: 180px;
    }

    .reservasi-body {
        flex: 1;
        padding: 20px 24px;
        display: flex;
        flex-direction: column;
        min-width: 0;
    }

    .reservasi-top {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 14px;
    }

    .reservasi-top h5 {
        color: #1a1a2e;
    }

    .min-width-0 { min-width: 0; }

    .status-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 6px 14px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 600;
        line-height: 1;
        white-space: nowrap;
        flex-shrink: 0;
    }

    .reservasi-detail-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 14px;
        padding: 14px 0;
        margin-bottom: 8px;
        border-top: 1px solid #f0f0f5;
        border-bottom: 1px solid #f0f0f5;
    }

    .detail-item p {
        color: #1a1a2e;
        font-size: .9rem;
    }

    .reservasi-footer {
        margin-top: auto;
        padding-top: 14px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        flex-wrap: wrap;
    }

    .btn-sm-custom {
        font-size: .8rem;
        padding: 8px 18px;
        border-radius: 10px;
        font-weight: 600;
        white-space: nowrap;
    }

    .btn-add-custom {
        background: #7367F0;
        color: #fff;
        border: none;
        padding: 8px 16px;
        border-radius: 10px;
        font-size: .82rem;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }
    .btn-add-custom:hover {
        background: #5a4fd6;
        color: #fff;
    }

    .reservasi-empty img { opacity: .85; }

    /* ============ TABLET ============ */
    @media (max-width: 991px) {
        .reservasi-thumb {
            flex: 0 0 160px;
            max-width: 160px;
        }

        .reservasi-body {
            padding: 16px 18px;
        }

        .reservasi-detail-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    /* ============ MOBILE ============ */
    @media (max-width: 576px) {
        .reservasi-container {
            padding: 16px 0 32px;
        }

        .reservasi-header {
            flex-direction: column;
            align-items: flex-start !important;
            gap: 10px;
        }

        .reservasi-card {
            flex-direction: column;
            border-radius: 16px;
        }

        .reservasi-thumb {
            flex: none;
            max-width: 100%;
            width: 100%;
            height: 160px;
        }

        .reservasi-thumb img {
            min-height: 160px;
        }

        .reservasi-body {
            padding: 16px;
        }

        .reservasi-detail-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
        }

        .reservasi-footer {
            flex-direction: column;
            align-items: stretch;
        }

        .reservasi-actions {
            width: 100%;
        }

        .reservasi-actions a {
            flex: 1;
            text-align: center;
        }
    }
</style>
@endpush

@endsection