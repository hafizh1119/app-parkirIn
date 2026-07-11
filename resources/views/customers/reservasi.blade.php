@extends('layouts.app')

@section('content')

<section class="section-py bg-body">

    <div class="container">

        <!-- Button Kembali -->
        <div class="mb-5">
        </div>

        <div class="row g-4">

            <!-- KIRI -->
            <div class="col-lg-8">

                <!-- Ringkasan Reservasi -->
                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-body p-4">

                        <h4 class="fw-bold mb-4">
                            Detail Reservasi
                        </h4>

                        <div class="mb-4">

                            <img
                                src="{{ asset($lokasi->gambar) }}"
                                class="img-fluid rounded-4 w-100"
                                style="height:220px;object-fit:cover;"
                                alt="{{ $lokasi->nama }}">

                        </div>

                        <div class="mb-4">

                            <h5 class="fw-bold mb-1">
                                {{ $lokasi->nama }}
                            </h5>

                            <p class="text-body-secondary mb-0">
                                {{ $lokasi->alamat }}
                            </p>

                        </div>

                        <div class="row g-3">

                            <div class="col-6">
                                <small class="text-body-secondary">Slot Parkir</small>
                                <h6 class="mb-0 fw-semibold">{{ $slot->kode_slot }}</h6>
                            </div>

                            <div class="col-6">
                                <small class="text-body-secondary">Kendaraan</small>
                                <h6 class="mb-0 fw-semibold">{{ ucfirst($slot->areaParkir->jenis_kendaraan) }}</h6>
                            </div>

                            <div class="col-6">
                                <small class="text-body-secondary">Area Parkir</small>
                                <h6 class="mb-0 fw-semibold">{{ $slot->areaParkir->nama_area }}</h6>
                            </div>

                            <div class="col-6">
                                <small class="text-body-secondary">Durasi Parkir</small>
                                <h6 class="mb-0 fw-semibold">{{ $durasi }} Jam</h6>
                            </div>

                            <div class="col-6">
                                <small class="text-body-secondary">Tanggal Reservasi</small>
                                <h6 class="mb-0 fw-semibold">{{ \Carbon\Carbon::parse($tanggal)->format('d M Y') }}</h6>
                            </div>

                            <div class="col-6">
                                <small class="text-body-secondary">Jam Masuk</small>
                                <h6 class="mb-0 fw-semibold">{{ $jam_masuk }}</h6>
                            </div>

                        </div>

                    </div>

                </div>

                <!-- Detail Kendaraan -->
                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-body p-4">

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="fw-bold mb-0">Detail Kendaraan</h5>
                        </div>

                        @if($kendaraan)

                            <div class="mb-3">
                                <small class="text-body-secondary">Nomor Polisi</small>
                                <h6 class="mb-0">{{ $kendaraan->nomor_polisi }}</h6>
                            </div>

                            <div class="mb-3">
                                <small class="text-body-secondary">Kendaraan</small>
                                <h6 class="mb-0">{{ $kendaraan->merk }}</h6>
                            </div>

                            <div class="mb-3">
                                <small class="text-body-secondary">Warna</small>
                                <h6 class="mb-0">{{ $kendaraan->warna }}</h6>
                            </div>

                            <div>
                                <small class="text-body-secondary">Jenis Kendaraan</small>
                                <h6 class="mb-0">{{ ucfirst($kendaraan->jenis_kendaraan) }}</h6>
                            </div>

                        @else

                            <div class="alert alert-warning mb-0">
                                Anda belum memiliki data kendaraan.
                            </div>

                        @endif

                    </div>

                </div>

                <!-- Membership / Event -->
                @if(Auth::user()->status_member == 'member')

                    <div class="card border-0 shadow-sm mb-4">

                        <div class="card-body p-4">

                            <h5 class="fw-bold mb-3">
                                🎉 Promo Event Member
                            </h5>

                            <p class="text-muted mb-4">
                                Pilih event untuk mendapatkan potongan harga.
                            </p>

                            @forelse($events as $event)

                                <div class="mb-3">

                                    <input
                                        type="radio"
                                        class="btn-check event-radio"
                                        name="event_option"
                                        id="event{{ $event->id }}"
                                        value="{{ $event->id }}"
                                        data-id="{{ $event->id }}"
                                        data-name="{{ $event->name }}"
                                        data-discount="{{ $event->discount_percentage }}">

                                    <label
                                        class="card border payment-card mb-0"
                                        for="event{{ $event->id }}"
                                        style="cursor:pointer;">

                                        <div class="card-body">

                                            <div class="d-flex justify-content-between align-items-center">

                                                <div>
                                                    <h6 class="fw-bold mb-1">{{ $event->name }}</h6>
                                                    <small class="text-muted">{{ $event->description }}</small>
                                                </div>

                                                <div class="text-end">
                                                    <span class="badge bg-success">
                                                        Diskon {{ $event->discount_percentage }}%
                                                    </span>
                                                </div>

                                            </div>

                                        </div>

                                    </label>

                                </div>

                            @empty

                                <div class="alert alert-warning mb-0">
                                    Belum ada event aktif.
                                </div>

                            @endforelse

                        </div>

                    </div>

                @endif
                
                @if(Auth::user()->status_member == 'member')

                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-body p-4">

                        <div class="d-flex justify-content-between align-items-center">

                            <div>

                                <h5 class="fw-bold mb-1">
                                    🎁 Tukarkan Point
                                </h5>

                                <small class="text-muted">
                                    Gunakan point untuk mengurangi biaya parkir.
                                </small>

                            </div>

                            <div class="form-check form-switch m-0">

                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    id="usePoint">

                            </div>

                        </div>

                        <hr>

                        <div class="d-flex justify-content-between align-items-center">

                            <div>

                                <div class="fw-semibold">

                                    Point Anda

                                </div>

                                <small class="text-muted">

                                    {{ number_format($totalPoint ?? 0,0,',','.') }} Point

                                </small>

                            </div>

                            <span
                                class="badge bg-label-primary fs-6">

                                {{ number_format($totalPoint ?? 0,0,',','.') }}

                            </span>

                        </div>

                        <div
                            class="alert alert-warning mt-3 mb-0 py-2"
                            style="font-size:.82rem;">

                            Point hanya dapat digunakan apabila jumlah point
                            mencukupi seluruh biaya parkir.

                        </div>

                    </div>

                </div>

                @endif
            </div>
            <!-- /KIRI -->

            <!-- KANAN -->
            @php
                $biayaParkir = $slot->areaParkir->tarif_per_jam * $durasi;
                $biayaAdmin = 1000;
                $totalBayar = $biayaParkir + $biayaAdmin;
            @endphp

            <div class="col-lg-4">

                <div class="card border-0 shadow-sm rounded-4">

                    <div class="card-body p-4">

                        <h5 class="fw-bold mb-4">
                            Ringkasan Pembayaran
                        </h5>

                        {{-- Biaya Parkir --}}
                        <div class="d-flex justify-content-between mb-2">
                            <span>Biaya Parkir</span>
                            <span id="biaya-parkir">
                                Rp {{ number_format($biayaParkir,0,',','.') }}
                            </span>
                        </div>

                        {{-- Biaya Admin --}}
                        <div class="d-flex justify-content-between mb-2">
                            <span>Biaya Admin</span>
                            <span id="biaya-admin">
                                Rp {{ number_format($biayaAdmin,0,',','.') }}
                            </span>
                        </div>

                        <hr>

                        {{-- Event --}}
                        <div class="d-flex justify-content-between mb-2">
                            <span>Event</span>
                            <span id="selected-event" class="text-muted">
                                Tidak Menggunakan Event
                            </span>
                        </div>

                        {{-- Diskon --}}
                        <div class="d-flex justify-content-between mb-3">
                            <span>Potongan Event</span>
                            <strong id="discount-amount" class="text-success">
                                Rp 0
                            </strong>
                        </div>

                        <hr>

                        <div class="d-flex justify-content-between mb-2">

                            <span>Point Digunakan</span>

                            <span id="point-status" class="text-muted">

                                Tidak Digunakan

                            </span>

                        </div>

                        <div class="d-flex justify-content-between mb-3">

                            <span>Potongan Point</span>

                            <strong id="point-discount" class="text-success">

                                Rp 0

                            </strong>

                        </div>

                        <hr>

                        {{-- Total --}}
                        <div class="d-flex justify-content-between mb-4">
                            <strong>Total Pembayaran</strong>
                            <strong id="total-payment" class="text-primary">
                                Rp {{ number_format($totalBayar,0,',','.') }}
                            </strong>
                        </div>

                        <form action="{{ route('customer.reservasi.store') }}" method="POST">

                            @csrf

                            <input type="hidden" name="lokasi_parkir_id" value="{{ $lokasi->id }}">
                            <input type="hidden" name="slot_parkir_id" value="{{ $slot->id }}">
                            <input type="hidden" name="tanggal_masuk" value="{{ $tanggal }}">
                            <input type="hidden" name="jam_masuk" value="{{ $jam_masuk }}">
                            <input type="hidden" name="durasi_jam" value="{{ $durasi }}">
                            <input type="hidden" name="event_id" id="event_id" value="">
                            <input type="hidden" name="discount_amount" id="discount_amount" value="0">
                            <input type="hidden" name="use_point" id="use_point" value="0">
                            <input type="hidden" name="point_used" id="point_used" value="0">
                            <input type="hidden" name="point_discount" id="point_discount" value="0">
                            <input type="hidden" name="total_bayar" id="total_bayar" value="{{ $totalBayar }}">

                            <div class="alert alert-info border-0 mb-4">
                                <div class="d-flex align-items-start">
                                    <i class="mdi mdi-information-outline mdi-24px me-2"></i>
                                    <div>
                                        <strong>Pembayaran melalui Midtrans</strong>
                                        <br>
                                        Setelah menekan tombol
                                        <b>Lanjutkan Pembayaran</b>,
                                        Anda akan diarahkan ke halaman pembayaran
                                        Midtrans untuk memilih metode pembayaran.
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 mb-2">
                                Lanjutkan Pembayaran
                            </button>

                        </form>

                        <a href="{{ route('customer.denah') }}" class="btn btn-outline-secondary w-100">
                            Batal
                        </a>

                    </div>

                </div>

            </div>
            <!-- /KANAN -->

        </div>

    </div>

