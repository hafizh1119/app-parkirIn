@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/swiper/swiper.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/front-page-landing.css') }}" />
@endpush

@section('content')

    <!-- Sections:Start -->

    <section id="dashboard" class="hero-section position-relative overflow-hidden min-vh-100 d-flex align-items-center">

          <!-- Background Blur -->
          <div class="hero-blur hero-blur-1"></div>
          <div class="hero-blur hero-blur-2"></div>

          <div class="container">

              <div class="row align-items-center gy-5">

                  <!-- Kiri -->
                  <div class="col-lg-6">

                      <span class="badge bg-label-primary rounded-pill px-4 py-2 mb-4">
                          🚗 Smart Parking Platform
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

                          <a href="#cari-parkir" class="btn btn-primary btn-lg">
                              Cari Parkir
                          </a>

                          <a href="#cara-kerja" class="btn btn-outline-primary btn-lg">
                              Cara Kerja
                          </a>

                      </div>

                  </div>

                  <!-- Kanan -->
                  <div class="col-lg-5 offset-lg-1">

                      <div class="card border-0 shadow-lg rounded-4">

                          <div class="card-body p-4 p-lg-5">

                              <div class="text-center mb-4">

                                  <div
                                      class="avatar avatar-lg mx-auto mb-3 bg-label-primary rounded-circle">

                                      <span class="mdi mdi-map-marker fs-2"></span>

                                  </div>

                                  <h4 class="fw-bold mb-1">
                                      Cari Lokasi Parkir
                                  </h4>

                                  <p class="text-body-secondary mb-0">
                                      Temukan area parkir terdekat dari lokasi Anda
                                  </p>

                              </div>

                              <div class="mb-3">

                                  <label class="form-label">
                                      Lokasi Anda
                                  </label>

                                  <input
                                      type="text"
                                      class="form-control"
                                      placeholder="Contoh: Semarang">

                              </div>

                              <div class="mb-4">

                                  <label class="form-label">
                                      Jenis Kendaraan
                                  </label>

                                  <select class="form-select">
                                      <option>Mobil</option>
                                      <option>Motor</option>
                                  </select>

                              </div>

                              <button
                                  class="btn btn-primary w-100 btn-lg">

                                  <span class="mdi mdi-magnify me-1"></span>
                                  Cari Sekarang

                              </button>

                              <div class="text-center mt-3">

                                  <a href="#"
                                      class="text-primary text-decoration-none">

                                      📍 Gunakan Lokasi Saat Ini

                                  </a>

                              </div>

                          </div>

                      </div>

                  </div>

              </div>

          </div>

      </section>

      <section id="parkir-terdekat" class="section-py bg-body position-relative d-flex align-items-center min-vh-100">

          <div class="container">

              <!-- Heading -->
              <div class="text-center mb-5">

                  <span class="badge bg-label-primary rounded-pill mb-3 px-3 py-2">
                      📍 Nearby Parking
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

                  <div class="col-lg-4 col-md-6">
                      <div class="card parking-card h-100 shadow-sm border-0">
                          <div class="position-relative">
                              <img
                                  src="https://blog.getandride.com/wp-content/uploads/2023/05/ukuran-parkiran-mobil.jpg"
                                  class="card-img-top"
                                  style="height:220px;object-fit:cover;">
                              <span class="badge bg-success position-absolute top-0 end-0 m-3">
                                  Tersedia
                              </span>
                          </div>
                          <div class="card-body">
                              <div class="d-flex justify-content-between mb-2">
                                  <h5 class="fw-semibold mb-0">Parkir UDINUS</h5>
                                  <span class="text-warning">⭐ 4.8</span>
                              </div>
                              <p class="text-body-secondary mb-3">
                                  Jl. Imam Bonjol No.207 Semarang
                              </p>
                              <div class="d-flex justify-content-between mb-3">
                                  <span>📍 1.2 km</span>
                                  <span class="text-success fw-semibold">25 Slot</span>
                              </div>
                              <a href="/customer/denah" class="btn btn-primary w-100">
                                  Lihat Denah
                              </a>
                          </div>
                      </div>
                  </div>

                  <div class="col-lg-4 col-md-6">
                      <div class="card parking-card h-100 shadow-sm border-0">
                          <div class="position-relative">
                              <img
                                  src="https://blog.getandride.com/wp-content/uploads/2023/05/ukuran-parkiran-mobil.jpg"
                                  class="card-img-top"
                                  style="height:220px;object-fit:cover;">
                              <span class="badge bg-success position-absolute top-0 end-0 m-3">
                                  Tersedia
                              </span>
                          </div>
                          <div class="card-body">
                              <div class="d-flex justify-content-between mb-2">
                                  <h5 class="fw-semibold mb-0">Parkir UDINUS</h5>
                                  <span class="text-warning">⭐ 4.8</span>
                              </div>
                              <p class="text-body-secondary mb-3">
                                  Jl. Imam Bonjol No.207 Semarang
                              </p>
                              <div class="d-flex justify-content-between mb-3">
                                  <span>📍 1.2 km</span>
                                  <span class="text-success fw-semibold">25 Slot</span>
                              </div>
                              <a href="/customer/denah" class="btn btn-primary w-100">
                                  Lihat Denah
                              </a>
                          </div>
                      </div>
                  </div>

                  <div class="col-lg-4 col-md-6">
                      <div class="card parking-card h-100 shadow-sm border-0">
                          <div class="position-relative">
                              <img
                                  src="https://blog.getandride.com/wp-content/uploads/2023/05/ukuran-parkiran-mobil.jpg"
                                  class="card-img-top"
                                  style="height:220px;object-fit:cover;">
                              <span class="badge bg-success position-absolute top-0 end-0 m-3">
                                  Tersedia
                              </span>
                          </div>
                          <div class="card-body">
                              <div class="d-flex justify-content-between mb-2">
                                  <h5 class="fw-semibold mb-0">Parkir UDINUS</h5>
                                  <span class="text-warning">⭐ 4.8</span>
                              </div>
                              <p class="text-body-secondary mb-3">
                                  Jl. Imam Bonjol No.207 Semarang
                              </p>
                              <div class="d-flex justify-content-between mb-3">
                                  <span>📍 1.2 km</span>
                                  <span class="text-success fw-semibold">25 Slot</span>
                              </div>
                              <a href="/customer/denah" class="btn btn-primary w-100">
                                  Lihat Denah
                              </a>
                          </div>
                      </div>
                  </div>

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
    <!-- Reviews: Start -->
