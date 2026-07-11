@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/swiper/swiper.css') }}" />
    {{-- <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/front-page-landing.css') }}" /> --}}
@endpush

@section('content')

    <!-- Sections:Start -->

    <section
    id="dashboard"
    class="hero-section position-relative overflow-hidden min-vh-100 d-flex align-items-center"
    style="padding-top: 100px;">

          <!-- Background Blur -->
          <div class="hero-blur hero-blur-1"></div>
          <div class="hero-blur hero-blur-2"></div>

          <div class="container">

              <div class="row align-items-center gy-5">

                  <!-- Kiri -->
                  <div class="col-lg-6">

                      <span class="badge bg-label-primary rounded-pill px-4 py-2 mb-4">
                          Smart Parking Platform
                      </span>

                      <h1 class="display-3 fw-bold mb-4">
                          Temukan Tempat Parkir Terdekat
                          <span class="text-primary">
                              dalam Hitungan Detik
                          </span>
                      </h1>

                      <p class="fs-5 text-body-secondary mb-5">
                          Cari lokasi parkir yang tersedia secara real-time,
                          pilih slot terbaik, dan lakukan reservasi sebelum tiba.
                          Nikmati pengalaman parkir yang lebih cepat dan praktis
                          bersama ParkirIn.
                      </p>

                      <div class="d-flex gap-3 flex-wrap">

                          <a href="{{ route('customer.cari-parkir') }}" class="btn btn-primary btn-lg">
                              Cari Parkir
                          </a>

                          <a href="#cara-kerja" class="btn btn-outline-primary btn-lg">
                              Cara Kerja
                          </a>

                      </div>

                  </div>

                <!-- Kanan - Ilustrasi Parkir -->
                <!-- Kanan -->
                    <div class="col-lg-5 offset-lg-1 d-flex align-items-center">
                        @include('partials.parking-illustration')
                    </div>
              </div>

          </div>

      </section>

      <section id="parkir-terdekat" class="bg-body position-relative d-flex align-items-center pt-4 pb-5">

        <div class="container">

            <!-- Heading -->
            <div class="text-center mt-5 mb-5">

                <h6 class="text-center fw-semibold d-flex justify-content-center align-items-center mb-3">

                    <img
                        src="{{ asset('assets/img/front-pages/icons/section-tilte-icon.png') }}"
                        alt="section title icon"
                        class="me-2">

                    <span class="text-uppercase">
                        Rekomendasi
                    </span>

                </h6>

                <h3 class="fw-bold mb-3">

                    Temukan
                    <span class="text-primary">
                        Lokasi Parkir Terbaik
                    </span>

                </h3>

                <p class="text-body-secondary mx-auto" style="max-width:650px;">

                    Pilih lokasi parkir terdekat dengan informasi slot dan tarif secara realtime.

                </p>

            </div>

            <!-- Cards -->
            <div class="row justify-content-center g-4">

                @foreach($lokasiParkir as $parkir)

                    @php
                        $tersedia = $parkir->slot_mobil > 0 || $parkir->slot_motor > 0;
                    @endphp

                    <div class="col-lg-4 col-md-6">
                        <div class="card parking-card h-100 border-0" style="border-radius: 20px; background: #ffffff; box-shadow: 0 2px 20px rgba(0, 0, 0, 0.04); transition: all 0.3s ease; overflow: hidden;">

                            <div class="position-relative">
                                <img src="{{ asset($parkir->gambar) }}" class="card-img-top" style="height: 220px; object-fit: cover; border-radius: 0;">
                                
                                <!-- Badge Status -->
                                <span class="badge position-absolute top-0 end-0 m-3 px-3 py-2 rounded-pill {{ $tersedia ? 'bg-success' : 'bg-danger' }}" style="font-weight: 500; font-size: 0.65rem; letter-spacing: 0.3px;">
                                    {{ $tersedia ? 'Tersedia' : 'Penuh' }}
                                </span>

                            </div>

                            <div class="card-body" style="padding: 18px 20px 20px;">

                                <!-- Nama -->
                                <h5 class="fw-bold mb-1" style="color: #1a1a2e; font-size: 1rem;">
                                    {{ $parkir->nama }}
                                </h5>

                                <!-- Alamat -->
                                <p class="text-muted mb-3" style="font-size: 0.75rem; color: #8e8ea0 !important;">
                                    <i class="mdi mdi-map-marker-outline me-1" style="font-size: 13px;"></i>
                                    {{ $parkir->alamat }}
                                </p>

                                <!-- Slot & Tarif dalam satu baris -->
                                <div class="d-flex justify-content-between align-items-center mb-3" style="border-bottom: 1px solid #f0f0f5; padding-bottom: 12px;">
                                    <div>
                                        <span style="font-size: 0.6rem; color: #9ca3af; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">Slot</span>
                                        <div class="d-flex gap-3 mt-1">
                                            <span style="font-size: 0.85rem; font-weight: 500; color: #7367F0;">
                                                <i class="mdi mdi-motorbike" style="font-size: 16px;"></i> {{ $parkir->slot_motor }}
                                            </span>
                                            <span style="font-size: 0.85rem; font-weight: 500; color: #4CAF50;">
                                                <i class="mdi mdi-car" style="font-size: 16px;"></i> {{ $parkir->slot_mobil }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="text-end">
                                        <span style="font-size: 0.6rem; color: #9ca3af; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">Tarif / Jam</span>
                                        <div class="fw-bold" style="color: #7367F0; font-size: 1rem;">
                                            Rp {{ number_format($parkir->tarif_per_jam, 0, ',', '.') }}
                                        </div>
                                    </div>
                                </div>

                                <!-- Button -->
                                <a href="{{ route('customer.atur-jadwal', $parkir->id) }}" class="btn w-100" style="background: #7367F0; color: #fff; border: none; border-radius: 12px; padding: 11px; font-weight: 600; font-size: 0.85rem; transition: all 0.3s ease;">
                                    <i class="mdi mdi-calendar-check me-2"></i> Reservasi
                                </a>

                            </div>
                        </div>
                    </div>

                @endforeach

            </div>

            <!-- Button -->
            <div class="text-center mt-5">
                <a
                    href="{{ route('customer.cari-parkir') }}"
                    class="btn btn-outline-primary btn-lg px-5" style="border-radius: 50px; font-weight: 600;">

                    Lihat Semua Lokasi

                </a>
            </div>

        </div>

    </section>
      <!-- Lokasi: End -->

      <!-- Cara Kerja -->
        <section id="cara-kerja" class="container pb-5">

            <!-- Heading -->
            <div class="text-center mt-5 mb-5">
                <h6 class="text-center fw-semibold d-flex justify-content-center align-items-center mb-3">
                    <img src="{{ asset('assets/img/front-pages/icons/section-tilte-icon.png') }}" alt="section title icon" class="me-2">
                    <span class="text-uppercase">Cara Kerja</span>
                </h6>
                <h3 class="fw-bold mb-3">
                    Reservasi Parkir Dalam
                    <span class="text-primary">4 Langkah Mudah</span>
                </h3>
                <p class="text-body-secondary mx-auto" style="max-width:650px;">
                    Cari lokasi parkir, pilih area dan slot yang tersedia,
                    kemudian lakukan reservasi dengan cepat melalui aplikasi
                    <strong>ParkirIn</strong>.
                </p>
            </div>

            <div class="row justify-content-center gy-4 gx-2">
                <!-- Step 1 -->
                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 d-flex justify-content-center">
                    <div class="cara-card">
                        <div class="step-header">
                            <div class="step-number">1</div>
                        </div>
                        <img src="{{ asset('assets/img/cara-kerja/cari-lokasi.svg') }}" class="cara-img" alt="Cari Lokasi">
                        <div class="cara-body">
                            <h5>Cari Lokasi</h5>
                            <p>Gunakan lokasi saat ini atau cari area parkir tujuan Anda.</p>
                        </div>
                    </div>
                </div>
                <!-- Step 2 -->
                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 d-flex justify-content-center">
                    <div class="cara-card">
                        <div class="step-header">
                            <div class="step-number step-green">2</div>
                        </div>
                        <img src="{{ asset('assets/img/cara-kerja/pilih-area.svg') }}" class="cara-img" alt="Pilih Area">
                        <div class="cara-body">
                            <h5>Pilih Area</h5>
                            <p>Lihat lokasi parkir terdekat beserta jumlah slot yang tersedia.</p>
                        </div>
                    </div>
                </div>
                <!-- Step 3 -->
                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 d-flex justify-content-center">
                    <div class="cara-card">
                        <div class="step-header">
                            <div class="step-number step-orange">3</div>
                        </div>
                        <img src="{{ asset('assets/img/cara-kerja/pilih-slot.svg') }}" class="cara-img" alt="Pilih Slot">
                        <div class="cara-body">
                            <h5>Pilih Slot</h5>
                            <p>Tentukan slot parkir melalui denah parkir interaktif secara realtime.</p>
                        </div>
                    </div>
                </div>
                <!-- Step 4 -->
                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 d-flex justify-content-center">
                    <div class="cara-card">
                        <div class="step-header">
                            <div class="step-number step-blue">4</div>
                        </div>
                        <img src="{{ asset('assets/img/cara-kerja/reservasi.svg') }}" class="cara-img" alt="Reservasi">
                        <div class="cara-body">
                            <h5>Reservasi</h5>
                            <p>Konfirmasi pemesanan dan langsung parkir tanpa mencari tempat kosong.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
      
    <!-- Pricing plans: Start -->
    <section id="membership" class="bg-body landing-pricing pt-5 pb-5">
        <div class="container">
            <!-- Heading -->
            <div class="text-center mb-5">
                <h6 class="text-center fw-semibold d-flex justify-content-center align-items-center mb-3">
                    <img
                        src="{{ asset('assets/img/front-pages/icons/section-tilte-icon.png') }}"
                        alt="section title icon"
                        class="me-2" />
                    <span class="text-uppercase">Membership ParkirIn</span>
                </h6>
                <h3 class="fw-bold mb-3">
                    Pilih Membership yang <span class="text-primary">Sesuai Kebutuhan Anda</span>
                </h3>
                <p class="text-body-secondary mx-auto" style="max-width:650px;">
                    Nikmati berbagai keuntungan eksklusif, diskon parkir,
                    dan akses prioritas di seluruh area parkir yang bermitra dengan ParkirIn.
                </p>
            </div>

            <div class="row gy-4 justify-content-center">
                <!-- Free Plan -->
                <div class="col-xl-4 col-lg-6">
                    <div class="card h-100 border-0 membership-card" style="border-radius: 20px; background: #ffffff; box-shadow: 0 2px 20px rgba(0,0,0,0.04); transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); overflow: hidden; transform: translateY(0);">
                        <div class="card-body p-4 d-flex flex-column">
                            <h4 class="fw-bold mb-1" style="color: #1a1a2e;">Non Member</h4>
                            <p class="text-muted small mb-3" style="color: #8e8ea0 !important;">Tanpa biaya keanggotaan</p>

                            <div class="d-flex align-items-end mb-4">
                                <span class="display-4 fw-bold" style="color: #1a1a2e; font-size: 2.5rem;">Gratis</span>
                                <span class="text-muted small mb-1 ms-2" style="color: #8e8ea0 !important;">/ selamanya</span>
                            </div>

                            <ul class="list-unstyled mb-4 flex-grow-1" style="font-size: 0.85rem; color: #4b5563; line-height: 2;">
                                <li class="d-flex align-items-center gap-2">
                                    <i class="mdi mdi-check-circle" style="color: #7367F0; font-size: 18px;"></i> Reservasi slot parkir
                                </li>
                                <li class="d-flex align-items-center gap-2">
                                    <i class="mdi mdi-check-circle" style="color: #7367F0; font-size: 18px;"></i> Pembayaran online
                                </li>
                                <li class="d-flex align-items-center gap-2">
                                    <i class="mdi mdi-check-circle" style="color: #7367F0; font-size: 18px;"></i> QR Code tiket parkir
                                </li>
                                <li class="d-flex align-items-center gap-2">
                                    <i class="mdi mdi-check-circle" style="color: #7367F0; font-size: 18px;"></i> Riwayat reservasi
                                </li>
                                <li class="d-flex align-items-center gap-2">
                                    <i class="mdi mdi-check-circle" style="color: #7367F0; font-size: 18px;"></i> Kelola kendaraan
                                </li>
                                <li class="d-flex align-items-center gap-2">
                                    <i class="mdi mdi-check-circle" style="color: #7367F0; font-size: 18px;"></i> Akses seluruh lokasi ParkirIn
                                </li>
                            </ul>

                            <div class="pt-3" style="border-top: 1px solid #f0f0f5;">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="text-muted small" style="color: #8e8ea0 !important;">Status</span>
                                    <span class="badge rounded-pill px-3 py-1" style="background: #f0f2ff; color: #7367F0; font-weight: 600; font-size: 0.65rem;">Pengguna Reguler</span>
                                </div>
                                @auth
                                    <a href="{{ route('customer.cari-parkir') }}"
                                    class="btn w-100 membership-btn membership-btn-login">
                                        <i class="mdi mdi-car-search me-1"></i>
                                        Mulai Reservasi
                                    </a>
                                @else
                                    <a href="{{ route('login') }}"
                                    class="btn w-100 membership-btn membership-btn-register">
                                        <i class="mdi mdi-login me-1"></i>
                                        Mulai Gratis
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Member Plan -->
                <div class="col-xl-4 col-lg-6">
                    <div class="card h-100 border-0 membership-card featured" style="border-radius: 20px; background: #ffffff; box-shadow: 0 2px 20px rgba(0,0,0,0.04); transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); overflow: hidden; transform: translateY(0);">

                        <div class="card-body p-4 d-flex flex-column">
                            <h4 class="fw-bold mb-1" style="color: #1a1a2e;">Member ParkirIn</h4>
                            <p class="text-muted small mb-3" style="color: #8e8ea0 !important;">Akses penuh semua fitur</p>

                            <div class="d-flex align-items-end mb-4">
                                <span class="display-4 fw-bold" style="color: #7367F0; font-size: 2.5rem;">Rp 50.000</span>
                                <span class="text-muted small mb-1 ms-2" style="color: #8e8ea0 !important;">/ Lifetime</span>
                            </div>

                            <ul class="list-unstyled mb-4 flex-grow-1" style="font-size: 0.85rem; color: #4b5563; line-height: 2;">
                                <li class="d-flex align-items-center gap-2">
                                    <i class="mdi mdi-check-circle" style="color: #7367F0; font-size: 18px;"></i> Semua fitur Non Member
                                </li>
                                <li class="d-flex align-items-center gap-2">
                                    <i class="mdi mdi-check-circle" style="color: #7367F0; font-size: 18px;"></i> Dapat Point setiap transaksi
                                </li>
                                <li class="d-flex align-items-center gap-2">
                                    <i class="mdi mdi-check-circle" style="color: #7367F0; font-size: 18px;"></i> Tukarkan Point potongan harga
                                </li>
                                <li class="d-flex align-items-center gap-2">
                                    <i class="mdi mdi-check-circle" style="color: #7367F0; font-size: 18px;"></i> Member Day diskon 10%
                                </li>
                                <li class="d-flex align-items-center gap-2">
                                    <i class="mdi mdi-check-circle" style="color: #7367F0; font-size: 18px;"></i> Berlaku aktif bertransaksi
                                </li>
                                <li class="d-flex align-items-center gap-2">
                                    <i class="mdi mdi-check-circle" style="color: #7367F0; font-size: 18px;"></i> Riwayat Point & Reward
                                </li>
                            </ul>

                            <div class="pt-3" style="border-top: 1px solid #f0f0f5;">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="text-muted small" style="color: #8e8ea0 !important;">Status</span>
                                    <span class="badge rounded-pill px-3 py-1" style="background: #7367F0; color: #fff; font-weight: 600; font-size: 0.65rem;">Member Lifetime</span>
                                </div>
                                @if(auth()->check())

                                    @if(auth()->user()->status_member == 'member')

                                        <button
                                            class="btn w-100"
                                            disabled
                                            style="background:#28C76F;color:#fff;border:none;border-radius:12px;padding:12px;font-weight:600;">

                                            <i class="mdi mdi-check-circle me-2"></i>
                                            Membership Aktif

                                        </button>

                                    @else

                                        <a
                                            href="{{ route('customer.membership') }}"
                                            class="btn w-100 membership-btn featured-btn"
                                            style="background:#7367F0;color:#fff;border:none;border-radius:12px;padding:12px;font-weight:600;font-size:.85rem;transition:.3s;box-shadow:0 4px 16px rgba(115,103,240,.25);">

                                            <i class="mdi mdi-crown me-2"></i>
                                            Daftar Member

                                        </a>

                                    @endif

                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing plans: End -->

        <section id="keunggulan-parkirin" class="min-vh-100 d-flex align-items-center overflow-hidden">
        <div class="container-fluid">
            <!-- Header Section -->
            <div class="text-center mb-5">
                <div class="d-flex justify-content-center align-items-center mb-3">
                    <img
                        src="{{ asset('assets/img/front-pages/icons/section-tilte-icon.png') }}"
                        class="me-2"
                        style="width: 28px; height: 28px; opacity: 0.7;">
                    <span class="section-badge">
                        Keunggulan ParkirIn
                    </span>
                </div>

                <h3 class="section-title">
                    Solusi Parkir Modern yang Cepat dan Praktis
                </h3>

                <p class="section-subtitle">
                    Nikmati pengalaman mencari dan memesan parkir dengan lebih mudah.
                </p>
            </div>

            <!-- Marquee Cards -->
            <div class="feature-slider">
                <div class="feature-track">
                    <!-- Card 1 -->
                    <div class="parkirin-card">
                        <div class="parkirin-body">
                            <h3>Lokasi Parkir Terdekat</h3>
                            <p>
                                Menampilkan area parkir terdekat berdasarkan lokasi pengguna secara realtime.
                            </p>
                        </div>
                        <img
                            src="{{ asset('assets/img/keunggulan/parkir.svg') }}"
                            class="parkirin-image"
                            alt="Lokasi Parkir">
                    </div>
            
                    <!-- Card 2 -->
                    <div class="parkirin-card">
                        <div class="parkirin-body">
                            <h3>Informasi Slot Tersedia</h3>
                            <p>
                                Mengetahui jumlah slot kosong yang tersedia sebelum pengguna tiba di lokasi parkir.
                            </p>
                        </div>
                        <img
                            src="{{ asset('assets/img/keunggulan/slot-tersedia.svg') }}"
                            class="parkirin-image"
                            alt="Slot Tersedia">
                    </div>

                    <!-- Card 3 -->
                    <div class="parkirin-card">
                        <div class="parkirin-body">
                            <h3>Denah Parkir Interaktif</h3>
                            <p>
                                Memilih slot parkir terbaik melalui denah parkir interaktif secara realtime.
                            </p>
                        </div>
                        <img
                            src="{{ asset('assets/img/keunggulan/denah.svg') }}"
                            class="parkirin-image"
                            alt="Denah Parkir">
                    </div>

                    <!-- Card 4 -->
                    <div class="parkirin-card">
                        <div class="parkirin-body">
                            <h3>Reservasi Cepat</h3>
                            <p>
                                Reservasi slot parkir hanya dalam beberapa detik tanpa perlu mencari tempat kosong.
                            </p>
                        </div>
                        <img
                            src="{{ asset('assets/img/keunggulan/reservasi.svg') }}"
                            class="parkirin-image"
                            alt="Reservasi">
                    </div>

                    <!-- Card 5 -->
                    <div class="parkirin-card">
                        <div class="parkirin-body">
                            <h3>Tarif Transparan</h3>
                            <p>
                                Menampilkan tarif parkir secara jelas sehingga pengguna mengetahui biaya sejak awal.
                            </p>
                        </div>
                        <img
                            src="{{ asset('assets/img/keunggulan/tarif.svg') }}"
                            class="parkirin-image"
                            alt="Tarif Parkir">
                    </div>

                    <!-- Card 6 -->
                    <div class="parkirin-card">
                        <div class="parkirin-body">
                            <h3>Pembayaran Mudah</h3>
                            <p>
                                Mendukung pembayaran digital melalui QRIS, Virtual Account, dan E-Wallet secara aman.
                            </p>
                        </div>
                        <img
                            src="{{ asset('assets/img/keunggulan/pembayaran.svg') }}"
                            class="parkirin-image"
                            alt="Pembayaran">
                    </div>

                    <!-- DUPLIKAT untuk seamless loop -->
                    <div class="parkirin-card">
                        <div class="parkirin-body">
                            <h3>Lokasi Parkir Terdekat</h3>
                            <p>
                                Menampilkan area parkir terdekat berdasarkan lokasi pengguna secara realtime.
                            </p>
                        </div>
                        <img
                            src="{{ asset('assets/img/keunggulan/parkir.svg') }}"
                            class="parkirin-image"
                            alt="Lokasi Parkir">
                    </div>
            
                    <div class="parkirin-card">
                        <div class="parkirin-body">
                            <h3>Informasi Slot Tersedia</h3>
                            <p>
                                Mengetahui jumlah slot kosong yang tersedia sebelum pengguna tiba di lokasi parkir.
                            </p>
                        </div>
                        <img
                            src="{{ asset('assets/img/keunggulan/slot-tersedia.svg') }}"
                            class="parkirin-image"
                            alt="Slot Tersedia">
                    </div>

                    <div class="parkirin-card">
                        <div class="parkirin-body">
                            <h3>Denah Parkir Interaktif</h3>
                            <p>
                                Memilih slot parkir terbaik melalui denah parkir interaktif secara realtime.
                            </p>
                        </div>
                        <img
                            src="{{ asset('assets/img/keunggulan/denah.svg') }}"
                            class="parkirin-image"
                            alt="Denah Parkir">
                    </div>

                    <div class="parkirin-card">
                        <div class="parkirin-body">
                            <h3>Reservasi Cepat</h3>
                            <p>
                                Reservasi slot parkir hanya dalam beberapa detik tanpa perlu mencari tempat kosong.
                            </p>
                        </div>
                        <img
                            src="{{ asset('assets/img/keunggulan/reservasi.svg') }}"
                            class="parkirin-image"
                            alt="Reservasi">
                    </div>

                    <div class="parkirin-card">
                        <div class="parkirin-body">
                            <h3>Tarif Transparan</h3>
                            <p>
                                Menampilkan tarif parkir secara jelas sehingga pengguna mengetahui biaya sejak awal.
                            </p>
                        </div>
                        <img
                            src="{{ asset('assets/img/keunggulan/tarif.svg') }}"
                            class="parkirin-image"
                            alt="Tarif Parkir">
                    </div>

                    <div class="parkirin-card">
                        <div class="parkirin-body">
                            <h3>Pembayaran Mudah</h3>
                            <p>
                                Mendukung pembayaran digital melalui QRIS, Virtual Account, dan E-Wallet secara aman.
                            </p>
                        </div>
                        <img
                            src="{{ asset('assets/img/keunggulan/pembayaran.svg') }}"
                            class="parkirin-image"
                            alt="Pembayaran">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Keunggulan Parkirin: End -->  

    <!-- Reviews: Start -->
      <section id="ulasan-parkirin" class="bg-body landing-reviews pb-0 d-flex flex-column justify-content-center pt-5">
        <div class="container">
          <h6 class="text-center fw-semibold d-flex justify-content-center align-items-center mb-4">
            <img src="{{ asset('assets/img/front-pages/icons/section-tilte-icon.png') }}"
                alt="section title icon" class="me-2" />
            <span class="text-uppercase">Ulasan Pengguna</span>
          </h6>
          <h3 class="text-center mb-2">
            <span class="fw-bold">Pengalaman Nyata</span> dari Pengguna Parkirin
          </h3>
          <p class="text-center fw-medium mb-3 mb-md-5">
            Ribuan pengguna sudah merasakan kemudahan reservasi parkir bersama Parkirin.
          </p>
        </div>

        <div class="swiper-reviews-carousel overflow-hidden pt-4">
          <div class="swiper" id="swiper-reviews">
            <div class="swiper-wrapper">

              <!-- Slide 1 -->
              <div class="swiper-slide">
                <div class="card h-100">
                  <div class="card-body text-body d-flex flex-column justify-content-between text-center p-4">
                    <p class="mb-3">"Parkirin bikin saya nggak perlu muter-muter nyari parkir lagi. Tinggal buka app, pilih slot, langsung masuk!"</p>
                    <div class="text-warning mb-3">⭐⭐⭐⭐⭐</div>
                    <div>
                      <h6 class="mb-1">Rizky Pratama</h6>
                      <p class="mb-0 text-muted small">Pengguna di Semarang</p>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Slide 2 -->
              <div class="swiper-slide">
                <div class="card h-100">
                  <div class="card-body text-body d-flex flex-column justify-content-between text-center p-4">
                    <p class="mb-3">"Denah parkir interaktifnya sangat membantu. Saya bisa lihat persis mana slot yang kosong sebelum berangkat."</p>
                    <div class="text-warning mb-3">⭐⭐⭐⭐⭐</div>
                    <div>
                      <h6 class="mb-1">Sari Dewi</h6>
                      <p class="mb-0 text-muted small">Pengguna di Yogyakarta</p>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Slide 3 -->
              <div class="swiper-slide">
                <div class="card h-100">
                  <div class="card-body text-body d-flex flex-column justify-content-between text-center p-4">
                    <p class="mb-3">"Reservasi cuma butuh beberapa detik. Sangat praktis buat saya yang sering buru-buru ke kantor."</p>
                    <div class="text-warning mb-3">⭐⭐⭐⭐⭐</div>
                    <div>
                      <h6 class="mb-1">Budi Santoso</h6>
                      <p class="mb-0 text-muted small">Pengguna di Jakarta</p>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Slide 4 -->
              <div class="swiper-slide">
                <div class="card h-100">
                  <div class="card-body text-body d-flex flex-column justify-content-between text-center p-4">
                    <p class="mb-3">"Parkiran lebih aman karena sudah tercatat. Ada konfirmasi reservasi jadi nggak khawatir slot diambil orang lain."</p>
                    <div class="text-warning mb-3">⭐⭐⭐⭐⭐</div>
                    <div>
                      <h6 class="mb-1">Anita Rahayu</h6>
                      <p class="mb-0 text-muted small">Pengguna di Bandung</p>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Slide 5 -->
              <div class="swiper-slide">
                <div class="card h-100">
                  <div class="card-body text-body d-flex flex-column justify-content-between text-center p-4">
                    <p class="mb-3">"Harga parkir transparan, tidak ada biaya tersembunyi. Saya bisa bandingkan tarif antar lokasi sebelum memilih."</p>
                    <div class="text-warning mb-3">⭐⭐⭐⭐☆</div>
                    <div>
                      <h6 class="mb-1">Dimas Aditya</h6>
                      <p class="mb-0 text-muted small">Pengguna di Surabaya</p>
                    </div>
                  </div>
                </div>
              </div>

            </div>

            {{-- Pagination di dalam swiper, tepat di bawah wrapper --}}
            <div class="swiper-pagination"></div>
          </div>
        </div>

      </section>

      <!-- Fun Facts: Start -->
        <section id="landingFunFacts" class="section-py landing-fun-facts">

            <div class="container">

                <div class="row justify-content-center gx-5 gy-5">

                    <!-- Pengguna -->
                    <div class="col-md-4 col-sm-6">

                        <div class="d-flex align-items-center justify-content-center gap-3">

                            <span class="badge badge-center rounded-pill bg-label-hover-info fun-facts-icon">

                                <i class="tf-icons mdi mdi-account-group-outline mdi-36px"></i>

                            </span>

                            <div class="text-start">

                                <h2 class="fw-bold mb-1">

                                    <span class="counter" data-target="10000">0</span>+

                                </h2>

                                <p class="fw-medium mb-0">

                                    Pengguna Terdaftar

                                </p>

                            </div>

                        </div>

                    </div>

                    <!-- Lokasi Parkir -->
                    <div class="col-md-4 col-sm-6">

                        <div class="d-flex align-items-center justify-content-center gap-3">

                            <span class="badge badge-center rounded-pill bg-label-hover-primary fun-facts-icon">

                                <i class="tf-icons mdi mdi-map-marker-multiple mdi-36px"></i>

                            </span>

                            <div class="text-start">

                                <h2 class="fw-bold mb-1">

                                    <span class="counter" data-target="100">0</span>+

                                </h2>

                                <p class="fw-medium mb-0">

                                    Lokasi Parkir

                                </p>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </section>
        <!-- Fun Facts: End -->

      <!-- FAQ: Start -->
      <section id="faq" class="landing-faq py-5">

          <div class="container">

              <!-- Heading -->
              <div class="text-center faq-heading">

                  <h6 class="fw-semibold d-flex justify-content-center align-items-center mb-3">

                      <img
                          src="{{ asset('assets/img/front-pages/icons/section-tilte-icon.png') }}"
                          class="me-2"
                          alt="">

                      <span class="text-uppercase">
                          FAQ
                      </span>

                  </h6>

                  <h3 class="fw-bold mb-3">

                      Pertanyaan yang
                      <span class="text-primary">
                          Sering Diajukan
                      </span>

                  </h3>

                  <p class="text-body-secondary mx-auto">

                      Temukan jawaban atas pertanyaan yang paling sering ditanyakan mengenai layanan ParkirIn.

                  </p>

              </div>

              <!-- Content -->
              <div class="row align-items-center justify-content-center gx-5 gy-4">

                  <!-- Left -->
                  <div class="col-lg-6">

                      <div class="faq-image-wrapper">

                          <img
                              src="{{ asset('assets/img/cara-kerja/faq.svg') }}"
                              class="faq-image"
                              alt="FAQ ParkirIn">

                      </div>

                  </div>

                  <!-- Right -->
                  <div class="col-lg-6">

                      <div class="accordion" id="accordionFront">

                          <!-- FAQ 1 -->
                          <div class="accordion-item">

                              <h2 class="accordion-header">

                                  <button
                                      class="accordion-button collapsed"
                                      type="button"
                                      data-bs-toggle="collapse"
                                      data-bs-target="#accordionOne">

                                      Apakah saya harus menjadi Member untuk menggunakan ParkirIn?

                                  </button>

                              </h2>

                              <div
                                  id="accordionOne"
                                  class="accordion-collapse collapse"
                                  data-bs-parent="#accordionFront">

                                  <div class="accordion-body">

                                      Tidak. Semua pengguna dapat mencari lokasi parkir, melihat slot yang tersedia, dan melakukan reservasi secara gratis. Membership memberikan keuntungan tambahan seperti poin reward, diskon Member Day, dan riwayat poin.

                                  </div>

                              </div>

                          </div>

                          <!-- FAQ 2 -->
                          <div class="accordion-item">

                              <h2 class="accordion-header">

                                  <button
                                      class="accordion-button collapsed"
                                      type="button"
                                      data-bs-toggle="collapse"
                                      data-bs-target="#accordionTwo">

                                      Bagaimana cara melakukan reservasi tempat parkir?

                                  </button>

                              </h2>

                              <div
                                  id="accordionTwo"
                                  class="accordion-collapse collapse"
                                  data-bs-parent="#accordionFront">

                                  <div class="accordion-body">

                                      Cari lokasi parkir, pilih area, tentukan slot yang tersedia, kemudian lakukan pembayaran untuk mendapatkan QR Code reservasi.

                                  </div>

                              </div>

                          </div>

                          <!-- FAQ 3 -->
                          <div class="accordion-item">

                              <h2 class="accordion-header">

                                  <button
                                      class="accordion-button"
                                      type="button"
                                      data-bs-toggle="collapse"
                                      data-bs-target="#accordionThree">

                                      Apakah informasi slot parkir diperbarui secara realtime?

                                  </button>

                              </h2>

                              <div
                                  id="accordionThree"
                                  class="accordion-collapse collapse show"
                                  data-bs-parent="#accordionFront">

                                  <div class="accordion-body">

                                      Ya. Status slot parkir diperbarui secara realtime sehingga pengguna dapat melihat ketersediaan slot sebelum tiba di lokasi.

                                  </div>

                              </div>

                          </div>

                          <!-- FAQ 4 -->
                          <div class="accordion-item">

                              <h2 class="accordion-header">

                                  <button
                                      class="accordion-button collapsed"
                                      type="button"
                                      data-bs-toggle="collapse"
                                      data-bs-target="#accordionFour">

                                      Di mana saja layanan ParkirIn dapat digunakan?

                                  </button>

                              </h2>

                              <div
                                  id="accordionFour"
                                  class="accordion-collapse collapse"
                                  data-bs-parent="#accordionFront">

                                  <div class="accordion-body">

                                      ParkirIn dapat digunakan di seluruh lokasi yang telah menjadi mitra resmi, seperti kampus, rumah sakit, pusat perbelanjaan, hotel, dan gedung perkantoran.

                                  </div>

                              </div>

                          </div>

                          <!-- FAQ 5 -->
                          <div class="accordion-item">

                              <h2 class="accordion-header">

                                  <button
                                      class="accordion-button collapsed"
                                      type="button"
                                      data-bs-toggle="collapse"
                                      data-bs-target="#accordionFive">

                                      Apa keuntungan menjadi Member ParkirIn?

                                  </button>

                              </h2>

                              <div
                                  id="accordionFive"
                                  class="accordion-collapse collapse"
                                  data-bs-parent="#accordionFront">

                                  <div class="accordion-body">

                                      Member mendapatkan poin setiap transaksi, dapat menukarkan poin menjadi potongan harga, memperoleh diskon Member Day, serta menikmati berbagai promo eksklusif.

                                  </div>

                              </div>

                          </div>

                      </div>

                  </div>

              </div>

          </div>

      </section>
      <!-- FAQ: End -->

      <!-- Mitra Kami -->
      <section id="mitra" class="section-py bg-body">

          <div class="container">

              <!-- Heading -->
              <div class="text-center mb-5">

                  <h6 class="text-center fw-semibold d-flex justify-content-center align-items-center mb-3">

                      <img
                          src="{{ asset('assets/img/front-pages/icons/section-tilte-icon.png') }}"
                          alt="section title icon"
                          class="me-2">

                      <span class="text-uppercase">
                          Mitra Kami
                      </span>

                  </h6>

                  <h3 class="fw-bold mb-3">

                      Bersama Mitra Terpercaya
                      <span class="text-primary">
                          Membangun Ekosistem Parkir Digital
                      </span>

                  </h3>

                  <p class="text-body-secondary mx-auto mb-5" style="max-width:650px;">

                      ParkirIn bekerja sama dengan berbagai institusi dan penyedia layanan pembayaran
                      untuk menghadirkan pengalaman parkir yang aman, mudah, dan nyaman.

                  </p>

              </div>

              <div class="row justify-content-center align-items-center g-4">

                  <div class="col-auto text-center">
                      <img src="{{ asset('assets/img/mitra/paragon.png') }}" class="partner-logo" alt="">
                  </div>

                  <div class="col-auto text-center">
                      <img src="{{ asset('assets/img/mitra/udinus.jpeg') }}" class="partner-logo" alt="">
                  </div>

                  <div class="col-auto text-center">
                      <img src="{{ asset('assets/img/mitra/rsmb.png') }}" class="partner-logo" alt="">
                  </div>

                  <div class="col-auto text-center">
                      <img src="{{ asset('assets/img/mitra/rsnu-babat.jpeg') }}" class="partner-logo" alt="">
                  </div>

                  <div class="col-auto text-center">
                      <img src="{{ asset('assets/img/mitra/java-heritage.jpg') }}" class="partner-logo" alt="">
                  </div>

                  <div class="col-auto text-center">
                      <img src="{{ asset('assets/img/mitra/ciputra.png') }}" class="partner-logo" alt="">
                  </div>

                  <div class="col-auto text-center">
                      <img src="{{ asset('assets/img/mitra/java-mall.jpg') }}" class="partner-logo" alt="">
                  </div>

                  <div class="col-auto text-center">
                      <img src="{{ asset('assets/img/mitra/ramayana.jpeg') }}" class="partner-logo" alt="">
                  </div>

                  <div class="col-auto text-center">
                      <img src="{{ asset('assets/img/mitra/tentrem.png') }}" class="partner-logo" alt="">
                  </div>
              </div>

              <div class="my-5"></div>

              <div class="text-center mt-5 mb-5">

                  <h4 class="fw-bold">

                      Mitra Pembayaran

                  </h4>

                  <p class="text-body-secondary mb-0">

                      Mendukung berbagai metode pembayaran digital untuk transaksi yang lebih cepat dan praktis.

                  </p>

              </div>

              <div class="row justify-content-center align-items-center gy-4">

                  <div class="col-auto text-center">
                      <img src="{{ asset('assets/img/mitra/brizzi.jpeg') }}" class="payment-logo" alt="">
                  </div>

                  <div class="col-auto text-center">
                      <img src="{{ asset('assets/img/mitra/dana.jpeg') }}" class="payment-logo" alt="">
                  </div>

                  <div class="col-auto text-center">
                      <img src="{{ asset('assets/img/mitra/link-aja.jpeg') }}" class="payment-logo" alt="">
                  </div>

                  <div class="col-auto text-center">
                      <img src="{{ asset('assets/img/mitra/ovo.jpeg') }}" class="payment-logo" alt="">
                  </div>

                  <div class="col-auto text-center">
                      <img src="{{ asset('assets/img/mitra/shopee.jpeg') }}" class="payment-logo" alt="">
                  </div>

                  <div class="col-auto text-center">
                      <img src="{{ asset('assets/img/mitra/shopee-pay.jpeg') }}" class="payment-logo" alt="">
                  </div>

              </div>

          </div>

      </section>
      <!-- Contact Us: End -->
    @endsection

@push('styles')
<style>

    .partner-logo{
        max-width:170px;
        max-height:70px;
        width:auto;
        height:auto;
        object-fit:contain;
        transition:all .3s ease;
    }

    .partner-logo:hover{
        transform:translateY(-5px) scale(1.05);
    }

    .payment-logo{
        max-width:120px;
        max-height:45px;
        width:auto;
        height:auto;
        object-fit:contain;
        transition:all .3s ease;
    }

    .payment-logo:hover{
        transform:translateY(-5px) scale(1.05);
    }

    /* ===========================
          Cara Kerja ParkirIn
        =========================== */

        #cara-kerja .container{

            max-width:1200px;
            scroll-margin-top: 80px;

        }

        #cara-kerja {
            scroll-margin-top: 100px !important;
        }

        .cara-card{

            width:320px;

            background:#fff;

            border:1px solid #ECECEC;

            border-radius:22px;

            overflow:hidden;

            box-shadow:0 8px 20px rgba(0,0,0,.05);

            transition:.3s;

        }

        .cara-card:hover{

            transform:translateY(-8px);

            box-shadow:0 18px 40px rgba(0,0,0,.12);

        }

        .cara-img{

            width:100%;

            height:200px;

            object-fit:contain;

            padding:10px;

            background:#fff;

        }

        .cara-body{

            padding:22px;

        }

        .cara-body h5{

            font-size:23px;

            font-weight:700;

            color:#2b2b2b;

            margin-bottom:12px;

        }

        .cara-body p{

            font-size:15px;

            color:#6b7280;

            line-height:1.8;

        }

        .step-header{

    display:flex;
    align-items:center;
    gap:12px;

    padding:18px 18px 0 18px;

}

.step-number{

    width:38px;
    height:38px;

    border-radius:50%;

    display:flex;
    justify-content:center;
    align-items:center;

    font-weight:700;
    font-size:18px;

    color:#fff;

    background:#5B5FEF;

}

.step-title{

    font-size:18px;
    font-weight:700;
    color:#2b2b2b;

}

.step-green{
    background:#4CAF50;
}

.step-orange{
    background:#FFA000;
}

.step-blue{
    background:#42A5F5;
}
/* Responsive */

@media (max-width:991px){

    .cara-card{

        max-width:290px;

    }

}

@media (max-width:768px){

    .cara-card{

        max-width:330px;

    }

}
    /*keunggulan*/
 /*keunggulan - Mempertahankan struktur asli */
    .parkirin-card {
        width: 360px;
        height: 500px;
        background: #fff;
        border-radius: 30px;
        overflow: hidden;
        position: relative;
        border: 1px solid #ECECEC;
        box-shadow: 0 8px 25px rgba(0, 0, 0, .05);
        transition: .35s;
    }

    .parkirin-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 45px rgba(0, 0, 0, .12);
    }

    .parkirin-body {
        padding: 30px;
    }

    /* ===== PERBAIKAN FONT & WARNA ===== */
    .parkirin-body h3 {
        font-family: 'Inter', 'Poppins', -apple-system, BlinkMacSystemFont, sans-serif;
        font-size: 28px;
        font-weight: 700;
        color: #1A1A2E;
        line-height: 1.3;
        margin-bottom: 16px;
        letter-spacing: -0.5px;
    }

    .parkirin-body p {
        font-family: 'Inter', 'Poppins', -apple-system, BlinkMacSystemFont, sans-serif;
        font-size: 17px;
        line-height: 1.7;
        color: #6B7280;
        margin: 0;
        font-weight: 400;
        letter-spacing: 0.2px;
    }

    .parkirin-image {
        position: absolute;
        left: 0;
        right: 0;
        bottom: 0;
        width: 100%;
        height: 230px;
        object-fit: cover;
    }

    /* ===== PERBAIKAN TITLE SECTION ===== */
    #keunggulan-parkirin .section-badge {
        font-family: 'Inter', 'Poppins', sans-serif;
        font-weight: 600;
        font-size: 0.75rem;
        letter-spacing: 2.5px;
        color: #6C5CE7;
        text-transform: uppercase;
        background: rgba(108, 92, 231, 0.10);
        padding: 6px 18px;
        border-radius: 50px;
        display: inline-block;
    }

    #keunggulan-parkirin .section-title {
        font-family: 'Inter', 'Poppins', sans-serif;
        font-weight: 700;
        font-size: 2.6rem;
        color: #1A1A2E;
        letter-spacing: -0.8px;
        line-height: 1.2;
        margin-bottom: 12px;
    }

    #keunggulan-parkirin .section-subtitle {
        font-family: 'Inter', 'Poppins', sans-serif;
        font-weight: 400;
        font-size: 1.1rem;
        color: #6B7280;
        letter-spacing: 0.2px;
    }

    /* ===== MARQUEE / SLIDER ===== */
    .feature-slider {
        overflow: hidden;
        padding: 20px 0;
        position: relative;
    }

    .feature-slider::before,
    .feature-slider::after {
        content: '';
        position: absolute;
        top: 0;
        bottom: 0;
        width: 120px;
        z-index: 2;
        pointer-events: none;
    }

    .feature-slider::before {
        left: 0;
        background: linear-gradient(90deg, #f8f9fc, transparent);
    }

    .feature-slider::after {
        right: 0;
        background: linear-gradient(-90deg, #f8f9fc, transparent);
    }

    .feature-track {
        display: flex;
        animation: scrollCards 30s linear infinite;
        gap: 24px;
        padding: 10px 0;
    }

    .feature-track:hover {
        animation-play-state: paused;
    }

    @keyframes scrollCards {
        0% { transform: translateX(0); }
        100% { transform: translateX(-50%); }
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 992px) {
        .parkirin-card {
            width: 300px;
            height: 440px;
        }

        .parkirin-body h3 {
            font-size: 24px;
        }

        .parkirin-body p {
            font-size: 15px;
        }

        .parkirin-image {
            height: 200px;
        }

        #keunggulan-parkirin .section-title {
            font-size: 2.2rem;
        }
    }

    @media (max-width: 768px) {
        .parkirin-card {
            width: 260px;
            height: 400px;
        }

        .parkirin-body {
            padding: 24px;
        }

        .parkirin-body h3 {
            font-size: 21px;
            margin-bottom: 12px;
        }

        .parkirin-body p {
            font-size: 14px;
            line-height: 1.6;
        }

        .parkirin-image {
            height: 170px;
        }

        #keunggulan-parkirin .section-title {
            font-size: 1.8rem;
        }

        #keunggulan-parkirin .section-subtitle {
            font-size: 1rem;
        }

        .feature-slider::before,
        .feature-slider::after {
            width: 60px;
        }

        .feature-track {
            gap: 16px;
        }
    }

    @media (max-width: 480px) {
        .parkirin-card {
            width: 220px;
            height: 360px;
            border-radius: 20px;
        }

        .parkirin-body {
            padding: 20px;
        }

        .parkirin-body h3 {
            font-size: 18px;
            margin-bottom: 10px;
        }

        .parkirin-body p {
            font-size: 13px;
            line-height: 1.5;
        }

        .parkirin-image {
            height: 150px;
        }

        #keunggulan-parkirin .section-title {
            font-size: 1.5rem;
        }

        #keunggulan-parkirin .section-subtitle {
            font-size: 0.9rem;
        }

        .feature-track {
            gap: 12px;
        }
    }


