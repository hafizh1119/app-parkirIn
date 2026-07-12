@extends('Admin.layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="space-y-6">

    <!-- Header -->
    <div>
        <nav class="flex items-center gap-2 text-sm text-gray-500 mb-1">
            <span class="text-[#5445cf] font-semibold">Dashboard</span>
        </nav>
        <h2 class="text-2xl font-bold text-gray-900">Ringkasan Sistem</h2>
        <p class="text-sm text-gray-500">Pantau seluruh aktivitas parkir, member, dan transaksi secara real-time.</p>
    </div>

    <!-- ================= CARD UTAMA ================= -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">

        <div class="bg-gradient-to-r from-[#5445cf] to-[#7c5cbf] p-6 rounded-2xl text-white shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm opacity-80">Total Pendapatan</p>
                    <h2 class="text-2xl font-bold">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h2>
                    <p class="text-xs opacity-70 mt-1">Rp {{ number_format($pendapatanBulanIni, 0, ',', '.') }} bulan ini</p>
                </div>
                <span class="material-symbols-outlined text-4xl opacity-80">payments</span>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Total Reservasi</p>
                    <h2 class="text-3xl font-bold text-gray-800">{{ number_format($totalReservasi) }}</h2>
                    <p class="text-xs text-gray-400 mt-1">{{ $reservasiHariIni }} reservasi hari ini</p>
                </div>
                <span class="material-symbols-outlined text-4xl text-blue-500">receipt_long</span>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Anggota Aktif</p>
                    <h2 class="text-3xl font-bold text-gray-800">{{ number_format($totalMemberAktif) }}</h2>
                    <p class="text-xs text-gray-400 mt-1">dari {{ $totalUser }} total user</p>
                </div>
                <span class="material-symbols-outlined text-4xl text-green-500">group</span>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Slot Tersedia</p>
                    <h2 class="text-3xl font-bold text-gray-800">{{ number_format($slotTersedia) }}</h2>
                    <p class="text-xs text-gray-400 mt-1">dari {{ $totalSlot }} total slot</p>
                </div>
                <span class="material-symbols-outlined text-4xl text-amber-500">local_parking</span>
            </div>
        </div>

    </div>

    <!-- ================= GRID DETAIL ================= -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- Kolom kiri: 2/3 -->
        <div class="lg:col-span-2 space-y-6">

            <!-- Status Reservasi -->
            <div class="bg-white rounded-2xl shadow-md p-6 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-indigo-100 to-transparent rounded-full -mr-10 -mt-10 blur-2xl"></div>
                <div class="flex items-center gap-2 mb-4 relative z-10">
                    <span class="material-symbols-outlined text-indigo-500 text-[18px]">donut_large</span>
                    <h3 class="text-sm font-semibold text-gray-700"> Status Reservasi</h3>
                </div>
                <div class="h-64 flex items-center justify-center relative">
                    <canvas id="chartStatusReservasi"></canvas>
                    <div class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none">
                        <span class="text-3xl font-bold text-gray-800" id="totalReservasiChart">
                            {{ $reservasiPending + $reservasiCheckin + $reservasiSelesai + $reservasiBatal }}
                        </span>
                        <span class="text-xs text-gray-400">Total</span>
                    </div>
                </div>
            </div>

            <!-- Aktivitas Reservasi Terbaru -->
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-gray-200 flex items-center justify-between">
                    <div>
                        <h3 class="font-semibold text-lg text-gray-900">Reservasi Terbaru</h3>
                        <p class="text-sm text-gray-500">{{ $reservasiTerbaru->count() }} aktivitas terakhir</p>
                    </div>
                    <a href="{{ route('admin.pembayaran.index') }}" class="text-sm font-semibold text-[#5445cf] hover:underline">
                        Lihat Semua
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="bg-gray-50 text-gray-600 border-b border-gray-200">
                                <th class="px-4 py-3 text-left font-semibold">Kode</th>
                                <th class="px-4 py-3 text-left font-semibold">Pelanggan</th>
                                <th class="px-4 py-3 text-left font-semibold">Lokasi</th>
                                <th class="px-4 py-3 text-left font-semibold">Kendaraan</th>
                                <th class="px-4 py-3 text-left font-semibold">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($reservasiTerbaru as $r)
                            <tr class="hover:bg-gray-50/50 transition">
                                <td class="px-4 py-3 font-semibold text-gray-800">{{ $r->kode_reservasi }}</td>
                                <td class="px-4 py-3">{{ $r->user->name ?? '-' }}</td>
                                <td class="px-4 py-3 text-gray-600">{{ $r->lokasiParkir->nama ?? '-' }}</td>
                                <td class="px-4 py-3 text-gray-600">{{ ucfirst($r->kendaraan->jenis_kendaraan ?? '-') }}</td>
                                <td class="px-4 py-3">
                                    @php
                                        $badge = match($r->status) {
                                            'dibayar' => 'bg-blue-50 text-blue-600',
                                            'checkin' => 'bg-indigo-50 text-indigo-600',
                                            'digunakan' => 'bg-purple-50 text-purple-600',
                                            'selesai' => 'bg-green-50 text-green-600',
                                            default => 'bg-yellow-50 text-yellow-600',
                                        };
                                    @endphp
                                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase {{ $badge }}">
                                        {{ ucfirst($r->status) }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-4 py-8 text-center text-gray-500">
                                    Belum ada reservasi.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <!-- Kolom kanan: 1/3 -->
        <div class="space-y-6">

            
           <!-- Ringkasan Operasional -->
            <div class="bg-white rounded-2xl shadow-md p-6">
                <div class="flex items-center gap-2 mb-4">
                    <span class="material-symbols-outlined text-teal-500 text-[18px]">bar_chart</span>
                    <h3 class="text-sm font-semibold text-gray-700">Ringkasan Operasional</h3>
                </div>
                <div class="h-64 flex items-center justify-center">
                    <canvas id="chartOperasional"></canvas>
                </div>
            </div>

            <!-- Event & Poin -->
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6">
                <h3 class="font-semibold text-lg text-gray-900 mb-4">Event & Poin</h3>

                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-500">Total Event</span>
                        <span class="font-semibold text-gray-800">{{ $totalEvent }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-500">Event Aktif</span>
                        <span class="font-semibold text-green-600">{{ $eventAktif }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-500">Event Akan Datang</span>
                        <span class="font-semibold text-blue-600">{{ $eventUpcoming }}</span>
                    </div>
                    <hr class="border-gray-100">
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-500">Poin Beredar</span>
                        <span class="font-semibold text-gray-800">{{ number_format($totalPoinBeredar) }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-500">Poin Ditukar</span>
                        <span class="font-semibold text-purple-600">{{ number_format($poinDitukar) }}</span>
                    </div>
                </div>
            </div>

            <!-- Lokasi Teramai -->
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6">
                <h3 class="font-semibold text-lg text-gray-900 mb-4">Lokasi Parkir</h3>

                <div class="space-y-3">
                    @forelse($lokasiTeramai as $i => $lokasi)
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <span class="w-6 h-6 rounded-full bg-[#5445cf]/10 text-[#5445cf] text-xs font-bold flex items-center justify-center">
                                {{ $i + 1 }}
                            </span>
                            <span class="text-sm text-gray-700">{{ $lokasi->nama }}</span>
                        </div>
                        <span class="text-sm font-semibold text-gray-800">{{ $lokasi->reservasi_count }}</span>
                    </div>
                    @empty
                    <p class="text-sm text-gray-500">Belum ada data.</p>
                    @endforelse
                </div>
            </div>

        </div>

    </div>

</div>

@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.min.js"></script>
<script>
    // ===== Palet warna modern (vivid tapi soft) =====
    const palette = {
        amber:   '#f59e0b',
        sky:     '#0ea5e9',
        emerald: '#10b981',
        rose:    '#f43f5e',
        violet:  '#8b5cf6',
        indigo:  '#6366f1',
        teal:    '#14b8a6',
        slate:   '#64748b',
    };

    // ===== Donut Chart: Status Reservasi =====
    const ctxStatus = document.getElementById('chartStatusReservasi');

    new Chart(ctxStatus, {
        type: 'doughnut',
        data: {
            labels: ['Pending', 'Check-in', 'Selesai', 'Batal'],
            datasets: [{
                data: [
                    {{ $reservasiPending }},
                    {{ $reservasiCheckin }},
                    {{ $reservasiSelesai }},
                    {{ $reservasiBatal }}
                ],
                backgroundColor: [palette.amber, palette.sky, palette.emerald, palette.rose],
                borderWidth: 4,
                borderColor: '#ffffff',
                hoverOffset: 8,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '72%',
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        usePointStyle: true,
                        pointStyle: 'circle',
                        boxWidth: 8,
                        font: { size: 11 },
                        padding: 16,
                    },
                },
                tooltip: {
                    backgroundColor: '#1f2937',
                    padding: 12,
                    cornerRadius: 8,
                    titleFont: { size: 12, weight: 'bold' },
                    bodyFont: { size: 12 },
                    callbacks: {
                        label: function (context) {
                            const value = context.parsed;
                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                            const percentage = total > 0 ? ((value / total) * 100).toFixed(1) : 0;
                            return `${value} reservasi (${percentage}%)`;
                        },
                    },
                },
            },
        }
    });

    // ===== Bar Chart: Ringkasan Operasional (gradient) =====
    const ctxOps = document.getElementById('chartOperasional');
    const gradientColors = [palette.indigo, palette.sky, palette.rose, palette.emerald, palette.amber, palette.slate];

    // Bikin gradient vertikal buat tiap bar
    const barGradients = gradientColors.map(color => {
        const gradient = ctxOps.getContext('2d').createLinearGradient(0, 0, 0, 260);
        gradient.addColorStop(0, color);
        gradient.addColorStop(1, color + '33'); // fade ke transparan di bawah
        return gradient;
    });

    new Chart(ctxOps, {
        type: 'bar',
        data: {
            labels: ['Lokasi', 'Area', 'Slot Terisi', 'Transaksi Lunas', 'Menunggu', 'Nonaktif'],
            datasets: [{
                label: 'Jumlah',
                data: [
                    {{ $totalLokasi }},
                    {{ $totalArea }},
                    {{ $slotTerisi }},
                    {{ $totalTransaksiLunas }},
                    {{ $menungguVerifikasi }},
                    {{ $userNonaktif }}
                ],
                backgroundColor: barGradients,
                borderRadius: 8,
                borderSkipped: false,
                maxBarThickness: 42,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#1f2937',
                    padding: 12,
                    cornerRadius: 8,
                    titleFont: { size: 12, weight: 'bold' },
                    bodyFont: { size: 12 },
                },
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: '#f1f5f9' },
                    ticks: { precision: 0, font: { size: 11 } },
                },
                x: {
                    grid: { display: false },
                    ticks: { font: { size: 11 } },
                },
            },
        }
    });
</script>
@endpush