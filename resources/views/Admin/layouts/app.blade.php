<!DOCTYPE html>

<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

<title>@yield('title', 'ParkirIn')</title>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet"/>

<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>

<style>
    body {
        font-family: 'Inter', sans-serif;
    }

    .material-symbols-outlined {
        font-variation-settings: 'FILL' 0,'wght' 400,'GRAD' 0,'opsz' 24;
    }

    .active-nav-border {
        box-shadow: inset -4px 0 0 0 #5445cf;
    }

    .custom-scrollbar::-webkit-scrollbar {
        width: 4px;
    }

    .custom-scrollbar::-webkit-scrollbar-track {
        background: transparent;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #e5e1ec;
        border-radius: 10px;
    }
</style>

@stack('styles')
@vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-background text-on-background antialiased flex min-h-screen">

@include('Admin.components.sidebar')

<main class="flex-1 ml-64 flex flex-col relative w-full">

    @include('Admin.components.header')

    <div class="bg-background flex-1">

        <div class="w-full max-w-[1600px] mx-auto px-6 lg:px-8 xl:px-10 py-6">

            @yield('content')

        </div>

    </div>

    @include('Admin.components.footer')

</main>

@stack('scripts')

</body>
</html>