/*Pengguna*/

.fun-facts-icon{

    width:70px;

    height:70px;

    display:flex;

    justify-content:center;

    align-items:center;

    border-radius:50%;

    flex-shrink:0;

}

.fun-facts-icon i{

    font-size:34px;

}

.fun-facts-text h2{

    font-size:32px;

    margin-bottom:4px;

}

.fun-facts-text p{

    margin-bottom:0;

    color:#6b7280;

    font-weight:600;

}
/* ==================================================
                    FAQ PARKIRIN
================================================== */

#faq{

    padding:80px 0;

    background:#fff;

}

#faq .container{

    max-width:1200px;

}

.faq-heading{

    margin-bottom:60px;

}

.faq-heading p{

    max-width:650px;

}

.faq-image-wrapper{

    display:flex;

    justify-content:center;

    align-items:center;

    height:100%;

}

.faq-image{

    width:100%;

    max-width:560px;

    height:auto;

    display:block;

    object-fit:contain;

}

#faq .accordion{

    width:100%;

}

#faq .accordion-item{

    border:none;

    border-radius:18px;

    overflow:hidden;

    margin-bottom:16px;

    box-shadow:0 8px 24px rgba(0,0,0,.06);

}

#faq .accordion-button{

    padding:22px 24px;

    font-size:16px;

    font-weight:600;

    color:#2c2c2c;

    background:#fff;

    box-shadow:none;

}

