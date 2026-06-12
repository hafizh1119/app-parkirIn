@extends('layouts.app')

@section('content')

<section class="section-py bg-body qr-page">

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-lg-6">

                <div class="card border-0 shadow-sm">

                    <div class="card-body p-5 text-center">

                        <div class="mb-4">

                            <div
                                class="avatar avatar-xl bg-label-success mx-auto mb-3">

                                <i class="mdi mdi-check-circle-outline fs-1 text-success"></i>

                            </div>

                            <h3 class="fw-bold mb-2">
                                Reservasi Berhasil!
                            </h3>

                            <p class="text-body-secondary mb-0">
                                Tempat parkir Anda berhasil dipesan.
                            </p>

                        </div>

                        <div class="border rounded-3 p-3 mb-4">

                            <small class="text-body-secondary d-block">
                                Kode Reservasi
                            </small>

                            <h4 class="fw-bold text-primary mb-0">
                                PKR-20260001
                            </h4>

                        </div>

                        <div class="mb-4">

                            <img
                                src="https://api.qrserver.com/v1/create-qr-code/?size=220x220&data=PKR-20260001"
                                class="img-fluid border rounded-3 p-3 bg-white"
                                alt="QR Code">

                        </div>

                        <p class="text-body-secondary mb-4">

                            Tunjukkan QR Code ini kepada petugas atau mesin
                            scan saat memasuki area parkir.

                        </p>

                        <div class="border rounded-3 p-4 text-start mb-4">

                            <h6 class="fw-bold mb-3">
                                Detail Reservasi
                            </h6>

                            <div class="row">

                                <div class="col-6 mb-3">
                                    <small class="text-body-secondary">
                                        Lokasi
                                    </small>
                                    <div class="fw-semibold">
                                        Parkir UDINUS
                                    </div>
                                </div>

                                <div class="col-6 mb-3">
                                    <small class="text-body-secondary">
                                        Slot
                                    </small>
                                    <div class="fw-semibold">
                                        A-12
                                    </div>
                                </div>

                                <div class="col-6">
                                    <small class="text-body-secondary">
                                        Tanggal
                                    </small>
                                    <div class="fw-semibold">
                                        12 Juni 2026
                                    </div>
                                </div>

                                <div class="col-6">
                                    <small class="text-body-secondary">
                                        Jam Masuk
                                    </small>
                                    <div class="fw-semibold">
                                        10:00 WIB
                                    </div>
                                </div>

                            </div>

                        </div>

                        <div class="d-grid gap-2">

                            <button
                                class="btn btn-primary">

                                Unduh Tiket

                            </button>

                            <a
                                href="{{ route('dashboard') }}"
                                class="btn btn-outline-secondary">

                                Kembali ke Beranda

                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

@push('stylist')
<style>

@media (max-width: 768px){

    .qr-page{
        padding-top: 80px;
    }

}
</style>

@endpush
@endsection