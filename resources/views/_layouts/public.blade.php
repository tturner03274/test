<!doctype html>
<html lang="en" class="font-lato">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" media="screen">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">

    <script src="{{ asset('js/app.js') }}"></script>
    @if(Request::is('/'))
    <title>{{ config('app.name', 'Laravel') }} | @yield('document_title')</title>
    @else
    <title>@yield('document_title') | {{ config('app.name', 'Laravel') }}</title>
    @endif


</head>

<body class="text-brand-gray-400 {{ Request::is('/') ? 'bg-white' : 'bg-brand-gray-100' }}">

    <header class="bg-brand-blue">
        <div class="container mx-auto px-4 flex justify-end items-center">

            <a class="block w-56 max-w-xs md:w-full" href="/">
                <img src="{{ asset('images/partsweb-logo.png') }}" alt="">
            </a>

            <ul class="ml-auto flex">
                <li><a class="block text-white p-2 px-3" href="/">Home</a></li>
                <li><a class="block text-white p-2 px-3" href="/register">Register</a></li>
                <li><a class="block text-white p-2 px-3" href="#">FAQ</a></li>
                <li><a class="block text-white p-2 px-3" href="#">Contact</a></li>
            </ul>

        </div>
    </header>

    <div class="relative">
        <div class="absolute z-0 top-0 left-0 w-full">
            <svg class="mx-auto w-auto" width="1204" height="77" viewBox="0 0 1204 77" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1204 -6.10352e-05L967.598 76.9999L-3.05176e-05 -6.10352e-05L1204 -6.10352e-05Z" fill="#F2E90A" />
            </svg>
        </div>

        <div class="relative">
            @yield('content')
        </div>

    </div>

    <footer class="{{ Request::is('/') ? 'bg-brand-gray-100' : 'bg-white' }} py-12 mt-24">
        <div class="container flex justify-between">

            <div class="w-full max-w-md bg-brand-blue rounded-lg p-6 text-white">
                <h3 class="text-2xl font-bold leading-none mb-3">Start buying parts using PartsWeb</h3>
                <p class="text-lg leading-tight mb-4">Register an application to become an approved buyer.</p>
                <div class="text-right">
                    <a class="inline-block px-6 py-3 font-bold rounded-sm uppercase bg-brand-yellow text-brand-blue" href="#">Register as a buyer</a>
                </div>
            </div>

            <div class="text-right">
                <ul>
                    <li><a class="block p-1 text-brand-blue" href="/">Home</a></li>
                    <li><a class="block p-1 text-brand-blue" href="#">Register</a></li>
                    <li><a class="block p-1 text-brand-blue" href="#">FAQ</a></li>
                    <li><a class="block p-1 text-brand-blue" href="#">Contact</a></li>
                </ul>
            </div>

        </div>
    </footer>

    <div class="bg-brand-blue py-8">

    </div>

    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>

    <script>
        AOS.init();
    </script>

</body>

</html>