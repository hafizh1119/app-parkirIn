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
                                    class="slot {{ $slot->status_tampil == 'tersedia' ? 'available' : 'occupied' }}"
                                    data-id="{{ $slot->id }}"
                                    data-kode="{{ $slot->kode_slot }}"
                                    data-area="{{ $slot->area_parkir_id }}"
                                    data-status="{{ $slot->status_tampil }}"
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

            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-body-secondary">Kendaraan Terdaftar</small>
                            <h6 class="fw-bold mb-0 mt-1" id="selectedMerk">{{ $kendaraan->merk }}</h6>
                            <small class="text-body-secondary" id="selectedNopol">{{ $kendaraan->nomor_polisi }}</small>
                        </div>

                        <button type="button" class="btn btn-sm btn-outline-primary"
                            data-bs-toggle="modal" data-bs-target="#modalKendaraan">
                            <i class="mdi mdi-pencil-outline me-1"></i> Ubah
                        </button>
                    </div>

                    {{-- PENTING: ini yang sebelumnya tidak ada.
                        Dipakai untuk tahu kendaraan mana yang benar-benar terpilih
                        saat user klik "Reservasi Sekarang" --}}
                    <input type="hidden" id="selectedKendaraanId" value="{{ $kendaraan->id }}">
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

<!-- Modal Kendaraan -->
<div class="modal fade" id="modalKendaraan" tabindex="-1" aria-labelledby="modalKendaraanLabel" aria-hidden="true">
    <div class="modal-dialog modal-bottom-sheet">
        <div class="modal-content">
            <div class="sheet-handle"></div>

            <div class="modal-header border-0 pb-2">
                <h5 class="modal-title fw-bold" id="modalKendaraanLabel">Pilih Kendaraan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <label class="fw-semibold mb-3 d-block">Kendaraan Terdaftar</label>

                <div class="list-group">
                    @foreach($kendaraanList as $item)
                        <label class="vehicle-item">
                            <div class="d-flex align-items-center">
                                <input
                                    class="form-check-input me-3 kendaraan-radio"
                                    type="radio"
                                    name="kendaraan_id"
                                    value="{{ $item->id }}"
                                    data-merk="{{ $item->merk }}"
                                    data-nopol="{{ $item->nomor_polisi }}"
                                    data-warna="{{ $item->warna }}"
                                    data-jenis="{{ $item->jenis_kendaraan }}"
                                    {{ $item->id == $kendaraan->id ? 'checked' : '' }}>

                                <div>
                                    <div class="vehicle-title">{{ $item->nomor_polisi }}</div>
                                    <div class="vehicle-sub">{{ $item->merk }}</div>
                                    <small class="text-muted">
                                        {{ ucfirst($item->jenis_kendaraan) }} • {{ $item->warna }}
                                    </small>
                                </div>
                            </div>
                        </label>
                    @endforeach
                </div>

                <button type="button" class="btn btn-primary w-100 mt-3"
                    data-bs-target="#modalTambahKendaraan" data-bs-toggle="modal">
                    <i class="ti ti-plus me-1"></i> Tambah Kendaraan
                </button>
            </div>

            <div class="modal-footer border-0">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" id="btnSimpanKendaraan" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalTambahKendaraan" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-bottom-sheet">
        <div class="modal-content">
            <div class="sheet-handle"></div>

            <div class="modal-header border-0">
                <h5 class="fw-bold">Tambah Kendaraan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form action="{{ route('customer.kendaraan.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Jenis Kendaraan</label>
                        <select name="jenis_kendaraan" class="form-select" required>
                            <option value="">Pilih</option>
                            <option value="mobil">Mobil</option>
                            <option value="motor">Motor</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nomor Polisi</label>
                        <input type="text" name="nomor_polisi" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Merk Kendaraan</label>
                        <input type="text" name="merk" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Warna</label>
                        <input type="text" name="warna" class="form-control" required>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Kendaraan</button>
                </div>
            </form>
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
.available{ background:#28c76f; }
.occupied{ background:#ea5455; }
.selected{ background:#7367f0; }
.slot:hover{ transform:translateY(-2px); }

.sheet-handle{
    width:55px;
    height:6px;
    background:#d9d9d9;
    border-radius:20px;
    margin:12px auto 6px;
}

.vehicle-item{
    border:1px solid #ebeef2;
    border-radius:16px;
    padding:16px;
    margin-bottom:14px;
    cursor:pointer;
    transition:.25s;
    background:#fff;
}
.vehicle-item:hover{
    border-color:#696cff;
    background:#f8f8ff;
}
.vehicle-item input{ margin-top:3px; }
.vehicle-item:has(input:checked){
    border:2px solid #696cff;
    background:#eef1ff;
    box-shadow:0 8px 20px rgba(105,108,255,.12);
}
.vehicle-title{ font-size:15px; font-weight:700; }
.vehicle-sub{ font-size:13px; color:#7a7a7a; }

@media (max-width:768px){
    .modal.fade .modal-dialog.modal-bottom-sheet{
        transform: translateY(100%);
        transition: transform .35s ease;
        margin:0;
    }
    .modal.show .modal-dialog.modal-bottom-sheet{
        transform: translateY(0);
    }
    .modal-bottom-sheet{
        position:fixed;
        left:0; right:0; bottom:0;
        width:100%; max-width:100%;
        margin:0;
        display:flex;
        align-items:flex-end;
    }
    .modal-bottom-sheet .modal-content{
        width:100%;
        border:0;
        border-radius:28px 28px 0 0;
        min-height:70vh;
        max-height:85vh;
        overflow:hidden;
        overflow-y:auto;
        box-shadow:0 -10px 40px rgba(0,0,0,.18);
        animation:sheetUp .35s ease;
    }
    .modal-backdrop.show{
        opacity:.45;
        backdrop-filter:blur(2px);
    }
}

@keyframes sheetUp{
    from{ transform:translateY(80px); opacity:.4; }
    to{ transform:translateY(0); opacity:1; }
}
</style>
@endpush


@push('scripts')
<script>
(function () {
    // ---------- Filter slot by area ----------
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

    // ---------- Klik slot parkir -> update detail ----------
    document.querySelectorAll('#parkingGrid .slot').forEach(slot => {
        slot.addEventListener('click', function () {
            if (this.classList.contains('occupied')) return;

            document.querySelectorAll('#parkingGrid .slot').forEach(s => s.classList.remove('selected'));
            this.classList.add('selected');

            const kodeSlot  = this.dataset.kode;
            const status    = this.dataset.status;
            const kendaraan = this.dataset.kendaraan;
            const tarif     = parseInt(this.dataset.tarif, 10);
            const slotId    = this.dataset.id;
            const namaArea  = selectArea.options[selectArea.selectedIndex].text;

            document.getElementById('detailNamaSlot').innerText = kodeSlot;
            document.getElementById('detailStatus').innerText   = status === 'tersedia' ? 'Tersedia' : 'Terisi';
            document.getElementById('detailKendaraan').innerText = kendaraan.toUpperCase();
            document.getElementById('detailArea').innerText      = namaArea;
            document.getElementById('detailTarif').innerText     = 'Rp ' + tarif.toLocaleString('id-ID') + '/Jam';

            const tanggal  = "{{ $tanggal }}";
            const jamMasuk = "{{ $jam_masuk }}";
            const durasi   = "{{ $durasi }}";
            const lokasiId = "{{ $lokasi->id }}";
            // ikutkan kendaraan_id yang sedang aktif ke link reservasi
            const kendaraanId = document.getElementById('selectedKendaraanId').value;

            document.getElementById('btnReservasi').href =
                `/customer/reservasi/${slotId}?tanggal_parkir=${tanggal}&jam_masuk=${jamMasuk}&durasi_jam=${durasi}&lokasi_parkir_id=${lokasiId}&kendaraan_id=${kendaraanId}`;
        });
    });

    // ---------- Modal kendaraan <-> modal tambah kendaraan ----------
    const modalKendaraanEl = document.getElementById('modalKendaraan');
    const modalTambahEl    = document.getElementById('modalTambahKendaraan');

    if (modalKendaraanEl && modalTambahEl) {
        modalTambahEl.addEventListener('show.bs.modal', function () {
            const instance = bootstrap.Modal.getInstance(modalKendaraanEl);
            if (instance) instance.hide();
        });

        modalTambahEl.addEventListener('hidden.bs.modal', function () {
            // hanya tampilkan lagi modalKendaraan kalau form tambah TIDAK baru saja submit
            new bootstrap.Modal(modalKendaraanEl).show();
        });
    }

    // ---------- Simpan kendaraan terpilih (FIX UTAMA) ----------
    const btnSimpan = document.getElementById('btnSimpanKendaraan');
    if (btnSimpan) {
        btnSimpan.addEventListener('click', function () {
            const radio = document.querySelector('.kendaraan-radio:checked');

            if (!radio) {
                alert('Pilih salah satu kendaraan terlebih dahulu.');
                return;
            }

            document.getElementById('selectedMerk').innerText  = radio.dataset.merk;
            document.getElementById('selectedNopol').innerText = radio.dataset.nopol;
            document.getElementById('selectedKendaraanId').value = radio.value;

            const instance = bootstrap.Modal.getInstance(modalKendaraanEl);
            if (instance) instance.hide();
        });
    }
})();
</script>
@endpush



@endsection