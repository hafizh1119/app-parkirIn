@extends('layouts.app')

@section('content')

<div class="riwayat-container">
    <div class="container">

        <div class="d-flex align-items-center justify-content-between mb-4 riwayat-header">
            <div>
                <h4 class="fw-bold mb-1">Riwayat Reservasi</h4>
                <p class="text-muted mb-0" style="font-size:.85rem;">
                    {{ $riwayat->count() }} total reservasi tercatat
                </p>
            </div>

            @if($riwayat->count() > 0)
            <div class="filter-tabs d-none d-md-flex">
                <button type="button" class="filter-tab active" data-filter="all">Semua</button>
                <button type="button" class="filter-tab" data-filter="pending">Menunggu</button>
                <button type="button" class="filter-tab" data-filter="dibayar">Dibayar</button>
                <button type="button" class="filter-tab" data-filter="checkin">Sedang Parkir</button>
                <button type="button" class="filter-tab" data-filter="selesai">Selesai</button>
            </div>
            @endif
        </div>

        @if($riwayat->count() > 0)
        <div class="mb-4 d-flex d-md-none filter-tabs filter-tabs-mobile">
            <button type="button" class="filter-tab active" data-filter="all">Semua</button>
            <button type="button" class="filter-tab" data-filter="pending">Menunggu</button>
            <button type="button" class="filter-tab" data-filter="dibayar">Dibayar</button>
            <button type="button" class="filter-tab" data-filter="checkin">Parkir</button>
            <button type="button" class="filter-tab" data-filter="selesai">Selesai</button>
        </div>
        @endif

        @forelse($riwayat as $item)

        <div class="riwayat-card" data-status="{{ $item->status }}">

            <div class="riwayat-thumb">
                <img
                    src="{{ asset($item->lokasiParkir->gambar) }}"
                    alt="{{ $item->lokasiParkir->nama }}"
                    loading="lazy"
                >
            </div>

            <div class="riwayat-body">

                <div class="riwayat-top">
                    <div class="min-width-0">
                        <h5 class="fw-bold mb-1 text-truncate">
                            {{ $item->lokasiParkir->nama }}
                        </h5>
                        <small class="text-muted">
                            <i class="mdi mdi-map-marker-outline"></i>
                            {{ $item->slotParkir->kode_slot }}
                        </small>
                    </div>

                    @if($item->status == 'pending')
                        <span class="status-badge bg-label-warning">Menunggu Pembayaran</span>
                    @elseif($item->status == 'dibayar')
                        <span class="status-badge bg-label-info">Dibayar</span>
                    @elseif($item->status == 'checkin')
                        <span class="status-badge bg-label-primary">Sedang Parkir</span>
                    @elseif($item->status == 'selesai')
                        <span class="status-badge bg-label-success">Selesai</span>
                    @else
                        <span class="status-badge bg-label-danger">Batal</span>
                    @endif
                </div>

                <div class="riwayat-detail-grid">

                    <div class="detail-item">
                        <small class="text-muted d-block">Kendaraan</small>
                        <p class="mb-0 fw-semibold">{{ $item->kendaraan->jenis_kendaraan }}</p>
                    </div>

                    <div class="detail-item">
                        <small class="text-muted d-block">Slot</small>
                        <p class="mb-0 fw-semibold">{{ $item->slotParkir->kode_slot ?? '-' }}</p>
                    </div>

                    <div class="detail-item">
                        <small class="text-muted d-block">Tanggal</small>
                        <p class="mb-0 fw-semibold">{{ $item->tanggal_masuk }}</p>
                    </div>

                    <div class="detail-item">
                        <small class="text-muted d-block">Jam Masuk</small>
                        <p class="mb-0 fw-semibold">{{ $item->jam_masuk }}</p>
                    </div>

                </div>

                <div class="riwayat-footer">

                    <div>
                        <small class="text-muted d-block">Total Bayar</small>
                        <h6 class="text-primary fw-bold mb-0">
                            Rp {{ number_format($item->total_bayar,0,',','.') }}
                        </h6>
                    </div>

                    <div class="d-flex gap-2 riwayat-actions">
                        

                        @if($item->status == 'dibayar' || $item->status == 'checkin')
                            <a href="{{ route('customer.qr-muncul', $item->id) }}" class="btn btn-primary btn-sm-custom">
                                <i class="mdi mdi-qrcode"></i> QR Code
                            </a>
                        @endif
                    </div>

                </div>

            </div>

        </div>

        @empty

        <div class="text-center py-5 riwayat-empty">

            <img
                src="{{ asset('assets/img/events/Belum-ada.svg') }}"
                alt="Belum Ada Riwayat"
                class="img-fluid mb-4 riwayat-empty-img">

            <h5 class="fw-bold mb-2">
                Belum Ada Riwayat Reservasi
            </h5>

            <p class="text-muted mb-0">
                Anda belum memiliki riwayat reservasi parkir.
            </p>

        </div>

        @endforelse

        <div class="text-center py-5 riwayat-empty-filtered" style="display:none;">
            <i class="mdi mdi-filter-off-outline" style="font-size:48px; color:#c5c4d4;"></i>
            <h6 class="mt-2 mb-0 text-muted">Tidak ada reservasi dengan status ini</h6>
        </div>

    </div>
