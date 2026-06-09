@extends('layouts.customer')

@section('content')

<!-- Hero Section -->
<section class="py-5 text-center text-white position-relative"
    style="
    background:url('https://images.unsplash.com/photo-1573348722427-f1d6819fdf98?q=80&w=1920');
    background-size:cover;
    background-position:center;
    min-height:400px;
    display:flex;
    align-items:center;
">

    <div style="
        position:absolute;
        top:0;
        left:0;
        width:100%;
        height:100%;
        background:rgba(0,0,0,.6);
    "></div>

    <div class="container position-relative">

        <h1 class="text-white fw-bold mb-3">
            Temukan Tempat Parkir Terbaik
        </h1>

        <h4 class="text-white mb-4">
            Cari lokasi parkir terdekat dan pesan slot dengan mudah
        </h4>

    </div>

</section>

<!-- Search Box -->
<div class="container">
    <div class="card shadow-lg border-0"
         style="margin-top:-50px; z-index:100; position:relative;">

        <div class="card-body p-4">

            <div class="row">

                <div class="col-md-5">
                    <input
                        type="text"
                        class="form-control"
                        placeholder="Masukkan lokasi atau nama tempat">
                </div>

                <div class="col-md-3">
                    <select class="form-select">
                        <option>Semua Lokasi</option>
                        <option>Mall</option>
                        <option>Kampus</option>
                        <option>Perkantoran</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <button class="btn btn-primary w-100">
                        Cari Lokasi
                    </button>
                </div>

            </div>

        </div>

    </div>
</div>

<!-- Lokasi Populer -->
<section class="container py-5">

    <div class="text-center mb-5">

        <h2 class="fw-bold">
            Lokasi Parkir Populer
        </h2>

        <p class="text-muted">
            Pilih lokasi parkir yang tersedia di sekitar Anda
        </p>

    </div>

    <div class="row">

        <!-- UDINUS -->
        <div class="col-lg-4 mb-4">

            <div class="card h-100 shadow-sm">

                <img
                    src="https://images.unsplash.com/photo-1590674899484-d5640e854abe?q=80&w=800"
                    class="card-img-top"
                    style="height:220px; object-fit:cover;">

                <div class="card-body">

                    <h5 class="fw-bold">
                        📍 Parkir UDINUS
                    </h5>

                    <p class="text-muted">
                        Jl. Imam Bonjol No.207, Semarang
                    </p>

                    <div class="d-flex justify-content-between">

                        <span class="text-success">
                            🚗 25 Slot Tersedia
                        </span>

                        <span>
                            📌 1.2 Km
                        </span>

                    </div>

                    <a href="/customer/denah"
                       class="btn btn-primary w-100 mt-3">

                        Lihat Denah

                    </a>

                </div>

            </div>

        </div>

        <!-- Simpang Lima -->
        <div class="col-lg-4 mb-4">

            <div class="card h-100 shadow-sm">

                <img
                    src="https://images.unsplash.com/photo-1519501025264-65ba15a82390?q=80&w=800"
                    class="card-img-top"
                    style="height:220px; object-fit:cover;">

                <div class="card-body">

                    <h5 class="fw-bold">
                        📍 Parkir Simpang Lima
                    </h5>

                    <p class="text-muted">
                        Simpang Lima, Semarang
                    </p>

                    <div class="d-flex justify-content-between">

                        <span class="text-success">
                            🚗 12 Slot Tersedia
                        </span>

                        <span>
                            📌 1.8 Km
                        </span>

                    </div>

                    <a href="/customer/denah"
                       class="btn btn-primary w-100 mt-3">

                        Lihat Denah

                    </a>

                </div>

            </div>

        </div>

        <!-- Paragon -->
        <div class="col-lg-4 mb-4">

            <div class="card h-100 shadow-sm">

                <img
                    src="https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?q=80&w=800"
                    class="card-img-top"
                    style="height:220px; object-fit:cover;">

                <div class="card-body">

                    <h5 class="fw-bold">
                        📍 Parkir Paragon Mall
                    </h5>

                    <p class="text-muted">
                        Jl. Pemuda No.118, Semarang
                    </p>

                    <div class="d-flex justify-content-between">

                        <span class="text-success">
                            🚗 40 Slot Tersedia
                        </span>

                        <span>
                            📌 2.1 Km
                        </span>

                    </div>

                    <a href="/customer/denah"
                       class="btn btn-primary w-100 mt-3">

                        Lihat Denah

                    </a>

                </div>

            </div>

        </div>

        <!-- DP Mall -->
        <div class="col-lg-4 mb-4">

            <div class="card h-100 shadow-sm">

                <img
                    src="https://images.unsplash.com/photo-1487958449943-2429e8be8625?q=80&w=800"
                    class="card-img-top"
                    style="height:220px; object-fit:cover;">

                <div class="card-body">

                    <h5 class="fw-bold">
                        📍 Parkir DP Mall
                    </h5>

                    <p class="text-muted">
                        Jl. Pemuda No.150, Semarang
                    </p>

                    <div class="d-flex justify-content-between">

                        <span class="text-success">
                            🚗 30 Slot Tersedia
                        </span>

                        <span>
                            📌 2.5 Km
                        </span>

                    </div>

                    <a href="/customer/denah"
                       class="btn btn-primary w-100 mt-3">

                        Lihat Denah

                    </a>

                </div>

            </div>

        </div>

        <!-- Java Mall -->
        <div class="col-lg-4 mb-4">

            <div class="card h-100 shadow-sm">

                <img
                    src="https://images.unsplash.com/photo-1460317442991-0ec209397118?q=80&w=800"
                    class="card-img-top"
                    style="height:220px; object-fit:cover;">

                <div class="card-body">

                    <h5 class="fw-bold">
                        📍 Parkir Java Mall
                    </h5>

                    <p class="text-muted">
                        Jl. MT. Haryono, Semarang
                    </p>

                    <div class="d-flex justify-content-between">

                        <span class="text-success">
                            🚗 18 Slot Tersedia
                        </span>

                        <span>
                            📌 3.0 Km
                        </span>

                    </div>

                    <a href="/customer/denah"
                       class="btn btn-primary w-100 mt-3">

                        Lihat Denah

                    </a>

                </div>

            </div>

        </div>

        <!-- Citraland -->
        <div class="col-lg-4 mb-4">

            <div class="card h-100 shadow-sm">

                <img
                    src="https://images.unsplash.com/photo-1448630360428-65456885c650?q=80&w=800"
                    class="card-img-top"
                    style="height:220px; object-fit:cover;">

                <div class="card-body">

                    <h5 class="fw-bold">
                        📍 Parkir Citraland Mall
                    </h5>

                    <p class="text-muted">
                        Jl. Siliwangi, Semarang
                    </p>

                    <div class="d-flex justify-content-between">

                        <span class="text-success">
                            🚗 22 Slot Tersedia
                        </span>

                        <span>
                            📌 4.2 Km
                        </span>

                    </div>

                    <a href="/customer/denah"
                       class="btn btn-primary w-100 mt-3">

                        Lihat Denah

                    </a>

                </div>

            </div>

        </div>

    </div>

</section>

@endsection