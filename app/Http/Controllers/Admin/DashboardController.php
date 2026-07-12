<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LokasiParkir;
use App\Models\AreaParkir;
use App\Models\SlotParkir;
use App\Models\User;
use App\Models\Membership;
use App\Models\Reservasi;
use App\Models\Pembayaran;
use App\Models\Event;
use App\Models\PointTransaction;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPendapatan = Pembayaran::where('status', 'dibayar')->sum('gross_amount');
        $pendapatanBulanIni = Pembayaran::where('status', 'dibayar')
            ->whereMonth('created_at', now()->month)
            ->sum('gross_amount');

        $totalReservasi = Reservasi::count();
        $reservasiHariIni = Reservasi::whereDate('created_at', today())->count();

        $totalMemberAktif = User::where('status_member', 'member')->count();
        $totalUser = User::count();

        $slotTersedia = SlotParkir::where('status', 'tersedia')->count();
        $totalSlot = SlotParkir::count();

        // Catatan: enum reservasi.status = pending, dibayar, digunakan, checkin, selesai
        // TIDAK ADA value 'batal' — jadi $reservasiBatal akan selalu 0 sampai kamu putuskan
        // mau diganti card-nya jadi apa (mis. 'digunakan') atau tambah value baru di enum.
        $reservasiPending = Reservasi::where('status', 'pending')->count();
        $reservasiCheckin = Reservasi::where('status', 'checkin')->count();
        $reservasiSelesai = Reservasi::where('status', 'selesai')->count();
        $reservasiBatal = Reservasi::where('status', 'batal')->count(); // selalu 0, lihat catatan di atas

        $reservasiTerbaru = Reservasi::with(['user', 'lokasiParkir', 'kendaraan'])
            ->latest()
            ->take(8)
            ->get();

        $totalLokasi = LokasiParkir::count();
        $totalArea = AreaParkir::count();
        $slotTerisi = SlotParkir::where('status', 'terisi')->count();
        $totalTransaksiLunas = Pembayaran::where('status', 'dibayar')->count();
        $menungguVerifikasi = Pembayaran::where('status', 'menunggu_verifikasi')->count();
        $userNonaktif = User::where('status_akun', 'nonaktif')->count();

        $totalEvent = Event::count();
        $eventAktif = Event::where('status', 'active')->count();
        $eventUpcoming = Event::where('status', 'upcoming')->count();

        $totalPoinBeredar = User::sum('total_points');
        $poinDitukar = PointTransaction::where('type', 'redeem')->sum('points');

        $lokasiTeramai = LokasiParkir::withCount('reservasi')
            ->orderByDesc('reservasi_count')
            ->take(5)
            ->get();

        return view('Admin.dashboard.index', compact(
            'totalPendapatan', 'pendapatanBulanIni',
            'totalReservasi', 'reservasiHariIni',
            'totalMemberAktif', 'totalUser',
            'slotTersedia', 'totalSlot',
            'reservasiPending', 'reservasiCheckin', 'reservasiSelesai', 'reservasiBatal',
            'reservasiTerbaru',
            'totalLokasi', 'totalArea', 'slotTerisi', 'totalTransaksiLunas',
            'menungguVerifikasi', 'userNonaktif',
            'totalEvent', 'eventAktif', 'eventUpcoming',
            'totalPoinBeredar', 'poinDitukar',
            'lokasiTeramai'
        ));
    }
}