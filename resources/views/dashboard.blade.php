@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/swiper/swiper.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/front-page-landing.css') }}" />
@endpush

@section('content')

@php
    $lokasiParkir = collect([
        (object) [
            'id' => 1,
            'nama' => 'Parkir UDINUS',
            'alamat' => 'Jl. Imam Bonjol No.207 Semarang',
            'gambar' => 'https://blog.getandride.com/wp-content/uploads/2023/05/ukuran-parkiran-mobil.jpg',
            'rating' => 4.8,
            'jarak' => 1.2,
            'motor' => 20,
            'mobil' => 11,
            'tarif_per_jam' => 5000,
        ],
        (object) [
            'id' => 2,
            'nama' => 'Paragon City Mall',
            'alamat' => 'Jl. Pemuda No.118 Semarang',
            'gambar' => 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?q=80&w=1200',
            'rating' => 4.7,
            'jarak' => 2.1,
            'motor' => 15,
            'mobil' => 8,
            'tarif_per_jam' => 6000,
        ],
        (object) [
            'id' => 3,
            'nama' => 'Simpang Lima',
            'alamat' => 'Kawasan Simpang Lima Semarang',
            'gambar' => 'https://images.unsplash.com/photo-1494526585095-c41746248156?q=80&w=1200',
            'rating' => 4.9,
            'jarak' => 0.8,
            'motor' => 35,
            'mobil' => 18,
            'tarif_per_jam' => 7000,
        ],
    ]);