#faq .accordion-button:focus{

    box-shadow:none;

}

#faq .accordion-button:not(.collapsed){

    background:#7367f0;

    color:#fff;

}

#faq .accordion-body{

    display:block !important;

    color:#2b2b2b !important;

    background:#ffffff !important;

    font-size:15px !important;

    line-height:1.8 !important;

    opacity:1 !important;

    visibility:visible !important;

}

/* ===== MEMBERSHIP CARDS ===== */
.membership-card {
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    transform: translateY(0);
}

.membership-card:hover {
    transform: translateY(-12px);
    box-shadow: 0 20px 60px rgba(115, 103, 240, 0.12) !important;
}

/* Featured card - pulse animation hanya saat di-hover */
.membership-card.featured:hover {
    animation: pulse-border 1.5s ease-in-out infinite;
    box-shadow: 0 20px 60px rgba(115, 103, 240, 0.25) !important;
    border-color: #7367F0 !important;
}

@keyframes pulse-border {
    0%, 100% {
        border-color: #7367F0;
        box-shadow: 0 20px 60px rgba(115, 103, 240, 0.25);
    }
    50% {
        border-color: #a78bfa;
        box-shadow: 0 20px 60px rgba(115, 103, 240, 0.40);
    }
}

.membership-card .membership-btn {
    transition: all 0.3s ease;
}

