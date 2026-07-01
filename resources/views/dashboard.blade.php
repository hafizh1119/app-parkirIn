@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/swiper/swiper.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/front-page-landing.css') }}" />
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
                            <div class="card parking-card h-100 shadow-sm border-0">

                                <div class="position-relative">
                                    <img src="{{ asset($parkir->gambar) }}" class="card-img-top" style="height:220px;object-fit:cover;">
                                    <span class="badge position-absolute top-0 end-0 m-3 {{ $tersedia ? 'bg-success' : 'bg-danger' }}">
                                        {{ $tersedia ? 'Tersedia' : 'Penuh' }}
                                    </span>
                                </div>

                                <div class="card-body">

                                    <div class="d-flex justify-content-between mb-2">
                                        <h5 class="fw-semibold mb-0">{{ $parkir->nama }}</h5>
                                        <span class="text-warning">⭐ {{ $parkir->rating ?? '4.5' }}</span>
                                    </div>

                                    <p class="text-body-secondary mb-3">{{ $parkir->alamat }}</p>

                                    <div class="d-flex justify-content-between mb-3">
                                        <span>📍 -</span>
                                        <span class="fw-semibold">
                                            <i class="mdi mdi-motorbike text-primary"></i> {{ $parkir->slot_motor }}
                                            &nbsp;
                                            <i class="mdi mdi-car text-success"></i> {{ $parkir->slot_mobil }}
                                        </span>
                                    </div>

                                    <div class="border-top pt-3 mb-3">
                                        <small class="text-body-secondary">Tarif</small>
                                        <h6 class="fw-bold text-primary mb-0">
                                            Rp {{ number_format($parkir->tarif_per_jam, 0, ',', '.') }}/Jam
                                        </h6>
                                    </div>

                                    <a href="{{ route('customer.atur-jadwal', $parkir->id) }}" class="btn btn-primary w-100">
                                        Reservasi
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
                      class="btn btn-outline-primary btn-lg px-5">

                      Lihat Semua Lokasi

                  </a>
              </div>

          </div>

      </section>
      <!-- Lokasi: End -->

      <!-- Cara Kerja -->
      <div class="container pb-5">

        <!-- Heading -->
        <div class="text-center mt-5 mb-5">

            <h6 class="text-center fw-semibold d-flex justify-content-center align-items-center mb-3">
                <img
                    src="{{ asset('assets/img/front-pages/icons/section-tilte-icon.png') }}"
                    alt="section title icon"
                    class="me-2">

                <span class="text-uppercase">
                    Cara Kerja
                </span>
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
                          <div class="step-number">
                              1
                          </div>
                      </div>

                      <img
                          src="{{ asset('assets/img/cara-kerja/cari-lokasi.svg') }}"
                          class="cara-img"
                          alt="Cari Lokasi">

                      <div class="cara-body">
                          <h5>Cari Lokasi</h5>
                          <p>
                              Gunakan lokasi saat ini atau cari area parkir tujuan Anda.
                          </p>
                      </div>
                  </div>
              </div>

              <!-- Step 2 -->
              <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 d-flex justify-content-center">
                  <div class="cara-card">
                      <div class="step-header">
                          <div class="step-number step-green">
                              2
                          </div>
                      </div>

                      <img
                          src="{{ asset('assets/img/cara-kerja/pilih-area.svg') }}"
                          class="cara-img"
                          alt="Pilih Area">

                      <div class="cara-body">
                          <h5>Pilih Area</h5>
                          <p>
                              Lihat lokasi parkir terdekat beserta jumlah slot yang tersedia.
                          </p>
                      </div>
                  </div>
              </div>

              <!-- Step 3 -->
              <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 d-flex justify-content-center">
                  <div class="cara-card">
                      <div class="step-header">
                          <div class="step-number step-orange">
                              3
                          </div>
                      </div>

                      <img
                          src="{{ asset('assets/img/cara-kerja/pilih-slot.svg') }}"
                          class="cara-img"
                          alt="Pilih Slot">

                      <div class="cara-body">
                          <h5>Pilih Slot</h5>
                          <p>
                              Tentukan slot parkir melalui denah parkir interaktif secara realtime.
                          </p>
                      </div>
                  </div>
              </div>

              <!-- Step 4 -->
              <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 d-flex justify-content-center">
                  <div class="cara-card">
                      <div class="step-header">
                          <div class="step-number step-blue">
                              4
                          </div>
                      </div>

                      <img
                          src="{{ asset('assets/img/cara-kerja/reservasi.svg') }}"
                          class="cara-img"
                          alt="Reservasi">
                      <div class="cara-body">
                          <h5>Reservasi</h5>
                          <p>
                              Konfirmasi pemesanan dan langsung parkir tanpa mencari tempat kosong.
                          </p>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      
      <!-- Pricing plans: Start -->
      <section id="membership" class="bg-body landing-pricing pt-5 pb-5">
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
                    <h3 class="mb-2 pb-1">Non Member</h3>

                    <div class="d-flex align-items-center">
                      <h5 class="d-flex mb-0">
                        <span class="display-3 fw-bold">0</span>
                      </h5>

                      <div class="ms-2 ps-1">
                        <h6 class="mb-1">Gratis</h6>
                        <p class="small mb-0">Tanpa biaya keanggotaan</p>
                      </div>
                    </div>

                    <img src="../../assets/img/front-pages/icons/smiling-icon.png" alt="" />
                  </div>

                  <div class="card-body d-flex flex-column">
                    <ul class="list-unstyled mb-0 flex-grow-1">

                    <li class="d-flex align-items-center mb-3">
                      <img src="../../assets/img/front-pages/icons/list-arrow-icon.png"
                          alt=""
                          class="me-2"
                          width="16">
                      <span>Reservasi slot parkir</span>
                    </li>

                    <li class="d-flex align-items-center mb-3">
                      <img src="../../assets/img/front-pages/icons/list-arrow-icon.png"
                          alt=""
                          class="me-2"
                          width="16">
                      <span>Pembayaran online</span>
                    </li>

                    <li class="d-flex align-items-center mb-3">
                      <img src="../../assets/img/front-pages/icons/list-arrow-icon.png"
                          alt=""
                          class="me-2"
                          width="16">
                      <span>QR Code tiket parkir</span>
                    </li>

                    <li class="d-flex align-items-center mb-3">
                      <img src="../../assets/img/front-pages/icons/list-arrow-icon.png"
                          alt=""
                          class="me-2"
                          width="16">
                      <span>Riwayat reservasi</span>
                    </li>

                    <li class="d-flex align-items-center mb-3">
                      <img src="../../assets/img/front-pages/icons/list-arrow-icon.png"
                          alt=""
                          class="me-2"
                          width="16">
                      <span>Kelola kendaraan</span>
                    </li>

                    <li class="d-flex align-items-center mb-3">
                      <img src="../../assets/img/front-pages/icons/list-arrow-icon.png"
                          alt=""
                          class="me-2"
                          width="16">
                      <span>Akses seluruh lokasi ParkirIn</span>
                    </li>

                  </ul>

                  <hr>

                  <div class="d-flex justify-content-between align-items-center">
                    <div>
                      <h6 class="mb-1">Status</h6>
                      <p class="small mb-0">Pengguna Reguler</p>
                    </div>

                    <span class="badge bg-label-secondary rounded-pill">
                      Gratis
                    </span>
                  </div>

                  <div class="text-center mt-4 pt-2">
                    <a href="register.html" class="btn btn-outline-secondary w-100">
                      Mulai Gratis
                    </a>
                  </div>

                </div>
              </div>
            </div>
            <!-- Free Plan: End -->

            <!-- Basic Plan: Start -->
            <div class="col-xl-4 col-lg-6">
              <div class="card shadow-none h-100 border border-primary">
                <div class="card-header border-0 pb-0">
                  <span class="badge bg-primary mb-3">
                    PALING POPULER
                  </span>

                  <h3 class="mb-2 pb-1">
                    Member ParkirIn
                  </h3>

                  <div class="d-flex align-items-center">

                    <h5 class="d-flex mb-0">
                      <sup class="h5 mt-3">Rp</sup>
                      <span class="display-3 fw-bold">50</span>
                      <sub class="h5 mb-1">.000</sub>
                    </h5>

                    <div class="ms-2 ps-1">
                      <h6 class="mb-1">Lifetime</h6>
                      <p class="small mb-0">
                        Bayar sekali, aktif selamanya
                      </p>
                    </div>

                  </div>

                  <img src="../../assets/img/front-pages/icons/smiling-icon.png" alt="" />

                </div>

                <div class="card-body d-flex flex-column">

                  <ul class="list-unstyled mb-0 flex-grow-1">

                    <li class="d-flex align-items-center mb-3">
                      <img src="../../assets/img/front-pages/icons/list-arrow-icon.png"
                          alt=""
                          class="me-2"
                          width="16">
                      <span>Semua fitur Non Member</span>
                    </li>

                    <li class="d-flex align-items-center mb-3">
                      <img src="../../assets/img/front-pages/icons/list-arrow-icon.png"
                          alt=""
                          class="me-2"
                          width="16">
                      <span>Dapat Point setiap transaksi</span>
                    </li>

                    <li class="d-flex align-items-center mb-3">
                      <img src="../../assets/img/front-pages/icons/list-arrow-icon.png"
                          alt=""
                          class="me-2"
                          width="16">
                      <span>Tukarkan Point menjadi potongan harga</span>
                    </li>

                    <li class="d-flex align-items-center mb-3">
                      <img src="../../assets/img/front-pages/icons/list-arrow-icon.png"
                          alt=""
                          class="me-2"
                          width="16">
                      <span>Member Day diskon 10% (syarat transaksi terpenuhi)</span>
                    </li>

                    <li class="d-flex align-items-center mb-3">
                      <img src="../../assets/img/front-pages/icons/list-arrow-icon.png"
                          alt=""
                          class="me-2"
                          width="16">
                      <span>Berlaku jika aktif bertransaksi</span>
                    </li>

                    <li class="d-flex align-items-center mb-3">
                      <img src="../../assets/img/front-pages/icons/list-arrow-icon.png"
                          alt=""
                          class="me-2"
                          width="16">
                      <span>Riwayat Point & Reward</span>
                    </li>

                  </ul>

                  <hr>

                  <div class="d-flex justify-content-between align-items-center">
                    <div>
                      <h6 class="mb-1">Status</h6>
                      <p class="small mb-0">Member Lifetime</p>
                    </div>

                    <span class="badge bg-label-primary rounded-pill">
                      Lifetime
                    </span>
                  </div>

                  <div class="text-center mt-4 pt-2">
                    <a href="payment-page.html" class="btn btn-primary w-100">
                      Daftar Member
                    </a>
                  </div>

                </div>

              </div>
            </div>
            <!-- Basic Plan: End -->
          </div>
        </div>
      </section>
      <!-- Pricing plans: End -->

      <!-- Keunggulan Parkirin: Start -->
      <section id="keunggulan-parkirin" class="min-vh-100 d-flex align-items-center overflow-hidden">
          <div class="container-fluid">
              <!-- CARD 1 -->
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
.parkirin-card{

    width:360px;
    height:500px;

    background:#fff;

    border-radius:30px;

    overflow:hidden;

    position:relative;

    border:1px solid #ECECEC;

    box-shadow:
        0 8px 25px rgba(0,0,0,.05);

    transition:.35s;
}

.parkirin-card:hover{

    transform:translateY(-8px);

    box-shadow:
        0 20px 45px rgba(0,0,0,.12);

}

.parkirin-body{

    padding:30px;

}

.parkirin-body h3{

    font-size:34px;

    font-weight:700;

    color:#404040;

    line-height:1.2;

    margin-bottom:22px;

}

.parkirin-body p{

    font-size:18px;

    line-height:1.6;

    color:#666;

    margin:0;

}

.parkirin-image{

    position:absolute;

    left:0;

    right:0;

    bottom:0;

    width:100%;

    height:230px;

    object-fit:cover;

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