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
                                src="{{ asset('assets/img/lokasi/' . $lokasi->gambar) }}"
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

                                <small class="text-body-secondary">
                                    Slot Parkir
                                </small>

                                <h6 class="mb-0 fw-semibold">
                                    {{ $slot->kode_slot }}
                                </h6>

                            </div>

                            <div class="col-6">

                                <small class="text-body-secondary">
                                    Kendaraan
                                </small>

                                <h6 class="mb-0 fw-semibold">
                                    {{ ucfirst($slot->jenis_kendaraan) }}
                                </h6>

                            </div>

                            <div class="col-6">

                                <small class="text-body-secondary">
                                    Area Parkir
                                </small>

                                <h6 class="mb-0 fw-semibold">
                                    Area {{ $slot->area }}
                                </h6>

                            </div>

                            <div class="col-6">

                                <small class="text-body-secondary">
                                    Durasi Parkir
                                </small>

                                <h6 class="mb-0 fw-semibold">
                                    {{ $durasi }} Jam
                                </h6>

                            </div>

                            <div class="col-6">

                                <small class="text-body-secondary">
                                    Tanggal Reservasi
                                </small>

                                <h6 class="mb-0 fw-semibold">
                                    {{ \Carbon\Carbon::parse($tanggal)->format('d M Y') }}
                                </h6>

                            </div>

                            <div class="col-6">

                                <small class="text-body-secondary">
                                    Jam Masuk
                                </small>

                                <h6 class="mb-0 fw-semibold">
                                    {{ $jam_masuk }}
                                </h6>

                            </div>

                        </div>

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

                        @if($kendaraan)

                            <div class="mb-3">

                                <small class="text-body-secondary">
                                    Nomor Polisi
                                </small>

                                <h6 class="mb-0">
                                    {{ $kendaraan->nomor_polisi }}
                                </h6>

                            </div>

                            <div class="mb-3">

                                <small class="text-body-secondary">
                                    Kendaraan
                                </small>

                                <h6 class="mb-0">
                                    {{ $kendaraan->merk }}
                                </h6>

                            </div>

                            <div class="mb-3">

                                <small class="text-body-secondary">
                                    Warna
                                </small>

                                <h6 class="mb-0">
                                    {{ $kendaraan->warna }}
                                </h6>

                            </div>

                            <div>

                                <small class="text-body-secondary">
                                    Jenis Kendaraan
                                </small>

                                <h6 class="mb-0">
                                    {{ ucfirst($kendaraan->jenis_kendaraan) }}
                                </h6>

                            </div>

                        @else

                            <div class="alert alert-warning mb-0">

                                Anda belum memiliki data kendaraan.

                            </div>

                        @endif

                    </div>

                </div>

                <!-- Membership -->
                <div class="card border-0 shadow-sm mb-4">

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

                <!-- KANAN -->
                @php
                    $biayaParkir = $slot->tarif_per_jam * $durasi;
                    $biayaAdmin = 1000;
                    $totalBayar = $biayaParkir + $biayaAdmin;
                @endphp
                <div class="col-lg-4">

                    <div class="card border-0 shadow-sm rounded-4 sticky-top">

                        <div class="card-body p-4">

                            <h5 class="fw-bold mb-4">
                                Ringkasan Pembayaran
                            </h5>

                            <div class="d-flex justify-content-between mb-2">

                                <span>
                                    Biaya Parkir
                                </span>

                                <span>
                                    Rp {{ number_format($biayaParkir, 0, ',', '.') }}
                                </span>

                            </div>

                            <div class="d-flex justify-content-between mb-3">

                                <span>
                                    Biaya Admin
                                </span>

                                <span>
                                    Rp {{ number_format($biayaAdmin, 0, ',', '.') }}
                                </span>

                            </div>

                            <hr>

                            <div class="d-flex justify-content-between mb-4">

                                <strong>
                                    Total
                                </strong>

                                <strong class="text-primary">
                                    Rp {{ number_format($totalBayar, 0, ',', '.') }}
                                </strong>

                            </div>
                            
                            <form action="{{ route('customer.reservasi.store') }}" method="POST">

                                @csrf

                                <input type="hidden" name="lokasi_parkir_id" value="{{ $lokasi->id }}">
                                <input type="hidden" name="slot_parkir_id" value="{{ $slot->id }}">
                                <input type="hidden" name="tanggal_masuk" value="{{ $tanggal }}">
                                <input type="hidden" name="jam_masuk" value="{{ $jam_masuk }}">
                                <input type="hidden" name="durasi_jam" value="{{ $durasi }}">
                                <input type="hidden" name="total_bayar" value="{{ $totalBayar }}">

                                <button type="submit" class="btn btn-primary w-100 mb-2">

                                    Lanjutkan Pembayaran

                                </button>

                            </form>

                            <a href="{{ route('customer.denah') }}"
                            class="btn btn-outline-secondary w-100">

                                Batal

                            </a>

                        </div>

                    </div>

                </div>

            </div>

            

        </div>

    </div>

</section>

@endsection