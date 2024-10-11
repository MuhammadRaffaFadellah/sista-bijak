<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sista Bijak - Home</title>
    <meta name="description" content="description here">
    <meta name="keywords" content="keywords,here">
    <link rel="icon" href="{{ asset('img/logo-kel-kesambi.png') }}" type="icon">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
        integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!--Replace with your tailwind.css once created-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"
        integrity="sha256-XF29CBwU1MWLaGEnsELogU6Y6rcc5nCkhhx89nFMIDQ=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/smooth-scroll/16.1.3/smooth-scroll.polyfills.min.js"></script>
</head>
<style>
    html {
        scroll-behavior: smooth;
        /* Pastikan scroll smooth di html */
    }

    body {
        margin: 0;
        padding: 0;
    }

    /* Untuk menyembunyikan card saat tidak di-hover */
    #loginButton {
        position: relative;
    }

    /* Tampilkan card saat link atau logo di-hover */
    #loginButton:hover #brandCard {
        display: block;
    }

    /* Mengatur elemen card */
    #brandCard {
        opacity: 0;
        visibility: hidden;
        background-color: white;
        border: 1px solid #ccc;
        /* Border lebih halus */
        padding: 10px;
        border-radius: 8px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.15);
        /* Shadow lebih lembut */
        width: 180px;
        z-index: 100;
        position: absolute;
        top: 90%;
        /* Menaikkan card agar lebih dekat ke teks */
        left: 50px;
        /* Menggeser card lebih ke kanan, jika diperlukan */
        font-size: 0.875rem;
        transition: opacity 0.3s ease, visibility 0.3s ease;
    }

    /* Posisikan segitiga sedikit ke kiri dari tengah */
    #brandCard::before {
        content: '';
        position: absolute;
        top: -10px;
        /* Tetap di atas card */
        left: 45%;
        /* Geser segitiga sedikit ke kiri dari tengah */
        transform: translateX(-50%);
        /* Sesuaikan dengan pergeseran */
        width: 0;
        height: 0;
        border-left: 10px solid transparent;
        border-right: 10px solid transparent;
        border-bottom: 10px solid white;
        border-bottom-color: #ccc;
        /* Border mengikuti card */
    }

    /* Hover state: JS akan menangani efek fade, jadi ini dihilangkan dari hover CSS */
    /* CSS untuk kelas aktif dan tidak aktif */
    .nav-link.active {
        font-weight: bold;
    }

    #navHome.active .fa-home {
        color: rgb(219, 39, 119);
        /* Warna merah untuk ikon rumah yang aktif */
    }

    #navGraph.active .fa-chart-area {
        color: green;
        /* Warna hijau untuk ikon graph yang aktif */
    }

    #navPayments.active .fa-wallet {
        color: blue;
        /* Warna biru untuk ikon payments yang aktif */
    }

    /* Warna abu-abu untuk link tidak aktif */
    .nav-link {
        color: gray;
        /* Warna default */
    }

    .nav-link:not(.active) {
        color: gray;
        /* Warna abu-abu untuk yang tidak aktif */
    }


    .nav-link.active .fas {
        color: inherit;
        /* Warna ikon mengikuti warna teks saat aktif */
    }
</style>

