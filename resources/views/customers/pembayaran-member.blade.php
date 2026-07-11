@extends('layouts.app')

@section('content')

<section class="bg-body" style="min-height: 100vh; display: flex; align-items: center; margin-top: -3rem; margin-bottom: -3rem;">

    <div class="container py-5">

        <div class="row g-4">

            <!-- Card Informasi Membership - Kiri (1 card) -->
            <div class="col-lg-6 d-flex">

                <div class="card border-0 shadow-sm w-100">

                    <div class="card-body p-4 d-flex flex-column">

                        <h3 class="fw-bold mb-4">
                            Membership ParkirIn
                        </h3>

                        <div class="bg-label-primary rounded-3 p-4 text-center mb-4">

                            <small class="text-body-secondary d-block mb-2">
                                Total Pembayaran
                            </small>

                            <h2 class="fw-bold text-primary mb-0">
                                Rp {{ number_format($membership->harga,0,',','.') }}
                            </h2>

                        </div>

                        <div class="list-group list-group-flush flex-grow-1">

                            <div class="list-group-item d-flex justify-content-between px-0">

                                <span class="text-body-secondary">
                                    Paket
                                </span>

                                <strong>
                                    Lifetime Member
                                </strong>

                            </div>

                            <div class="list-group-item d-flex justify-content-between px-0">

                                <span class="text-body-secondary">
                                    Masa Berlaku
                                </span>

                                <strong>
                                    Selamanya
                                </strong>

                            </div>

                            <div class="list-group-item d-flex justify-content-between px-0">

                                <span class="text-body-secondary">
                                    Pembayaran
                                </span>

                                <strong>
                                    Midtrans
                                </strong>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <!-- Card Kanan (2 card) -->
            <div class="col-lg-6 d-flex flex-column gap-4">

                <!-- Card Benefit -->
                <div class="card border-0 shadow-sm w-100">

                    <div class="card-body p-4">

                        <h5 class="fw-bold mb-3">
                            Keuntungan Menjadi Member
                        </h5>

                        <ul class="list-unstyled mb-0">

                            <li class="mb-3">
                                ✅ Mendapatkan point setiap checkout parkir
                            </li>

                            <li class="mb-3">
                                ✅ Menukarkan point menjadi berbagai reward
                            </li>

                            <li class="mb-3">
                                ✅ Promo dan penawaran khusus member
                            </li>

                            <li class="mb-3">
                                ✅ Riwayat point tersimpan otomatis
                            </li>

                            <li>
                                ✅ Benefit eksklusif ParkirIn di masa mendatang
                            </li>

                        </ul>

                    </div>

                </div>

                <!-- Card Pembayaran -->
                <div class="card border-0 shadow-sm w-100">

                    <div class="card-body p-4">

                        <h5 class="fw-bold">
                            Pembayaran Membership
                        </h5>

                        <p class="text-muted mt-2 mb-4">

                            Pembayaran diproses melalui Midtrans.
                            Pilih metode pembayaran favorit Anda seperti
                            QRIS, Virtual Account, GoPay, ShopeePay,
                            maupun kartu debit/kredit.

                        </p>

                        @if($statusPembayaran == 'belum_bayar')

                        <button
                            onclick="bayarMembership()"
                            class="btn btn-primary w-100">

                            Bayar Membership

                        </button>

                        @else

                        <button
                            class="btn btn-success w-100"
                            disabled>

                            Membership Aktif

                        </button>

                        @endif

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

@push('scripts')

<script
    src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="{{ config('midtrans.client_key') }}">
</script>

<script>

function bayarMembership() {

    snap.pay('{{ $pembayaran->snap_token }}', {

        onSuccess: function(result) {

            fetch("{{ route('customer.membership.finish', $membership->id) }}", {

                method: 'POST',

                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }

            })

            .then(res => res.json())

            .then(data => {

                if (data.success) {

                    location.reload();

                } else {

                    alert(data.message ?? "Status pembayaran belum settlement.");

                }

            })

            .catch(err => {

                console.log(err);

                alert("Finish Error");

            });

        },

        onPending: function(result) {

            alert("Pembayaran masih pending.");

        },

        onError: function(result) {

            alert("Pembayaran gagal.");

        },

        onClose: function() {

            console.log("Popup ditutup.");

        }

    });

}

</script>

@endpush

@endsection