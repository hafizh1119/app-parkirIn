@extends('layouts.app')

@section('content')

<section class="section-py bg-body">

    <div class="container">

        <!-- Button Kembali -->
        <div class="mb-5">  
        </div>

        <!-- Denah + Detail -->
        <div class="row g-4">

            <!-- Denah -->
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">

                        <div class="row mb-4">

                            <div class="col-md-6">

                                <label class="form-label fw-semibold">
                                    Area Parkir
                                </label>

                                <select class="form-select" id="selectArea">
                                    @forelse($areas as $area)
                                        <option value="{{ $area->id }}">
                                            {{ $area->nama_area }}
                                        </option>
                                    @empty
                                        <option disabled>Tidak ada area tersedia</option>
                                    @endforelse
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

                            @foreach($slotParkir as $slot)

                                <button
                                    class="slot {{ $slot->status == 'tersedia' ? 'available' : 'occupied' }}"
                                    data-id="{{ $slot->id }}"
                                    data-kode="{{ $slot->kode_slot }}"
                                    data-area="{{ $slot->area_parkir_id }}"
                                    data-status="{{ $slot->status }}"
                                    data-tarif="{{ $slot->areaParkir->tarif_per_jam }}"
                                    data-kendaraan="{{ $jenis_kendaraan }}">

                                    {{ $slot->kode_slot }}

                                </button>

                            @endforeach

                        </div>

                    </div>
                </div>
            </div>

            <div class="col-lg-4">

            <!-- Detail Kendaraan -->
            <div class="card border-0 shadow-sm mb-4">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <small class="text-body-secondary">
                                Kendaraan Terdaftar
                            </small>

                            <h6 class="fw-bold mb-0 mt-1">
                                {{ $kendaraan->merk }}
                            </h6>

                            <small class="text-body-secondary">
                                {{ $kendaraan->nomor_polisi }}
                            </small>

                        </div>

                        <button
                            type="button"
                            class="btn btn-sm btn-outline-primary"
                            data-bs-toggle="modal"
                            data-bs-target="#modalKendaraan">

                            <i class="mdi mdi-pencil-outline me-1"></i>
                            Ubah

                        </button>

                    </div>

                </div>

            </div>

            <!-- Detail Parkir -->
            <div class="card border-0 shadow-sm h-75">

                <div class="card-body p-4 d-flex flex-column">

                    <h5 class="fw-bold mb-4">
                        Detail Parkir
                    </h5>

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

                    <div class="mt-auto">

                        <a
                            href="#"
                            id="btnReservasi"
                            class="btn btn-primary w-100 mb-2">

                            Reservasi Sekarang

                        </a>

                        <a
                            href="{{ route('customer.atur-jadwal', $lokasi->id) }}"
                            class="btn btn-outline-secondary w-100">

                            Batal

                        </a>

                    </div>

                </div>

            </div>

        </div>

        </div>

    </div>

</section>

<!-- Modal Detail Kendaraan -->
<div
    class="modal fade"
    id="modalKendaraan"
    tabindex="-1"
    aria-labelledby="modalKendaraanLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-bottom-sheet">

        <div class="modal-content border-0">
            <div class="text-center pt-3">

                <div
                    style="
                        width:50px;
                        height:5px;
                        background:#dcdcdc;
                        border-radius:20px;
                        margin:auto;">
                </div>

            </div>

            <div class="modal-header">

                <h5
                    class="modal-title fw-bold"
                    id="modalKendaraanLabel">

                    Detail Kendaraan

                </h5>

            </div>

            <div class="modal-body">

                <div class="mb-3">

                    <label class="form-label">
                        Nomor Polisi
                    </label>

                    <input
                        type="text"
                        class="form-control"
                        value="H 4567 WE">

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Merek Kendaraan
                    </label>

                    <input
                        type="text"
                        class="form-control"
                        value="Toyota Avanza">

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Warna Kendaraan
                    </label>

                    <input
                        type="text"
                        class="form-control"
                        value="Putih">

                </div>

                <div class="mb-0">

                    <label class="form-label">
                        Jenis Kendaraan
                    </label>

                    <select class="form-select">

                        <option selected>
                            Mobil
                        </option>

                        <option>
                            Motor
                        </option>

                    </select>

                </div>

            </div>

            <div class="modal-footer">

                <button
                    type="button"
                    class="btn btn-outline-secondary"
                    data-bs-dismiss="modal">

                    Batal

                </button>

                <button
                    type="button"
                    class="btn btn-primary">

                    Simpan Perubahan

                </button>

            </div>

        </div>

    </div>

