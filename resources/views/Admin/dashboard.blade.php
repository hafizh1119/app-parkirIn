<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>ParkirIn - Dashboard</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: "#5445cf",
                        "brand-purple": "#7367F0",
                        surface: "#fcf8ff",
                        "surface-container": "#f0ecf8",
                        "surface-container-lowest": "#ffffff",
                        "on-surface": "#1c1b23",
                        secondary: "#5b5f63",
                        "on-surface-variant": "#474554",
                        "outline-variant": "#c8c4d6",
                        error: "#ba1a1a",
                    },
                    fontFamily: {
                        'label-sm': ['Inter'],
                        'headline-md': ['Inter'],
                        'headline-lg': ['Inter'],
                        'body-md': ['Inter'],
                        'body-lg': ['Inter'],
                        'headline-xl': ['Inter'],
                        'label-md': ['Inter']
                    },
                    boxShadow: {
                        'elevation-1': '0px 2px 10px 0px rgba(76, 78, 100, 0.1)',
                        'elevation-2': '0px 4px 18px 0px rgba(76, 78, 100, 0.12)'
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .stat-card {
            transition: all 0.3s ease;
        }
        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 25px rgba(76, 78, 100, 0.15);
        }
        .stat-icon {
            transition: all 0.3s ease;
        }
        .stat-card:hover .stat-icon {
            transform: scale(1.1) rotate(-5deg);
        }
        .chart-container {
            position: relative;
            height: 250px;
        }
        .activity-item {
            transition: all 0.3s ease;
        }
        .activity-item:hover {
            background: rgba(84, 69, 207, 0.05);
            transform: translateX(4px);
        }
        .progress-bar {
            transition: width 1.5s ease;
        }
    </style>
</head>
<body class="bg-[#fcf8ff] text-[#1c1b23] antialiased flex min-h-screen">

<!-- ==================== SIDEBAR ==================== -->
<aside class="fixed left-0 top-0 h-full w-64 bg-white shadow-md flex flex-col py-4 px-3 z-50">
    <div class="flex items-center gap-3 px-4 py-6 mb-4">
        <div class="w-10 h-10 bg-[#5445cf] rounded-lg flex items-center justify-center">
            <span class="material-symbols-outlined text-white" style="font-variation-settings: 'FILL' 1;">local_parking</span>
        </div>
        <div>
            <h1 class="text-xl font-bold text-[#5445cf]">ParkirIn</h1>
            <p class="text-xs text-[#5b5f63] opacity-70">Admin Console</p>
        </div>
    </div>
    <nav class="flex-1 space-y-1 overflow-y-auto">
        <!-- DASHBOARD -->
        <a class="flex items-center gap-3 px-4 py-3 rounded-lg bg-[#5445cf]/10 text-[#5445cf] font-bold border-r-4 border-[#5445cf]" href="/admin/dashboard">
            <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">dashboard</span>
            <span>Dashboard</span>
        </a>

        <!-- LOKASI PARKIR - SUDAH BISA DI KLIK -->
        <a class="flex items-center gap-3 px-4 py-3 rounded-lg text-[#5b5f63] hover:bg-[#e5e1ec]/50 transition-colors" href="/admin/lokasi-parkir">
            <span class="material-symbols-outlined">local_parking</span>
            <span>Lokasi Parkir</span>
        </a>

        <a class="flex items-center gap-3 px-4 py-3 rounded-lg text-[#5b5f63] hover:bg-[#e5e1ec]/50 transition-colors" href="#">
            <span class="material-symbols-outlined">group</span>
            <span>User Management</span>
        </a>
        <a class="flex items-center gap-3 px-4 py-3 rounded-lg text-[#5b5f63] hover:bg-[#e5e1ec]/50 transition-colors" href="#">
            <span class="material-symbols-outlined">assessment</span>
            <span>Reports</span>
        </a>
    </nav>
    <div class="mt-auto px-4 py-4 border-t border-[#c8c4d6]/30">
        <a href="/admin/lokasi-parkir/create" class="w-full bg-[#5445cf] text-white py-3 rounded-lg flex items-center justify-center gap-2 shadow-lg hover:shadow-[#5445cf]/20 transition-all">
            <span class="material-symbols-outlined text-[20px]">add</span>
            <span>Tambah Lokasi</span>
        </a>
    </div>
</aside>

