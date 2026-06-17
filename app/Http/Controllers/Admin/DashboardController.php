<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Reservasi;
use App\Models\Kendaraan;
use App\Models\LokasiParkir;
use App\Models\SlotParkir;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // ============ STATISTIK UTAMA ============
        $totalUsers = User::count();
        $totalAdmins = User::where('role', 'admin')->count();
        $totalCustomers = User::where('role', 'customer')->count();
        $totalVehicles = Kendaraan::count();
        $totalReservations = Reservasi::count();
        $totalLocations = LokasiParkir::count();
        $totalSlots = SlotParkir::count();
        
        // Status slot parkir
        $availableSlots = SlotParkir::where('status', 'tersedia')->count();
        $occupiedSlots = SlotParkir::where('status', 'terisi')->count();

        // Status reservasi
        $pendingReservations = Reservasi::where('status', 'pending')->count();
        $paidReservations = Reservasi::where('status', 'dibayar')->count();
        $completedReservations = Reservasi::where('status', 'selesai')->count();
        $canceledReservations = Reservasi::where('status', 'dibatalkan')->count();

        // ============ PERTUMBUHAN (Growth) ============
        $lastMonth = Carbon::now()->subMonth();
        
        $currentMonthReservations = Reservasi::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();
            
        $lastMonthReservations = Reservasi::whereMonth('created_at', $lastMonth->month)
            ->whereYear('created_at', $lastMonth->year)
            ->count();
            
        $reservationGrowth = $lastMonthReservations > 0 
            ? round((($currentMonthReservations - $lastMonthReservations) / $lastMonthReservations) * 100) 
            : 0;

        $currentMonthUsers = User::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();
            
        $lastMonthUsers = User::whereMonth('created_at', $lastMonth->month)
            ->whereYear('created_at', $lastMonth->year)
            ->count();
            
        $userGrowth = $lastMonthUsers > 0 
            ? round((($currentMonthUsers - $lastMonthUsers) / $lastMonthUsers) * 100) 
            : 0;

        // ============ DATA CHART 7 HARI ============
        $labels = [];
        $reservations = [];
        $users = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $labels[] = $date->format('d M');
            $reservations[] = Reservasi::whereDate('created_at', $date)->count();
            $users[] = User::whereDate('created_at', $date)->count();
        }

        $chartData = [
            'labels' => $labels,
            'reservations' => $reservations,
            'users' => $users,
        ];

        // ============ DATA STATUS RESERVASI ============
        $statusData = [
            'pending' => $pendingReservations,
            'dibayar' => $paidReservations,
            'selesai' => $completedReservations,
            'dibatalkan' => $canceledReservations,
        ];

        // ============ LOKASI POPULER ============
        $popularLocations = LokasiParkir::withCount(['reservasi' => function($query) {
                $query->where('status', 'dibayar');
            }])
            ->orderBy('reservasi_count', 'desc')
            ->take(5)
            ->get()
            ->map(function ($location) {
                $totalSlots = SlotParkir::where('lokasi_parkir_id', $location->id)->count();
                $occupiedSlots = SlotParkir::where('lokasi_parkir_id', $location->id)
                    ->where('status', 'terisi')
                    ->count();
                    
                return (object) [
                    'name' => $location->nama,
                    'total' => $occupiedSlots,
                    'capacity' => $totalSlots > 0 ? $totalSlots : 100,
                    'percentage' => $totalSlots > 0 
                        ? round(($occupiedSlots / $totalSlots) * 100) 
                        : 0,
                ];
            });

        if ($popularLocations->isEmpty()) {
            $popularLocations = collect([
                (object) ['name' => 'Belum Ada Data', 'total' => 0, 'capacity' => 100, 'percentage' => 0],
            ]);
        }

        // ============ AKTIVITAS TERBARU ============
        $recentActivities = collect();

        // Reservasi terbaru
        $reservasiList = Reservasi::with('user')
            ->latest()
            ->take(3)
            ->get();

        foreach ($reservasiList as $item) {
            $statusColors = [
                'pending' => 'bg-yellow-100 text-yellow-600',
                'dibayar' => 'bg-green-100 text-green-600',
                'selesai' => 'bg-blue-100 text-blue-600',
                'dibatalkan' => 'bg-red-100 text-red-600',
            ];
            
            $statusLabels = [
                'pending' => 'Menunggu Pembayaran',
                'dibayar' => 'Sudah Dibayar',
                'selesai' => 'Selesai',
                'dibatalkan' => 'Dibatalkan',
            ];
            
            $statusColor = $statusColors[$item->status] ?? 'bg-gray-100 text-gray-600';
            $statusLabel = $statusLabels[$item->status] ?? $item->status;
            
            $dotColor = 'bg-yellow-400';
            if ($item->status === 'dibayar') {
                $dotColor = 'bg-green-400';
            } elseif ($item->status === 'dibatalkan') {
                $dotColor = 'bg-red-400';
            }
            
            $recentActivities->push((object) [
                'type' => 'reservasi',
                'message' => "Reservasi baru dari <span class='font-semibold'>{$item->user->name}</span> - <span class='text-xs px-2 py-0.5 rounded-full {$statusColor}'>{$statusLabel}</span>",
                'time' => $item->created_at->diffForHumans(),
                'icon' => 'event_note',
                'color' => 'text-blue-500',
                'bg_color' => 'bg-blue-100',
                'dot_color' => $dotColor,
            ]);
        }

        // User baru
        $userList = User::latest()
            ->take(2)
            ->get();

        foreach ($userList as $item) {
            $roleLabel = $item->role === 'admin' ? 'Admin' : 'Customer';
            $recentActivities->push((object) [
                'type' => 'user',
                'message' => "User baru mendaftar: <span class='font-semibold'>{$item->name}</span> ({$roleLabel})",
                'time' => $item->created_at->diffForHumans(),
                'icon' => 'person_add',
                'color' => 'text-green-500',
                'bg_color' => 'bg-green-100',
                'dot_color' => 'bg-green-400',
            ]);
        }

        // Urutkan berdasarkan waktu
        $recentActivities = $recentActivities->sortByDesc(function ($item) {
            return $item->time;
        })->values()->take(5);

        // ============ CONVERT KE JSON UNTUK JAVASCRIPT ============
        $chartDataJson = json_encode($chartData);
        $statusDataJson = json_encode($statusData);

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalAdmins',
            'totalCustomers',
            'totalVehicles',
            'totalReservations',
            'totalLocations',
            'totalSlots',
            'availableSlots',
            'occupiedSlots',
            'pendingReservations',
            'paidReservations',
            'completedReservations',
            'canceledReservations',
            'reservationGrowth',
            'userGrowth',
            'chartData',
            'statusData',
            'popularLocations',
            'recentActivities',
            'chartDataJson',
            'statusDataJson'
        ));
    }
}