@endphp

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

      <section id="parkir-terdekat" class="section-py bg-body position-relative d-flex align-items-center min-vh-100">

          <div class="container">

              <!-- Heading -->
              <div class="text-center mb-5">

                  <span class="badge bg-label-primary rounded-pill mb-3 px-3 py-2">
                      Nearby Parking
                  </span>

                  <h2 class="fw-bold mb-3">
                      Area Parkir Terdekat
                  </h2>

                  <p class="text-body-secondary fs-6 mx-auto"
                      style="max-width:700px;">
                      Temukan lokasi parkir yang tersedia di sekitar Anda secara real-time,
                      pilih area terbaik, dan lakukan reservasi langsung dari aplikasi.
                  </p>

              </div>

              <!-- Cards -->
          <div class="row justify-content-center g-4">

              @foreach($lokasiParkir as $parkir)

              <div class="col-lg-4 col-md-6">

                  <div class="card parking-card h-100 shadow-sm border-0">

                      <div class="position-relative">

                          <img
                              src="{{ $parkir->gambar }}"
                              class="card-img-top"
                              style="height:220px;object-fit:cover;">

                          <span class="badge bg-success position-absolute top-0 end-0 m-3">
                              Tersedia
                          </span>

                      </div>

                      <div class="card-body">

                          <div class="d-flex justify-content-between mb-2">

                              <h5 class="fw-semibold mb-0">
                                  {{ $parkir->nama }}
                              </h5>

                              <span class="text-warning">
                                  ⭐ {{ $parkir->rating }}
                              </span>

                          </div>

                          <p class="text-body-secondary mb-3">
                              {{ $parkir->alamat }}
                          </p>

                          <div class="d-flex justify-content-between mb-3">

                              <span>
                                  📍 {{ $parkir->jarak }} km
                              </span>

                              <span class="fw-semibold">

                                  <i class="mdi mdi-motorbike text-primary"></i>
                                  {{ $parkir->motor }}

                                  &nbsp;

                                  <i class="mdi mdi-car text-success"></i>
                                  {{ $parkir->mobil }}

                              </span>

                          </div>

                          <div class="border-top pt-3 mb-3">

                              <small class="text-body-secondary">
                                  Tarif
                              </small>

                              <h6 class="fw-bold text-primary mb-0">
                                  Rp {{ number_format($parkir->tarif_per_jam, 0, ',', '.') }}/Jam
                              </h6>

                          </div>

                          <a
                            href="{{ route('customer.atur-jadwal', $parkir->id) }}"
                            class="btn btn-primary w-100">

                            Reservasi

                        </a>

                      </div>

                  </div>

              </div>

              @endforeach

          </div>

              <!-- Button -->
              <div class="text-center mt-5">
                  <a href="/customer/cari-parkir" class="btn btn-outline-primary btn-lg px-5">
                      Lihat Semua Lokasi
                  </a>
              </div>

          </div>

      </section>
      <!-- Hero: End -->

      <!-- Cara Kerja: Start -->
      <section id="cara-kerja" class="bg-white d-flex align-items-center" style="min-height:60vh;">

          <div class="container">

              <h6 class="text-center fw-semibold d-flex justify-content-center align-items-center mb-4">
                  <img
                      src="{{ asset('assets/img/front-pages/icons/section-tilte-icon.png') }}"
                      alt="section title icon"
                      class="me-2" />
                  <span class="text-uppercase">Cara Kerja</span>
              </h6>

              <h3 class="text-center mb-2">
                  <span class="fw-bold">
                      Reservasi Parkir Dalam 4 Langkah Mudah
                  </span>
              </h3>

              <p class="text-center fw-medium mb-5">
                  Temukan slot parkir terbaik dan lakukan reservasi kapan saja secara cepat dan mudah.
              </p>

              <div class="row g-5 text-center">

                  <!-- Step 1 -->
                  <div class="col-lg-3 col-sm-6">

                      <div class="landing-feature">

                          <div class="mb-4">

                              <span class="badge rounded-pill bg-label-primary p-3">

                                  <i class="mdi mdi-map-marker-radius mdi-36px"></i>

                              </span>

                          </div>

                          <h5 class="mb-2">
                              Cari Lokasi
                          </h5>

                          <p class="mb-0">
                              Gunakan lokasi saat ini atau cari area parkir tujuan Anda.
                          </p>

                      </div>

                  </div>

                  <!-- Step 2 -->
                  <div class="col-lg-3 col-sm-6">

                      <div class="landing-feature">

                          <div class="mb-4">

                              <span class="badge rounded-pill bg-label-success p-3">

                                  <i class="mdi mdi-car-search mdi-36px"></i>

                              </span>

                          </div>

                          <h5 class="mb-2">
                              Pilih Area
                          </h5>

                          <p class="mb-0">
                              Lihat lokasi parkir terdekat beserta jumlah slot yang tersedia.
                          </p>

                      </div>

                  </div>

                  <!-- Step 3 -->
                  <div class="col-lg-3 col-sm-6">

                      <div class="landing-feature">

                          <div class="mb-4">

                              <span class="badge rounded-pill bg-label-warning p-3">

                                  <i class="mdi mdi-parking mdi-36px"></i>

                              </span>

                          </div>

                          <h5 class="mb-2">
                              Pilih Slot
                          </h5>

                          <p class="mb-0">
                              Tentukan slot parkir melalui denah parkir interaktif secara realtime.
                          </p>

                      </div>

                  </div>

                  <!-- Step 4 -->
                  <div class="col-lg-3 col-sm-6">

                      <div class="landing-feature">

                          <div class="mb-4">

                              <span class="badge rounded-pill bg-label-info p-3">

                                  <i class="mdi mdi-check-decagram mdi-36px"></i>

                              </span>

                          </div>

                          <h5 class="mb-2">
                              Reservasi
                          </h5>

                          <p class="mb-0">
                              Konfirmasi pemesanan dan langsung parkir tanpa mencari tempat kosong.
                          </p>

                      </div>

                  </div>

              </div>

          </div>

      </section>
      <!-- Cara Kerja: End -->
      
      <!-- Keunggulan Parkirin: Start -->
      <section id="keunggulan-parkirin" class="min-vh-100 d-flex align-items-center overflow-hidden">

          <div class="container-fluid">

              <!-- Heading -->
              <div class="text-center mb-5">

                  <h6 class="text-center fw-semibold d-flex justify-content-center align-items-center mb-4">
                      <img
                          src="{{ asset('assets/img/front-pages/icons/section-tilte-icon.png') }}"
                          class="me-2">
                      <span class="text-uppercase">
                          Keunggulan ParkirIn
                      </span>
                  </h6>

                  <h3 class="fw-bold">
                      Solusi Parkir Modern yang Cepat dan Praktis
                  </h3>

                  <p class="text-body-secondary">
                      Nikmati pengalaman mencari dan memesan parkir dengan lebih mudah.
                  </p>

              </div>

              <!-- Marquee -->
              <div class="feature-slider">

                  <div class="feature-track">

                      <!-- Card 1 -->
                      <div class="feature-card">

                        <div class="text-center">

                            <div class="mb-3">

                                <span class="badge bg-label-primary rounded-pill p-3">

                                    <i class="mdi mdi-map-marker-radius mdi-36px"></i>

                                </span>

                            </div>

                            <h5 class="fw-semibold">
                                Lokasi Parkir Terdekat
                            </h5>

                            <p class="mb-0 text-body-secondary">
                                Menampilkan area parkir terdekat berdasarkan lokasi pengguna secara realtime.
                            </p>

                        </div>

                      </div>
              
                      <!-- Card 2 -->
                      <div class="feature-card">

                        <div class="text-center">

                            <div class="mb-3">

                                <span class="badge bg-label-primary rounded-pill p-3">

                                    <i class="mdi mdi-parking"></i>

                                </span>

                            </div>

                            <h5 class="fw-semibold">
                                Informasi Slot Tersedia
                            </h5>

                            <p class="mb-0 text-body-secondary">
                              Mengetahui jumlah slot kosong yang tersedia sebelum tiba di lokasi.
                            </p>

                        </div>
                      </div>

                      <!-- Card 3 -->
                      <div class="feature-card">
                        <div class="text-center">

                            <div class="mb-3">

                                <span class="badge bg-label-primary rounded-pill p-3">

                                    <i class="mdi mdi-car-search"></i>

                                </span>

                            </div>

                            <h5 class="fw-semibold">
                                Denah Parkir Interaktif
                            </h5>

                            <p class="mb-0 text-body-secondary">
                              Melihat denah parkir secara realtime untuk memilih slot terbaik.
                            </p>

                        </div>
                      </div>

                      <!-- Card 4 -->
                      <div class="feature-card">
                        <div class="text-center">

                            <div class="mb-3">

                                <span class="badge bg-label-primary rounded-pill p-3">

                                    <i class="mdi mdi-check-decagram"></i>

                                </span>

                            </div>

                            <h5 class="fw-semibold">
                                Reservasi Cepat
                            </h5>

                            <p class="mb-0 text-body-secondary">
                              Melakukan reservasi dalam hitungan detik tanpa perlu mencari tempat kosong.
                            </p>

                        </div>
                      </div>

                      <!-- Card 5 -->
                      <div class="feature-card">
                        <div class="text-center">

                            <div class="mb-3">

                                <span class="badge bg-label-primary rounded-pill p-3">

                                    <i class="mdi mdi-currency-usd"></i>

                                </span>

                            </div>

                            <h5 class="fw-semibold">
                                Tarif Transparan
                            </h5>

                            <p class="mb-0 text-body-secondary">
                              Menampilkan tarif parkir secara jelas tanpa biaya tersembunyi.
                            </p>

                        </div>
                      </div>

                      <!-- Card 6 -->
                      <div class="feature-card">

                        <div class="text-center">

                            <div class="mb-3">

                                <span class="badge bg-label-primary rounded-pill p-3">

                                    <i class="mdi mdi-parking"></i>

                                </span>

                            </div>

                            <h5 class="fw-semibold">
                                Informasi Slot Tersedia
                            </h5>

                            <p class="mb-0 text-body-secondary">
                              Mengetahui jumlah slot kosong yang tersedia sebelum tiba di lokasi.
                            </p>

                        </div>
                      </div>

                  </div>

              </div>

          </div>

      </section>
      <!-- Keunggulan Parkirin: End -->
      
      <!-- Pricing plans: Start -->
      <section id="membership" class="section-py bg-body landing-pricing min-vh-100 d-flex align-items-center">
        <div class="container bg-icon-left">
          <h6 class="text-center fw-semibold d-flex justify-content-center align-items-center mb-4">
            <img
              src="../../assets/img/front-pages/icons/section-tilte-icon.png"
              alt="section title icon"
              class="me-2" />
            <span class="text-uppercase">Membership ParkirIn</span>
          </h6>
          <h3 class="text-center mb-2"><span class="fw-bold">Pilih Membership yang Sesuai Kebutuhan Anda</span> </h3>
          <p class="text-center fw-medium mb-2 pt-3">
            Nikmati berbagai keuntungan eksklusif, diskon parkir,
            dan akses prioritas di seluruh area parkir yang bermitra dengan ParkirIn.
          </p>
          <div id="slider-pricing" class="mb-5"></div>
          <div class="row gy-4 justify-content-center">
            <!-- Free Plan: Start -->
            <div class="col-xl-4 col-lg-6">
              <div class="card shadow-none h-100">
                <div class="card-header border-0 pb-0">
                  <h3 class="mb-2 pb-1">Free</h3>
                  <div class="d-flex align-items-center">
                    <h5 class="d-flex mb-0"><span class="display-3 fw-bold">0</span></h5>
                    <div class="ms-2 ps-1">
                      <h6 class="mb-1">Gratis</h6>
                      <p class="small mb-0">Cocok untuk pengguna baru</p>
                    </div>
                  </div>
                  <img src="../../assets/img/front-pages/icons/smiling-icon.png" alt="smiling icon" />
                </div>
                <div class="card-body d-flex flex-column">
                  <ul class="list-unstyled mb-0 flex-grow-1">
                    <li class="mb-2">
                      <h6 class="mb-0">
                        <img src="../../assets/img/front-pages/icons/list-arrow-icon.png" alt="" class="me-2 scaleX-n1-rtl" style="width:16px;" />
                        Cari lokasi parkir
                      </h6>
                    </li>
                    <li class="mb-2">
                      <h6 class="mb-0">
                        <img src="../../assets/img/front-pages/icons/list-arrow-icon.png" alt="" class="me-2 scaleX-n1-rtl" style="width:16px;" />
                        Lihat slot tersedia realtime
                      </h6>
                    </li>
                    <li class="mb-2">
                      <h6 class="mb-0">
                        <img src="../../assets/img/front-pages/icons/list-arrow-icon.png" alt="" class="me-2 scaleX-n1-rtl" style="width:16px;" />
                        Pilih slot parkir
                      </h6>
                    </li>
                    <li class="mb-2">
                      <h6 class="mb-0">
                        <img src="../../assets/img/front-pages/icons/list-arrow-icon.png" alt="" class="me-2 scaleX-n1-rtl" style="width:16px;" />
                        Reservasi parkir
                      </h6>
                    </li>
                    <li class="mb-2">
                      <h6 class="mb-0">
                        <img src="../../assets/img/front-pages/icons/list-arrow-icon.png" alt="" class="me-2 scaleX-n1-rtl" style="width:16px;" />
                        Akses denah parkir
                      </h6>
                    </li>
                    <li class="mb-2">
                      <h6 class="mb-0">
                        <img src="../../assets/img/front-pages/icons/list-arrow-icon.png" alt="" class="me-2 scaleX-n1-rtl" style="width:16px;" />
                        Riwayat reservasi
                      </h6>
                    </li>
                  </ul>
                  <hr />
                  <div class="d-flex justify-content-between align-items-center flex-wrap">
                    <div class="me-1">
                      <h6 class="mb-1">Tanpa Biaya</h6>
                      <p class="small mb-0">Langsung bisa digunakan</p>
                    </div>
                    <span class="badge bg-label-secondary rounded-pill">Gratis</span>
                  </div>
                  <div class="text-center mt-4 pt-2">
                    <a href="register.html" class="btn btn-outline-secondary w-100">Mulai Gratis</a>
                  </div>
                </div>
              </div>
            </div>
            <!-- Free Plan: End -->

            <!-- Basic Plan: Start -->
            <div class="col-xl-4 col-lg-6">
              <div class="card shadow-none h-100">
                <div class="card-header border-0 pb-0">
                  <h3 class="mb-2 pb-1">Basic Membership</h3>
                  <div class="d-flex align-items-center">
                    <h5 class="d-flex mb-0"><sup class="h5 mt-3">Rp</sup><span class="display-3 fw-bold">49</span><sub class="h5 mb-1 align-self-end">.000</sub></h5>
                    <div class="ms-2 ps-1">
                      <h6 class="mb-1">Per Bulan</h6>
                      <p class="small mb-0">Berlaku di seluruh mitra ParkirIn</p>
                    </div>
                  </div>
                  <img src="../../assets/img/front-pages/icons/smiling-icon.png" alt="smiling icon" />
                </div>
                <div class="card-body d-flex flex-column">
                  <ul class="list-unstyled mb-0 flex-grow-1">
                    <li class="mb-2">
                      <h6 class="mb-0">
                        <img src="../../assets/img/front-pages/icons/list-arrow-icon.png" alt="" class="me-2 scaleX-n1-rtl" style="width:16px;" />
                        Semua fitur Pengguna Reguler
                      </h6>
                    </li>
                    <li class="mb-2">
                      <h6 class="mb-0">
                        <img src="../../assets/img/front-pages/icons/list-arrow-icon.png" alt="" class="me-2 scaleX-n1-rtl" style="width:16px;" />
                        Parkir gratis hingga 20 jam/bulan
                      </h6>
                    </li>
                    <li class="mb-2">
                      <h6 class="mb-0">
                        <img src="../../assets/img/front-pages/icons/list-arrow-icon.png" alt="" class="me-2 scaleX-n1-rtl" style="width:16px;" />
                        Diskon parkir di seluruh mitra ParkirIn
                      </h6>
                    </li>
                    <li class="mb-2">
                      <h6 class="mb-0">
                        <img src="../../assets/img/front-pages/icons/list-arrow-icon.png" alt="" class="me-2 scaleX-n1-rtl" style="width:16px;" />
                        Prioritas reservasi slot
                      </h6>
                    </li>
                    <li class="mb-2">
                      <h6 class="mb-0">
                        <img src="../../assets/img/front-pages/icons/list-arrow-icon.png" alt="" class="me-2 scaleX-n1-rtl" style="width:16px;" />
                        Fast Check-In
                      </h6>
                    </li>
                    <li class="mb-2">
                      <h6 class="mb-0">
                        <img src="../../assets/img/front-pages/icons/list-arrow-icon.png" alt="" class="me-2 scaleX-n1-rtl" style="width:16px;" />
                        Booking hingga 7 hari sebelumnya
                      </h6>
                    </li>
                  </ul>
                  <hr />
                  <div class="d-flex justify-content-between align-items-center flex-wrap">
                    <div class="me-1">
                      <h6 class="mb-1">Basic Support</h6>
                      <p class="small mb-0">Email & Chat</p>
                    </div>
                    <span class="badge bg-label-primary rounded-pill">Member Aktif</span>
                  </div>
                  <div class="text-center mt-4 pt-2">
                    <a href="payment-page.html" class="btn btn-outline-primary w-100">Pilih Paket</a>
                  </div>
                </div>
              </div>
            </div>
            <!-- Basic Plan: End -->
          </div>
        </div>
      </section>
      <!-- Pricing plans: End -->

    <!-- Reviews: Start -->
      <section id="ulasan-parkirin" class="section-py bg-white landing-reviews pb-0 min-vh-100 d-flex flex-column justify-content-center">
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
      <!-- Reviews: End -->

      <!-- Fun facts: Start -->
      <section id="landingFunFacts" class="section-py landing-fun-facts">
        <div class="container">
          <div class="row gx-0 gy-5 gx-sm-5">
            <div class="col-md-3 col-sm-6 text-center">
              <span class="badge badge-center rounded-pill bg-label-hover-primary fun-facts-icon mb-4"
                ><i class="tf-icons mdi mdi-map-marker-multiple mdi-36px"></i
              ></span>
              <h2 class="fw-bold mb-1">150+</h2>
              <p class="fw-medium mb-0">Area Mitra Parkir</p>
            </div>
            <div class="col-md-3 col-sm-6 text-center">
              <span class="badge badge-center rounded-pill bg-label-hover-success fun-facts-icon mb-4"
                ><i class="tf-icons mdi mdi-parking mdi-36px"></i
              ></span>
              <h2 class="fw-bold mb-1">5,000+</h2>
              <p class="fw-medium mb-0">Slot Tersedia</p>
            </div>
            <div class="col-md-3 col-sm-6 text-center">
              <span class="badge badge-center rounded-pill bg-label-hover-warning fun-facts-icon mb-4"
                ><i class="tf-icons mdi mdi-check-circle-outline mdi-36px"></i
              ></span>
              <h2 class="fw-bold mb-1">25,000+</h2>
              <p class="fw-medium mb-0">Reservasi Berhasil</p>
            </div>
            <div class="col-md-3 col-sm-6 text-center">
              <span class="badge badge-center rounded-pill bg-label-hover-info fun-facts-icon mb-4"
                ><i class="tf-icons mdi mdi-medal-outline mdi-36px"></i
              ></span>
              <h2 class="fw-bold mb-1">10,000+</h2>
              <p class="fw-medium mb-0">Pengguna Aktif</p>
            </div>
          </div>
        </div>
      </section>
      <!-- Fun facts: End -->

      <!-- FAQ: Start -->
      <section id="faq" class="section-py bg-body landing-faq">
        <div class="container bg-icon-right">
          <h6 class="text-center fw-semibold d-flex justify-content-center align-items-center mb-4">
            <img
              src="../../assets/img/front-pages/icons/section-tilte-icon.png"
              alt="section title icon"
              class="me-2" />
            <span class="text-uppercase">faq</span>
          </h6>
          <h3 class="text-center mb-2">Pertanyaan yang<span class="fw-bold"> Sering Diajukan</span></h3>
          <p class="text-center fw-medium mb-3 mb-md-5 pb-3">
            Temukan jawaban atas pertanyaan yang paling sering ditanyakan mengenai layanan ParkirIn.
          </p>
          <div class="row gy-5">
            <div class="col-lg-5">
              <div class="text-center">
                <img
                  src="{{ asset('assets/img/Faq/car-faq.png') }}"
                  alt="FAQ ParkirIn"
                  class="faq-image" />
              </div>
            </div>
            <div class="col-lg-7">
              <div class="accordion" id="accordionFront">
                <div class="accordion-item">
                  <h2 class="accordion-header" id="head-One">
                    <button
                      type="button"
                      class="accordion-button collapsed"
                      data-bs-toggle="collapse"
                      data-bs-target="#accordionOne"
                      aria-expanded="true"
                      aria-controls="accordionOne">
                      Apakah saya harus menjadi Member untuk menggunakan ParkirIn?
                    </button>
                  </h2>

                  <div
                    id="accordionOne"
                    class="accordion-collapse collapse"
                    data-bs-parent="#accordionFront"
                    aria-labelledby="accordionOne">
                    <div class="accordion-body">
                        Tidak. Semua pengguna dapat mencari lokasi parkir, melihat slot yang tersedia, dan melakukan reservasi secara gratis. Membership hanya memberikan keuntungan tambahan seperti diskon parkir, prioritas reservasi, dan jam parkir gratis.
                    </div>
                  </div>
                </div>
                <div class="accordion-item">
                  <h2 class="accordion-header" id="head-Two">
                    <button
                      type="button"
                      class="accordion-button collapsed"
                      data-bs-toggle="collapse"
                      data-bs-target="#accordionTwo"
                      aria-expanded="false"
                      aria-controls="accordionTwo">
                      Bagaimana cara melakukan reservasi tempat parkir?
                    </button>
                  </h2>
                  <div
                    id="accordionTwo"
                    class="accordion-collapse collapse"
                    aria-labelledby="accordionTwo"
                    data-bs-parent="#accordionFront">
                    <div class="accordion-body">
                      Pilih lokasi parkir yang diinginkan, lihat denah area parkir, pilih slot yang tersedia, lalu lakukan konfirmasi reservasi. Slot akan disimpan sesuai waktu yang telah ditentukan.
                    </div>
                  </div>
                </div>
                <div class="accordion-item active">
                  <h2 class="accordion-header" id="head-Three">
                    <button
                      type="button"
                      class="accordion-button"
                      data-bs-toggle="collapse"
                      data-bs-target="#accordionThree"
                      aria-expanded="true"
                      aria-controls="accordionThree">
                      Apakah informasi slot parkir diperbarui secara realtime?
                    </button>
                  </h2>
                  <div
                    id="accordionThree"
                    class="accordion-collapse collapse show"
                    aria-labelledby="accordionThree"
                    data-bs-parent="#accordionFront">
                    <div class="accordion-body">
                      Ya. ParkirIn menampilkan ketersediaan slot parkir secara realtime sehingga pengguna dapat mengetahui jumlah slot kosong sebelum tiba di lokasi.
                    </div>
                  </div>
                </div>
                <div class="accordion-item">
                  <h2 class="accordion-header" id="head-Four">
                    <button
                      type="button"
                      class="accordion-button collapsed"
                      data-bs-toggle="collapse"
                      data-bs-target="#accordionFour"
                      aria-expanded="false"
                      aria-controls="accordionFour">
                      Di mana saja layanan ParkirIn dapat digunakan?
                    </button>
                  </h2>
                  <div
                    id="accordionFour"
                    class="accordion-collapse collapse"
                    aria-labelledby="accordionFour"
                    data-bs-parent="#accordionFront">
                    <div class="accordion-body">
                      ParkirIn dapat digunakan di seluruh area parkir yang telah bekerja sama sebagai mitra resmi ParkirIn, seperti kampus, pusat perbelanjaan, perkantoran, dan lokasi publik lainnya.
                    </div>
                  </div>
                </div>
                <div class="accordion-item">
                  <h2 class="accordion-header" id="head-Five">
                    <button
                      type="button"
                      class="accordion-button collapsed"
                      data-bs-toggle="collapse"
                      data-bs-target="#accordionFive"
                      aria-expanded="false"
                      aria-controls="accordionFive">
                      Apa keuntungan menjadi Member ParkirIn?
                    </button>
                  </h2>
                  <div
                    id="accordionFive"
                    class="accordion-collapse collapse"
                    aria-labelledby="accordionFive"
                    data-bs-parent="#accordionFront">
                    <div class="accordion-body">
                      Member ParkirIn mendapatkan berbagai keuntungan seperti diskon parkir di lokasi mitra, prioritas reservasi slot, akses booking lebih awal, serta kuota parkir gratis setiap bulan sesuai paket membership yang dipilih.
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- FAQ: End -->

      <!-- Contact Us: Start -->
      <section id="landingContact" class="section-py bg-body landing-contact">
        <div class="container bg-icon-left">
          <h6 class="text-center fw-semibold d-flex justify-content-center align-items-center mb-4">
            <img
              src="{{ asset('assets/img/front-pages/icons/section-tilte-icon.png') }}"
              alt="section title icon"
              class="me-2" />
            <span class="text-uppercase">Hubungi Kami</span>
          </h6>

          <h3 class="text-center mb-2">
            <span class="fw-bold">Butuh Bantuan?</span> Hubungi Kami
          </h3>

          <p class="text-center fw-medium mb-3 mb-md-5 pb-3">
            Kami siap membantu terkait reservasi parkir, pembayaran, tiket QR, dan layanan ParkirIn.
          </p>

          <div class="row gy-4">

            <div class="col-lg-5">

              <div class="card h-100">

                <div class="bg-primary rounded text-white card-body">

                  <p class="fw-medium mb-1">
                    Tim Dukungan ParkirIn
                  </p>

                  <p class="display-6 mb-4">
                    Sampaikan pertanyaan, kritik, atau kendala Anda kepada kami.
                  </p>

                  <img
                    src="{{ asset('assets/img/ContactUs/contactus.png') }}"
                    alt="Hubungi Kami"
                    class="w-100 mb-3 pb-1" />

                </div>

              </div>

            </div>

            <div class="col-lg-7">

              <div class="card">

                <div class="card-body">

                  <h5 class="mb-4">
                    Kirim Pesan
                  </h5>

                  <form class="h-100 d-flex flex-column">

                    <div class="row g-3 flex-grow-1">

                        <div class="col-md-6">

                            <div class="form-floating form-floating-outline">

                                <input
                                    type="text"
                                    class="form-control"
                                    id="basic-default-fullname"
                                    placeholder="Masukkan nama lengkap" />

                                <label for="basic-default-fullname">
                                    Nama Lengkap
                                </label>

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-floating form-floating-outline">

                                <input
                                    type="email"
                                    class="form-control"
                                    id="basic-default-email"
                                    placeholder="Masukkan email aktif" />

                                <label for="basic-default-email">
                                    Alamat Email
                                </label>

                            </div>

                        </div>

                        <div class="col-12">

                            <div class="form-floating form-floating-outline h-100">

                                <textarea
                                    class="form-control h-100"
                                    placeholder="Tuliskan pertanyaan atau kendala Anda"
                                    aria-label="Pesan"
                                    id="basic-default-message"
                                    style="min-height:350px;"></textarea>

                                <label for="basic-default-message">
                                    Pesan
                                </label>

                            </div>

                        </div>

                    </div>

                    <button
                        type="submit"
                        class="btn btn-primary mt-3 align-self-start">

                        Kirim Pesan

                    </button>

                </form>

                </div>

              </div>

            </div>

          </div>

        </div>
      </section>
      <!-- Contact Us: End -->
    <!-- / Sections:End -->
    @endsection

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

