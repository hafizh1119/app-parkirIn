<header
    class="sticky top-0 z-40 flex items-center justify-between h-16 px-6 bg-surface-container-lowest shadow-sm w-full"
    id="TopNavBar">

<div class="flex items-center flex-1">

<div class="relative w-full max-w-md">

    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
        search
    </span>

    <input
        type="text"
        placeholder="Search anything..."
        class="w-full h-11 pl-10 pr-4 rounded-xl
               bg-gray-50
               border border-gray-200
               focus:border-primary
               focus:ring-4 focus:ring-primary/10
               transition-all
               outline-none">

</div>

</div>

<div class="flex items-center gap-4 ml-6">

    <button class="relative w-10 h-10 flex items-center justify-center rounded-full hover:bg-surface-variant transition-colors">
        <span class="material-symbols-outlined text-on-surface-variant">
            notifications
        </span>

        <span class="absolute top-2 right-2 w-2 h-2 bg-error rounded-full border-2 border-white"></span>
    </button>

    <button class="w-10 h-10 flex items-center justify-center rounded-full hover:bg-surface-variant transition-colors">
        <span class="material-symbols-outlined text-on-surface-variant">
            settings
        </span>
    </button>

    <div class="relative">

    <button
        type="button"
        onclick="toggleUserMenu()"
        class="flex items-center gap-3 hover:bg-surface-variant/50 rounded-xl px-2 py-1.5 transition-colors">

        <div class="text-right">
            <p class="font-bold text-on-surface">
                {{ auth()->user()->name }}
            </p>
            <p class="text-sm text-secondary">
                {{ auth()->user()->role == 'admin' ? 'Super Admin' : ucfirst(auth()->user()->role) }}
            </p>
        </div>

        <img
            src="{{ auth()->user()->foto_profil ? asset(auth()->user()->foto_profil) : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) . '&background=5445cf&color=fff' }}"
            class="w-10 h-10 rounded-full border-2 border-primary-container object-cover"
            alt="{{ auth()->user()->name }}">

        <span class="material-symbols-outlined text-gray-400 text-[18px]">
            expand_more
        </span>

    </button>

    <!-- Dropdown Menu -->
    <div
        id="userDropdownMenu"
        class="hidden absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-lg border border-gray-100 py-2 z-50">

        <div class="px-4 py-2 border-b border-gray-100">
            <p class="text-sm font-semibold text-gray-800">{{ auth()->user()->name }}</p>
            <p class="text-xs text-gray-500">{{ auth()->user()->email }}</p>
        </div>

        <a href="#"
            class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
            <span class="material-symbols-outlined text-[18px] text-gray-500">person</span>
            Profil Saya
        </a>

        <a href="#"
            class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
            <span class="material-symbols-outlined text-[18px] text-gray-500">settings</span>
            Pengaturan
        </a>

        <hr class="my-2 border-gray-100">

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button
                type="submit"
                class="w-full flex items-center gap-3 px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 transition-colors">
                <span class="material-symbols-outlined text-[18px]">logout</span>
                Logout
            </button>
        </form>

    </div>

</div>

<script>
    function toggleUserMenu() {
        document.getElementById('userDropdownMenu').classList.toggle('hidden');
    }

    // Tutup dropdown kalau klik di luar area menu
    document.addEventListener('click', function (event) {
        const menu = document.getElementById('userDropdownMenu');
        const button = event.target.closest('button[onclick="toggleUserMenu()"]');

        if (!button && menu && !menu.contains(event.target)) {
            menu.classList.add('hidden');
        }
    });
</script>

</header>