.membership-card:hover .membership-btn {
    background: #7367F0;
    color: #fff;
    transform: scale(1.02);
    box-shadow: 0 4px 20px rgba(115, 103, 240, 0.35);
}

.membership-card.featured:hover .featured-btn {
    background: linear-gradient(135deg, #7367F0, #5a4bd1);
    box-shadow: 0 8px 30px rgba(115, 103, 240, 0.45);
    transform: scale(1.02);
}

.membership-card .mdi-check-circle {
    transition: all 0.3s ease;
}

.membership-card:hover .mdi-check-circle {
    transform: scale(1.1);
    color: #5a4bd1;
}

.membership-card .badge {
    transition: all 0.3s ease;
}

.membership-card:hover .badge {
    transform: scale(1.05);
}

.membership-card .display-4 {
    transition: all 0.3s ease;
}

.membership-card:hover .display-4 {
    transform: scale(1.02);
}
</style>


@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    new Swiper('#swiper-reviews', {
        slidesPerView: 1,
        spaceBetween: 24,
        loop: true,
        centeredSlides: true,
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
        },
        pagination: {
            el: '#swiper-reviews .swiper-pagination',
            clickable: true,
        },
        breakpoints: {
            576: { slidesPerView: 2, centeredSlides: true },
            992: { slidesPerView: 3, centeredSlides: true },
        },
    });
});
</script>

