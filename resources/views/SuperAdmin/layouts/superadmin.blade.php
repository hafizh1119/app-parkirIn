<!DOCTYPE html>
<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
  <title>Super Admin - @yield('title')</title>

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" />

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet" />

  <!-- Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialdesignicons/7.2.96/css/materialdesignicons.min.css" />

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Inter', sans-serif;
      background: #f5f5f9;
      color: #4b4b6c;
      overflow-x: hidden;
    }

    /* Layout Wrapper */
    .layout-wrapper {
      display: flex;
      min-height: 100vh;
    }

    /* ========== SIDEBAR ========== */
    .layout-menu {
      width: 260px;
      background: #ffffff;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
      position: fixed;
      top: 0;
      bottom: 0;
      left: 0;
      z-index: 1000;
      transition: all 0.2s ease;
      display: flex;
      flex-direction: column;
    }

    .layout-page {
      margin-left: 260px;
      flex: 1;
      transition: margin-left 0.2s ease;
    }

    /* Brand */
    .app-brand {
      padding: 1.2rem 1.5rem;
      border-bottom: 1px solid #e9e9ef;
      margin-bottom: 1rem;
    }

    .app-brand-link {
      display: flex;
      align-items: center;
      gap: 10px;
      text-decoration: none;
    }

    .app-brand-logo {
      font-size: 1.8rem;
      font-weight: 700;
      color: #7367f0;
    }

    .app-brand-text {
      font-size: 1.1rem;
      font-weight: 700;
      color: #2c2c44;
    }

    /* Menu */
    .menu-inner {
      padding: 0 0.75rem;
      flex: 1;
      list-style: none;
    }

    .menu-item {
      margin-bottom: 0.25rem;
    }

    .menu-link {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 0.7rem 1rem;
      border-radius: 8px;
      color: #5e5e7e;
      text-decoration: none;
      font-weight: 500;
      transition: all 0.2s;
    }

    .menu-link i {
      font-size: 1.4rem;
      width: 28px;
    }

    .menu-link:hover {
      background: #f0f0f5;
      color: #7367f0;
    }

    .menu-item.active .menu-link {
      background: #7367f0;
      color: white;
      box-shadow: 0 4px 10px rgba(115, 103, 240, 0.2);
    }

    /* Navbar */
    .layout-navbar {
      background: #ffffff;
      padding: 0.8rem 1.5rem;
      display: flex;
      align-items: center;
      justify-content: flex-end;
      border-bottom: 1px solid #e9e9ef;
      position: sticky;
      top: 0;
      z-index: 999;
    }

    .navbar-nav-right {
      display: flex;
      align-items: center;
      gap: 1rem;
    }

    .avatar {
      width: 40px;
      height: 40px;
      background: linear-gradient(135deg, #7367f0, #9b8cff);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: 600;
      color: white;
    }

    .avatar img {
      width: 100%;
      height: 100%;
      border-radius: 50%;
      object-fit: cover;
    }

    /* Content */
    .content-wrapper {
      padding: 1.5rem;
      flex: 1;
    }

    .container-xxl {
      max-width: 1440px;
      margin: 0 auto;
    }

    /* Cards */
    .card {
      background: #ffffff;
      border-radius: 1rem;
      box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
      padding: 1.25rem 1.5rem;
      transition: all 0.2s;
      border: 1px solid #e9ecef;
    }

    .card-header {
      padding-bottom: 1rem;
      margin-bottom: 1rem;
      border-bottom: 1px solid #e9ecef;
    }

    .card-title {
      font-size: 1.1rem;
      font-weight: 600;
      margin-bottom: 0;
    }

    /* Grid */
    .row {
      display: flex;
      flex-wrap: wrap;
      margin: -0.75rem;
    }

    .col {
      flex: 1;
      padding: 0.75rem;
    }

    .col-md-12, .col-lg-8, .col-lg-2, .col-12, .col-xl-8, .col-xl-4, .col-md-6, .col-md-4 {
      padding: 0.75rem;
    }

    .col-lg-8 { flex: 0 0 66.666%; max-width: 66.666%; }
    .col-lg-2 { flex: 0 0 16.666%; max-width: 16.666%; }
    .col-xl-8 { flex: 0 0 66.666%; max-width: 66.666%; }
    .col-xl-4 { flex: 0 0 33.333%; max-width: 33.333%; }
    .col-md-6 { flex: 0 0 50%; max-width: 50%; }
    .col-md-4 { flex: 0 0 33.333%; max-width: 33.333%; }
    .col-12 { flex: 0 0 100%; max-width: 100%; }

    /* Buttons */
    .btn {
      padding: 0.5rem 1.25rem;
      border-radius: 8px;
      border: none;
      cursor: pointer;
      font-weight: 500;
      text-decoration: none;
      display: inline-block;
      font-size: 0.85rem;
    }

    .btn-primary {
      background: #7367f0;
      color: white;
    }

    .btn-primary:hover {
      background: #5e52e0;
    }

    .btn-sm {
      padding: 0.3rem 0.8rem;
      font-size: 0.75rem;
      border-radius: 6px;
    }

    .btn-danger {
      background: #ea5455;
      color: white;
    }

    .btn-info {
      background: #00cfe8;
      color: white;
    }

    /* Badges */
    .badge {
      padding: 0.25rem 0.7rem;
      border-radius: 30px;
      font-size: 0.7rem;
      font-weight: 600;
    }

    .badge-success { background: #e4f4e6; color: #2c9e4e; }
    .badge-warning { background: #fff0e0; color: #ff9f43; }
    .badge-primary { background: #e9e9ff; color: #7367f0; }
    .badge-danger { background: #ffe5e5; color: #ea5455; }

    /* Tables */
    .table-responsive {
      overflow-x: auto;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    th, td {
      text-align: left;
      padding: 0.9rem 0.5rem;
      border-bottom: 1px solid #edf2f7;
    }

    th {
      font-weight: 600;
      color: #5a5a7a;
      font-size: 0.85rem;
    }

    /* Stat Card */
    .stat-card {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .stat-info h5 {
      font-size: 1.8rem;
      margin-bottom: 0.25rem;
      font-weight: 600;
      color: #2c2c44;
    }

    .stat-icon {
      width: 48px;
      height: 48px;
      background: rgba(115, 103, 240, 0.12);
      border-radius: 14px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.5rem;
      color: #7367f0;
    }

    /* Footer */
    .footer {
      background: #fff;
      border-top: 1px solid #e9e9ef;
      padding: 1rem 1.5rem;
      text-align: center;
      font-size: 0.8rem;
      color: #8f8fb2;
    }

    /* Utilities */
    .d-flex { display: flex; }
    .align-items-center { align-items: center; }
    .justify-content-between { justify-content: space-between; }
    .justify-content-end { justify-content: flex-end; }
    .text-center { text-align: center; }
    .text-end { text-align: right; }
    .text-muted { color: #8c8cab; }
    .mt-2 { margin-top: 0.75rem; }
    .mt-3 { margin-top: 1rem; }
    .mt-4 { margin-top: 1.5rem; }
    .mb-0 { margin-bottom: 0; }
    .mb-1 { margin-bottom: 0.25rem; }
    .mb-2 { margin-bottom: 0.75rem; }
    .mb-3 { margin-bottom: 1rem; }
    .me-2 { margin-right: 0.5rem; }
    .ms-auto { margin-left: auto; }
    .p-0 { padding: 0; }
    .py-1 { padding-top: 0.25rem; padding-bottom: 0.25rem; }
    .gap-2 { gap: 0.5rem; }
    .gap-3 { gap: 1rem; }

    /* Mobile */
    .menu-toggle-btn {
      display: none;
      background: none;
      border: none;
      font-size: 1.5rem;
      cursor: pointer;
      color: #7367f0;
      position: absolute;
      left: 20px;
      top: 15px;
    }

    @media (max-width: 768px) {
      .layout-menu {
        transform: translateX(-260px);
      }
      .layout-page {
        margin-left: 0;
      }
      .menu-toggle-btn {
        display: block;
      }
      .layout-navbar {
        padding-left: 70px;
      }
      .col-lg-8, .col-lg-2, .col-xl-8, .col-xl-4, .col-md-6, .col-md-4 {
        flex: 0 0 100%;
        max-width: 100%;
      }
    }
  </style>

  @stack('styles')
</head>

<body>
  <div class="layout-wrapper">
    <!-- SIDEBAR -->
    <aside id="layout-menu" class="layout-menu">
      <div class="app-brand">
        <a href="{{ url('/SuperAdmin/dashboard') }}" class="app-brand-link">
          <span class="app-brand-logo">
            <i class="mdi mdi-shield-crown"></i>
          </span>
          <span class="app-brand-text">SuperAdmin</span>
        </a>
      </div>

      <ul class="menu-inner">
        <li class="menu-item {{ request()->is('SuperAdmin/dashboard') ? 'active' : '' }}">
          <a href="{{ url('/SuperAdmin/dashboard') }}" class="menu-link">
            <i class="mdi mdi-home-outline"></i>
            <span>Dashboard</span>
          </a>
        </li>
        <li class="menu-item {{ request()->is('SuperAdmin/kelola-mitra') ? 'active' : '' }}">
          <a href="{{ url('/SuperAdmin/kelola-mitra') }}" class="menu-link">
            <i class="mdi mdi-store-outline"></i>
            <span>Kelola Mitra</span>
          </a>
        </li>
        <li class="menu-item {{ request()->is('SuperAdmin/kelola-user-mitra') ? 'active' : '' }}">
          <a href="{{ url('/SuperAdmin/kelola-user-mitra') }}" class="menu-link">
            <i class="mdi mdi-account-group-outline"></i>
            <span>Kelola User (Mitra)</span>
          </a>
        </li>
        <li class="menu-item {{ request()->is('SuperAdmin/keuangan') ? 'active' : '' }}">
          <a href="{{ url('/SuperAdmin/keuangan') }}" class="menu-link">
            <i class="mdi mdi-chart-line"></i>
            <span>Keuangan</span>
          </a>
        </li>
        <li class="menu-item {{ request()->is('SuperAdmin/laporan') ? 'active' : '' }}">
          <a href="{{ url('/SuperAdmin/laporan') }}" class="menu-link">
            <i class="mdi mdi-file-document-outline"></i>
            <span>Laporan</span>
          </a>
        </li>
      </ul>
    </aside>

    <!-- MAIN CONTENT -->
    <div class="layout-page">
      <nav class="layout-navbar">
        <button class="menu-toggle-btn" id="menuToggleBtn">
          <i class="mdi mdi-menu"></i>
        </button>
        <div class="navbar-nav-right">
          <div class="avatar">
            <span>SA</span>
          </div>
        </div>
      </nav>

      <div class="content-wrapper">
        <div class="container-xxl">
          @yield('content')
        </div>
      </div>

      <footer class="footer">
        <div>© {{ date('Y') }} Super Admin Dashboard. All rights reserved.</div>
      </footer>
    </div>
  </div>

  <script>
    const menuToggle = document.getElementById('menuToggleBtn');
    const layoutMenu = document.getElementById('layout-menu');
    
    if (menuToggle) {
      menuToggle.addEventListener('click', function() {
        if (layoutMenu.style.transform === 'translateX(-260px)' || !layoutMenu.style.transform) {
          layoutMenu.style.transform = 'translateX(0)';
        } else {
          layoutMenu.style.transform = 'translateX(-260px)';
        }
      });
    }
  </script>

  @stack('scripts')
</body>
</html>