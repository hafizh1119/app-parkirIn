<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>ParkirIn - @yield('title', 'Admin Console')</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "surface-tint": "#5648d1",
                        "on-primary-container": "#fffbff",
                        "surface-bright": "#fcf8ff",
                        "primary-fixed-dim": "#c5c0ff",
                        "on-surface-variant": "#474554",
                        "secondary-container": "#dfe3e8",
                        "secondary": "#5b5f63",
                        "outline-variant": "#c8c4d6",
                        "tertiary": "#006673",
                        "primary-fixed": "#e4dfff",
                        "tertiary-fixed": "#9eefff",
                        "surface": "#fcf8ff",
                        "on-primary-fixed": "#140067",
                        "on-secondary-container": "#616569",
                        "primary": "#5445cf",
                        "tertiary-container": "#008091",
                        "on-secondary-fixed-variant": "#43474c",
                        "inverse-on-surface": "#f3effb",
                        "outline": "#787586",
                        "on-surface": "#1c1b23",
                        "error-container": "#ffdad6",
                        "on-tertiary": "#ffffff",
                        "on-tertiary-fixed-variant": "#004e59",
                        "surface-dim": "#dcd8e4",
                        "surface-container-high": "#eae6f2",
                        "on-background": "#1c1b23",
                        "surface-variant": "#e5e1ec",
                        "secondary-fixed": "#dfe3e8",
                        "primary-container": "#6d60e9",
                        "background": "#fcf8ff",
                        "surface-container-low": "#f6f2fe",
                        "on-secondary": "#ffffff",
                        "surface-container-lowest": "#ffffff",
                        "inverse-surface": "#312f38",
                        "on-primary-fixed-variant": "#3d2bb9",
                        "on-primary": "#ffffff",
                        "tertiary-fixed-dim": "#28d9f3",
                        "secondary-fixed-dim": "#c3c7cc",
                        "on-secondary-fixed": "#181c20",
                        "on-error-container": "#93000a",
                        "surface-container": "#f0ecf8",
                        "inverse-primary": "#c5c0ff",
                        "error": "#ba1a1a",
                        "surface-container-highest": "#e5e1ec",
                        "on-error": "#ffffff",
                        "on-tertiary-container": "#f8feff",
                        "on-tertiary-fixed": "#001f24",
                        "brand-purple": "#7367F0"
                    },
                    borderRadius: {
                        DEFAULT: "0.25rem",
                        lg: "0.5rem",
                        xl: "0.75rem",
                        "2xl": "1rem",
                        full: "9999px"
                    },
                    spacing: {
                        xl: "32px",
                        lg: "24px",
                        gutter: "24px",
                        base: "4px",
                        "container-max": "1440px",
                        xs: "4px",
                        sm: "8px",
                        md: "16px"
                    },
                    fontFamily: {
                        "label-sm": ["Inter"],
                        "headline-md": ["Inter"],
                        "headline-lg": ["Inter"],
                        "body-md": ["Inter"],
                        "body-lg": ["Inter"],
                        "headline-xl": ["Inter"],
                        "label-md": ["Inter"]
                    },
                    boxShadow: {
                        "elevation-1": "0px 2px 10px 0px rgba(76, 78, 100, 0.1)",
                        "elevation-2": "0px 4px 18px 0px rgba(76, 78, 100, 0.12)"
                    }
                }
            }
        }
    </script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        html, body {
            height: 100%;
            overflow: hidden;
        }
        
        body { 
            font-family: 'Inter', sans-serif; 
        }
        
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #e5e1ec; border-radius: 10px; }
        
        .status-badge {
            transition: all 0.3s ease;
        }
        .status-badge:hover {
            transform: scale(1.05);
        }
        
        .admin-card {
            transition: all 0.3s ease;
        }
        .admin-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(84, 69, 207, 0.1);
        }
        
        /* Style untuk pagination */
        .pagination .page-item.active .page-link {
            background-color: #5445cf !important;
            border-color: #5445cf !important;
            color: white !important;
        }
        .pagination .page-link {
            color: #5445cf !important;
        }
        .pagination .page-link:hover {
            background-color: #f0ecf8 !important;
        }
        
        /* BIAR HALAMAN BISA SCROLL */
        .main-content {
            height: 100vh;
            overflow-y: auto;
            overflow-x: hidden;
        }
        
        .content-wrapper {
            flex: 1;
            min-height: 100%;
        }
    </style>
    @stack('styles')
</head>
<body class="bg-background text-on-background antialiased flex">
    @include('admin.layouts.sidebar')
    
    <!-- PAKAI CLASS main-content BIAR BISA SCROLL -->
    <main class="flex-1 ml-64 main-content">
        <!-- Top Navigation Bar - STICKY DI ATAS -->
        <header class="sticky top-0 z-40 flex justify-between items-center h-16 px-xl bg-surface-container-lowest dark:bg-surface-container-lowest shadow-sm">
            <div class="flex items-center gap-4 flex-1">
                <div class="relative w-full max-w-md">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline">search</span>
                    <input class="w-full pl-10 pr-4 py-2 bg-surface-container rounded-lg border-none focus:ring-2 focus:ring-primary/20 transition-all font-body-md text-body-md" placeholder="Search anything..." type="text"/>
                </div>
            </div>
            <div class="flex items-center gap-md">
                <button class="w-10 h-10 flex items-center justify-center rounded-full hover:bg-surface-variant transition-colors relative">
                    <span class="material-symbols-outlined text-on-surface-variant">notifications</span>
                    <span class="absolute top-2 right-2.5 w-2 h-2 bg-error rounded-full border-2 border-white"></span>
                </button>
                <button class="w-10 h-10 flex items-center justify-center rounded-full hover:bg-surface-variant transition-colors">
                    <span class="material-symbols-outlined text-on-surface-variant">settings</span>
                </button>
                <div class="h-8 w-px bg-outline-variant/50 mx-2"></div>
                <div class="flex items-center gap-3">
                    <div class="text-right">
                        <p class="font-label-md text-label-md text-on-surface font-bold leading-none">{{ Auth::user()->name ?? 'Admin User' }}</p>
                        <p class="font-label-sm text-label-sm text-secondary">{{ Auth::user()->role ?? 'Super Admin' }}</p>
                    </div>
                    <img alt="Profile" class="w-10 h-10 rounded-full border-2 border-primary-container" 
                         src="{{ Auth::user()->avatar ?? 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name ?? 'Admin').'&background=5445cf&color=fff&size=100' }}"/>
                </div>
            </div>
        </header>
        
        <!-- Page Content - BISA SCROLL -->
        <div class="p-xl bg-background content-wrapper">
            @yield('content')
        </div>
        
        <!-- Background Decoration - POSISI FIXED -->
        <div class="fixed bottom-0 right-0 p-lg opacity-5 pointer-events-none" style="margin-left: 256px;">
            <span class="material-symbols-outlined text-[300px] text-primary">@yield('bg-icon', 'group')</span>
        </div>
    </main>
    
    @stack('scripts')
</body>
</html>