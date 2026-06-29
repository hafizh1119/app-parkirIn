@extends('layouts.app')

@section('content')

<div class="container py-4">

    <h4 class="fw-bold mb-4">
        Riwayat Reservasi
    </h4>

    @forelse($riwayat as $item)

    <div class="card border-0 shadow-sm mb-4 rounded-4 overflow-hidden">

        {{-- Gambar Lokasi --}}
        <img
            src="{{ asset($item->lokasiParkir->gambar) }}"
            class="card-img-top"
            style="height:180px; object-fit:cover;"
        >

        <div class="card-body">

            <div class="d-flex justify-content-between">

                <div>
                    <h5 class="fw-bold mb-1">
                        {{ $item->lokasiParkir->nama }}
                    </h5>

                    <small class="text-muted">
                        {{ $item->slotParkir->kode_slot }}
                    </small>
                </div>

                    @if($item->status == 'pending')
                    <span class="status-badge bg-label-warning">
                        Menunggu Pembayaran
                    </span>

                @elseif($item->status == 'dibayar')
                    <span class="status-badge bg-label-info">
                        Dibayar
                    </span>

                @elseif($item->status == 'checkin')
                    <span class="status-badge bg-label-primary">
                        Sedang Parkir
                    </span>

                @elseif($item->status == 'selesai')
                    <span class="status-badge bg-label-success">
                        Selesai
                    </span>

                @else
                    <span class="status-badge bg-label-danger">
                        Batal
                    </span>
                @endif

            </div>

            <hr>

            <div class="row g-2">

                <div class="col-6">
                    <small class="text-muted">
                        Kendaraan
                    </small>
                    <p class="mb-0 fw-semibold">
                        {{ $item->kendaraan->jenis_kendaraan }}
                    </p>
                </div>

                <div class="col-6">
                    <small class="text-muted">
                        Slot
                    </small>
                    <p class="mb-0 fw-semibold">
                        {{ $item->slotParkir->nomor_slot }}
                    </p>
                </div>

                <div class="col-6">
                    <small class="text-muted">
                        Tanggal
                    </small>
                    <p class="mb-0 fw-semibold">
                        {{ $item->tanggal_masuk }}
                    </p>
                </div>

                <div class="col-6">
                    <small class="text-muted">
                        Jam Masuk
                    </small>
                    <p class="mb-0 fw-semibold">
                        {{ $item->jam_masuk }}
                    </p>
                </div>

                <div class="col-12">
                    <small class="text-muted">
                        Total Bayar
                    </small>

                    <h6 class="text-primary fw-bold mb-0">
                        Rp {{ number_format($item->total_bayar,0,',','.') }}
                    </h6>
                </div>

            </div>

            <div class="d-flex gap-2 mt-3">

                <a
                    href="#"
                    class="btn btn-outline-primary flex-fill"
                >
                    Detail
                </a>

                {{-- Tombol QR — sesuaikan kondisi --}}
                @if($item->status == 'dibayar' || $item->status == 'checkin')
                    <a href="{{ route('customer.qr-muncul', $item->id) }}" class="btn btn-primary flex-fill">
                        QR Code
                    </a>
                @endif

            </div>

        </div>

    </div>

    @empty

    <div class="text-center mt-5">
        <img
            src="{{ asset('assets/img/empty-history.png') }}"
            width="180"
        >

        <h5 class="mt-3">
            Belum Ada Riwayat Reservasi
        </h5>
    </div>

    @endforelse

</div>

@push('styles')
<style>
.status-badge{
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: auto !important;
    min-width: unset !important;
    padding: 6px 12px;
    border-radius: 999px;
    font-size: 12px;
    font-weight: 600;
    line-height: 1;
    white-space: nowrap;
}
</style>
@endpush
@endsection