/* ===== Background tambahan per section ===== */

#parkir-terdekat{
    background: linear-gradient(180deg, #0d0d14 0%, #16161f 100%) !important;
    color:#fff;
}

#parkir-terdekat .badge.bg-label-primary{
    background:rgba(115,103,240,.2)!important;
    color:#c4b8ff!important;
    border:1px solid rgba(115,103,240,.3);
}

#parkir-terdekat h2,
#parkir-terdekat .text-body-secondary{
    color:#b8b8c5!important;
}

#parkir-terdekat h2.fw-bold{
    color:#ffffff!important;
}

#cara-kerja{
    background: linear-gradient(180deg, #16161f 0%, #1a1a2e 100%) !important;
    color:#fff;
}

#cara-kerja h6,
#cara-kerja h3,
#cara-kerja h5{
    color:#ffffff!important;
}

#cara-kerja p{
    color:#b8b8c5!important;
}

#keunggulan-parkirin{
    background: linear-gradient(180deg, #1a1a2e 0%, #0d0d14 100%) !important;
    position: relative;
    color:#fff;
}

#keunggulan-parkirin h6,
#keunggulan-parkirin h3,
#keunggulan-parkirin h5{
    color:#ffffff!important;
}

#keunggulan-parkirin .text-body-secondary,
#keunggulan-parkirin p{
    color:#b8b8c5!important;
}