<script>

document.addEventListener("DOMContentLoaded", function () {

    const counters = document.querySelectorAll(".counter");

    const observer = new IntersectionObserver((entries) => {

        entries.forEach(entry => {

            if (!entry.isIntersecting) return;

            const counter = entry.target;

            const target = parseInt(counter.dataset.target);

            let start = 0;

            const duration = 2000; // 2 detik

            const startTime = performance.now();

            function animate(currentTime) {

                const progress = Math.min((currentTime - startTime) / duration, 1);

                const value = Math.floor(progress * target);

                counter.innerText = value.toLocaleString('id-ID');

                if (progress < 1) {

                    requestAnimationFrame(animate);

                } else {

                    counter.innerText = target.toLocaleString('id-ID');

                }

            }

            requestAnimationFrame(animate);

            observer.unobserve(counter);

        });

    }, {

        threshold: 0.5

    });

    counters.forEach(counter => observer.observe(counter));

});

</script>

<style>
/* ===== HERO SECTION ===== */
.hero-section{
    background: linear-gradient(
        135deg,
        #1a1a2e 0%,
        #16161f 50%,
        #0d0d14 100%
    );
}

.hero-section h1,
.hero-section .display-3{
    color:#ffffff;
}

.hero-section .text-body-secondary{
    color:#b8b8c5!important;
}

