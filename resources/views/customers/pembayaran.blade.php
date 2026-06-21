@extends('layouts.app')

@section('content')

<section class="section-py bg-body">

    <div class="container">

        <!-- Header -->
        <div class="mb-4">
        </div>

        <div class="row g-4">

            <!-- Detail Pembayaran -->
            <div class="col-lg-7">

                <div class="card border-0 shadow-sm">

                    <div class="card-body p-4">

                        <h4 class="fw-bold mb-4">
                            Detail Pembayaran
                        </h4>

                        <div class="bg-label-primary rounded-3 p-4 text-center mb-4">

                            <small class="text-body-secondary d-block">
                                Total Pembayaran
                            </small>

                            <h2 class="fw-bold text-primary mb-0">
                                Rp {{ number_format($reservasi->total_bayar, 0, ',', '.') }}
                            </h2>

                        </div>

                        <div class="row g-3">

                            <div class="col-md-6">

                                <div class="border rounded-3 p-3 d-flex align-items-center">

                                    <div class="rounded-3 bg-label-primary p-3 me-3">

                                        <i class="mdi mdi-bank text-primary fs-2"></i>

                                    </div>

                                    <div>

                                        <small class="text-body-secondary">
                                            Bank Tujuan
                                        </small>

                                        <h6 class="fw-bold mb-0 mt-1">
                                            Bank BCA
                                        </h6>

                                    </div>

                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="border rounded-3 p-3 d-flex align-items-center">

                                    <div class="rounded-3 bg-label-info p-3 me-3">

                                        <i class="mdi mdi-credit-card-outline text-info fs-2"></i>

                                    </div>

                                    <div>

                                        <small class="text-body-secondary">
                                            Nomor Rekening
                                        </small>

                                        <div class="d-flex align-items-center justify-content-between mt-1">

                                            <h6
                                                class="fw-bold mb-0"
                                                id="nomorRekening">

                                                1234567890

                                            </h6>

                                            <button
                                                type="button"
                                                id="btnCopy"
                                                class="btn btn-sm btn-icon btn-text-secondary"
                                                onclick="copyRekening()">

                                                <i class="mdi mdi-content-copy"></i>

                                            </button>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="col-12">

                                <div class="border rounded-3 p-3 d-flex align-items-center">

                                    <div class="rounded-3 bg-label-success p-3 me-3">

                                        <i class="mdi mdi-account-outline text-success fs-2"></i>

                                    </div>

                                    <div>

                                        <small class="text-body-secondary">
                                            Atas Nama
                                        </small>

                                        <h6 class="fw-bold mb-0 mt-1">
                                            ParkirIn
                                        </h6>

                                    </div>

                                </div>

                            </div>

                        </div>
                        <div class="alert alert-warning mt-4 mb-0">

                            <strong>Penting!</strong><br>

                            Pastikan nominal transfer sesuai dengan total
                            pembayaran agar proses verifikasi lebih cepat.

                        </div>

                    </div>

                </div>

            </div>

            <!-- Upload Bukti -->
            <div class="col-lg-5">

                <div class="card border-0 shadow-sm">

                    <div class="card-body p-4">

                        <h4 class="fw-bold mb-4">
                            Upload Bukti Pembayaran
                        </h4>

                        <div class="mb-4">

                            @if($statusPembayaran == 'belum_bayar')

                                <span class="badge bg-label-danger">
                                    🔴 Belum Bayar
                                </span>

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

                            <div class="alert alert-warning mt-3 mb-0">

                                Tiket parkir akan tersedia setelah pembayaran diverifikasi oleh admin.

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

                        @if($statusPembayaran == 'dibayar')

                        <div class="text-center">

                            <a
                                href="{{ route('customer.qr-muncul', $reservasi->id) }}"
                                class="btn btn-success px-5">

                                Lihat Tiket Saya

                            </a>

                        </div>

                        @endif

                    </div>

                </div>

            </div>
        </div>

    </div>

</section>

@push('scripts')
<script>
document
    .getElementById('buktiPembayaran')
    .addEventListener('change', function() {

        if (!this.files.length) return;

        const file = this.files[0];

        const lihatFile =
            document.getElementById('namaFile');

        lihatFile.href =
            URL.createObjectURL(file);

        lihatFile.classList.remove('d-none');

        const sekarang = new Date();

        document
            .getElementById('tanggalUpload')
            .textContent =
            sekarang.toLocaleDateString('id-ID', {
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            }) +
            ' • ' +
            sekarang.toLocaleTimeString('id-ID', {
                hour: '2-digit',
                minute: '2-digit'
            }) +
            ' WIB';

        document
            .getElementById('uploadResult')
            .classList.remove('d-none');

    });
</script>

<script>

function copyRekening() {

    const rekening =
        document.getElementById('nomorRekening')
            .textContent.trim();

    const btn =
        document.getElementById('btnCopy');

    navigator.clipboard.writeText(rekening);

    btn.innerHTML =
        '<i class="mdi mdi-check text-success"></i>';

    btn.classList.add('text-success');

    setTimeout(() => {

        btn.innerHTML =
            '<i class="mdi mdi-content-copy"></i>';

        btn.classList.remove('text-success');

    }, 2000);

}

</script>
@endpush

@push('styles')
    <style>

    .lihat-file{
        transition: .3s;
    }

    .lihat-file:hover{
        color: #7367f0 !important;
        text-decoration: underline !important;
    }

    .lihat-file{
        transition: .2s;
    }

    .lihat-file:hover{
        opacity: .8;
        text-decoration: underline !important;
    }
    </style>

@endpush

@endsection