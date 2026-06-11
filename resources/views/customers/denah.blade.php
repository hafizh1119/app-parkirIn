@extends('layouts.app')

@section('content')

<section class="section-py bg-body">

    <div class="container">

        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}">Beranda</a>
                </li>
                <li class="breadcrumb-item">Area Parkir</li>
                <li class="breadcrumb-item active">Denah Parkir</li>
            </ol>
        </nav>

        <!-- Header -->
        <div class="mb-5">
            <h2 class="fw-bold mb-2">Denah Parkir Interaktif</h2>
            <p class="text-body-secondary">
                Pilih slot parkir yang tersedia secara realtime dan lakukan reservasi dengan mudah.
            </p>
        </div>

        <!-- Statistik -->
        <div class="row g-4 mb-5">
            <div class="col-lg-3 col-md-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <span class="badge bg-label-primary mb-2">Total Slot</span>
                        <h3 class="fw-bold mb-0">20</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <span class="badge bg-label-success mb-2">Tersedia</span>
                        <h3 class="fw-bold text-success mb-0">8</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <span class="badge bg-label-danger mb-2">Terisi</span>
                        <h3 class="fw-bold text-danger mb-0">10</h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Denah + Detail -->
        <div class="row g-4">

            <!-- Denah -->
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">

                        <!-- Pilih Jenis Kendaraan -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold mb-2">Jenis Kendaraan</label>
                            <div class="input-group" style="max-width: 260px;">
                                <select class="form-select" id="selectKendaraan">
                                    <option value="mobil">🚗 Mobil</option>
                                    <option value="motor">🛵 Motor</option>
                                </select>
                            </div>
                        </div>

                        <!-- Header Denah -->
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="fw-bold mb-0">Denah Area Parkir</h5>
                            <div class="d-flex gap-3 flex-wrap">
                                <small>🟩 Tersedia</small>
                                <small>🟥 Terisi</small>
                                <small>🟪 Dipilih</small>
                            </div>
                        </div>

                        <!-- Denah Mobil -->
                        <div id="mobilMap">
                            <div class="parking-grid">
                                <button class="slot available">A1</button>
                                <button class="slot occupied">A2</button>
                                <button class="slot available">A3</button>
                                <button class="slot occupied">A4</button>
                                <button class="slot available">A5</button>

                                <button class="slot reserved">B1</button>
                                <button class="slot occupied">B2</button>
                                <button class="slot available">B3</button>
                                <button class="slot occupied">B4</button>
                                <button class="slot available">B5</button>

                                <button class="slot available">C1</button>
                                <button class="slot selected">C2</button>
                                <button class="slot occupied">C3</button>
                                <button class="slot available">C4</button>
                                <button class="slot reserved">C5</button>

                                <button class="slot occupied">D1</button>
                                <button class="slot occupied">D2</button>
                                <button class="slot available">D3</button>
                                <button class="slot occupied">D4</button>
                                <button class="slot available">D5</button>
                            </div>
                        </div>

                        <!-- Denah Motor -->
                        <div id="motorMap" style="display:none;">
                            <div class="parking-grid-motor">
                                <button class="slot available">M1</button>
                                <button class="slot available">M2</button>
                                <button class="slot occupied">M3</button>
                                <button class="slot available">M4</button>

                                <button class="slot available">M5</button>
                                <button class="slot occupied">M6</button>
                                <button class="slot available">M7</button>
                                <button class="slot available">M8</button>

                                <button class="slot available">M9</button>
                                <button class="slot available">M10</button>
                                <button class="slot occupied">M11</button>
                                <button class="slot available">M12</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Detail Slot -->
<div class="col-lg-4">
    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">

            <h5 class="fw-bold mb-4">Detail Slot</h5>

            <div class="mb-3">
                <small class="text-body-secondary">Slot</small>
                <h6 class="mb-0" id="detailNamaSlot">— Pilih slot</h6>
            </div>

            <div class="mb-3">
                <small class="text-body-secondary">Status</small>
                <h6 class="mb-0 fw-semibold" id="detailStatus">—</h6>
            </div>

            <div class="mb-3">
                <small class="text-body-secondary">Kendaraan</small>
                <h6 class="mb-0" id="detailKendaraan">—</h6>
            </div>

            <div class="mb-3">
                <small class="text-body-secondary">Area</small>
                <h6 class="mb-0" id="detailArea">—</h6>
            </div>

            <div class="mb-4">
                <small class="text-body-secondary">Tarif</small>
                <h5 class="fw-bold mb-0" id="detailTarif">—</h5>
            </div>

            <button class="btn btn-secondary w-100 mb-2" id="btnReservasi" disabled>
                Reservasi Sekarang
            </button>
            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary w-100">Kembali</a>

        </div>
    </div>
</div>

        </div>

    </div>

</section>

@push('styles')
<style>
    .parking-grid-motor {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 12px;
    }
</style>
@endpush

