<aside class="fixed left-0 top-0 h-full w-64 bg-surface shadow-md flex flex-col h-screen py-md px-sm z-50" id="SideNavBar">
    <div class="flex items-center gap-3 px-md py-lg mb-md">
        <div class="w-10 h-10 bg-primary-container rounded-lg flex items-center justify-center">
            <span class="material-symbols-outlined text-on-primary-container" style="font-variation-settings: 'FILL' 1;">local_parking</span>
        </div>
        <div>
            <h1 class="font-headline-lg text-headline-lg font-bold text-primary leading-tight">ParkirIn</h1>
            <p class="font-label-sm text-label-sm text-secondary opacity-70">Admin Console</p>
        </div>
    </div>
    <nav class="flex-1 space-y-1 overflow-y-auto custom-scrollbar px-sm">
        <!-- Dashboard -->
        <a class="flex items-center gap-3 px-md py-3 rounded-lg text-secondary hover:bg-surface-variant/50 transition-colors duration-200 group" href="/admin/dashboard">
            <span class="material-symbols-outlined group-hover:text-primary transition-colors">dashboard</span>
            <span class="font-label-md text-label-md">Dashboard</span>
        </a>

        <!-- Lokasi Parkir -->
        <a class="flex items-center gap-3 px-md py-3 rounded-lg bg-primary-container/10 text-primary font-bold border-r-4 border-primary transition-all group" href="/admin/lokasi-parkir">
            <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">local_parking</span>
            <span class="font-label-md text-label-md">Lokasi Parkir</span>
        </a>

        <!-- User Management -->
        <a class="flex items-center gap-3 px-md py-3 rounded-lg text-secondary hover:bg-surface-variant/50 transition-colors duration-200 group" href="#">
            <span class="material-symbols-outlined group-hover:text-primary transition-colors">group</span>
            <span class="font-label-md text-label-md">User Management</span>
        </a>

        <!-- Reports -->
        <a class="flex items-center gap-3 px-md py-3 rounded-lg text-secondary hover:bg-surface-variant/50 transition-colors duration-200 group" href="#">
            <span class="material-symbols-outlined group-hover:text-primary transition-colors">assessment</span>
            <span class="font-label-md text-label-md">Reports</span>
        </a>
    </nav>
    <div class="mt-auto px-md py-md border-t border-outline-variant/30">
        <a href="/admin/parkir/create" class="w-full bg-primary text-white py-3 rounded-lg flex items-center justify-center gap-2 shadow-lg hover:shadow-primary/20 active:scale-95 transition-all">
            <span class="material-symbols-outlined text-[20px]">add</span>
            <span class="font-label-md text-label-md">Tambah Lokasi</span>
        </a>
    </div>
</aside>