<body class="bg-gray-100 font-sans leading-normal tracking-normal">
    <nav id="header" class="bg-white fixed w-full z-10 top-0 shadow">
        <div class="w-full container mx-auto flex items-center justify-between mt-0 pt-3 pb-3 md:pb-0">
            <!-- Tombol Menu di Sebelah Kanan (untuk Mobile) -->
            <div class="block lg:hidden pr-4 order-2">
                <button id="nav-toggle"
                    class="flex items-center px-3 py-2 border rounded text-gray-500 border-gray-600 hover:text-gray-900 hover:border-teal-500 appearance-none focus:outline-none">
                    <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <title>Menu</title>
                        <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" />
                    </svg>
                </button>
            </div>

            <!-- Logo -->
            <div class="flex-grow flex justify-between items-center order-1 lg:order-none">
                <a href="{{ route('login') }}" id="loginButton" class="relative flex items-center">
                    <img src="{{ asset('/img/logo-kel-kesambi.png') }}" alt="sista-bijak" class="w-auto h-16 ml-2 pb-2">
                    <span class="font-bold uppercase ml-5">
                        <h5 class="pb-2">sista bijak</h5>
                    </span>
                    <!-- Card yang muncul saat di hover -->
                    <div id="brandCard"
                        class="absolute left-0 top-16 w-48 p-3 bg-white shadow-lg border rounded-lg hidden z-10">
                        <p class="font-bold text-sm">Sistem Statistik Kesambi Juara dalam Angka</p>
                    </div>
                </a>
            </div>

            <div class="hidden lg:flex lg:items-center lg:w-auto" id="nav-content">
                <ul class="list-reset lg:flex flex-1 items-center px-4 md:px-0">
                    <li class="mr-6 my-2 md:my-0">
                        <a href="#home" id="navHome"
                            class="nav-link block py-1 md:py-3 pl-1 align-middle text-gray-500 no-underline border-b-2 border-orange-600">
                            <i class="fas fa-home fa-fw mr-3 text-gray-600"></i>
                            <span class="pb-1 md:pb-0 text-sm">Home</span>
                        </a>
                    </li>
                    <li class="mr-6 my-2 md:my-0">
                        <a href="#graph" id="navGraph"
                            class="nav-link block py-1 md:py-3 pl-1 align-middle text-gray-500 no-underline border-b-2 border-white">
                            <i class="fas fa-chart-area fa-fw mr-3"></i><span class="pb-1 md:pb-0 text-sm">Graph</span>
                        </a>
                    </li>
                    <li class="mr-6 my-2 md:my-0">
                        <a href="#payments" id="navPayments"
                            class="nav-link block py-1 md:py-3 pl-1 align-middle text-gray-500 no-underline border-b-2 border-white">
                            <i class="fa fa-wallet fa-fw mr-3"></i><span class="pb-1 md:pb-0 text-sm">Payments</span>
                        </a>
                    </li>
                </ul>
            </div>

        </div>
    </nav>
    <!-- CSS untuk Dropdown di Mobile -->
    <style>
        @media (max-width: 1024px) {

            /* Tampilan untuk mobile */
            #nav-content {
                position: absolute;
                top: 100%;
                right: 0;
                left: 0;
                background-color: white;
                border-top: 1px solid #e2e8f0;
                z-index: 10;
                display: none;
                /* Sembunyikan menu awalnya */
            }

            /* Atur posisi tombol menu di sebelah kanan */
            .block.lg\\:hidden.pr-4 {
                order: 2;
            }

            /* Atur posisi logo di sebelah kiri */
            #loginButton {
                order: 1;
            }
        }
    </style>

    <!-- JavaScript untuk Toggle Dropdown -->
    <script>
        // Fungsi untuk melakukan fade-in
        function fadeIn(element, duration = 300) {
            element.style.opacity = 0;
            element.style.visibility = 'visible';
            let opacity = 0;
            const interval = 50; // Durasi animasi dalam milidetik
            const increment = interval / duration;

            function animate() {
                opacity += increment;
                if (opacity >= 1) {
                    opacity = 1;
                    element.style.opacity = opacity;
                    return;
                }
                element.style.opacity = opacity;
                requestAnimationFrame(animate);
            }
            animate();
        }
        // Fungsi untuk melakukan fade-out
        function fadeOut(element, duration = 300) {
            let opacity = 1;
            const interval = 50;
            const decrement = interval / duration;

            function animate() {
                opacity -= decrement;
                if (opacity <= 0) {
                    opacity = 0;
                    element.style.opacity = opacity;
                    element.style.visibility = 'hidden'; // Sembunyikan setelah fade-out selesai
                    return;
                }
                element.style.opacity = opacity;
                requestAnimationFrame(animate);
            }
            animate();
        }
        // Seleksi elemen
        const loginButton = document.getElementById('loginButton');
        const brandCard = document.getElementById('brandCard');

        loginButton.addEventListener('mouseenter', () => {
            brandCard.style.opacity = '1';
            brandCard.style.visibility = 'visible';
        });

        loginButton.addEventListener('mouseleave', () => {
            brandCard.style.opacity = '0';
            brandCard.style.visibility = 'hidden';
        });


        document.addEventListener("DOMContentLoaded", function() {
            var navToggle = document.getElementById('nav-toggle');
            var navContent = document.getElementById('nav-content');
            navToggle.addEventListener('click', function() {
                // Toggle dropdown menu
                if (navContent.style.display === "none" || navContent.style.display === "") {
                    navContent.style.display = "block";
                } else {
                    navContent.style.display = "none";
                }
            });
        });
    </script>

    <!--Container-->
    <div class="container w-full mx-auto pt-10" id="home">
        <div class="w-full px-4 md:px-0 md:mt-8 mb-16 text-gray-800 leading-normal">
            <!--Console Content-->
            <div class="flex flex-wrap mt-10">
                <div class="w-full md:w-1/4 xl:w-1/4 p-3">
                    <!--Metric Card-->
                    <div class="bg-white border rounded shadow p-2">
                        <div class="flex flex-row items-center">
                            <div class="flex-shrink pr-4">
                                <div class="rounded p-3 bg-green-600"><i class="fa fa-users fa-2x fa-fw fa-inverse"></i>
                                </div>
                            </div>
                            <div class="flex-1 text-right md:text-center">
                                <h5 class="font-bold uppercase text-gray-500">Jumlah Keseluruhan Penduduk</h5>
                                <h3 class="font-bold text-3xl"> {{ $totalPenduduk }} <span class="text-green-500"><i
                                            class="fa fa-users"></i></span></h3>
                            </div>
                        </div>
                    </div>
                    <!--/Metric Card-->
                </div>
                <div class="w-full md:w-1/4 xl:w-1/4 p-3">
                    <!--Metric Card-->
                    <div class="bg-white border rounded shadow p-2">
                        <div class="flex flex-row items-center">
                            <div class="flex-shrink pr-4">
                                <div class="rounded p-3 bg-yellow-600"><i
                                        class="fas fa-male fa-2x fa-fw fa-inverse"></i></div>
                            </div>
                            <div class="flex-1 text-right md:text-center">
                                <h5 class="font-bold uppercase text-gray-500">Jumlah Keseluruhan Laki-Laki</h5>
                                <h3 class="font-bold text-3xl"> {{ $totalLakiLaki }} <span class="text-yellow-600"><i
                                            class="fa fa-male"></i></span></h3>
                            </div>
                        </div>
                    </div>
                    <!--/Metric Card-->
                </div>
                <div class="w-full md:w-1/4 xl:w-1/4 p-3">
                    <!--Metric Card-->
                    <div class="bg-white border rounded shadow p-2">
                        <div class="flex flex-row items-center">
                            <div class="flex-shrink pr-4">
                                <div class="rounded p-3 bg-pink-600"><i
                                        class="fas fa-female fa-2x fa-fw fa-inverse"></i></div>
                            </div>
                            <div class="flex-1 text-right md:text-center">
                                <h5 class="font-bold uppercase text-gray-500">Jumlah Keseluruhan Perempuan</h5>
                                <h3 class="font-bold text-3xl"> {{ $totalPerempuan }} <span class="text-pink-500"><i
                                            class="fa fa-female"></i></span></h3>
                            </div>
                        </div>
                    </div>
                    <!--/Metric Card-->
                </div>
                <div class="w-full md:w-1/4 xl:w-1/4 p-3">
                    <!--Metric Card-->
                    <div class="bg-white border rounded shadow p-2">
                        <div class="flex flex-row items-center">
                            <div class="flex-shrink pr-4">
                                <div class="rounded p-3 bg-blue-600"><i
                                        class="fas fa-baby fa-2x fa-fw fa-inverse"></i></div>
                            </div>
                            <div class="flex-1 text-right md:text-center">
                                <h5 class="font-bold uppercase text-gray-500">Jumlah Keseluruhan Lahir</h5>
                                <h3 class="font-bold text-3xl"> {{ $totalLahir }} <span class="text-blue-500"><i
                                            class="fa fa-baby"></i></span></h3>
                            </div>
                        </div>
                    </div>
                    <!--/Metric Card-->
                </div>
                <!-- Repeat the same structure for the remaining cards -->
                <div class="w-full md:w-1/4 xl:w-1/4 p-3">
                    <!--Metric Card-->
                    <div class="bg-white border rounded shadow p-2">
                        <div class="flex flex-row items-center">
                            <div class="flex-shrink pr-4">
                                <div class="rounded p-3 bg-red-600"><i
                                        class="fas fa-monument fa-2x fa-fw fa-inverse"></i></div>
                            </div>
                            <div class="flex-1 text-right md:text-center">
                                <h5 class="font-bold uppercase text-gray-500">Jumlah Keseluruhan Meninggal</h5>
                                <h3 class="font-bold text-3xl"> {{ $totalMeninggal }} <span class="text-red-500"><i
                                            class="fa fa-monument"></i></span></h3>
                            </div>
                        </div>
                    </div>
                    <!--/Metric Card-->
                </div>
                <div class="w-full md:w-1/4 xl:w-1/4 p-3">
                    <!--Metric Card-->
                    <div class="bg-white border rounded shadow p-2">
                        <div class="flex flex-row items-center">
                            <div class="flex-shrink pr-4">
                                <div class="rounded p-3 bg-green-600"><i
                                        class="fas fa-sign-in-alt fa-2x fa-fw fa-inverse"></i></div>
                            </div>
                            <div class="flex-1 text-right md:text-center">
                                <h5 class="font-bold uppercase text-gray-500">Jumlah Migrasi Masuk</h5>
                                <h3 class="font-bold text-3xl">{{ $totalMigrasiMasuk }} <span
                                        class="text-green-500"><i class="fas fa-caret-up"></i></span></h3>
                            </div>
                        </div>
                    </div>
                    <!--/Metric Card-->
                </div>
                <div class="w-full md:w-1/4 xl:w-1/4 p-3">
                    <!--Metric Card-->
                    <div class="bg-white border rounded shadow p-2">
                        <div class="flex flex-row items-center">
                            <div class="flex-shrink pr-4">
                                <div class="rounded p-3 bg-red-900"><i
                                        class="fas fa-sign-out-alt fa-2x fa-fw fa-inverse"></i></div>
                            </div>
                            <div class="flex-1 text-right md:text-center">
                                <h5 class="font-bold uppercase text-gray-500">Jumlah Migrasi Keluar</h5>
                                <h3 class="font-bold text-3xl">{{ $totalMigrasiKeluar }} <span class="text-red-500"><i
                                            class="fas fa-caret-down"></i></span></h3>
                            </div>
                        </div>
                    </div>
                    <!--/Metric Card-->
                </div>
                <div class="w-full md:w-1/4 xl:w-1/4 p-3">
                    <!--Metric Card-->
                    <div class="bg-white border rounded shadow p-2">
                        <div class="flex flex-row items-center">
                            <div class="flex-shrink pr-4">
                                <div class="rounded p-3 bg-yellow-500"><i
                                        class="fas fa-store fa-2x fa-fw fa-inverse"></i></div>
                            </div>
                            <div class="flex-1 text-right md:text-center">
                                <h5 class="font-bold uppercase text-gray-500">Jumlah Keseluruhan UMKM</h5>
                                <h3 class="font-bold text-3xl">{{ $totalUmkm }} <span class="text-yellow-400"><i
                                            class="fas fa-store"></i></span></h3>
                            </div>
                        </div>
                    </div>
                    <!--/Metric Card-->
                </div>
                <div class="w-full md:w-1/4 xl:w-1/4 p-3">
                    <!--Metric Card-->
                    <div class="bg-white border rounded shadow p-2">
                        <div class="flex flex-row items-center">
                            <div class="flex-shrink pr-4">
                                <div class="rounded p-3 bg-purple-900"><i
                                        class="fas fa-warehouse fa-2x fa-fw fa-inverse"></i></div>
                            </div>
                            <div class="flex-1 text-right md:text-center">
                                <h5 class="font-bold uppercase text-gray-500">Jumlah UMKM Industri</h5>
                                <h3 class="font-bold text-3xl">{{ $totalUmkmIndustri }} <span
                                        class="text-purple-500"><i class="fas fa-warehouse"></i></span></h3>
                            </div>
                        </div>
                    </div>
                    <!--/Metric Card-->
                </div>
                <div class="w-full md:w-1/4 xl:w-1/4 p-3">
                    <!--Metric Card-->
                    <div class="bg-white border rounded shadow p-2">
                        <div class="flex flex-row items-center">
                            <div class="flex-shrink pr-4">
                                <div class="rounded p-3 bg-blue-900"><i
                                        class="fas fa-hotel fa-2x fa-fw fa-inverse"></i></div>
                            </div>
                            <div class="flex-1 text-right md:text-center">
                                <h5 class="font-bold uppercase text-gray-500">UMKM Penyedia Akomodasi</h5>
                                <h3 class="font-bold text-3xl">{{ $totalUmkmPenyediaAkomodasi }} <span
                                        class="text-blue-500"><i class="fas fa-hotel"></i></span></h3>
                            </div>
                        </div>
                    </div>
                    <!--/Metric Card-->
                </div>
                <div class="w-full md:w-1/4 xl:w-1/4 p-3">
                    <!--Metric Card-->
                    <div class="bg-white border rounded shadow p-2">
                        <div class="flex flex-row items-center">
                            <div class="flex-shrink pr-4">
                                <div class="rounded p-3 bg-green-800"><i
                                        class="fas fa-shopping-cart fa-2x fa-fw fa-inverse"></i></div>
                            </div>
                            <div class="flex-1 text-right md:text-center">
                                <h5 class="font-bold uppercase text-gray-500">Jumlah UMKM Perdagangan</h5>
                                <h3 class="font-bold text-3xl">{{ $totalUmkmPerdagangan }} <span
                                        class="text-green-500"><i class="fas fa-shopping-cart"></i></span></h3>
                            </div>
                        </div>
                    </div>
                    <!--/Metric Card-->
                </div>
                <div class="w-full md:w-1/4 xl:w-1/4 p-3">
                    <!--Metric Card-->
                    <div class="bg-white border rounded shadow p-2">
                        <div class="flex flex-row items-center">
                            <div class="flex-shrink pr-4">
                                <div class="rounded p-3 bg-gray-800"><i
                                        class="fas fa-hard-hat fa-2x fa-fw fa-inverse"></i></div>
                            </div>
                            <div class="flex-1 text-right md:text-center">
                                <h5 class="font-bold uppercase text-gray-500">Jumlah UMKM Konstruksi</h5>
                                <h3 class="font-bold text-3xl">{{ $totalUmkmKonstruksi }} <span
                                        class="text-gray-500"><i class="fas fa-hard-hat"></i></span></h3>
                            </div>
                        </div>
                    </div>
                    <!--/Metric Card-->
                </div>
                <div class="w-full md:w-1/4 xl:w-1/4 p-3">
                    <!--Metric Card-->
                    <div class="bg-white border rounded shadow p-2">
                        <div class="flex flex-row items-center">
                            <div class="flex-shrink pr-4">
                                <div class="rounded p-3 bg-red-700"><i class="fas fa-list fa-2x fa-fw fa-inverse"></i>
                                </div>
                            </div>
                            <div class="flex-1 text-right md:text-center">
                                <h5 class="font-bold uppercase text-gray-500">Jumlah Jasa Lainnya</h5>
                                <h3 class="font-bold text-3xl">{{ $totalUmkmJasaLainnya }} <span
                                        class="text-red-500"><i class="fas fa-list"></i></span></h3>
                            </div>
                        </div>
                    </div>
                    <!--/Metric Card-->
                </div>
            </div>

            <!-- grafik -->
            <div class="flex flex-col mt-8" id="graph">
                <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                    <div
                        class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
                        <hr class="border-b-2 border-gray-400 my-8 mx-4">
                        <div class="flex flex-row flex-wrap flex-grow mt-2">
                            <div class="w-full md:w-1/2 p-3">
                                <!--Graph Card-->
                                <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"
                                    integrity="sha256-XF29CBwU1MWLaGEnsELogU6Y6rcc5nCkhhx89nFMIDQ=" crossorigin="anonymous"></script>
                                <div class="bg-white border rounded shadow h-full">
                                    <div class="border-b p-3">
                                        <h5 class="font-bold uppercase text-gray-600">Total Penduduk</h5>
                                    </div>
                                    <div class="p-5">
                                        <canvas id="donutChart" class="chart-canvas" width="300"
                                            height="300"></canvas>
                                    </div>
                                </div>
                                <!--/Graph Card-->
                            </div>

                            <div class="w-full md:w-1/2 p-3">
                                <!--Graph Card-->
                                <div class="bg-white border rounded shadow h-full">
                                    <div class="border-b p-3">
                                        <h5 class="font-bold uppercase text-gray-600">Jumlah Penduduk per RW</h5>
                                    </div>
                                    <div class="p-5">
                                        <canvas id="barChart" class="chart-canvas" width="500"
                                            height="300"></canvas>
                                    </div>
                                </div>
                                <!--/Graph Card-->
                            </div>

                            <div class="w-full md:w-1/2 p-3">
                                <!--Graph Card-->
                                <div class="bg-white border rounded shadow h-full">
                                    <div class="border-b p-3">
                                        <h5 class="font-bold uppercase text-gray-600">Jumlah Lahir, Meninggal dan
                                            Migrasi</h5>
                                    </div>
                                    <div class="p-5">
                                        <canvas id="lineChart" class="chart-canvas" width="500"
                                            height="300"></canvas>
                                    </div>
                                </div>
                                <!--/Graph Card-->
                            </div>

                            <div class="w-full md:w-1/2 p-3">
                                <!--Graph Card-->
                                <div class="bg-white border rounded shadow h-full">
                                    <div class="border-b p-3">
                                        <h5 class="font-bold uppercase text-gray-600">Jumlah UMKM Menurut Jenis Usaha
                                        </h5>
                                    </div>
                                    <div class="p-5">
                                        <canvas id="horizontalBarChart" class="chart-canvas" width="500"
                                            height="300"></canvas>
                                    </div>
                                </div>
                                <!--/Graph Card-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <style>
                .chart-canvas {
                    width: 100% !important;
                    height: 220px !important;
                }
            </style>

            <script>
                // Inisialisasi grafik Donut
                new Chart(document.getElementById("donutChart"), {
                    type: 'doughnut',
                    data: {
                        labels: ['Laki-Laki', 'Perempuan'],
                        datasets: [{
                            data: [{{ $totalLakiLaki }}, {{ $totalPerempuan }}],
                            backgroundColor: ['rgba(54, 162, 235, 0.2)', 'rgba(255, 99, 132, 0.2)'],
                            borderColor: ['rgba(54, 162, 235, 1)', 'rgba(255, 99, 132, 1)'],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false
                    }
                });

                const rwData = @json($dataByRw);
                const labels = Object.keys(rwData);
                const dataLk = labels.map(rw => rwData[rw]['LAKI-LAKI'] || 0);
                const dataPr = labels.map(rw => rwData[rw]['PEREMPUAN'] || 0);

                // Inisialisasi grafik Bar
                new Chart(document.getElementById("barChart"), {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                                label: 'Laki-Laki',
                                data: dataLk,
                                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                                borderColor: 'rgba(54, 162, 235, 1)',
                                borderWidth: 1
                            },
                            {
                                label: 'Perempuan',
                                data: dataPr,
                                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                borderColor: 'rgba(255, 99, 132, 1)',
                                borderWidth: 1
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });

                // Inisialisasi grafik Line
                new Chart(document.getElementById("lineChart"), {
                    type: 'line',
                    data: {
                        labels: ['TW I', 'TW II', 'TW III', 'TW IV'],
                        datasets: [{
                                label: 'Jumlah Lahir',
                                data: [{{ $totalLahirLakiLaki }}, {{ $totalLahirPerempuan }}],
                                borderColor: 'rgb(54, 162, 235)',
                                fill: false
                            },
                            {
                                label: 'Jumlah Meninggal',
                                data: [{{ $totalMeninggalLakiLaki }}, {{ $totalMeninggalPerempuan }}],
                                borderColor: 'rgb(255, 10, 32)',
                                fill: false
                            },
                            {
                                label: 'Jumlah Migrasi Masuk',
                                data: [{{ $totalMigrasiMasukLakiLaki }}, {{ $totalMigrasiMasukPerempuan }}],
                                borderColor: 'rgb(75, 200, 21)',
                                fill: false
                            },
                            {
                                label: 'Jumlah Migrasi Keluar',
                                data: [{{ $totalMigrasiKeluarLakiLaki }}, {{ $totalMigrasiKeluarPerempuan }}],
                                borderColor: 'rgb(255, 206, 30)',
                                fill: false
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    stepSize: 1, // Mengatur langkah ke 1 untuk menghindari desimal
                                    callback: function(value) {
                                        return Number(value).toFixed(0); // Menghilangkan desimal
                                    }
                                }
                            }
                        }
                    }
                });

                // Inisialisasi grafik Horizontal Bar
                new Chart(document.getElementById("horizontalBarChart"), {
                    type: 'horizontalBar',
                    data: {
                        labels: ['Industri', 'Perdagangan', 'Akomodasi', 'Konstruksi', 'Jasa Lainnya'],
                        datasets: [{
                            label: 'Jumlah UMKM',
                            data: [{{ $totalUmkmIndustri }}, {{ $totalUmkmPerdagangan }},
                                {{ $totalUmkmPenyediaAkomodasi }}, {{ $totalUmkmKonstruksi }},
                                {{ $totalUmkmJasaLainnya }}
                            ],
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            x: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            </script>


            <div class="w-full p-3">
                <!--Table Card-->
                <div class="bg-white border rounded shadow">
                    <div class="border-b p-3">
                        <h5 class="font-bold uppercase text-gray-600">Table</h5>
                    </div>
                    <div class="p-5">
                        <table class="w-full p-5 text-gray-700">
                            <thead>
                                <tr>
                                    <th class="text-left text-blue-900">Name</th>
                                    <th class="text-left text-blue-900">Side</th>
                                    <th class="text-left text-blue-900">Role</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td>Obi Wan Kenobi</td>
                                    <td>Light</td>
                                    <td>Jedi</td>
                                </tr>
                                <tr>
                                    <td>Greedo</td>
                                    <td>South</td>
                                    <td>Scumbag</td>
                                </tr>
                                <tr>
                                    <td>Darth Vader</td>
                                    <td>Dark</td>
                                    <td>Sith</td>
                                </tr>
                            </tbody>
                        </table>

                        <p class="py-2"><a href="#">See More issues...</a></p>

                    </div>
                </div>
                <!--/table Card-->
            </div>


        </div>

        <!--/ Console Content-->

    </div>


    </div>
    <!--/container-->

    <footer class="bg-white dark:bg-gray-900">
        <div class="mx-auto w-full max-w-screen-xl p-4 py-6 lg:py-8">
            <div class="md:flex md:justify-between">
                <div class="flex items-center justify-center">
                    <div class="flex items-center max-w-full mt-7">
                        <img src="{{ asset('/img/logo-kel-kesambi.png') }}" alt="sista-bijak"
                            class="w-auto h-28 ml-2">
                        <span class="mr-10 ml-3 text-30 font-semibold text-black">SISTA BIJAK</span>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-8 sm:gap-6 sm:grid-cols-3">
                    <div>
                        <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Resources</h2>
                        <ul class="text-gray-500 dark:text-gray-400 font-medium">
                            <li class="mb-4">
                                <a href="https://flowbite.com/" class="hover:underline">Flowbite</a>
                            </li>
                            <li>
                                <a href="https://tailwindcss.com/" class="hover:underline">Tailwind CSS</a>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Follow us</h2>
                        <ul class="text-gray-500 dark:text-gray-400 font-medium">
                            <li class="mb-4">
                                <a href="https://github.com/themesberg/flowbite" class="hover:underline ">Github</a>
                            </li>
                            <li>
                                <a href="https://discord.gg/4eeurUVvTy" class="hover:underline">Discord</a>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Legal</h2>
                        <ul class="text-gray-500 dark:text-gray-400 font-medium">
                            <li class="mb-4">
                                <a href="#" class="hover:underline">Privacy Policy</a>
                            </li>
                            <li>
                                <a href="#" class="hover:underline">Terms &amp; Conditions</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
            <div class="sm:flex sm:items-center sm:justify-between">
                <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2024 <a
                        href="https://flowbite.com/" class="hover:underline">Flowbite™</a>. All Rights Reserved.
                </span>
                <div class="flex mt-4 sm:justify-center sm:mt-0">
                    <a href="#" class="text-gray-500 hover:text-gray-900 dark:hover:text-white">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 8 19">
                            <path fill-rule="evenodd"
                                d="M6.135 3H8V0H6.135a4.147 4.147 0 0 0-4.142 4.142V6H0v3h2v9.938h3V9h2.021l.592-3H5V3.591A.6.6 0 0 1 5.592 3h.543Z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="sr-only">Facebook page</span>
                    </a>
                    <a href="#" class="text-gray-500 hover:text-gray-900 dark:hover:text-white ms-5">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 21 16">
                            <path
                                d="M16.942 1.556a16.3 16.3 0 0 0-4.126-1.3 12.04 12.04 0 0 0-.529 1.1 15.175 15.175 0 0 0-4.573 0 11.585 11.585 0 0 0-.535-1.1 16.274 16.274 0 0 0-4.129 1.3A17.392 17.392 0 0 0 .182 13.218a15.785 15.785 0 0 0 4.963 2.521c.41-.564.773-1.16 1.084-1.785a10.63 10.63 0 0 1-1.706-.83c.143-.106.283-.217.418-.33a11.664 11.664 0 0 0 10.118 0c.137.113.277.224.418.33-.544.328-1.116.606-1.71.832a12.52 12.52 0 0 0 1.084 1.785 16.46 16.46 0 0 0 5.064-2.595 17.286 17.286 0 0 0-2.973-11.59ZM6.678 10.813a1.941 1.941 0 0 1-1.8-2.045 1.93 1.93 0 0 1 1.8-2.047 1.919 1.919 0 0 1 1.8 2.047 1.93 1.93 0 0 1-1.8 2.045Zm6.644 0a1.94 1.94 0 0 1-1.8-2.045 1.93 1.93 0 0 1 1.8-2.047 1.918 1.918 0 0 1 1.8 2.047 1.93 1.93 0 0 1-1.8 2.045Z" />
                        </svg>
                        <span class="sr-only">Discord community</span>
                    </a>
                    <a href="#" class="text-gray-500 hover:text-gray-900 dark:hover:text-white ms-5">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 20 17">
                            <path fill-rule="evenodd"
                                d="M20 1.892a8.178 8.178 0 0 1-2.355.635 4.074 4.074 0 0 0 1.8-2.235 8.344 8.344 0 0 1-2.605.98A4.13 4.13 0 0 0 13.85 0a4.068 4.068 0 0 0-4.1 4.038 4 4 0 0 0 .105.919A11.705 11.705 0 0 1 1.4.734a4.006 4.006 0 0 0 1.268 5.392 4.165 4.165 0 0 1-1.859-.5v.05A4.057 4.057 0 0 0 4.1 9.635a4.19 4.19 0 0 1-1.856.07 4.108 4.108 0 0 0 3.831 2.807A8.36 8.36 0 0 1 0 14.184 11.732 11.732 0 0 0 6.291 16 11.502 11.502 0 0 0 17.964 4.5c0-.177 0-.35-.012-.523A8.143 8.143 0 0 0 20 1.892Z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="sr-only">Twitter page</span>
                    </a>
                    <a href="#" class="text-gray-500 hover:text-gray-900 dark:hover:text-white ms-5">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 .333A9.911 9.911 0 0 0 6.866 19.65c.5.092.678-.215.678-.477 0-.237-.01-1.017-.014-1.845-2.757.6-3.338-1.169-3.338-1.169a2.627 2.627 0 0 0-1.1-1.451c-.9-.615.07-.6.07-.6a2.084 2.084 0 0 1 1.518 1.021 2.11 2.11 0 0 0 2.884.823c.044-.503.268-.973.63-1.325-2.2-.25-4.516-1.1-4.516-4.9A3.832 3.832 0 0 1 4.7 7.068a3.56 3.56 0 0 1 .095-2.623s.832-.266 2.726 1.016a9.409 9.409 0 0 1 4.962 0c1.89-1.282 2.717-1.016 2.717-1.016.366.83.402 1.768.1 2.623a3.827 3.827 0 0 1 1.02 2.659c0 3.807-2.319 4.644-4.525 4.889a2.366 2.366 0 0 1 .673 1.834c0 1.326-.012 2.394-.012 2.72 0 .263.18.572.681.475A9.911 9.911 0 0 0 10 .333Z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="sr-only">GitHub account</span>
                    </a>
                    <a href="#" class="text-gray-500 hover:text-gray-900 dark:hover:text-white ms-5">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 0a10 10 0 1 0 10 10A10.009 10.009 0 0 0 10 0Zm6.613 4.614a8.523 8.523 0 0 1 1.93 5.32 20.094 20.094 0 0 0-5.949-.274c-.059-.149-.122-.292-.184-.441a23.879 23.879 0 0 0-.566-1.239 11.41 11.41 0 0 0 4.769-3.366ZM8 1.707a8.821 8.821 0 0 1 2-.238 8.5 8.5 0 0 1 5.664 2.152 9.608 9.608 0 0 1-4.476 3.087A45.758 45.758 0 0 0 8 1.707ZM1.642 8.262a8.57 8.57 0 0 1 4.73-5.981A53.998 53.998 0 0 1 9.54 7.222a32.078 32.078 0 0 1-7.9 1.04h.002Zm2.01 7.46a8.51 8.51 0 0 1-2.2-5.707v-.262a31.64 31.64 0 0 0 8.777-1.219c.243.477.477.964.692 1.449-.114.032-.227.067-.336.1a13.569 13.569 0 0 0-6.942 5.636l.009.003ZM10 18.556a8.508 8.508 0 0 1-5.243-1.8 11.717 11.717 0 0 1 6.7-5.332.509.509 0 0 1 .055-.02 35.65 35.65 0 0 1 1.819 6.476 8.476 8.476 0 0 1-3.331.676Zm4.772-1.462A37.232 37.232 0 0 0 13.113 11a12.513 12.513 0 0 1 5.321.364 8.56 8.56 0 0 1-3.66 5.73h-.002Z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="sr-only">Dribbble account</span>
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        /*Toggle dropdown list*/
        /*https://gist.github.com/slavapas/593e8e50cf4cc16ac972afcbad4f70c8*/

        var userMenuDiv = document.getElementById("userMenu");
        var userMenu = document.getElementById("userButton");

        var navMenuDiv = document.getElementById("nav-content");
        var navMenu = document.getElementById("nav-toggle");

        document.onclick = check;

        function check(e) {
            var target = (e && e.target) || (event && event.srcElement);

            //User Menu
            if (!checkParent(target, userMenuDiv)) {
                // click NOT on the menu
                if (checkParent(target, userMenu)) {
                    // click on the link
                    if (userMenuDiv.classList.contains("invisible")) {
                        userMenuDiv.classList.remove("invisible");
                    } else {
                        userMenuDiv.classList.add("invisible");
                    }
                } else {
                    // click both outside link and outside menu, hide menu
                    userMenuDiv.classList.add("invisible");
                }
            }

            //Nav Menu
            if (!checkParent(target, navMenuDiv)) {
                // click NOT on the menu
                if (checkParent(target, navMenu)) {
                    // click on the link
                    if (navMenuDiv.classList.contains("hidden")) {
                        navMenuDiv.classList.remove("hidden");
                    } else {
                        navMenuDiv.classList.add("hidden");
                    }
                } else {
                    // click both outside link and outside menu, hide menu
                    navMenuDiv.classList.add("hidden");
                }
            }

        }

        function checkParent(t, elm) {
            while (t.parentNode) {
                if (t == elm) {
                    return true;
                }
                t = t.parentNode;
            }
            return false;
        }
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('href').substring(1);
                const targetElement = document.getElementById(targetId);

                const scrollToPosition = targetElement.offsetTop;
                const startPosition = window.pageYOffset;
                const distance = scrollToPosition - startPosition;
                const duration = 800;
                let startTime = null;

                function animation(currentTime) {
                    if (startTime === null) startTime = currentTime;
                    const timeElapsed = currentTime - startTime;
                    const run = ease(timeElapsed, startPosition, distance, duration);
                    window.scrollTo(0, run);
                    if (timeElapsed < duration) requestAnimationFrame(animation);
                }

                function ease(t, b, c, d) {
                    t /= d / 2;
                    if (t < 1) return c / 2 * t * t + b;
                    t--;
                    return -c / 2 * (t * (t - 2) - 1) + b;
                }

                requestAnimationFrame(animation);
            });
        });
        // Fungsi untuk mengatur kelas aktif pada navigasi
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', function() {
                // Hapus kelas 'active' dari semua link
                document.querySelectorAll('.nav-link').forEach(link => {
                    link.classList.remove('active');
                });
                // Tambahkan kelas 'active' pada link yang diklik
                this.classList.add('active');
            });
        });
        // Fungsi untuk mengatur kelas aktif pada navigasi
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', function() {
                // Hapus kelas 'active' dari semua link dan set warna ke abu-abu
                document.querySelectorAll('.nav-link').forEach(link => {
                    link.classList.remove('active');
                    link.style.color = 'gray'; // Set warna menjadi abu-abu saat tidak aktif
                });

                // Tambahkan kelas 'active' pada link yang diklik dan set warnanya
                this.classList.add('active');
                if (this.id === "navHome") {
                    this.style.color = 'pink'; // Warna merah untuk Home
                } else if (this.id === "navGraph") {
                    this.style.color = 'green'; // Warna hijau untuk Graph
                } else if (this.id === "navPayments") {
                    this.style.color = 'blue'; // Warna biru untuk Payments
                }
            });
        });
    </script>
</body>

</html>
