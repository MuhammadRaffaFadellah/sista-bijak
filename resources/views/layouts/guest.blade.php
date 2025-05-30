<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('img/logo-kel-kesambi.png') }}">
    <title>{{ config('APP.NAME', 'Sista Bijak - Login') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <!-- <div>
                <a href="/">
                    <img class="w-20 h-20" src="{{ asset('img/image (1).png') }}"/>
                </a>
            </div> -->

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <div class="flex items-center justify-center">
                <a href="javascript::void(0)">
                    <img class="w-32 h-32 justify-center" src="{{ asset('/img/logo-kel-kesambi.png') }}" />
                </a>

            </div>
            <div><h1 class="text-2xl font-bold text-center text-cyan-800">LOGIN</h1></div>
            {{ $slot }}
        </div>
    </div>
</body>

</html>