</div>

@push('styles')
<style>
    .riwayat-empty{
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 60px 20px;
}

.riwayat-empty-img{
    width: 260px;
    max-width: 100%;
    height: auto;
    margin-bottom: 24px;
}

.riwayat-empty h5{
    font-weight: 700;
    color: #3b3b3b;
}

.riwayat-empty p{
    max-width: 320px;
    line-height: 1.6;
}

    .riwayat-container {
        padding: 24px 0 40px;
        background: #f4f6fb;
        min-height: 100vh;
    }

    .riwayat-header h4 {
        color: #1a1a2e;
    }

    /* ===== Filter tabs ===== */
    .filter-tabs {
        gap: 8px;
        flex-wrap: wrap;
    }

    .filter-tabs-mobile {
        overflow-x: auto;
        flex-wrap: nowrap;
        padding-bottom: 4px;
    }

    .filter-tab {
        border: 1.5px solid #e5e7f0;
        background: #fff;
        color: #6b7280;
        font-size: .8rem;
        font-weight: 600;
        padding: 7px 16px;
        border-radius: 999px;
        white-space: nowrap;
        transition: all .2s ease;
    }

    .filter-tab:hover {
        border-color: #7367F0;
        color: #7367F0;
    }

    .filter-tab.active {
        background: #7367F0;
        border-color: #7367F0;
        color: #fff;
    }

    /* ===== Grid desktop ===== */
    .riwayat-container .container {
        max-width: 1200px;
    }

    @media (min-width: 992px) {
        .riwayat-container .container > div:not(.riwayat-header):not(.filter-tabs) {
            /* placeholder to keep specificity low */
        }
    }

    /* Cards become a responsive grid on larger screens */
    .riwayat-container .container {
        display: block;
    }

    @media (min-width: 992px) {
        .riwayat-cards-grid {
            display: grid;
        }
    }

    .riwayat-card {
        background: #fff;
        border-radius: 18px;
        box-shadow: 0 2px 16px rgba(115, 103, 240, .07);
        overflow: hidden;
        margin-bottom: 20px;
        display: flex;
        transition: transform .2s ease, box-shadow .2s ease;
    }

    .riwayat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(115, 103, 240, .12);
    }

    .riwayat-thumb {
        flex: 0 0 220px;
        max-width: 220px;
        overflow: hidden;
    }

    .riwayat-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        min-height: 180px;
    }

    .riwayat-body {
        flex: 1;
        padding: 20px 24px;
        display: flex;
        flex-direction: column;
        min-width: 0;
    }

    .riwayat-top {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 14px;
    }

    .riwayat-top h5 {
        color: #1a1a2e;
    }

    .min-width-0 { min-width: 0; }

    .status-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: auto !important;
        min-width: unset !important;
        padding: 6px 14px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 600;
        line-height: 1;
        white-space: nowrap;
        flex-shrink: 0;
    }

    .riwayat-detail-grid {
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

    .riwayat-footer {
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

    .riwayat-empty img { opacity: .85; }

    /* ============ TABLET ============ */
    @media (max-width: 991px) {
        .riwayat-thumb {
            flex: 0 0 160px;
            max-width: 160px;
        }

        .riwayat-body {
            padding: 16px 18px;
        }

        .riwayat-detail-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    /* ============ MOBILE ============ */
    @media (max-width: 576px) {
        .riwayat-container {
            padding: 16px 0 32px;
        }

        .riwayat-header {
            flex-direction: column;
            align-items: flex-start !important;
            gap: 10px;
        }

        .riwayat-card {
            flex-direction: column;
            border-radius: 16px;
        }

        .riwayat-thumb {
            flex: none;
            max-width: 100%;
            width: 100%;
            height: 160px;
        }

        .riwayat-thumb img {
            min-height: 160px;
        }

        .riwayat-body {
            padding: 16px;
        }

        .riwayat-detail-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
        }

        .riwayat-footer {
            flex-direction: column;
            align-items: stretch;
        }

        .riwayat-actions {
            width: 100%;
        }

        .riwayat-actions a {
            flex: 1;
            text-align: center;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const tabs = document.querySelectorAll('.filter-tab');
        const cards = document.querySelectorAll('.riwayat-card');
        const emptyFiltered = document.querySelector('.riwayat-empty-filtered');

        function applyFilter(status) {
            let visibleCount = 0;

            cards.forEach(function (card) {
                const match = status === 'all' || card.dataset.status === status;
                card.style.display = match ? 'flex' : 'none';
                if (match) visibleCount++;
            });

            if (emptyFiltered) {
                emptyFiltered.style.display = (visibleCount === 0 && cards.length > 0) ? 'block' : 'none';
            }
        }

        document.querySelectorAll('.filter-tab').forEach(function (btn) {
            btn.addEventListener('click', function () {
                document.querySelectorAll('.filter-tab').forEach(function (b) {
                    b.classList.remove('active');
                });

                document.querySelectorAll('.filter-tab[data-filter="' + this.dataset.filter + '"]').forEach(function (b) {
                    b.classList.add('active');
                });

                applyFilter(this.dataset.filter);
            });
        });
    });
</script>
@endpush

@endsection