@push('scripts')
<script>
    // Switch kendaraan
    document.getElementById('selectKendaraan').addEventListener('change', function () {
        const val = this.value;
        document.getElementById('mobilMap').style.display = val === 'mobil' ? 'block' : 'none';
        document.getElementById('motorMap').style.display = val === 'motor' ? 'block' : 'none';
        document.getElementById('detailKendaraan').textContent = val === 'mobil' ? 'Mobil' : 'Motor';
    });

    // Data slot
    const slotData = {
        A1: { status: 'available', area: 'Baris A', tarif: 'Rp 5.000/Jam' },
        A2: { status: 'occupied',  area: 'Baris A', tarif: 'Rp 5.000/Jam' },
        A3: { status: 'available', area: 'Baris A', tarif: 'Rp 5.000/Jam' },
        A4: { status: 'occupied',  area: 'Baris A', tarif: 'Rp 5.000/Jam' },
        A5: { status: 'available', area: 'Baris A', tarif: 'Rp 5.000/Jam' },
        B1: { status: 'reserved',  area: 'Baris B', tarif: 'Rp 5.000/Jam' },
        B2: { status: 'occupied',  area: 'Baris B', tarif: 'Rp 5.000/Jam' },
        B3: { status: 'available', area: 'Baris B', tarif: 'Rp 5.000/Jam' },
        B4: { status: 'occupied',  area: 'Baris B', tarif: 'Rp 5.000/Jam' },
        B5: { status: 'available', area: 'Baris B', tarif: 'Rp 5.000/Jam' },
        C1: { status: 'available', area: 'Baris C', tarif: 'Rp 5.000/Jam' },
        C2: { status: 'available', area: 'Baris C', tarif: 'Rp 5.000/Jam' },
        C3: { status: 'occupied',  area: 'Baris C', tarif: 'Rp 5.000/Jam' },
        C4: { status: 'available', area: 'Baris C', tarif: 'Rp 5.000/Jam' },
        C5: { status: 'reserved',  area: 'Baris C', tarif: 'Rp 5.000/Jam' },
        D1: { status: 'occupied',  area: 'Baris D', tarif: 'Rp 5.000/Jam' },
        D2: { status: 'occupied',  area: 'Baris D', tarif: 'Rp 5.000/Jam' },
        D3: { status: 'available', area: 'Baris D', tarif: 'Rp 5.000/Jam' },
        D4: { status: 'occupied',  area: 'Baris D', tarif: 'Rp 5.000/Jam' },
        D5: { status: 'available', area: 'Baris D', tarif: 'Rp 5.000/Jam' },
        M1:  { status: 'available', area: 'Motor',   tarif: 'Rp 2.000/Jam' },
        M2:  { status: 'available', area: 'Motor',   tarif: 'Rp 2.000/Jam' },
        M3:  { status: 'occupied',  area: 'Motor',   tarif: 'Rp 2.000/Jam' },
        M4:  { status: 'available', area: 'Motor',   tarif: 'Rp 2.000/Jam' },
        M5:  { status: 'available', area: 'Motor',   tarif: 'Rp 2.000/Jam' },
        M6:  { status: 'occupied',  area: 'Motor',   tarif: 'Rp 2.000/Jam' },
        M7:  { status: 'available', area: 'Motor',   tarif: 'Rp 2.000/Jam' },
        M8:  { status: 'available', area: 'Motor',   tarif: 'Rp 2.000/Jam' },
        M9:  { status: 'available', area: 'Motor',   tarif: 'Rp 2.000/Jam' },
        M10: { status: 'available', area: 'Motor',   tarif: 'Rp 2.000/Jam' },
        M11: { status: 'occupied',  area: 'Motor',   tarif: 'Rp 2.000/Jam' },
        M12: { status: 'available', area: 'Motor',   tarif: 'Rp 2.000/Jam' },
    };

    const statusLabel = {
        available: { text: 'Tersedia',  cls: 'text-success' },
        occupied:  { text: 'Terisi',    cls: 'text-danger'  },
        reserved:  { text: 'Dipesan',   cls: 'text-warning' },
    };

    let selectedSlot = null;

    document.querySelectorAll('.slot').forEach(function (btn) {
    btn.addEventListener('click', function () {
        const name = this.textContent.trim();
        const data = slotData[name];
        if (!data) return;

        // Kalau occupied/reserved, tetap tampilkan info tapi jangan ubah visual
        if (data.status !== 'available') {
            // Reset slot selected sebelumnya jika ada
            if (selectedSlot) {
                const prev = slotData[selectedSlot.textContent.trim()];
                if (prev) {
                    selectedSlot.classList.remove('selected');
                    selectedSlot.classList.add(prev.status);
                }
                selectedSlot = null;
            }
        } else {
            // Kembalikan slot selected sebelumnya
            if (selectedSlot && selectedSlot !== this) {
                const prev = slotData[selectedSlot.textContent.trim()];
                if (prev) {
                    selectedSlot.classList.remove('selected');
                    selectedSlot.classList.add(prev.status);
                }
            }

            // Tandai slot baru
            this.classList.remove('available');
            this.classList.add('selected');
            selectedSlot = this;
        }

        // Update panel detail
        const info = statusLabel[data.status];
        document.getElementById('detailNamaSlot').textContent  = name;
        document.getElementById('detailStatus').textContent    = info.text;
        document.getElementById('detailStatus').className      = 'mb-0 fw-semibold ' + info.cls;
        document.getElementById('detailKendaraan').textContent = name.startsWith('M') ? 'Motor' : 'Mobil';
        document.getElementById('detailArea').textContent      = data.area;
        document.getElementById('detailTarif').textContent     = data.tarif;

        // Tombol reservasi
        const btnReservasi = document.getElementById('btnReservasi');
        if (data.status === 'available') {
            btnReservasi.disabled = false;
            btnReservasi.classList.replace('btn-secondary', 'btn-primary');
        } else {
            btnReservasi.disabled = true;
            btnReservasi.classList.replace('btn-primary', 'btn-secondary');
        }
    });
});
</script>
@endpush

@endsection