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

                    <!-- Foto Lokasi -->
                    <div class="mb-4">

                        <img
                            src="https://blog.getandride.com/wp-content/uploads/2023/05/ukuran-parkiran-mobil.jpg"
                            class="img-fluid rounded-4 w-100"
                            style="height:220px;object-fit:cover;"
                            alt="Parkir">

                    </div>

                    <!-- Informasi Lokasi -->
                    <div class="mb-4">

                        <h5 class="fw-bold mb-1">
                            Parkir UDINUS
                        </h5>

                        <p class="text-body-secondary mb-0">
                            Jl. Imam Bonjol No.207 Semarang
                        </p>

                    </div>

                    <div class="row g-3">

                    <div class="col-6">

                        <small class="text-body-secondary">
                            Slot Parkir
                        </small>

                        <h6 class="mb-0 fw-semibold">
                            A-12
                        </h6>

                    </div>

                    <div class="col-6">

                        <small class="text-body-secondary">
                            Kendaraan
                        </small>

                        <h6 class="mb-0 fw-semibold">
                            Mobil
                        </h6>

                    </div>

                    <div class="col-6">

                        <small class="text-body-secondary">
                            Area Parkir
                        </small>

                        <h6 class="mb-0 fw-semibold">
                            Area A
                        </h6>

                    </div>

                    <div class="col-6">

                        <small class="text-body-secondary">
                            Durasi Parkir
                        </small>

                        <h6 class="mb-0 fw-semibold">
                            2 Jam
                        </h6>

                    </div>

                    <div class="col-6">

                        <small class="text-body-secondary">
                            Tanggal Reservasi
                        </small>

                        <h6 class="mb-0 fw-semibold">
                            12 Juni 2026
                        </h6>

                    </div>

                    <div class="col-6">

                        <small class="text-body-secondary">
                            Jam Masuk
                        </small>

                        <h6 class="mb-0 fw-semibold">
                            10:00 WIB
                        </h6>

                    </div>

                </div>

                </div>

                </div>

                <!-- Detail Kendaraan -->
                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-body p-4">

                        <div class="d-flex justify-content-between align-items-center mb-4">

                            <h5 class="fw-bold mb-0">
                                Detail Kendaraan
                            </h5>

                        </div>

                        <div class="mb-3">

                            <small class="text-body-secondary">
                                Nomor Polisi
                            </small>

                            <h6 class="mb-0">
                                H 4567 WE
                            </h6>

                        </div>

                        <div class="mb-3">

                            <small class="text-body-secondary">
                                Kendaraan
                            </small>

                            <h6 class="mb-0">
                                Toyota Avanza
                            </h6>

                        </div>

                        <div class="mb-3">

                            <small class="text-body-secondary">
                                Warna
                            </small>

                            <h6 class="mb-0">
                                Putih
                            </h6>

                        </div>

                        <div>

                            <small class="text-body-secondary">
                                Jenis Kendaraan
                            </small>

                            <h6 class="mb-0">
                                Mobil
                            </h6>

                        </div>

                    </div>

                </div>

                <!-- Membership -->
                <div class="card border-0 shadow-sm">

                    <div class="card-body p-4">

                        <h5 class="fw-bold mb-3">
                            Membership ParkirIn
                        </h5>

                        <ul class="mb-0">

                            <li>Prioritas Reservasi</li>
                            <li>Diskon Tarif Parkir</li>
                            <li>Akses Area Premium</li>
                            <li>Berlaku di Semua Mitra ParkirIn</li>

                        </ul>

                    </div>

                </div>

            </div>

            <!-- KANAN -->
            <div class="col-lg-4">

                <div class="card border-0 shadow-sm sticky-top">

                    <div class="card-body p-4">

                        <h5 class="fw-bold mb-4">
                            Ringkasan Pembayaran
                        </h5>

                        <div class="d-flex justify-content-between mb-2">
                            <span>Biaya Parkir</span>
                            <span>Rp 10.000</span>
                        </div>

                        <div class="d-flex justify-content-between mb-3">
                            <span>Biaya Admin</span>
                            <span>Rp 1.000</span>
                        </div>

                        <hr>

                        <div class="d-flex justify-content-between mb-4">

                            <strong>Total</strong>

                            <strong class="text-primary">
                                Rp 11.000
                            </strong>

                        </div>
                        
                        <a href="{{ route('customer.pembayaran') }}"
                            class="btn btn-primary w-100 mb-2">

                            Lanjutkan Pembayaran
                        </a>

                        <a href="{{ route('customer.denah') }}"
                           class="btn btn-outline-secondary w-100">

                            Batal

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

@endsection