<section id="landingReviews" class="section-py bg-body landing-reviews pb-0 min-vh-100 d-flex flex-column justify-content-center">
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

  {{-- Spacer agar pagination tidak nempel hr --}}
  <div class="pb-4"></div>

  <hr class="m-0" />
</section>
<!-- Reviews: End -->

      <!-- Pricing plans: Start -->
      <section id="landingPricing" class="section-py bg-body landing-pricing">
        <div class="container bg-icon-left">
          <h6 class="text-center fw-semibold d-flex justify-content-center align-items-center mb-4">
            <img
              src="../../assets/img/front-pages/icons/section-tilte-icon.png"
              alt="section title icon"
              class="me-2" />
            <span class="text-uppercase">pricing plans</span>
          </h6>
          <h3 class="text-center mb-2"><span class="fw-bold">Tailored pricing plans</span> designed for you</h3>
          <p class="text-center fw-medium mb-5 pt-3 pb-lg-5">
            All plans include 40+ advanced tools and features to boost your product.<br />
            the best plan to fit your needs.
          </p>
          <div id="slider-pricing" class="mb-5"></div>
          <div class="row gy-4 pt-lg-3">
            <!-- Basic Plan: Start -->
            <div class="col-xl-4 col-lg-6">
              <div class="card shadow-none">
                <div class="card-header border-0">
                  <h3 class="mb-2 pb-1">Basic Plan</h3>
                  <div class="d-flex align-items-center">
                    <h5 class="d-flex mb-0"><sup class="h5 mt-3">$</sup><span class="display-3 fw-bold">20</span></h5>
                    <div class="ms-2 ps-1">
                      <h6 class="mb-1">Per month</h6>
                      <p class="small mb-0">10% off for yearly subscription</p>
                    </div>
                  </div>
                  <img src="../../assets/img/front-pages/icons/smiling-icon.png" alt="smiling icon" />
                </div>
                <div class="card-body">
                  <ul class="list-unstyled">
                    <li>
                      <h5>
                        <img
                          src="../../assets/img/front-pages/icons/list-arrow-icon.png"
                          alt="list arrow icon"
                          class="me-2 pe-1 scaleX-n1-rtl" />
                        Timeline
                      </h5>
                    </li>
                    <li>
                      <h5>
                        <img
                          src="../../assets/img/front-pages/icons/list-arrow-icon.png"
                          alt="list arrow icon"
                          class="me-2 pe-1 scaleX-n1-rtl" />
                        Basic search
                      </h5>
                    </li>
                    <li>
                      <h5>
                        <img
                          src="../../assets/img/front-pages/icons/list-arrow-icon.png"
                          alt="list arrow icon"
                          class="me-2 pe-1 scaleX-n1-rtl" />
                        Live chat widget
                      </h5>
                    </li>
                    <li>
                      <h5>
                        <img
                          src="../../assets/img/front-pages/icons/list-arrow-icon.png"
                          alt="list arrow icon"
                          class="me-2 pe-1 scaleX-n1-rtl" />
                        Email marketing
                      </h5>
                    </li>
                    <li>
                      <h5>
                        <img
                          src="../../assets/img/front-pages/icons/list-arrow-icon.png"
                          alt="list arrow icon"
                          class="me-2 pe-1 scaleX-n1-rtl" />
                        Custom Forms
                      </h5>
                    </li>
                    <li>
                      <h5>
                        <img
                          src="../../assets/img/front-pages/icons/list-arrow-icon.png"
                          alt="list arrow icon"
                          class="me-2 pe-1 scaleX-n1-rtl" />
                        Traffic analytics
                      </h5>
                    </li>
                  </ul>
                  <hr />
                  <div class="d-flex justify-content-between align-items-center flex-wrap">
                    <div class="me-1">
                      <h6 class="mb-1">Basic Support</h6>
                      <p class="small mb-0">Only Email</p>
                    </div>
                    <span class="badge bg-label-primary rounded-pill">AVG. Time: 24h</span>
                  </div>
                  <div class="text-center mt-4 pt-2">
                    <a href="payment-page.html" class="btn btn-outline-primary w-100">Get Started</a>
                  </div>
                </div>
              </div>
            </div>
            <!-- Basic Plan: End -->

            <!-- Favourite Plan: Start -->
            <div class="col-xl-4 col-lg-6">
              <div class="card border-primary border-2 shadow-none">
                <div class="card-header border-0">
                  <h3 class="mb-2 pb-1">Favourite Plan</h3>
                  <div class="d-flex align-items-center">
                    <h5 class="d-flex mb-0"><sup class="h5 mt-3">$</sup><span class="display-3 fw-bold">51</span></h5>
                    <div class="ms-2 ps-1">
                      <h6 class="mb-1">Per month</h6>
                      <p class="small mb-0">10% off for yearly subscription</p>
                    </div>
                  </div>
                  <img src="../../assets/img/front-pages/icons/smiling-icon.png" alt="smiling icon" />
                </div>
                <div class="card-body">
                  <ul class="list-unstyled">
                    <li>
                      <h5>
                        <img
                          src="../../assets/img/front-pages/icons/list-arrow-icon.png"
                          alt="list arrow icon"
                          class="me-2 pe-1 scaleX-n1-rtl" />
                        Everything in basic
                      </h5>
                    </li>
                    <li>
                      <h5>
                        <img
                          src="../../assets/img/front-pages/icons/list-arrow-icon.png"
                          alt="list arrow icon"
                          class="me-2 pe-1 scaleX-n1-rtl" />
                        Timeline with database
                      </h5>
                    </li>
                    <li>
                      <h5>
                        <img
                          src="../../assets/img/front-pages/icons/list-arrow-icon.png"
                          alt="list arrow icon"
                          class="me-2 pe-1 scaleX-n1-rtl" />
                        Advanced search
                      </h5>
                    </li>
                    <li>
                      <h5>
                        <img
                          src="../../assets/img/front-pages/icons/list-arrow-icon.png"
                          alt="list arrow icon"
                          class="me-2 pe-1 scaleX-n1-rtl" />
                        Marketing automation
                      </h5>
                    </li>
                    <li>
                      <h5>
                        <img
                          src="../../assets/img/front-pages/icons/list-arrow-icon.png"
                          alt="list arrow icon"
                          class="me-2 pe-1 scaleX-n1-rtl" />
                        Advanced chatbot
                      </h5>
                    </li>
                    <li>
                      <h5>
                        <img
                          src="../../assets/img/front-pages/icons/list-arrow-icon.png"
                          alt="list arrow icon"
                          class="me-2 pe-1 scaleX-n1-rtl" />
                        Campaign management
                      </h5>
                    </li>
                  </ul>
                  <hr />
                  <div class="d-flex justify-content-between align-items-center flex-wrap">
                    <div class="me-1">
                      <h6 class="mb-1">Standard Support</h6>
                      <p class="small mb-0">Email & Chat</p>
                    </div>
                    <span class="badge bg-label-primary rounded-pill">AVG. Time: 6h</span>
                  </div>
                  <div class="text-center mt-4 pt-2">
                    <a href="payment-page.html" class="btn btn-primary w-100">Get Started</a>
                  </div>
                </div>
              </div>
            </div>
            <!-- Favourite Plan: End -->

            <!-- Standard Plan: Start -->
            <div class="col-xl-4 col-lg-6">
              <div class="card shadow-none">
                <div class="card-header border-0">
                  <h3 class="mb-2 pb-1">Standard Plan</h3>
                  <div class="d-flex align-items-center">
                    <h5 class="d-flex mb-0"><sup class="h5 mt-3">$</sup><span class="display-3 fw-bold">99</span></h5>
                    <div class="ms-2 ps-1">
                      <h6 class="mb-1">Per month</h6>
                      <p class="small mb-0">10% off for yearly subscription</p>
                    </div>
                  </div>
                  <img src="../../assets/img/front-pages/icons/smiling-icon.png" alt="smiling icon" />
                </div>
                <div class="card-body">
                  <ul class="list-unstyled">
                    <li>
                      <h5>
                        <img
                          src="../../assets/img/front-pages/icons/list-arrow-icon.png"
                          alt="list arrow icon"
                          class="me-2 pe-1 scaleX-n1-rtl" />
                        Everything in premium
                      </h5>
                    </li>
                    <li>
                      <h5>
                        <img
                          src="../../assets/img/front-pages/icons/list-arrow-icon.png"
                          alt="list arrow icon"
                          class="me-2 pe-1 scaleX-n1-rtl" />
                        Timeline with database
                      </h5>
                    </li>
                    <li>
                      <h5>
                        <img
                          src="../../assets/img/front-pages/icons/list-arrow-icon.png"
                          alt="list arrow icon"
                          class="me-2 pe-1 scaleX-n1-rtl" />
                        Fuzzy search
                      </h5>
                    </li>
                    <li>
                      <h5>
                        <img
                          src="../../assets/img/front-pages/icons/list-arrow-icon.png"
                          alt="list arrow icon"
                          class="me-2 pe-1 scaleX-n1-rtl" />
                        A/B testing sanbox
                      </h5>
                    </li>
                    <li>
                      <h5>
                        <img
                          src="../../assets/img/front-pages/icons/list-arrow-icon.png"
                          alt="list arrow icon"
                          class="me-2 pe-1 scaleX-n1-rtl" />
                        Custom permissions
                      </h5>
                    </li>
                    <li>
                      <h5>
                        <img
                          src="../../assets/img/front-pages/icons/list-arrow-icon.png"
                          alt="list arrow icon"
                          class="me-2 pe-1 scaleX-n1-rtl" />
                        Social media automation
                      </h5>
                    </li>
                  </ul>
                  <hr />
                  <div class="d-flex justify-content-between align-items-center flex-wrap">
                    <div class="me-1">
                      <h6 class="mb-1">Exclusive Support</h6>
                      <p class="small mb-0">Email, Chat & Google Meet</p>
                    </div>
                    <span class="badge bg-label-primary rounded-pill">Live Support</span>
                  </div>
                  <div class="text-center mt-4 pt-2">
                    <a href="payment-page.html" class="btn btn-outline-primary w-100">Get Started</a>
                  </div>
                </div>
              </div>
            </div>
            <!-- Standard Plan: End -->
          </div>
        </div>
      </section>
      <!-- Pricing plans: End -->

      <!-- Fun facts: Start -->
      <section id="landingFunFacts" class="section-py landing-fun-facts">
        <div class="container">
          <div class="row gx-0 gy-5 gx-sm-5">
            <div class="col-md-3 col-sm-6 text-center">
              <span class="badge badge-center rounded-pill bg-label-hover-primary fun-facts-icon mb-4"
                ><i class="tf-icons mdi mdi-land-plots mdi-36px"></i
              ></span>
              <h2 class="fw-bold mb-1">137+</h2>
              <p class="fw-medium mb-0">Completed Sites</p>
            </div>
            <div class="col-md-3 col-sm-6 text-center">
              <span class="badge badge-center rounded-pill bg-label-hover-success fun-facts-icon mb-4"
                ><i class="tf-icons mdi mdi-clock-outline mdi-36px"></i
              ></span>
              <h2 class="fw-bold mb-1">1,100+</h2>
              <p class="fw-medium mb-0">Working Hours</p>
            </div>
            <div class="col-md-3 col-sm-6 text-center">
              <span class="badge badge-center rounded-pill bg-label-hover-warning fun-facts-icon mb-4"
                ><i class="tf-icons mdi mdi-emoticon-happy-outline mdi-36px"></i
              ></span>
              <h2 class="fw-bold mb-1">137+</h2>
              <p class="fw-medium mb-0">Happy Customers</p>
            </div>
            <div class="col-md-3 col-sm-6 text-center">
              <span class="badge badge-center rounded-pill bg-label-hover-info fun-facts-icon mb-4"
                ><i class="tf-icons mdi mdi-medal-outline mdi-36px"></i
              ></span>
              <h2 class="fw-bold mb-1">23+</h2>
              <p class="fw-medium mb-0">Awards Winning</p>
            </div>
          </div>
        </div>
      </section>
      <!-- Fun facts: End -->

      <!-- FAQ: Start -->
      <section id="landingFAQ" class="section-py bg-body landing-faq">
        <div class="container bg-icon-right">
          <h6 class="text-center fw-semibold d-flex justify-content-center align-items-center mb-4">
            <img
              src="../../assets/img/front-pages/icons/section-tilte-icon.png"
              alt="section title icon"
              class="me-2" />
            <span class="text-uppercase">faq</span>
          </h6>
          <h3 class="text-center mb-2">Frequently asked<span class="fw-bold"> questions</span></h3>
          <p class="text-center fw-medium mb-3 mb-md-5 pb-3">
            Browse through these FAQs to find answers to commonly asked questions.
          </p>
          <div class="row gy-5">
            <div class="col-lg-5">
              <div class="text-center">
                <img
                  src="../../assets/img/front-pages/landing-page/sitting-girl-with-laptop.png
          "
                  alt="sitting girl with laptop"
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
                      Do you charge for each upgrade?
                    </button>
                  </h2>

                  <div
                    id="accordionOne"
                    class="accordion-collapse collapse"
                    data-bs-parent="#accordionFront"
                    aria-labelledby="accordionOne">
                    <div class="accordion-body">
                      Lemon drops chocolate cake gummies carrot cake chupa chups muffin topping. Sesame snaps icing
                      marzipan gummi bears macaroon dragée danish caramels powder. Bear claw dragée pastry topping
                      soufflé. Wafer gummi bears marshmallow pastry pie.
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
                      Do I need to purchase a license for each website?
                    </button>
                  </h2>
                  <div
                    id="accordionTwo"
                    class="accordion-collapse collapse"
                    aria-labelledby="accordionTwo"
                    data-bs-parent="#accordionFront">
                    <div class="accordion-body">
                      Dessert ice cream donut oat cake jelly-o pie sugar plum cheesecake. Bear claw dragée oat cake
                      dragée ice cream halvah tootsie roll. Danish cake oat cake pie macaroon tart donut gummies. Jelly
                      beans candy canes carrot cake. Fruitcake chocolate chupa chups.
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
                      What is regular license?
                    </button>
                  </h2>
                  <div
                    id="accordionThree"
                    class="accordion-collapse collapse show"
                    aria-labelledby="accordionThree"
                    data-bs-parent="#accordionFront">
                    <div class="accordion-body">
                      Regular license can be used for end products that do not charge users for access or service(access
                      is free and there will be no monthly subscription fee). Single regular license can be used for
                      single end product and end product can be used by you or your client. If you want to sell end
                      product to multiple clients then you will need to purchase separate license for each client. The
                      same rule applies if you want to use the same end product on multiple domains(unique setup). For
                      more info on regular license you can check official description.
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
                      What is extended license?
                    </button>
                  </h2>
                  <div
                    id="accordionFour"
                    class="accordion-collapse collapse"
                    aria-labelledby="accordionFour"
                    data-bs-parent="#accordionFront">
                    <div class="accordion-body">
                      Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis et aliquid quaerat possimus maxime!
                      Mollitia reprehenderit neque repellat deleniti delectus architecto dolorum maxime, blanditiis
                      earum ea, incidunt quam possimus cumque.
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
                      Which license is applicable for SASS application?
                    </button>
                  </h2>
                  <div
                    id="accordionFive"
                    class="accordion-collapse collapse"
                    aria-labelledby="accordionFive"
                    data-bs-parent="#accordionFront">
                    <div class="accordion-body">
                      Lorem ipsum dolor sit amet consectetur, adipisicing elit. Sequi molestias exercitationem ab cum
                      nemo facere voluptates veritatis quia, eveniet veniam at et repudiandae mollitia ipsam quasi
                      labore enim architecto non!
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- FAQ: End -->

      <!-- CTA: Start -->
      <section id="landingCTA" class="section-py border border-2 landing-cta p-lg-0 pb-0">
        <div class="container">
          <div class="row align-items-center gy-5 gy-lg-0">
            <div class="col-lg-6 text-center text-lg-start">
              <h6 class="h2 text-primary fw-bold mb-1">Ready to Get Started?</h6>
              <p class="fw-medium mb-4">Start your project with a 14-day free trial</p>
              <a href="payment-page.html" class="btn btn-primary"
                >Get Started<i class="mdi mdi-arrow-right mdi-24px ms-3 scaleX-n1-rtl"></i
              ></a>
            </div>
            <div class="col-lg-6 pt-lg-5">
              <img
                src="{{ asset('assets/img/front-pages/landing-page/cta-dashboard.png') }}"
                alt="cta dashboard"
                class="img-fluid" />
            </div>
          </div>
        </div>
      </section>
      <!-- CTA: End -->

      <!-- Contact Us: Start -->
      <section id="landingContact" class="section-py bg-body landing-contact">
        <div class="container bg-icon-left">
          <h6 class="text-center fw-semibold d-flex justify-content-center align-items-center mb-4">
            <img
              src="{{ asset('assets/img/front-pages/icons/section-tilte-icon.png') }}"
              alt="section title icon"
              class="me-2" />
            <span class="text-uppercase">contact us</span>
          </h6>
          <h3 class="text-center mb-2"><span class="fw-bold">Lets work</span> together</h3>
          <p class="text-center fw-medium mb-3 mb-md-5 pb-3">Any question or remark? just write us a message</p>
          <div class="row gy-4">
            <div class="col-lg-5">
              <div class="card h-100">
                <div class="bg-primary rounded text-white card-body">
                  <p class="fw-medium mb-1">Let’s contact with us</p>
                  <p class="display-6 mb-4">Share your ideas or requirement with our experts.</p>
                  <img
                    src="{{ asset('assets/img/front-pages/landing-page/let’s-contact.png') }}"
                    alt="let’s contact"
                    class="w-100 mb-2 pb-1" />
                  <p class="mb-0">
                    Looking for more customisation, more features, and more anything? Don’t worry, We’ve provide you
                    with an entire team of experienced professionals.
                  </p>
                </div>
              </div>
            </div>
            <div class="col-lg-7">
              <div class="card">
                <div class="card-body">
                  <h5 class="mb-4">Share your ideas</h5>
                  <form>
                    <div class="row g-3">
                      <div class="col-md-6">
                        <div class="form-floating form-floating-outline">
                          <input type="text" class="form-control" id="basic-default-fullname" placeholder="John Doe" />
                          <label for="basic-default-fullname">Full name</label>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-floating form-floating-outline">
                          <input
                            type="email"
                            class="form-control"
                            id="basic-default-email"
                            placeholder="johndoe99@gmail.com" />
                          <label for="basic-default-email">Email address</label>
                        </div>
                      </div>

                      <div class="col-12">
                        <div class="form-floating form-floating-outline">
                          <textarea
                            class="form-control h-px-200"
                            placeholder="Message"
                            aria-label="Message"
                            id="basic-default-message"></textarea>
                          <label for="basic-default-message">Message</label>
                        </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Send inquiry</button>
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

    @push('scripts')
        <script src="{{ asset('assets/vendor/libs/swiper/swiper.js') }}"></script>
        <script src="{{ asset('assets/js/front-page-landing.js') }}"></script>
    @endpush

