@extends('layouts.app')

@section('content')

<section class="section-py bg-body">

    <div class="container">

        <!-- Denah + Detail -->
        <div class="row g-4">

            <!-- Denah -->
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">

                        <div class="row mb-4">

                            <div class="col-md-6">

                                <label class="form-label fw-semibold">
                                    Jenis Kendaraan
                                </label>

                                <select class="form-select" id="selectKendaraan">

                                    <option value="mobil">
                                        🚗 Mobil
                                    </option>

                                    <option value="motor">
                                        🛵 Motor
                                    </option>

                                </select>

                            </div>

                            <div class="col-md-6">

                                <label class="form-label fw-semibold">
                                    Area Parkir
                                </label>

                                <select class="form-select" id="selectArea">

                                    <option value="A">
                                        Area A
                                    </option>

                                    <option value="B">
                                        Area B
                                    </option>

                                    <option value="C">
                                        Area C
                                    </option>

                                </select>

                            </div>

                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-4">

                            <h5 class="fw-bold mb-0">
                                Denah Area Parkir
                            </h5>

                            <div class="d-flex gap-3 flex-wrap">

                                <small>
                                    🟩 Tersedia
                                </small>

                                <small>
                                    🟥 Terisi
                                </small>

                                <small>
                                    🟪 Dipilih
                                </small>

                            </div>

                        </div>

                        <div id="parkingGrid" class="parking-grid">

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

.parking-grid{
    display:grid;
    grid-template-columns:repeat(5,1fr);
    gap:12px;
}

.slot{
    border:none;
    border-radius:12px;
    padding:15px;
    font-weight:600;
    color:#fff;
    cursor:pointer;
    transition:.3s;
}

.available{
    background:#28c76f;
}

.occupied{
    background:#ea5455;
}

.selected{
    background:#7367f0;
}

.slot:hover{
    transform:translateY(-2px);
}

</style>
@endpush

@push('scripts')
<script>
    const parkingGrid = document.getElementById('parkingGrid');

    const kendaraanSelect = document.getElementById('selectKendaraan');
    const areaSelect = document.getElementById('selectArea');

    let selectedSlot = null;

    function generateSlots() {

        parkingGrid.innerHTML = '';

        const kendaraan = kendaraanSelect.value;
        const area = areaSelect.value;

        for (let i = 1; i <= 25; i++) {

            let slotName = '';

            if (kendaraan === 'mobil') {
                slotName = area + '-' + i;
            } else {
                slotName = 'M' + area + '-' + i;
            }

            const available = Math.random() > 0.35;

            const btn = document.createElement('button');

            btn.className =
                'slot ' + (available ? 'available' : 'occupied');

            btn.innerText = slotName;

            btn.addEventListener('click', function () {

                document.querySelectorAll('.slot.selected')
                    .forEach(x => {
                        x.classList.remove('selected');
                        x.classList.add('available');
                    });

                document.getElementById('detailNamaSlot').textContent =
                    slotName;

                document.getElementById('detailKendaraan').textContent =
                    kendaraan === 'mobil'
                    ? 'Mobil'
                    : 'Motor';

                document.getElementById('detailArea').textContent =
                    'Area ' + area;

                document.getElementById('detailTarif').textContent =
                    kendaraan === 'mobil'
                    ? 'Rp 5.000/Jam'
                    : 'Rp 2.000/Jam';

                if (available) {

                    btn.classList.remove('available');
                    btn.classList.add('selected');

                    document.getElementById('detailStatus')
                        .textContent = 'Tersedia';

                    document.getElementById('detailStatus')
                        .className = 'mb-0 fw-semibold text-success';

                    document.getElementById('btnReservasi')
                        .disabled = false;

                    document.getElementById('btnReservasi')
                        .className = 'btn btn-primary w-100 mb-2';

                } else {

                    document.getElementById('detailStatus')
                        .textContent = 'Terisi';

                    document.getElementById('detailStatus')
                        .className = 'mb-0 fw-semibold text-danger';

                    document.getElementById('btnReservasi')
                        .disabled = true;

                    document.getElementById('btnReservasi')
                        .className = 'btn btn-secondary w-100 mb-2';
                }

            });

            parkingGrid.appendChild(btn);
        }
    }

    generateSlots();

    kendaraanSelect.addEventListener('change', generateSlots);
    areaSelect.addEventListener('change', generateSlots);
</script>
@endpush

@endsection