@extends('Admin.layouts.app')

@section('content')

<div class="mb-6">
    <h2 class="text-2xl font-bold">
        Verifikasi Pembayaran
    </h2>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-6">

    <div class="bg-white rounded-2xl shadow-sm p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">
                    Total Pendapatan
                </p>
                <h3 class="text-2xl font-bold text-green-600 mt-2">
                    Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
                </h3>
            </div>

            <span class="material-symbols-outlined text-green-600 text-4xl">
                payments
            </span>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">
                    Parkir Mobil
                </p>
                <h3 class="text-2xl font-bold text-blue-600 mt-2">
                    {{ $parkirMobil }}
                </h3>
            </div>

            <span class="material-symbols-outlined text-blue-600 text-4xl">
                directions_car
            </span>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">
                    Parkir Motor
                </p>
                <h3 class="text-2xl font-bold text-orange-600 mt-2">
                    {{ $parkirMotor }}
                </h3>
            </div>

            <span class="material-symbols-outlined text-orange-600 text-4xl">
                two_wheeler
            </span>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">
                    Transaksi Berhasil
                </p>
                <h3 class="text-2xl font-bold text-purple-600 mt-2">
                    {{ $totalTransaksi }}
                </h3>
            </div>

            <span class="material-symbols-outlined text-purple-600 text-4xl">
                receipt_long
            </span>
        </div>
    </div>

</div>

<div class="bg-white rounded-2xl shadow overflow-hidden">

    <table class="w-full">

        <thead class="bg-gray-50">
            <tr>
                <th class="px-4 py-3 text-left">Kode Reservasi</th>
                <th class="px-4 py-3 text-left">Nama Customer</th>
                <th class="px-4 py-3 text-left">Lokasi</th>
                <th class="px-4 py-3 text-left">Slot</th>
                <th class="px-4 py-3 text-left">Total Bayar</th>
                <th class="px-4 py-3 text-center">Bukti Transfer</th>
                <th class="px-4 py-3 text-left">Status</th>
                <th class="px-4 py-3 text-center">Aksi</th>
            </tr>
        </thead>

        <tbody>

            @forelse($pembayaran as $item)

            <tr class="border-t hover:bg-gray-50">

                <td class="px-4 py-4 font-medium">
                    {{ $item->reservasi->kode_reservasi }}
                </td>

                <td class="px-4 py-4">
                    {{ $item->reservasi->user->name ?? '-' }}
                </td>

                <td class="px-4 py-4">
                    {{ $item->reservasi->lokasiParkir->nama ?? '-' }}
                </td>

                <td class="px-4 py-4">
                    {{ $item->reservasi->slotParkir->kode_slot ?? '-' }}
                </td>

                <td class="px-4 py-4 font-semibold text-primary">
                    Rp {{ number_format($item->reservasi->total_bayar ?? 0, 0, ',', '.') }}
                </td>

                <td class="px-4 py-4 text-center">

                    <a
                        href="{{ asset('assets/img/bukti-pembayaran/' . $item->bukti_pembayaran) }}"
                        target="_blank">

                        <img
                            src="{{ asset('assets/img/bukti-pembayaran/' . $item->bukti_pembayaran) }}"
                            alt="Bukti Pembayaran"
                            class="w-16 h-16 object-cover rounded-lg border mx-auto hover:scale-105 transition">

                    </a>

                </td>

                <td class="px-4 py-4">

                    @if($item->status == 'menunggu_verifikasi')

                        <div class="flex items-center justify-center gap-2">

                            <form action="{{ route('admin.pembayaran.verifikasi', $item->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="px-3 py-2 rounded-lg bg-green-600 text-white hover:bg-green-700">
                                    Terima
                                </button>
                            </form>

                            <form action="{{ route('admin.pembayaran.tolak', $item->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="px-3 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700">
                                    Tolak
                                </button>
                            </form>

                        </div>

                    @elseif($item->status == 'dibayar')
                        <span class="px-2 py-1 bg-green-100 text-green-700 rounded-full text-xs font-semibold">✓ Diterima</span>

                    @elseif($item->status == 'ditolak')
                        <span class="px-2 py-1 bg-red-100 text-red-700 rounded-full text-xs font-semibold">✗ Ditolak</span>

                    @else
                        <span class="text-gray-400 text-sm">{{ $item->status }}</span>

                    @endif

                </td>

                <td class="px-4 py-4">

                    @if($item->status == 'pending')

                    <div class="flex items-center justify-center gap-2">

                        <form
                            action="{{ route('admin.pembayaran.verifikasi', $item->id) }}" method="POST"
                            method="POST">

                            @csrf

                            <button
                                type="submit"
                                class="px-3 py-2 rounded-lg bg-green-600 text-white hover:bg-green-700">

                                Terima

                            </button>

                        </form>

                        <form
                            action="{{ route('admin.pembayaran.tolak', $item->id) }}" method="POST"
                            method="POST">

                            @csrf

                            <button
                                type="submit"
                                class="px-3 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700">

                                Tolak

                            </button>

                        </form>

                    </div>

                    @else

                    <span class="text-gray-400 text-sm">
                        Selesai
                    </span>

                    @endif

                </td>

            </tr>

            @empty

            <tr>
                <td colspan="7" class="text-center py-10 text-gray-500">
                    Belum ada data pembayaran
                </td>
            </tr>

            @endforelse

        </tbody>

    </table>

</div>

@endsection