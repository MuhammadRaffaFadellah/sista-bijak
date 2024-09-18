<!DOCTYPE html>
<html lang="{{ $page->language ?? 'en' }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="referrer" content="always">
        <meta name="description" content="Surat Pengadaan">
        <link rel="icon" href="{{ asset('img/Logo Si-PBJ.png') }}">
        @vite(['resources/css/app.css','resources/js/app.js'])
        <title>Sista Bijak - Login</title>
        <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css"  rel="stylesheet" />
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
        @vite('resources/css/app.css')
        @yield('style')
    </head>
    <body>
        @include('spinner')
        <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-200 font-roboto">
            @include('_layouts.sidebar')
            
            <div class="flex-1 flex flex-col overflow-hidden">
                @include('_layouts.header')
                <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
                    <div class="button-container flex justify-between">
                        <h2 class="text-xl text-gray-600 font-bold px-4 pt-4">@yield('page-title', 'Si-PBJ')</h2>
                        @yield('side-right')
                    </div>
                    <div class="container mx-auto px-6 pb-8">
                        @yield('body')
                    </div>
                </main>
            </div>
        </div>
        <!-- Bootstrap JS Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/2.1.3/js/dataTables.js"></script>
        <script src="https://cdn.datatables.net/2.1.3/js/dataTables.tailwindcss.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@9.0.3"></script>
    </body>
</html>
