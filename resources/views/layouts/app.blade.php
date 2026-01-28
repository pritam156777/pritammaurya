<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <link rel="stylesheet" href="{{ asset('css/product.css') }}">
        <link rel="stylesheet" href="{{ asset('css/navigation-design.css') }}">
        <link rel="stylesheet" href="{{ asset('css/folder-slider.css') }}">
        <link rel="stylesheet" href="{{ asset('css/views-shop-shows.css') }}">

        <link rel="stylesheet" href="{{ asset('css/show-show-start.css') }}">

        <script src="https://js.stripe.com/v3/"></script>
        <script>
            window.STRIPE_PUBLIC_KEY = "{{ config('services.stripe.key') }}";
        </script>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="p-6 max-w-7xl mx-auto px-4 mt-6">
                @yield('content')
            </main>
        </div>


        {{-- scrollTopBtn css used in public/css/navigation-design.css--}}
        <button id="scrollTopBtn" title="Go to top">
            <i class="fas fa-chevron-up"></i>
        </button>
        <script>
            const scrollTopBtn = document.getElementById("scrollTopBtn");

            window.addEventListener("scroll", function () {
                if (window.scrollY > 300) {
                    scrollTopBtn.style.display = "flex";
                } else {
                    scrollTopBtn.style.display = "none";
                }
            });

            scrollTopBtn.addEventListener("click", function () {
                window.scrollTo({
                    top: 0,
                    behavior: "smooth"
                });
            });
        </script>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('js/views-shop-shows.js') }}"></script>
        <script src="{{ asset('js/shop.js') }}"></script>
        <script src="{{ asset('js/folder-slider.js') }}"></script>
        <script src="{{ asset('js/create/slider.js') }}"></script>
        <script src="{{ asset('js/show-show-start.js') }}"></script>
        <script src="{{ asset('js/card-page.js') }}"></script>



    </body>
</html>