.hero-section .badge.bg-label-primary{
    background:rgba(115,103,240,.2)!important;
    color:#c4b8ff!important;
    border:1px solid rgba(115,103,240,.3);
}

.hero-blur{
    position:absolute;
    border-radius:50%;
    filter:blur(120px);
    z-index:0;
}

.hero-blur-1{
    width:500px;
    height:500px;
    background:rgba(115,103,240,.35);
    top:-150px;
    left:-150px;
    animation: float1 8s ease-in-out infinite;
}

.hero-blur-2{
    width:450px;
    height:450px;
    background:rgba(167,139,250,.25);
    bottom:-100px;
    right:-100px;
    animation: float2 10s ease-in-out infinite;
}

.hero-section .container{
    position:relative;
    z-index:2;
}

.hero-section .card{
    background:#ffffff;
    box-shadow: 0 1rem 4rem rgba(0,0,0,.4)!important;
}

@keyframes float1{
    0%,100%{ transform:translateY(0); }
    50%{ transform:translateY(30px); }
}

@keyframes float2{
    0%,100%{ transform:translateY(0); }
    50%{ transform:translateY(-30px); }
}

.parking-card{
    transition:all .3s ease;
}

.parking-card:hover{
    transform:translateY(-8px);
    box-shadow:0 1rem 3rem rgba(0,0,0,.12)!important;
}

#swiper-reviews {
  padding-bottom: 40px;
}

#swiper-reviews .swiper-pagination {
  position: relative;
  bottom: auto;
  margin-top: 16px;
  text-align: center;
}

#landingReviews {
  min-height: 100vh;
  display: flex;
  flex-direction: column;
  justify-content: center;
}

/* ===== FUN FACTS ===== */
#landingFunFacts{
    background: linear-gradient(135deg, #7367f0 0%, #a78bfa 100%);
    color:#fff;
}

#landingFunFacts h2,
#landingFunFacts p{
    color:#fff;
}

#landingFunFacts .fun-facts-icon{
    background: rgba(255,255,255,.18)!important;
    color:#fff;
}

</style>