</div>

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

<style>

@media (max-width: 768px){

    .modal-bottom-sheet{

        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;

        margin: 0;

        max-width: 100%;
        width: 100%;

        transform: translateY(0);

    }

    .modal-bottom-sheet .modal-content{

        border-radius: 24px 24px 0 0;

        min-height: 70vh;
        max-height: 85vh;

        overflow-y: auto;

    }

}
@media (max-width: 768px){

    .modal.fade .modal-dialog.modal-bottom-sheet{
        transform: translateY(100%);
        transition: transform .35s ease-out;
    }

    .modal.show .modal-dialog.modal-bottom-sheet{
        transform: translateY(0);
    }

    .modal-bottom-sheet{

        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;

        margin: 0;
        width: 100%;
        max-width: 100%;

    }

    .modal-bottom-sheet .modal-content{

        border-radius: 24px 24px 0 0;
        min-height: 70vh;
        max-height: 85vh;

        overflow-y: auto;

    }

}
</style>
@endpush

@push('scripts')
<script>
    // Filter slot by area
    function filterSlotByArea(areaId) {
        document.querySelectorAll('#parkingGrid .slot').forEach(slot => {
            slot.style.display = slot.dataset.area == areaId ? '' : 'none';
        });
    }

    const selectArea = document.getElementById('selectArea');
    if (selectArea) {
        filterSlotByArea(selectArea.value);
        selectArea.addEventListener('change', function () {
            filterSlotByArea(this.value);
        });
    }

    // Klik slot → update detail
    document.querySelectorAll('#parkingGrid .slot').forEach(slot => {
        slot.addEventListener('click', function () {
            if (this.classList.contains('occupied')) return;

            document.querySelectorAll('#parkingGrid .slot').forEach(s => s.classList.remove('selected'));
            this.classList.add('selected');

            const kodeSlot  = this.dataset.kode;
            const status    = this.dataset.status;
            const kendaraan = this.dataset.kendaraan;
            const tarif     = parseInt(this.dataset.tarif);
            const slotId    = this.dataset.id;
            const namaArea  = selectArea.options[selectArea.selectedIndex].text;

            document.getElementById('detailNamaSlot').innerText  = kodeSlot;
            document.getElementById('detailStatus').innerText     = status === 'tersedia' ? ' Tersedia' : ' Terisi';
            document.getElementById('detailKendaraan').innerText  = kendaraan.toUpperCase();
            document.getElementById('detailArea').innerText       = namaArea;
            document.getElementById('detailTarif').innerText      = 'Rp ' + tarif.toLocaleString('id-ID') + '/Jam';

            const tanggal  = "{{ $tanggal }}";
            const jamMasuk = "{{ $jam_masuk }}";
            const durasi   = "{{ $durasi }}";
            const lokasiId = "{{ $lokasi->id }}";

            document.getElementById('btnReservasi').href =
                `/customer/reservasi/${slotId}?tanggal_parkir=${tanggal}&jam_masuk=${jamMasuk}&durasi_jam=${durasi}&lokasi_parkir_id=${lokasiId}`;
        });
    });
</script>

<script>
    function filterSlotByArea(areaId) {
        document.querySelectorAll('#parkingGrid .slot').forEach(slot => {
            slot.style.display = slot.dataset.area == areaId ? '' : 'none';
        });
    }

    const selectArea = document.getElementById('selectArea');
    if (selectArea) {
        filterSlotByArea(selectArea.value);
        selectArea.addEventListener('change', function () {
            filterSlotByArea(this.value);
        });
    }
</script>
@endpush



@endsection