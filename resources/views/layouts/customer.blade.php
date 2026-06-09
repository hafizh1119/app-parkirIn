<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>ParkirIn</title>

    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/materialdesignicons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/core.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/theme-default.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}">
</head>

<body>

    <nav class="layout-navbar navbar navbar-expand-lg align-items-center bg-navbar-theme">
        <div class="container">

            <a class="navbar-brand fw-bold" href="/customer/dashboard">
                ParkirIn
            </a>

            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="/customer/dashboard">
                    Dashboard
                </a>

                <a class="nav-link" href="/customer/cari-parkir">
                    Cari Parkir
                </a>

                <a class="nav-link" href="/customer/riwayat">
                    Riwayat
                </a>

                <a class="nav-link" href="/customer/profil">
                    Profil
                </a>
            </div>

        </div>
    </nav>

    <div class="container py-5">

        @yield('content')

    </div>

    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>

</body>
</html>