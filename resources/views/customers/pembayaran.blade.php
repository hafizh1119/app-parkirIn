@extends('layouts.app')

@section('content')

<section class="section-py bg-body">

    <div class="container">

        <div class="row g-4 justify-content-center">

            <!-- Card 1: Informasi Pembayaran -->
            <div class="col-lg-5">

                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-body p-4">

                        <h4 class="fw-bold mb-4">
                            Pembayaran
                        </h4>

                        @if($statusPembayaran == 'belum_bayar')

                            <div class="alert alert-warning rounded-3">
                                <div class="fw-semibold mb-1">
                                    🟡 Menunggu Pembayaran
                                </div>
                                Silakan selesaikan pembayaran melalui Midtrans.
                            </div>

                        @elseif($statusPembayaran == 'dibayar')

                            <div class="alert alert-success rounded-3">
                                <div class="fw-semibold mb-1">
                                    🟢 Pembayaran Berhasil
                                </div>
                                Tiket parkir sudah dapat digunakan.
                            </div>

                        @endif

                        <div class="bg-label-primary rounded-3 p-4 text-center mb-4">
                            <small class="text-body-secondary d-block">
                                Total Pembayaran
                            </small>
                            <h2 class="fw-bold text-primary mb-0">
                                Rp {{ number_format($reservasi->total_bayar, 0, ',', '.') }}
                            </h2>
                        </div>

                        <div class="list-group list-group-flush">

                            <div class="list-group-item d-flex justify-content-between px-0">
                                <span class="text-body-secondary">Kode Reservasi</span>
                                <strong>{{ $reservasi->kode_reservasi }}</strong>
                            </div>

                            <div class="list-group-item d-flex justify-content-between px-0">
                                <span class="text-body-secondary">Lokasi</span>
                                <strong>{{ $reservasi->lokasiParkir->nama }}</strong>
                            </div>

                            <div class="list-group-item d-flex justify-content-between px-0">
                                <span class="text-body-secondary">Slot</span>
                                <strong>{{ $reservasi->slotParkir->kode_slot }}</strong>
                            </div>

                            <div class="list-group-item d-flex justify-content-between px-0">
                                <span class="text-body-secondary">Tanggal</span>
                                <strong>{{ \Carbon\Carbon::parse($reservasi->tanggal_masuk)->format('d M Y') }}</strong>
                            </div>

                            <div class="list-group-item d-flex justify-content-between px-0">
                                <span class="text-body-secondary">Jam Masuk</span>
                                <strong>{{ substr($reservasi->jam_masuk, 0, 5) }} WIB</strong>
                            </div>

                            <div class="list-group-item d-flex justify-content-between px-0">
                                <span class="text-body-secondary">Durasi</span>
                                <strong>{{ $reservasi->durasi_jam }} Jam</strong>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <!-- Card 2: Aksi Pembayaran -->
            <div class="col-lg-4">

                <div class="card border-0 shadow-sm">

                    <div class="card-body p-4">

                        <h5 class="fw-bold mb-2">
                            Aksi Pembayaran
                        </h5>

                        <p class="text-muted mb-4">
                            Pembayaran dilakukan melalui Midtrans.
                            Klik tombol di bawah untuk memilih metode pembayaran.
                        </p>

                        @if($statusPembayaran == 'belum_bayar')

                            <button
                                type="button"
                                onclick="bayarSekarang()"
                                class="btn btn-primary w-100 mb-3">
                                Bayar Sekarang
                            </button>

<<<<<<< Updated upstream
                            @elseif($statusPembayaran == 'menunggu_verifikasi')

                                <span class="badge bg-label-warning">
                                    🟡 Menunggu Verifikasi
                                </span>

                            @elseif($statusPembayaran == 'dibayar')

                                <span class="badge bg-label-success">
                                    🟢 Sudah Dibayar
                                </span>

                            @endif

                        </div>

                        <form
                            action="{{ route('customer.pembayaran.store') }}"
                            method="POST"
                            enctype="multipart/form-data">

                            @csrf

                            <input
                                type="hidden"
                                name="reservasi_id"
                                value="{{ $reservasi->id }}">

                            <div class="mb-3">

                                <label class="form-label fw-semibold">
                                    Upload Bukti Pembayaran
                                </label>

                                <input
                                    type="file"
                                    name="bukti_pembayaran"
                                    class="form-control"
                                    required>

                            </div>

                            <div class="alert alert-warning d-flex align-items-start py-2 px-3 mb-3">

                                <i class="mdi mdi-alert-circle-outline me-2 mt-1"></i>

                                <small>

                                    <strong>Perhatian!</strong><br>

                                    Format: JPG, PNG, PDF.
                                    Maksimal ukuran file 2 MB.

                                </small>

                            </div>

                            @if($statusPembayaran == 'menunggu_verifikasi')

                                <div class="d-flex justify-content-between align-items-center">

                                    <small class="text-warning fw-semibold">

                                        Menunggu Verifikasi Admin

                                    </small>

                                    <a
                                        href="{{ asset('assets/img/bukti-pembayaran/' . $pembayaran->bukti_pembayaran) }}"
                                        target="_blank"
                                        class="fw-semibold text-primary text-decoration-none lihat-file">

                                        Lihat File

                                    </a>

                                </div>

                            @elseif($statusPembayaran == 'dibayar')

                                <div class="alert alert-success mb-3">

                                    Pembayaran telah diverifikasi.

                                </div>

                            @else

                                <button
                                    type="submit"
                                    class="btn btn-primary w-100 mb-3">

                                    Kirim Bukti Pembayaran

                                </button>

                            @endif

                        </form>

                        <div class="text-center">
=======
                        @endif

                        @if($statusPembayaran == 'dibayar')

                        <a
                            href="{{ route('customer.qr-muncul', $reservasi->id) }}"
                            class="btn btn-success w-100 d-block mt-3">
>>>>>>> Stashed changes

                            Lihat Tiket Parkir

                        </a>

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

function bayarSekarang() {

    snap.pay('{{ $pembayaran->snap_token }}', {

        onSuccess: function(result) {

            fetch("{{ route('customer.finish',$reservasi->id) }}",{

                method:'POST',

                headers:{
                    'X-CSRF-TOKEN':'{{ csrf_token() }}',
                    'Accept':'application/json'
                }

            })

            .then(res => res.json())

            .then(data => {

                console.log(data);

                if(data.success){

                    location.reload();

                }else{

                    alert(data.message ?? "Status pembayaran belum settlement.");

                }

            })

            .catch(err=>{

                console.log(err);

                alert("Finish Error");

            });

        },

        onPending:function(result){

            window.location.reload();

        },

        onError:function(result){

            alert('Pembayaran gagal');

        },

        onClose:function(){

            console.log('Popup ditutup');

        }

    });

}

</script>

@endpush

@endsection