#keunggulan-parkirin .feature-card{
    background:rgba(255,255,255,.04);
    border:1px solid rgba(255,255,255,.08);
    border-radius:1rem;
}

#keunggulan-parkirin::before{
    content:"";
    position:absolute;
    top:-100px;
    left:50%;
    transform:translateX(-50%);
    width:600px;
    height:600px;
    background:rgba(115,103,240,.18);
    border-radius:50%;
    filter:blur(140px);
    pointer-events:none;
}

/* ===== MEMBERSHIP ===== */
#membership{
    background: linear-gradient(135deg, #0d0d14 0%, #16161f 60%, #1a1a2e 100%) !important;
    position: relative;
    overflow: hidden;
    color:#fff;
}

/* Judul section membership (di luar kartu) */
#membership > .container > h6,
#membership > .container > h3 {
    color:#ffffff!important;
}

#membership .text-body-secondary,
#membership > .container > p{
    color:#b8b8c5!important;
}

#membership .card{
    background:#ffffff;
}

/* Perbaikan: semua teks di dalam kartu membership → warna gelap */
#membership .card h3,
#membership .card h5,
#membership .card h6,
#membership .card .display-3,
#membership .card .display-4,
#membership .card .display-5,
#membership .card .fw-bold {
    color: #1a1a2e !important;
}

