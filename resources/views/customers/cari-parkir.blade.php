@extends('layouts.app')

@section('content')

@php
    $lokasiParkir = collect([
        (object) [
            'id' => 1,
            'nama' => 'Parkir UDINUS',
            'alamat' => 'Jl. Imam Bonjol No.207 Semarang',
            'gambar' => null,
            'rating' => 4.8,
            'jarak' => 1.2,
            'slot_tersedia' => 25,
            'tarif_per_jam' => 5000,
        ],
        (object) [
            'id' => 2,
            'nama' => 'DP Mall Semarang',
            'alamat' => 'Jl. Pemuda No.150 Semarang',
            'gambar' => null,
            'rating' => 4.5,
            'jarak' => 1.8,
            'slot_tersedia' => 12,
            'tarif_per_jam' => 6000,
        ],
        (object) [
            'id' => 3,
            'nama' => 'Lawang Sewu Park',
            'alamat' => 'Jl. Pemuda No.160 Semarang',
            'gambar' => null,
            'rating' => 4.2,
            'jarak' => 2.0,
            'slot_tersedia' => 0,
            'tarif_per_jam' => 4000,
        ],
    ]);
@endphp

<section class="section-py bg-body">
    <div class="container">

        <!-- Search Card -->
        <div class="card border-0 shadow-lg mb-5 rounded-4">

            <div class="card-body p-4 p-lg-5">

                <div class="d-flex justify-content-start mb-4">

                    <a
                        href="{{ route('dashboard') }}"
                        class="btn btn-outline-primary rounded-pill">

                        <i class="mdi mdi-arrow-left me-1"></i>

                        Kembali

                    </a>

                </div>

                <div class="text-center mb-4">

                    <span class="badge bg-label-primary rounded-pill px-3 py-2 mb-3">
                        🚗 Smart Parking Search
                    </span>

                    <h4 class="fw-bold mb-1">
                        Temukan Tempat Parkir Terbaik
                    </h4>

                    <p class="text-body-secondary mb-0">
                        Cari lokasi parkir berdasarkan lokasi, waktu, dan durasi parkir.
                    </p>

                </div>

                <form>

                    <div class="row g-3 align-items-end">

                        <!-- Lokasi -->
                        <div class="col-lg-5">

                            <label class="form-label fw-semibold">
                                Lokasi Parkir
                            </label>

                            <div class="input-group input-group-lg">

                                <span class="input-group-text bg-transparent">
                                    <i class="mdi mdi-map-marker-radius"></i>
                                </span>

                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Cari lokasi parkir...">

                            </div>

                        </div>

                        <!-- Tanggal -->
                        <div class="col-lg-2">

                            <label class="form-label fw-semibold">
                                Tanggal
                            </label>

                            <input
                                type="date"
                                class="form-control form-control-lg">

                        </div>

                        <!-- Waktu -->
                        <div class="col-lg-2">

                            <label class="form-label fw-semibold">
                                Waktu Masuk
                            </label>

                            <input
                                type="time"
                                class="form-control form-control-lg">

                        </div>

                        <!-- Durasi -->
                        <div class="col-lg-3">

                            <label class="form-label fw-semibold">
                                Durasi Parkir
                            </label>

                            <select class="form-select form-select-lg">

                                <option>1 Jam</option>
                                <option>2 Jam</option>
                                <option>3 Jam</option>
                                <option>4 Jam</option>
                                <option>5 Jam</option>

                            </select>

                        </div>

                    </div>

                    <div class="row mt-4">

                        <div class="col-lg-12">

                            <button
                                type="button"
                                class="btn btn-primary btn-lg w-100">

                                <i class="mdi mdi-magnify me-2"></i>
                                Cari Tempat Parkir

                            </button>

                        </div>

                    </div>

                </form>

            </div>

        </div>

        <!-- Results -->
        <div class="row g-4">

            @forelse ($lokasiParkir as $parkir)
            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm h-100">

                    <div class="position-relative">
                        <img src="https://blog.getandride.com/wp-content/uploads/2023/05/ukuran-parkiran-mobil.jpg"
                             alt="{{ $parkir->nama }}"
                             class="card-img-top" style="height: 180px; object-fit: cover;">

                        <div class="position-absolute top-0 end-0 m-3">
                            @if ($parkir->slot_tersedia > 0)
                                <span class="badge bg-label-success rounded-pill">
                                    <i class="mdi mdi-circle-medium"></i> Tersedia
                                </span>
                            @else
                                <span class="badge bg-label-danger rounded-pill">
                                    <i class="mdi mdi-circle-medium"></i> Penuh
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="card-body d-flex flex-column">

                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h5 class="fw-bold mb-0">{{ $parkir->nama }}</h5>
                            <div class="d-flex align-items-center gap-1 text-warning">
                                <i class="mdi mdi-star"></i>
                                <span class="fw-semibold text-body">{{ $parkir->rating ?? '4.5' }}</span>
                            </div>
                        </div>

                        <p class="text-body-secondary small d-flex align-items-center gap-1 mb-3">
                            <i class="mdi mdi-map-marker"></i>
                            {{ $parkir->alamat }}
                        </p>

                        <div class="d-flex gap-4 mb-3">
                            <div class="d-flex align-items-center gap-1 text-body-secondary small">
                                <i class="mdi mdi-map text-primary"></i>
                                {{ $parkir->jarak ?? '-' }} km
                            </div>
                            <div class="d-flex align-items-center gap-1 text-body-secondary small">
                                <i class="mdi mdi-car text-primary"></i>
                                {{ $parkir->slot_tersedia }} Slot Tersedia
                            </div>
                        </div>

                        <div class="mt-auto pt-3 border-top">
                            <p class="text-body-secondary small mb-0">Harga</p>
                            <p class="fw-bold text-primary fs-5 mb-0">
                                Rp {{ number_format($parkir->tarif_per_jam, 0, ',', '.') }}
                                <span class="fw-normal text-body-secondary small">/ Jam</span>
                            </p>
                        </div>

                        <div class="mt-3">

                            <a
                                href="{{ route('customer.denah') }}"
                                class="btn btn-primary w-100">

                                <i class="mdi mdi-calendar-check-outline me-1"></i>

                                Reservasi Sekarang

                            </a>

                        </div>

                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <i class="mdi mdi-magnify-close" style="font-size: 4rem; color: #c8c4d6;"></i>
                <p class="text-body-secondary mt-2">Tidak ada lokasi parkir ditemukan.</p>
            </div>
            @endforelse

        </div>

    </div>
</section>

@endsection