@extends('Admin.layouts.app')

@section('title', 'Scan QR Code')

@section('content')
<div class="p-6">

    <h2 class="text-2xl font-bold mb-6">Scan QR Code Parkir</h2>

    <div class="grid grid-cols-12 gap-6">

        {{-- Scanner --}}
        <div class="col-span-12 lg:col-span-6">
            <div class="bg-white rounded-2xl shadow p-6">

                <h3 class="font-semibold text-lg mb-4">Kamera Scanner</h3>

                <div id="reader" class="w-full rounded-xl overflow-hidden"></div>

                <div class="mt-4">
                    <input
                        type="text"
                        id="manualInput"
                        placeholder="Atau masukkan kode QR manual..."
                        class="w-full border rounded-xl px-4 py-2 mt-2">
                    <button
                        onclick="scanManual()"
                        class="mt-2 w-full bg-primary text-white py-2 rounded-xl">
                        Scan Manual
                    </button>
                </div>

            </div>
        </div>

        {{-- Hasil Scan --}}
        <div class="col-span-12 lg:col-span-6">
            <div class="bg-white rounded-2xl shadow p-6">

                <h3 class="font-semibold text-lg mb-4">Hasil Scan</h3>

                <div id="hasilScan" class="text-gray-400 text-center py-12">
                    Belum ada hasil scan
                </div>

            </div>
        </div>

    </div>

</div>
@endsection