</section>

@push('styles')
<style>
    .payment-card{
        transition:.25s;
        cursor:pointer;
        background:#fff;
        border:2px solid #e6e6e6 !important;
    }

    .payment-card:hover{
        border-color:#7367F0 !important;
    }

    /* Highlight kartu event yang dipilih */
    .event-radio:checked + .payment-card{
        background:#F1EEFF;
        border-color:#7367F0 !important;
        box-shadow:0 4px 15px rgba(115,103,240,.15);
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {

    const biayaParkir = Number({{ $biayaParkir }});
    const biayaAdmin  = Number({{ $biayaAdmin }});
    const totalAwal   = biayaParkir + biayaAdmin;
    const totalPoint  = Number({{ $totalPoint ?? 0 }});

    const elEventId       = document.getElementById('event_id');
    const elDiscount      = document.getElementById('discount_amount');
    const elTotalBayar    = document.getElementById('total_bayar');
    const elSelectedEvent = document.getElementById('selected-event');
    const elDiscountAmount= document.getElementById('discount-amount');
    const elTotalPayment  = document.getElementById('total-payment');

    // ==== Handler pilih event (kode kamu yang lama, tidak berubah) ====
    document.querySelectorAll('.event-radio').forEach(function (radio) {
        radio.addEventListener('change', function () {
            if (!this.checked) return;
            const eventId   = this.dataset.id;
            const eventName = this.dataset.name;
            const discount  = Number(this.dataset.discount);
            const discountNominal = Math.round((biayaParkir * discount) / 100);
            const totalBayar = totalAwal - discountNominal;

            elEventId.value = eventId;
            elDiscount.value = discountNominal;
            elTotalBayar.value = totalBayar;

            elSelectedEvent.textContent = eventName;
            elSelectedEvent.classList.remove('text-muted');
            elDiscountAmount.textContent = '- Rp ' + discountNominal.toLocaleString('id-ID');
            elTotalPayment.textContent = 'Rp ' + totalBayar.toLocaleString('id-ID');
        });
    });

    // ==== Handler toggle "Gunakan Point" — SEKARANG DI DALAM SCOPE YANG SAMA ====
    const usePoint = document.getElementById('usePoint');

    if (usePoint) {
        usePoint.addEventListener('change', function () {
            let totalSekarang = Number(document.getElementById('total_bayar').value);
            let diskonEvent = Number(document.getElementById('discount_amount').value);
            let sisaBiayaParkir = biayaParkir - diskonEvent; // <- sekarang biayaParkir kebaca

            if (this.checked) {
                if (totalPoint < sisaBiayaParkir) {
                    alert("Point Anda belum mencukupi.");
                    this.checked = false;
                    return;
                }
                document.getElementById('use_point').value = 1;
                document.getElementById('point_used').value = sisaBiayaParkir;
                document.getElementById('point_discount').value = sisaBiayaParkir;
                document.getElementById('point-status').textContent =
                    sisaBiayaParkir.toLocaleString('id-ID') + " Point";
                document.getElementById('point-discount').textContent =
                    "- Rp " + sisaBiayaParkir.toLocaleString('id-ID');
                document.getElementById('total-payment').textContent =
                    "Rp " + biayaAdmin.toLocaleString('id-ID');
                document.getElementById('total_bayar').value = biayaAdmin;
            } else {
                document.getElementById('use_point').value = 0;
                document.getElementById('point_used').value = 0;
                document.getElementById('point_discount').value = 0;
                document.getElementById('point-status').textContent = "Tidak Digunakan";
                document.getElementById('point-discount').textContent = "Rp 0";
                document.getElementById('total-payment').textContent =
                    "Rp " + totalSekarang.toLocaleString('id-ID');
                document.getElementById('total_bayar').value = totalSekarang;
            }
        });
    }

});
</script>
@endpush

@endsection