#membership .card p,
#membership .card .small,
#membership .card .text-muted,
#membership .card .text-body-secondary {
    color: #4a4a6a !important;
}

#membership .card .list-unstyled li h6,
#membership .card ul li h6 {
    color: #1a1a2e !important;
}

#membership .card hr {
    border-color: rgba(0,0,0,.1);
}

#membership .card .btn-outline-secondary {
    color: #4a4a6a !important;
    border-color: #4a4a6a !important;
}

#membership .card .btn-outline-primary {
    color: #7367f0 !important;
    border-color: #7367f0 !important;
}

#membership .card .btn-primary {
    background: #7367f0 !important;
    color: #ffffff !important;
    border-color: #7367f0 !important;
}

/* Badge di dalam kartu tetap berwarna */
#membership .card .badge.bg-label-secondary {
    background: rgba(0,0,0,.08) !important;
    color: #4a4a6a !important;
}

#membership .card .badge.bg-label-primary {
    background: rgba(115,103,240,.15) !important;
    color: #7367f0 !important;
}

#membership::after{
    content:"";
    position:absolute;
    bottom:-150px;
    right:-150px;
    width:400px;
    height:400px;
    background:rgba(167,139,250,.2);
    border-radius:50%;
    filter:blur(120px);
    pointer-events:none;
}

