<!doctype html>
<html lang="en" class="font-inter">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" media="screen">
    @yield('css')
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <title>@yield('document_title') | {{ config('app.name', 'Laravel') }}</title>
</head>

<body class="text-sm text-brand-gray-500">
    <div class="flex flex-col md:flex-row min-h-screen">

        <aside class="w-full md:w-full md:max-w-xs bg-brand-blue text-white md:py-4">

            <div class="flex items-center px-4 md:mb-16">
                <a class="block w-48 md:w-64" href="/dashboard">
                    <img src="{{ asset('images/partsweb-logo.png') }}" alt="">
                </a>
                <button class="md:hidden ml-auto"><i class="fas fa-bars text-white text-3xl"></i></button>
            </div>

            <nav class="hidden md:block">

                @if ( Auth::user()->hasRole(['admin', 'super-admin']) )
                <a class="block font-bold px-4 py-2" href="/users">Users</a>
                @endif

                <a class="block font-bold px-4 py-2" href="/parts-requests/">Parts Requests</a>

                @if ( Auth::user()->hasRole(['supplier', 'admin', 'super-admin']) )
                <a class="block font-bold px-4 py-2" href="/bids">Bids</a>
                @endif

            </nav>

        </aside>

        <main class="flex-1 bg-brand-gray-200 pb-24">
            <header class="bg-white py-6 mb-10">
                <div class="max-w-6xl flex px-4 md:pl-10">
                    <p class="ml-auto text-sm text-right"><a class="text-brand-blue pr-2" href="/dashboard">{{ Auth::user()->email }}</a> <a class="text-brand-gray-500" href="{{ url('/logout') }}">Logout</a></p>
                </div>
            </header>

            <section class="max-w-6xl w-full px-4 md:px-10">

                @yield('content')

            </section>
        </main>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
    @yield('js')

</body>

</html>