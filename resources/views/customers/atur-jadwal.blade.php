@extends('layouts.app')

@section('content')

<section class="section-py bg-body">

<div class="container">

    <!-- Button Kembali -->
    <div class="mb-4">

    </div>

    <div class="row justify-content-center">

        <div class="col-lg-7">

            <!-- Atur Jadwal -->
            <div class="card border-0 shadow-sm rounded-4 mb-4">

                <div class="card-body p-4 p-lg-5">

                    <div class="text-center mb-4">

                        <span class="badge bg-label-primary rounded-pill px-3 py-2 mb-3">
                            🕒 Jadwal Reservasi
                        </span>

                        <h3 class="fw-bold mb-2">
                            Atur Jadwal Parkir
                        </h3>

                        <p class="text-body-secondary mb-0">
                            Tentukan waktu parkir untuk melihat slot yang tersedia.
                        </p>

                    </div>

                    <form action="{{ route('customer.denah') }}" method="GET">

                        <!-- Lokasi -->
                        <div class="mb-4">

                            <label class="form-label fw-semibold">
                                Lokasi Parkir
                            </label>

                            <div class="border rounded-3 p-3 bg-body-tertiary">

                                <div class="fw-semibold">
                                    📍 Parkir UDINUS
                                </div>

                                <small class="text-body-secondary">
                                    Jl. Imam Bonjol No.207 Semarang
                                </small>

                            </div>

                        </div>

                        <div class="row g-3">

                            <!-- Tanggal -->
                            <div class="col-md-6">

                                <label class="form-label fw-semibold">
                                    Tanggal Parkir
                                </label>

                                <input
                                    type="date"
                                    class="form-control">

                            </div>

                            <!-- Jam -->
                            <div class="col-md-6">

                                <label class="form-label fw-semibold">
                                    Jam Masuk
                                </label>

                                <input
                                    type="time"
                                    class="form-control">

                            </div>

                        </div>

                        <!-- Durasi -->
                        <div class="mt-3">

                            <label class="form-label fw-semibold">
                                Durasi Parkir
                            </label>

                            <select class="form-select">

                                <option>1 Jam</option>
                                <option>2 Jam</option>
                                <option>3 Jam</option>
                                <option>4 Jam</option>
                                <option>5 Jam</option>
                                <option>6 Jam</option>

                            </select>

                        </div>

                        <!-- Kendaraan -->
                        <div class="mt-4">

                            <label class="form-label fw-semibold d-block">
                                Jenis Kendaraan
                            </label>

                            <div class="btn-group w-100">

                                <input
                                    type="radio"
                                    class="btn-check"
                                    name="kendaraan"
                                    id="mobil"
                                    value="mobil"
                                    checked>

                                <label
                                    class="btn btn-outline-primary"
                                    for="mobil">

                                    🚗 Mobil

                                </label>

                                <input
                                    type="radio"
                                    class="btn-check"
                                    name="kendaraan"
                                    id="motor"
                                    value="motor">

                                <label
                                    class="btn btn-outline-primary"
                                    for="motor">

                                    🛵 Motor

                                </label>

                            </div>

                        </div>

                        <!-- Button -->
                        <div class="mt-4">

                            <button
                                type="submit"
                                class="btn btn-primary btn-lg w-100 mb-2">

                                Lihat Slot Tersedia

                            </button>

                            <a href="{{ route('dashboard') }}"
                                class="btn btn-outline-secondary w-100">

                                Batal

                            </a>

                        </div>

                    </form>

                </div>

            </div>

            <!-- Cara Kerja -->
            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-body p-4">

                    <h5 class="fw-bold mb-4">
                        Bagaimana Cara Kerjanya?
                    </h5>

                    <div class="d-flex mb-4">

                        <div class="me-3">
                            <span class="badge bg-label-primary p-3">
                                <i class="mdi mdi-clock-outline"></i>
                            </span>
                        </div>

                        <div>

                            <h6 class="fw-semibold">
                                Tentukan Jadwal
                            </h6>

                            <small class="text-body-secondary">
                                Pilih tanggal, jam masuk dan durasi parkir.
                            </small>

                        </div>

                    </div>

                    <div class="d-flex mb-4">

                        <div class="me-3">
                            <span class="badge bg-label-primary p-3">
                                <i class="mdi mdi-parking"></i>
                            </span>
                        </div>

                        <div>

                            <h6 class="fw-semibold">
                                Pilih Slot
                            </h6>

                            <small class="text-body-secondary">
                                Lihat denah area parkir dan pilih slot terbaik.
                            </small>

                        </div>

                    </div>

                    <div class="d-flex">

                        <div class="me-3">
                            <span class="badge bg-label-primary p-3">
                                <i class="mdi mdi-credit-card-outline"></i>
                            </span>
                        </div>

                        <div>

                            <h6 class="fw-semibold">
                                Reservasi & Bayar
                            </h6>

                            <small class="text-body-secondary">
                                Konfirmasi reservasi dan lakukan pembayaran.
                            </small>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>
```

</section>

@endsection