/* ===== ULASAN ===== */
#ulasan-parkirin{
    background: linear-gradient(180deg, #1a1a2e 0%, #16161f 100%) !important;
    color:#fff;
}

#ulasan-parkirin h6,
#ulasan-parkirin h3{
    color:#ffffff!important;
}

#ulasan-parkirin p{
    color:#b8b8c5!important;
}

#ulasan-parkirin .card{
    background:#ffffff;
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

/* ===== FAQ ===== */
#faq{
    background: linear-gradient(180deg, #16161f 0%, #0d0d14 100%) !important;
    color:#fff;
}

#faq h6,
#faq h3{
    color:#ffffff!important;
}

#faq p{
    color:#b8b8c5!important;
}

/* Perbaikan: accordion FAQ agar teks terbaca */
#faq .accordion-item {
    background: rgba(255,255,255,0.06) !important;
    border: 1px solid rgba(115,103,240,.25) !important;
    border-radius: 0.75rem !important;
    margin-bottom: 0.75rem;
}

#faq .accordion-button {
    background: rgba(255,255,255,0.06) !important;
    color: #ffffff !important;
    font-weight: 500;
    border-radius: 0.75rem !important;
}

#faq .accordion-button::after {
    filter: invert(1) brightness(2);
}

#faq .accordion-button:not(.collapsed) {
    background: rgba(115,103,240,.2) !important;
    color: #c4b8ff !important;
    box-shadow: none !important;
}

#faq .accordion-body {
    background: rgba(255,255,255,.02) !important;
    color: #b8b8c5 !important;
    border-top: 1px solid rgba(115,103,240,.2);
    border-radius: 0 0 0.75rem 0.75rem;
}

/* ===== CONTACT ===== */
#landingContact{
    background: radial-gradient(circle at 80% 20%, rgba(115,103,240,.15) 0%, transparent 50%), #0d0d14 !important;
    color:#fff;
}

#landingContact h6,
#landingContact h3{
    color:#ffffff!important;
}

#landingContact p{
    color:#b8b8c5!important;
}

#landingContact .card{
    background:#ffffff;
}
</style>