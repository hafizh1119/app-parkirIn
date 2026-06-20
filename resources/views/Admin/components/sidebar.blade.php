<aside
    id="SideNavBar"
    class="fixed top-0 left-0 z-50 flex h-screen w-64 flex-col border-r border-gray-200 bg-white shadow-sm">

<!-- Logo -->
<div class="flex h-16 items-center gap-3 border-b border-gray-100 px-6">

    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-primary text-white">
        <span class="material-symbols-outlined">
            local_parking
        </span>
    </div>

    <div>
        <h1 class="text-xl font-bold text-primary">
            ParkirIn
        </h1>

        <p class="text-xs text-gray-500">
            Admin Console
        </p>
    </div>

</div>

<!-- Menu -->
<nav class="flex-1 overflow-y-auto p-4 space-y-2">

    <a href="{{ route('admin.dashboard') }}"
        class="flex items-center gap-3 rounded-xl px-4 py-3 text-gray-700 transition hover:bg-gray-100">

        <span class="material-symbols-outlined">
            dashboard
        </span>

        <span class="font-medium">
            Dashboard
        </span>
    </a>

    <a href="{{ route('admin.lokasi-parkir.index') }}"
        class="flex items-center gap-3 rounded-xl px-4 py-3 transition-all duration-200
        {{ request()->routeIs('admin.lokasi-parkir.*')
            ? 'bg-primary/10 font-semibold text-primary border-r-4 border-primary'
            : 'text-gray-600 hover:bg-primary/10 hover:text-primary' }}">

        <span class="material-symbols-outlined">
            local_parking
        </span>

        <span>
            Lokasi Parkir
        </span>
    </a>

    <a href="{{ route('admin.scan.index') }}"
        class="flex items-center gap-3 rounded-xl px-4 py-3 transition-all duration-200
        {{ request()->routeIs('admin.scan.*')
            ? 'bg-primary/10 font-semibold text-primary border-r-4 border-primary'
            : 'text-gray-600 hover:bg-primary/10 hover:text-primary' }}">

        <span class="material-symbols-outlined">
            qr_code_scanner
        </span>

        <span>
            Gate System
        </span>

    </a>

    <a href="{{ route('admin.pembayaran.index') }}"
        class="flex items-center gap-3 rounded-xl px-4 py-3 transition-all duration-200
        {{ request()->routeIs('admin.pembayaran.*')
            ? 'bg-primary/10 font-semibold text-primary border-r-4 border-primary'
            : 'text-gray-600 hover:bg-primary/10 hover:text-primary' }}">

        <span class="material-symbols-outlined">
            payments
        </span>

        <span>
            Verifikasi Pembayaran
        </span>

    </a>
</nav>

</aside>