<script>
document.addEventListener('DOMContentLoaded', function () {
    new Swiper('#swiper-reviews', {
        slidesPerView: 1,
        spaceBetween: 24,
        loop: true,
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
        },
        pagination: {
            el: '#swiper-reviews .swiper-pagination',
            clickable: true,
        },
        breakpoints: {
            576: { slidesPerView: 2 },
            992: { slidesPerView: 3 },
        },
    });
});
</script>

<style>
.hero-section{
    background: linear-gradient(
        180deg,
        #f8f7ff 0%,
        #ffffff 100%
    );
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
    background:rgba(115,103,240,.25);
    top:-150px;
    left:-150px;
    animation: float1 8s ease-in-out infinite;
}

.hero-blur-2{
    width:450px;
    height:450px;
    background:rgba(255,76,81,.15);
    bottom:-100px;
    right:-100px;
    animation: float2 10s ease-in-out infinite;
}

.hero-section .container{
    position:relative;
    z-index:2;
}

@keyframes float1{
    0%,100%{
        transform:translateY(0);
    }
    50%{
        transform:translateY(30px);
    }
}

@keyframes float2{
    0%,100%{
        transform:translateY(0);
    }
    50%{
        transform:translateY(-30px);
    }
}

.parking-card{
    transition:all .3s ease;
}

.parking-card:hover{
    transform:translateY(-8px);
    box-shadow:0 1rem 3rem rgba(0,0,0,.12)!important;
}

/* Pastikan pagination muncul di tengah dan tidak overlap card */
#swiper-reviews {
  padding-bottom: 40px; /* beri ruang untuk pagination */
}

#swiper-reviews .swiper-pagination {
  position: relative; /* keluar dari absolute agar tidak overlap */
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
</style>

