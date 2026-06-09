@extends('layouts.customer')

@section('content')

<h2 class="mb-4">Selamat Datang di ParkirIn</h2>

<div class="row">

    <div class="col-md-4">
        <div class="card">
            <div class="card-body text-center">

                <h5>Cari Tempat Parkir</h5>

                <a href="/customer/cari-parkir"
                   class="btn btn-primary mt-2">
                    Cari Sekarang
                </a>

            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-body text-center">

                <h5>Riwayat Parkir</h5>

                <a href="/customer/riwayat"
                   class="btn btn-success mt-2">
                    Lihat Riwayat
                </a>

            </div>
        </div>
    </div>

</div>

@endsection