<!-- ==================== MAIN CONTENT ==================== -->
<main class="flex-1 ml-64 flex flex-col min-h-screen max-w-[calc(1440px-256px)] mx-auto w-full">

    <!-- Top Navbar -->
    <header class="flex justify-between items-center h-16 px-8 bg-white shadow-sm sticky top-0 z-40">
        <div class="flex items-center gap-4 flex-1">
            <div class="relative w-full max-w-md">
                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-[#787586]">search</span>
                <input class="w-full pl-10 pr-4 py-2 bg-[#f0ecf8] rounded-lg border-none focus:ring-2 focus:ring-[#5445cf]/20 transition-all" placeholder="Search anything..." type="text"/>
            </div>
        </div>
        <div class="flex items-center gap-4">
            <button class="w-10 h-10 flex items-center justify-center rounded-full hover:bg-[#e5e1ec] transition-colors relative">
                <span class="material-symbols-outlined text-[#474554]">notifications</span>
                <span class="absolute top-2 right-2.5 w-2 h-2 bg-[#ba1a1a] rounded-full border-2 border-white"></span>
            </button>
            <button class="w-10 h-10 flex items-center justify-center rounded-full hover:bg-[#e5e1ec] transition-colors">
                <span class="material-symbols-outlined text-[#474554]">settings</span>
            </button>
            <div class="h-8 w-px bg-[#c8c4d6]/50 mx-2"></div>
            <div class="flex items-center gap-3">
                <div class="text-right">
                    <p class="text-sm font-bold text-[#1c1b23]">Admin User</p>
                    <p class="text-xs text-[#5b5f63]">Super Admin</p>
                </div>
                <img class="w-10 h-10 rounded-full border-2 border-[#5445cf]" src="https://ui-avatars.com/api/?name=Admin&background=5445cf&color=fff&size=100" alt="Profile"/>
            </div>
        </div>
    </header>

    <!-- Page Content -->
    <div class="p-8 bg-[#fcf8ff] flex-1 overflow-y-auto">

        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
            <div>
                <h2 class="text-3xl font-bold text-[#1c1b23]">Dashboard</h2>
                <p class="text-[#5b5f63] text-sm mt-1">Selamat datang kembali, Admin!</p>
            </div>
            <div class="flex items-center gap-3">
                <div class="px-4 py-3 bg-white rounded-lg border border-[#c8c4d6]/20 flex items-center gap-2">
                    <span class="material-symbols-outlined text-[20px] text-[#5b5f63]">calendar_today</span>
                    <span class="text-sm text-[#5b5f63]">{{ date('d F Y') }}</span>
                </div>
                <button onclick="location.reload()" class="px-4 py-3 bg-[#5445cf] text-white rounded-lg flex items-center gap-2 shadow-lg hover:shadow-[#5445cf]/30 transition-all">
                    <span class="material-symbols-outlined text-[20px]">refresh</span>
                    <span class="text-sm font-bold">Refresh</span>
                </button>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            <div class="stat-card bg-white rounded-2xl shadow-elevation-1 p-4 border border-[#c8c4d6]/20">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-[#5b5f63] text-sm font-medium">Total Reservasi</p>
                        <p class="text-3xl font-bold text-[#1c1b23] mt-1">{{ number_format($totalReservations ?? 0) }}</p>
                        <p class="text-xs {{ ($reservationGrowth ?? 0) >= 0 ? 'text-green-600' : 'text-red-600' }} mt-1 flex items-center gap-1">
                            <span class="material-symbols-outlined text-[16px]">{{ ($reservationGrowth ?? 0) >= 0 ? 'trending_up' : 'trending_down' }}</span>
                            {{ ($reservationGrowth ?? 0) >= 0 ? '+' : '' }}{{ $reservationGrowth ?? 0 }}% dari bulan lalu
                        </p>
                    </div>
                    <div class="stat-icon w-14 h-14 bg-[#5445cf]/10 rounded-2xl flex items-center justify-center text-[#5445cf]">
                        <span class="material-symbols-outlined text-[32px]">event_note</span>
                    </div>
                </div>
            </div>

            <div class="stat-card bg-white rounded-2xl shadow-elevation-1 p-4 border border-[#c8c4d6]/20">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-[#5b5f63] text-sm font-medium">Total User</p>
                        <p class="text-3xl font-bold text-[#1c1b23] mt-1">{{ number_format($totalUsers ?? 0) }}</p>
                        <p class="text-xs {{ ($userGrowth ?? 0) >= 0 ? 'text-green-600' : 'text-red-600' }} mt-1 flex items-center gap-1">
                            <span class="material-symbols-outlined text-[16px]">{{ ($userGrowth ?? 0) >= 0 ? 'trending_up' : 'trending_down' }}</span>
                            {{ ($userGrowth ?? 0) >= 0 ? '+' : '' }}{{ $userGrowth ?? 0 }}% dari bulan lalu
                        </p>
                    </div>
                    <div class="stat-icon w-14 h-14 bg-blue-100 rounded-2xl flex items-center justify-center text-blue-600">
                        <span class="material-symbols-outlined text-[32px]">people</span>
                    </div>
                </div>
            </div>

            <div class="stat-card bg-white rounded-2xl shadow-elevation-1 p-4 border border-[#c8c4d6]/20">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-[#5b5f63] text-sm font-medium">Total Kendaraan</p>
                        <p class="text-3xl font-bold text-[#1c1b23] mt-1">{{ number_format($totalVehicles ?? 0) }}</p>
                        <p class="text-xs text-[#5b5f63] mt-1 flex items-center gap-1">
                            <span class="material-symbols-outlined text-[16px]">directions_car</span>
                            Terdaftar di sistem
                        </p>
                    </div>
                    <div class="stat-icon w-14 h-14 bg-orange-100 rounded-2xl flex items-center justify-center text-orange-600">
                        <span class="material-symbols-outlined text-[32px]">directions_car</span>
                    </div>
                </div>
            </div>

            <div class="stat-card bg-white rounded-2xl shadow-elevation-1 p-4 border border-[#c8c4d6]/20">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-[#5b5f63] text-sm font-medium">Slot Parkir</p>
                        <p class="text-3xl font-bold text-[#1c1b23] mt-1">{{ number_format($totalSlots ?? 0) }}</p>
                        <p class="text-xs text-[#5b5f63] mt-1 flex items-center gap-1">
                            <span class="material-symbols-outlined text-[16px]">check_circle</span>
                            {{ $availableSlots ?? 0 }} tersedia / {{ $occupiedSlots ?? 0 }} terisi
                        </p>
                    </div>
                    <div class="stat-icon w-14 h-14 bg-purple-100 rounded-2xl flex items-center justify-center text-purple-600">
                        <span class="material-symbols-outlined text-[32px]">local_parking</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 mb-8">
            <div class="lg:col-span-2 bg-white rounded-2xl shadow-elevation-1 p-4 border border-[#c8c4d6]/20">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h3 class="text-lg font-bold text-[#1c1b23]">Aktivitas 7 Hari Terakhir</h3>
                        <p class="text-[#5b5f63] text-sm">Grafik reservasi dan user baru</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="flex items-center gap-1">
                            <span class="w-3 h-3 rounded-full bg-[#5445cf]"></span>
                            <span class="text-xs text-[#5b5f63]">Reservasi</span>
                        </div>
                        <div class="flex items-center gap-1">
                            <span class="w-3 h-3 rounded-full bg-[#60a5fa]"></span>
                            <span class="text-xs text-[#5b5f63]">User</span>
                        </div>
                    </div>
                </div>
                <div class="chart-container">
                    <canvas id="activityChart"></canvas>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-elevation-1 p-4 border border-[#c8c4d6]/20">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h3 class="text-lg font-bold text-[#1c1b23]">Status Reservasi</h3>
                        <p class="text-[#5b5f63] text-sm">Distribusi status</p>
                    </div>
                </div>
                <div class="chart-container">
                    <canvas id="statusChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Bottom Row -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
            <!-- Popular Locations -->
            <div class="bg-white rounded-2xl shadow-elevation-1 p-4 border border-[#c8c4d6]/20">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h3 class="text-lg font-bold text-[#1c1b23]">Lokasi Populer</h3>
                        <p class="text-[#5b5f63] text-sm">Kapasitas parkir terisi</p>
                    </div>
                    <a href="#" class="text-[#5445cf] text-sm font-medium hover:underline">Lihat Semua</a>
                </div>
                <div class="space-y-4">
                    @forelse($popularLocations ?? [] as $location)
                    <div>
                        <div class="flex items-center justify-between mb-1">
                            <span class="text-sm font-medium text-[#1c1b23]">{{ $location->name }}</span>
                            <span class="text-xs text-[#5b5f63]">{{ $location->total }}/{{ $location->capacity }}</span>
                        </div>
                        <div class="w-full bg-[#f0ecf8] rounded-full h-2">
                            <div class="bg-[#5445cf] rounded-full h-2 progress-bar" style="width: {{ $location->percentage }}%"></div>
                        </div>
                    </div>
                    @empty
                    <div class="text-center text-[#5b5f63] py-4">
                        <span class="material-symbols-outlined text-4xl">inbox</span>
                        <p class="mt-2">Belum ada data lokasi</p>
                    </div>
                    @endforelse
                </div>
            </div>

            <!-- Recent Activities -->
            <div class="lg:col-span-2 bg-white rounded-2xl shadow-elevation-1 p-4 border border-[#c8c4d6]/20">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h3 class="text-lg font-bold text-[#1c1b23]">Aktivitas Terbaru</h3>
                        <p class="text-[#5b5f63] text-sm">Update terakhir dari sistem</p>
                    </div>
                    <a href="#" class="text-[#5445cf] text-sm font-medium hover:underline">Lihat Semua</a>
                </div>
                <div class="space-y-3">
                    @forelse($recentActivities ?? [] as $activity)
                    <div class="activity-item flex items-start gap-3 p-3 rounded-xl transition-all cursor-pointer">
                        <div class="w-10 h-10 {{ $activity->bg_color ?? 'bg-gray-100' }} rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="material-symbols-outlined text-[20px] {{ $activity->color ?? 'text-gray-500' }}">{{ $activity->icon ?? 'info' }}</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm text-[#1c1b23]">{!! $activity->message !!}</p>
                            <p class="text-xs text-[#5b5f63] flex items-center gap-1 mt-0.5">
                                <span class="material-symbols-outlined text-[14px]">schedule</span>
                                {{ $activity->time }}
                            </p>
                        </div>
                        <span class="w-2 h-2 rounded-full {{ $activity->dot_color ?? 'bg-gray-300' }} flex-shrink-0 mt-2"></span>
                    </div>
                    @empty
                    <div class="text-center text-[#5b5f63] py-4">
                        <span class="material-symbols-outlined text-4xl">inbox</span>
                        <p class="mt-2">Belum ada aktivitas</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>

    </div>

</main>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Data dari Controller - parse dari JSON string
        var chartData = JSON.parse('{!! $chartDataJson !!}');
        var statusData = JSON.parse('{!! $statusDataJson !!}');

        // Activity Chart
        var ctx1 = document.getElementById('activityChart');
        if (ctx1) {
            new Chart(ctx1.getContext('2d'), {
                type: 'line',
                data: {
                    labels: chartData.labels,
                    datasets: [{
                        label: 'Reservasi',
                        data: chartData.reservations,
                        borderColor: '#5445cf',
                        backgroundColor: 'rgba(84, 69, 207, 0.1)',
                        fill: true,
                        tension: 0.4,
                        pointBackgroundColor: '#5445cf',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointRadius: 4
                    }, {
                        label: 'User Baru',
                        data: chartData.users,
                        borderColor: '#60a5fa',
                        backgroundColor: 'rgba(96, 165, 250, 0.1)',
                        fill: true,
                        tension: 0.4,
                        pointBackgroundColor: '#60a5fa',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointRadius: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: 'index'
                    }
                }
            });
        }

        // Status Chart
        var ctx2 = document.getElementById('statusChart');
        if (ctx2) {
            new Chart(ctx2.getContext('2d'), {
                type: 'doughnut',
                data: {
                    labels: ['Pending', 'Dibayar', 'Selesai', 'Dibatalkan'],
                    datasets: [{
                        data: Object.values(statusData),
                        backgroundColor: [
                            '#fbbf24',
                            '#34d399',
                            '#60a5fa',
                            '#f87171'
                        ],
                        borderWidth: 2,
                        borderColor: '#ffffff'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                padding: 12,
                                usePointStyle: true,
                                pointStyle: 'circle',
                                font: {
                                    size: 11,
                                    family: 'Inter'
                                }
                            }
                        }
                    },
                    cutout: '65%'
                }
            });
        }

        // Animate progress bars
        setTimeout(function() {
            document.querySelectorAll('.progress-bar').forEach(function(bar) {
                var width = bar.style.width;
                bar.style.width = '0%';
                setTimeout(function() {
                    bar.style.width = width;
                }, 100);
            });
        }, 500);
    });
</script>

</body>
</html>