    <!DOCTYPE html>
    <html
    lang="en"
    class="light-style layout-navbar-fixed layout-wide"
    dir="ltr"
    data-theme="theme-default">

    <head>

        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <title>ParkirIn</title>

        <!-- Favicon -->
        <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/icon/logo.svg') }}" />

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

        <link
            href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap"
            rel="stylesheet">

        <!-- Semua CSS Materialize -->
        <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/materialdesignicons.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/node-waves/node-waves.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/core.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/theme-default.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
        <!-- Auth Page -->
        <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-auth.css') }}" />

        <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/front-page.css') }}" />
    {{-- <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/front-page-landing.css') }}" /> --}}


        <!-- Helpers -->
        <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>

        <!-- Config -->
        <script src="{{ asset('assets/js/config.js') }}"></script>

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        @stack('styles')
        <link href="https://fonts.cdnfonts.com/css/gilroy-bold" rel="stylesheet">
    </head>

    <body>

        @include('components.layouts.navbar')

        @yield('content')

        @include('components.layouts.footer')

        <!-- Core JS -->
        <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
        <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/node-waves/node-waves.js') }}"></script>

        <!-- Vendors JS -->
        <script src="{{ asset('assets/vendor/libs/nouislider/nouislider.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>

        <!-- Main JS -->
        <script src="{{ asset('assets/js/main.js') }}"></script>
        <script src="{{ asset('assets/js/front-main.js') }}"></script>

        <!-- Page JS -->
        <script src="{{ asset('assets/js/front-page-landing.js') }}"></script>

        @stack('scripts')

    </body>

    </html>