@push('scripts')
<script src="https://unpkg.com/html5-qrcode"></script>
<script>
    const html5QrCode = new Html5Qrcode("reader");

    html5QrCode.start(
        { facingMode: "environment" },
        { fps: 10, qrbox: { width: 300, height: 300 } },
        (decodedText) => {
            html5QrCode.stop();
            prosesQR(decodedText);
        },
        (errorMessage) => {}
    ).catch(err => {
        document.getElementById('reader').innerHTML = `
            <div class="text-red-500 text-center py-8">
                <span class="material-symbols-outlined text-4xl">videocam_off</span>
                <p class="mt-2">Kamera tidak dapat diakses: ${err}</p>
                <p class="text-sm text-gray-400">Gunakan input manual di bawah</p>
            </div>
        `;
    });

    function scanManual() {
        const val = document.getElementById('manualInput').value.trim();
        if (val) prosesQR(val);
    }

    function prosesQR(data) {
        fetch("{{ route('admin.scan.process') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ qr_data: data })
        })
        .then(res => {
            if (!res.ok) {
                return res.text().then(text => { throw new Error(text) });
            }
            return res.json();
        })
        .then(result => {
            const el = document.getElementById('hasilScan');

            if (result.status === 'success') {
                const r = result.reservasi;

                if (result.mode === 'checkin') {
                    el.innerHTML = `
                        <div class="bg-green-50 border border-green-200 rounded-xl p-4 text-left">
                            <div class="flex items-center gap-2 mb-3">
                                <span class="material-symbols-outlined text-green-600">login</span>
                                <span class="font-bold text-green-700 text-lg">Check-in Berhasil!</span>
                            </div>
                            <div class="space-y-2 text-sm">
                                <div class="flex justify-between border-b pb-1"><span class="text-gray-500">Kode</span><span class="font-semibold">${r.kode}</span></div>
                                <div class="flex justify-between border-b pb-1"><span class="text-gray-500">Nama</span><span class="font-semibold">${r.nama}</span></div>
                                <div class="flex justify-between border-b pb-1"><span class="text-gray-500">Slot</span><span class="font-semibold">${r.slot}</span></div>
                                <div class="flex justify-between border-b pb-1"><span class="text-gray-500">Kendaraan</span><span class="font-semibold">${r.kendaraan}</span></div>
                                <div class="flex justify-between border-b pb-1"><span class="text-gray-500">Tanggal</span><span class="font-semibold">${r.tanggal}</span></div>
                                <div class="flex justify-between border-b pb-1"><span class="text-gray-500">Jam Masuk</span><span class="font-semibold">${r.jam}</span></div>
                                <div class="flex justify-between"><span class="text-gray-500">Durasi Booking</span><span class="font-semibold">${r.durasi} Jam</span></div>
                            </div>
                        </div>
                    `;
                } else {
                    const kekurangan = parseInt(r.kekurangan);
                    el.innerHTML = `
                        <div class="${kekurangan > 0 ? 'bg-yellow-50 border-yellow-200' : 'bg-green-50 border-green-200'} border rounded-xl p-4 text-left">
                            <div class="flex items-center gap-2 mb-3">
                                <span class="material-symbols-outlined ${kekurangan > 0 ? 'text-yellow-600' : 'text-green-600'}">logout</span>
                                <span class="font-bold ${kekurangan > 0 ? 'text-yellow-700' : 'text-green-700'} text-lg">
                                    ${kekurangan > 0 ? '⚠️ Check-out - Ada Kekurangan Bayar!' : '✅ Check-out Berhasil!'}
                                </span>
                            </div>
                            <div class="space-y-2 text-sm">
                                <div class="flex justify-between border-b pb-1"><span class="text-gray-500">Kode</span><span class="font-semibold">${r.kode}</span></div>
                                <div class="flex justify-between border-b pb-1"><span class="text-gray-500">Nama</span><span class="font-semibold">${r.nama}</span></div>
                                <div class="flex justify-between border-b pb-1"><span class="text-gray-500">Kendaraan</span><span class="font-semibold">${r.kendaraan}</span></div>
                                <div class="flex justify-between border-b pb-1"><span class="text-gray-500">Jam Masuk</span><span class="font-semibold">${r.jam_masuk}</span></div>
                                <div class="flex justify-between border-b pb-1"><span class="text-gray-500">Jam Keluar</span><span class="font-semibold">${r.jam_keluar}</span></div>
                                <div class="flex justify-between border-b pb-1"><span class="text-gray-500">Durasi Booking</span><span class="font-semibold">${r.durasi_booking} Jam</span></div>
                                <div class="flex justify-between border-b pb-1"><span class="text-gray-500">Durasi Aktual</span><span class="font-semibold">${r.durasi_aktual} Jam</span></div>
                                <div class="flex justify-between border-b pb-1"><span class="text-gray-500">Total Dibayar</span><span class="font-semibold">Rp ${parseInt(r.total_dibayar).toLocaleString('id-ID')}</span></div>
                                <div class="flex justify-between border-b pb-1"><span class="text-gray-500">Total Aktual</span><span class="font-semibold">Rp ${parseInt(r.total_aktual).toLocaleString('id-ID')}</span></div>
                                <div class="flex justify-between pt-1">
                                    <span class="font-bold ${kekurangan > 0 ? 'text-red-600' : 'text-green-600'}">
                                        ${kekurangan > 0 ? 'Kekurangan Bayar' : 'Lunas'}
                                    </span>
                                    <span class="font-bold text-lg ${kekurangan > 0 ? 'text-red-600' : 'text-green-600'}">
                                        ${kekurangan > 0 ? 'Rp ' + kekurangan.toLocaleString('id-ID') : '✓'}
                                    </span>
                                </div>
                            </div>
                        </div>
                    `;
                }
            } else {
                el.innerHTML = `
                    <div class="bg-red-50 border border-red-200 rounded-xl p-4 text-center">
                        <span class="material-symbols-outlined text-red-500 text-5xl">cancel</span>
                        <p class="text-red-600 font-bold text-lg mt-2">❌ QR Tidak Valid</p>
                        <p class="text-red-500 mt-1">${result.message}</p>
                    </div>
                `;
            }
        })
        .catch(err => {
            document.getElementById('hasilScan').innerHTML = `
                <div class="bg-red-50 border border-red-200 rounded-xl p-4 text-center">
                    <span class="material-symbols-outlined text-red-500 text-5xl">error</span>
                    <p class="text-red-600 font-bold mt-2">Gagal menghubungi server</p>
                    <p class="text-red-400 text-sm mt-1">${err.message}</p>
                </div>
            `;
        });
    }
</script>
@endpush