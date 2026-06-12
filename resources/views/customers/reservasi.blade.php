@extends('layouts.app')

@section('content')

<section class="section-py bg-body">

    <div class="container">

        <!-- Button Kembali -->
        <div class="mb-4">

            <a href="{{ route('customer.denah') }}"
               class="btn btn-outline-primary">

                <i class="mdi mdi-arrow-left me-1"></i>
                Kembali

            </a>

        </div>

        <div class="row g-4">

            <!-- KIRI -->
            <div class="col-lg-8">

                <!-- Ringkasan Reservasi -->
                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-body p-4">

                        <h4 class="fw-bold mb-4">
                            Ringkasan Reservasi
                        </h4>

                        <div class="row align-items-center">

                            <div class="col-md-4">

                                <img
                                    src="https://blog.getandride.com/wp-content/uploads/2023/05/ukuran-parkiran-mobil.jpg"
                                    class="img-fluid rounded"
                                    alt="Parkir">

                            </div>

                            <div class="col-md-8">

                                <h5 class="fw-bold">
                                    Parkir UDINUS
                                </h5>

                                <p class="text-body-secondary">
                                    Jl. Imam Bonjol No.207 Semarang
                                </p>

                                <div class="row g-3">

                                    <div class="col-6">
                                        <small class="text-body-secondary">Slot</small>
                                        <div class="fw-semibold">A-12</div>
                                    </div>

                                    <div class="col-6">
                                        <small class="text-body-secondary">Kendaraan</small>
                                        <div class="fw-semibold">Mobil</div>
                                    </div>

                                    <div class="col-6">
                                        <small class="text-body-secondary">Area</small>
                                        <div class="fw-semibold">Area A</div>
                                    </div>

                                    <div class="col-6">
                                        <small class="text-body-secondary">Durasi</small>
                                        <div class="fw-semibold">2 Jam</div>
                                    </div>

                                    <div class="col-6">
                                        <small class="text-body-secondary">Tanggal</small>
                                        <div class="fw-semibold">12 Juni 2026</div>
                                    </div>

                                    <div class="col-6">
                                        <small class="text-body-secondary">Jam Masuk</small>
                                        <div class="fw-semibold">10:00 WIB</div>
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- Detail Kendaraan -->
                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-body p-4">

                        <h5 class="fw-bold mb-4">
                            Detail Kendaraan
                        </h5>

                        <div class="mb-3">

                            <label class="form-label">
                                Nomor Polisi
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                placeholder="Contoh: H 1234 AB">

                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                Jenis Kendaraan
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                value="Mobil"
                                readonly>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                Slot Parkir
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                value="A-12"
                                readonly>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                Area Parkir
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                value="Area A"
                                readonly>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                Durasi Parkir
                            </label>

                            <select class="form-select">

                                <option>1 Jam</option>
                                <option selected>2 Jam</option>
                                <option>3 Jam</option>
                                <option>4 Jam</option>
                                <option>5 Jam</option>

                            </select>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                Tanggal Masuk
                            </label>

                            <input
                                type="date"
                                class="form-control">

                        </div>

                        <div class="mb-4">

                            <label class="form-label">
                                Jam Masuk
                            </label>

                            <input
                                type="time"
                                class="form-control">

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

                        <h6 class="fw-bold mb-3">
                            Metode Pembayaran
                        </h6>

                        <select class="form-select mb-4">

                            <option>QRIS</option>
                            <option>GoPay</option>
                            <option>OVO</option>
                            <option>DANA</option>
                            <option>Virtual Account</option>

                        </select>

                        <button
                            class="btn btn-primary w-100 mb-2">

                            Lanjutkan Pembayaran

                        </button>

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