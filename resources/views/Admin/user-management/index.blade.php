@extends('admin.layouts.main')

@section('title', 'Kelola Admin')

@section('bg-icon', 'group')

@section('content')
<!-- Header Section -->
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-xl">
    <div>
        <nav class="flex items-center gap-2 text-secondary mb-1">
            <a class="font-label-md text-label-md hover:text-primary" href="{{ route('admin.dashboard') }}">Dashboard</a>
            <span class="material-symbols-outlined text-[16px]">chevron_right</span>
            <span class="font-label-md text-label-md font-bold text-on-surface">User Management</span>
        </nav>
        <h2 class="font-headline-xl text-headline-xl text-on-surface">Kelola Admin</h2>
        <p class="text-secondary text-sm mt-1">Kelola akun administrator dan hak akses mereka</p>
    </div>
    <a href="{{ route('admin.users.create') }}" class="bg-brand-purple hover:bg-brand-purple/90 text-white px-lg py-md rounded-lg flex items-center gap-2 shadow-lg shadow-brand-purple/20 transition-all transform active:scale-95">
        <span class="material-symbols-outlined">person_add</span>
        <span class="font-label-md text-label-md font-bold">+ Tambah Admin</span>
    </a>
</div>

<!-- Statistik Cards -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-xl">
    <div class="bg-white rounded-xl shadow-elevation-1 p-lg border border-outline-variant/20">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-secondary text-sm font-medium">Total Admin</p>
                <p class="text-2xl font-bold text-on-surface mt-1">{{ $totalUsers }}</p>
            </div>
            <div class="w-12 h-12 bg-primary-container/10 rounded-full flex items-center justify-center text-primary">
                <span class="material-symbols-outlined">people</span>
            </div>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow-elevation-1 p-lg border border-outline-variant/20">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-secondary text-sm font-medium">Admin Aktif</p>
                <p class="text-2xl font-bold text-on-surface mt-1">{{ $activeUsers }}</p>
            </div>
            <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center text-green-600">
                <span class="material-symbols-outlined">check_circle</span>
            </div>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow-elevation-1 p-lg border border-outline-variant/20">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-secondary text-sm font-medium">Admin Non-Aktif</p>
                <p class="text-2xl font-bold text-on-surface mt-1">{{ $inactiveUsers }}</p>
            </div>
            <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center text-red-600">
                <span class="material-symbols-outlined">block</span>
            </div>
        </div>
    </div>
</div>

