@extends('layouts.front')

@section('content')

<style>
    .slot {
        width: 80px;
        height: 80px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: bold;
        cursor: pointer;
        transition: 0.3s;
    }

    .slot:hover {
        transform: scale(1.05);
    }

    .available {
        background: #28c76f;
    }

    .booked {
        background: #ff9f43;
    }

    .filled {
        background: #ea5455;
        cursor: not-allowed;
    }

    .parking-row {
        gap: 15px;
        margin-bottom: 15px;
    }

    .road {
        background: #f5f5f9;
        border: 2px dashed #d9dee3;
        padding: 15px;
        border-radius: 10px;
        margin: 25px 0;
        font-weight: 600;
        color: #666;
    }
</style>

<div class="container py-5">

    <div class="text-center mb-5">

        <h2 class="fw-bold">
            Denah Parkir UDINUS
        </h2>

        <p class="text-muted">
            Pilih slot parkir yang tersedia
        </p>

    </div>

    <!-- Keterangan -->

    <div class="d-flex justify-content-center gap-4 mb-5">

        <div>
            🟩 Tersedia
        </div>

        <div>
            🟨 Dibooking
        </div>

        <div>
            🟥 Terisi
        </div>

    </div>

    <!-- Entrance -->

    <div class="road text-center">
        ⬇ ENTRANCE
    </div>

    <!-- Baris A -->

    <div class="d-flex justify-content-center parking-row">

        <div class="slot available">A1</div>
        <div class="slot available">A2</div>
        <div class="slot filled">A3</div>
        <div class="slot available">A4</div>

    </div>

    <!-- Jalan -->

    <div class="road text-center">
        JALUR KENDARAAN
    </div>

    <!-- Baris B -->

    <div class="d-flex justify-content-center parking-row">

        <div class="slot available">B1</div>
        <div class="slot booked">B2</div>
        <div class="slot filled">B3</div>
        <div class="slot available">B4</div>

    </div>

    <!-- Jalan -->

    <div class="road text-center">
        JALUR KENDARAAN
    </div>

    <!-- Baris C -->

    <div class="d-flex justify-content-center parking-row">

        <div class="slot available">C1</div>
        <div class="slot available">C2</div>
        <div class="slot available">C3</div>
        <div class="slot available">C4</div>

    </div>

    <div class="text-center mt-5">

        <a href="/customer/transaksi" class="btn btn-primary btn-lg">

            Lanjut Booking

        </a>

    </div>

</div>

@endsection