<!-- Main Content Card -->
<section class="bg-white rounded-2xl shadow-elevation-1 overflow-hidden border border-outline-variant/20">
    <!-- Toolbar -->
    <div class="p-lg flex flex-col md:flex-row items-center justify-between gap-md border-b border-outline-variant/10">
        <div class="relative w-full md:w-80">
            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline">search</span>
            <input id="searchUser" class="w-full pl-10 pr-4 py-2 border border-outline-variant rounded-lg focus:ring-1 focus:ring-primary focus:border-primary transition-all font-body-md text-body-md" placeholder="Cari nama atau email..." type="text"/>
        </div>
        <div class="flex items-center gap-sm w-full md:w-auto">
            <select id="statusFilter" class="pl-md pr-xl py-2 border border-outline-variant rounded-lg focus:ring-1 focus:ring-primary focus:border-primary transition-all font-label-md text-label-md bg-white">
                <option value="">Semua Status</option>
                <option value="aktif">Aktif</option>
                <option value="non-aktif">Non-Aktif</option>
            </select>
            <select id="roleFilter" class="pl-md pr-xl py-2 border border-outline-variant rounded-lg focus:ring-1 focus:ring-primary focus:border-primary transition-all font-label-md text-label-md bg-white">
                <option value="">Semua Role</option>
                <option value="super admin">Super Admin</option>
                <option value="admin">Admin</option>
                <option value="operator">Operator</option>
            </select>
            <button class="flex items-center gap-2 px-md py-2 border border-outline-variant rounded-lg hover:bg-surface-container transition-colors text-on-surface-variant font-label-md">
                <span class="material-symbols-outlined text-[20px]">ios_share</span>
                Export
            </button>
        </div>
    </div>
    
    <!-- Data Table -->
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-surface-container/50 border-b border-outline-variant/20">
                    <th class="p-lg w-12">
                        <input class="rounded border-outline-variant text-primary focus:ring-primary h-4 w-4" type="checkbox"/>
                    </th>
                    <th class="p-lg font-label-md text-label-md text-secondary uppercase tracking-wider">Admin</th>
                    <th class="p-lg font-label-md text-label-md text-secondary uppercase tracking-wider">Email</th>
                    <th class="p-lg font-label-md text-label-md text-secondary uppercase tracking-wider">Role</th>
                    <th class="p-lg font-label-md text-label-md text-secondary uppercase tracking-wider">Status</th>
                    <th class="p-lg font-label-md text-label-md text-secondary uppercase tracking-wider">Terakhir Aktif</th>
                    <th class="p-lg font-label-md text-label-md text-secondary uppercase tracking-wider text-center">Aksi</th>
                </tr>
            </thead>
            <tbody id="userTableBody" class="divide-y divide-outline-variant/10">
                @forelse($users as $user)
                <tr class="hover:bg-primary/5 transition-colors group admin-card" data-name="{{ strtolower($user->name) }}" data-email="{{ strtolower($user->email) }}" data-role="{{ strtolower($user->role) }}" data-status="{{ strtolower($user->status) }}">
                    <td class="p-lg">
                        <input class="rounded border-outline-variant text-primary focus:ring-primary h-4 w-4" type="checkbox"/>
                    </td>
                    <td class="p-lg">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full {{ $user->role_color ?? 'bg-primary-container/20' }} flex items-center justify-center text-white font-bold">
                                {{ $user->initials ?? strtoupper(substr($user->name, 0, 2)) }}
                            </div>
                            <div>
                                <span class="font-body-md text-body-md font-bold text-on-surface">{{ $user->name }}</span>
                                <p class="font-label-sm text-label-sm text-secondary">@ {{ $user->username ?? strtolower(str_replace(' ', '.', $user->name)) }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="p-lg font-body-md text-body-md text-on-surface-variant">{{ $user->email }}</td>
                    <td class="p-lg">
                        <span class="inline-flex items-center px-3 py-1 rounded-full {{ $user->role_badge_color ?? 'bg-primary/10 text-primary' }} font-label-sm text-label-sm border {{ $user->role_border_color ?? 'border-primary/20' }}">
                            <span class="w-1.5 h-1.5 rounded-full {{ $user->role_dot_color ?? 'bg-primary' }} mr-2"></span>
                            {{ $user->role }}
                        </span>
                    </td>
                    <td class="p-lg">
                        <span class="inline-flex items-center px-3 py-1 rounded-full {{ $user->status == 'Aktif' ? 'bg-green-100 text-green-700 border-green-200' : 'bg-red-100 text-red-700 border-red-200' }} font-label-sm text-label-sm border status-badge">
                            <span class="w-1.5 h-1.5 rounded-full {{ $user->status == 'Aktif' ? 'bg-green-500' : 'bg-red-500' }} mr-2"></span>
                            {{ $user->status }}
                        </span>
                    </td>
                    <td class="p-lg font-body-md text-body-md text-on-surface-variant">{{ $user->last_active ?? $user->updated_at->diffForHumans() }}</td>
                    <td class="p-lg">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('admin.users.show', $user->id) }}" class="p-2 rounded-lg text-secondary hover:bg-primary-container/20 hover:text-primary transition-all" title="Detail">
                                <span class="material-symbols-outlined text-[20px]">visibility</span>
                            </a>
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="p-2 rounded-lg text-secondary hover:bg-primary-container/20 hover:text-primary transition-all" title="Edit">
                                <span class="material-symbols-outlined text-[20px]">edit</span>
                            </a>
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus admin ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 rounded-lg text-secondary hover:bg-error/10 hover:text-error transition-all" title="Hapus">
                                    <span class="material-symbols-outlined text-[20px]">delete</span>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="p-lg text-center text-secondary">Tidak ada data admin</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <!-- Pagination -->
    <div class="p-lg border-t border-outline-variant/10 flex flex-col md:flex-row items-center justify-between gap-md">
        <p class="font-label-md text-label-md text-secondary">
            Menampilkan <span class="text-on-surface font-bold">{{ $users->firstItem() ?? 0 }} - {{ $users->lastItem() ?? 0 }}</span> dari <span class="text-on-surface font-bold">{{ $users->total() }}</span> admin
        </p>
        <div class="flex items-center gap-sm">
            {{ $users->links() }}
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    // Search functionality
    document.getElementById('searchUser')?.addEventListener('input', function(e) {
        const query = e.target.value.toLowerCase();
        document.querySelectorAll('#userTableBody tr').forEach(row => {
            const name = row.dataset.name || '';
            const email = row.dataset.email || '';
            if (name.includes(query) || email.includes(query)) {
                row.style.display = 'table-row';
            } else {
                row.style.display = 'none';
            }
        });
    });

    // Role filter
    document.getElementById('roleFilter')?.addEventListener('change', function(e) {
        const selectedRole = e.target.value.toLowerCase();
        document.querySelectorAll('#userTableBody tr').forEach(row => {
            const role = row.dataset.role || '';
            if (selectedRole === '' || role === selectedRole) {
                row.style.display = 'table-row';
            } else {
                row.style.display = 'none';
            }
        });
    });

    // Status filter
    document.getElementById('statusFilter')?.addEventListener('change', function(e) {
        const selectedStatus = e.target.value.toLowerCase();
        document.querySelectorAll('#userTableBody tr').forEach(row => {
            const status = row.dataset.status || '';
            if (selectedStatus === '' || status === selectedStatus) {
                row.style.display = 'table-row';
            } else {
                row.style.display = 'none';
            }
        });
    });
</script>
@endpush