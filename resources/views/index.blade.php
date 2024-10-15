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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <!--Replace with your tailwind.css once created-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"
        integrity="sha256-XF29CBwU1MWLaGEnsELogU6Y6rcc5nCkhhx89nFMIDQ=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/smooth-scroll/16.1.3/smooth-scroll.polyfills.min.js"></script>
</head>
<style>
.cardg, .card1 {
    position: relative;
    overflow: hidden;
}

.overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background-color: rgba(0, 0, 0, 0.7);
    overflow: hidden;
    width: 100%;
    height: 0;
    transition: .5s ease;
    display: flex;
    align-items: center;
    justify-content: center;
}

.cardg:hover .overlay, .card1:hover .overlay {
    height: 50px; /* Adjust this value to control how much of the overlay is shown */
}

.overlay-text {
    color: white;
    font-size: 16px;
    text-align: center;
}

.containerg {
    height: auto;
    width: auto;
    max-height: 800px;
    max-width: 1280px;
    min-height: 600px;
    min-width: 1000px;
    display: flex;
    justify-content: space-around;
    align-items: center;
    margin: 0 auto;
}

.card1-border, .borderg {
    height: 369px;
    width: 290px;
    background: transparent;
    border-radius: 10px;
    transition: border 1s;
    position: relative;
}

.card1-border:hover, .borderg:hover {
    border: 1px solid #fff;
}

.card1-border {
    height: 440px;
}

.big-card, .cardg {
    height: 379px;
    width: 300px;
    background: #808080;
    border-radius: 10px;
    transition: background 0.8s;
    overflow: hidden;
    background: #000;
    display: flex;
    justify-content: center;
    align-items: center;
    position: relative;
}

.card0 {
    background: URL("https://upload.wikimedia.org/wikipedia/commons/1/19/Visit_of_Bill_Gates%2C_Chairman_of_Breakthrough_Energy_Ventures%2C_to_the_European_Commission_5_%28cropped%29_%28cropped%29.jpg") center center no-repeat;
    background-size: 350px;
}

.card0:hover {
    background: URL("https://upload.wikimedia.org/wikipedia/commons/1/19/Visit_of_Bill_Gates%2C_Chairman_of_Breakthrough_Energy_Ventures%2C_to_the_European_Commission_5_%28cropped%29_%28cropped%29.jpg") center center no-repeat;
    background-size: 400px; /* Ukuran zoom yang lebih kecil */
}

.card0:hover h2 {
    opacity: 1;
}

.card0:hover .fa {
    opacity: 1;
}

.big-card {
    height: 450px;
    width: 300px;
}

.card1 {
    background: url("https://kelkesambi.cirebonkota.go.id/wp-content/uploads/2024/09/Beige-Aesthetic-Feminine-Business-Twitter-Profile-Picture-eBook-1-963x1536.png") center center no-repeat;
    background-size: 300px;
}

.card1:hover {
    background: url("https://kelkesambi.cirebonkota.go.id/wp-content/uploads/2024/09/Beige-Aesthetic-Feminine-Business-Twitter-Profile-Picture-eBook-1-963x1536.png") center center no-repeat;
    background-size: 400px; /* Ukuran zoom yang lebih kecil */
}

.card1:hover h2 {
    opacity: 1;
}

.card1:hover .fa {
    opacity: 1;
}

.card2 {
    background: url("https://i.pinimg.com/564x/5b/a9/9a/5ba99a3fd59ca8a98d24f36debda382a.jpg") center center no-repeat;
    background-size: 350px;
}

.card2:hover {
    background: url("https://i.pinimg.com/564x/5b/a9/9a/5ba99a3fd59ca8a98d24f36debda382a.jpg") center center no-repeat;
    background-size: 400px; /* Ukuran zoom yang lebih kecil */
}

.card2:hover h2 {
    opacity: 1;
}

.card2:hover .fa {
    opacity: 1;
}

h2 {
    font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
    color: #fff;
    margin: 20px;
    opacity: 0;
    transition: opacity 1s;
}

.fa {
    opacity: 0;
    transition: opacity 1s;
}

.card1-icons, .icons {
    position: absolute;
    fill: #fff;
    color: #fff;
    height: 130px;
    top: 226px;
    width: 50px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: space-around;
}

.card1-icons {
    top: 295px;
}

.card1-icons:hover .fa, .icons:hover .fa {
    transform: scale(1.025s);
    transition: 1s;
}


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
                                <div class="rounded p-3 bg-green-600"><i
                                        class="fas fa-users fa-2x fa-fw fa-inverse"></i>
                                </div>
                            </div>
                            <div class="flex-1 text-right md:text-center">
                                <h5 class="font-bold uppercase text-gray-500">Jumlah Keseluruhan Penduduk</h5>
                                <h3 class="font-bold text-3xl"> {{ $totalPenduduk }} <span class="text-green-500"><i
                                            class="fas fa-users"></i></span></h3>
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
                                            class="fas fa-male"></i></span></h3>
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
                                            class="fas fa-female"></i></span></h3>
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
                                <div class="rounded p-3 bg-blue-600"><i class="fas fa-baby fa-2x fa-fw fa-inverse"></i>
                                </div>
                            </div>
                            <div class="flex-1 text-right md:text-center">
                                <h5 class="font-bold uppercase text-gray-500">Jumlah Keseluruhan Lahir</h5>
                                <h3 class="font-bold text-3xl"> {{ $totalLahir }} <span class="text-blue-500"><i
                                            class="fas fa-baby"></i></span></h3>
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
                                            class="fas fa-monument"></i></span></h3>
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
                                <h3 class="font-bold text-3xl">{{ $totalMigrasiMasuk }} <span class="text-green-500"><i
                                            class="fas fa-caret-up"></i></span></h3>
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
                                <h3 class="font-bold text-3xl">{{ $totalUmkmIndustri }} <span class="text-purple-500"><i
                                            class="fas fa-warehouse"></i></span></h3>
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
                                <div class="rounded p-3 bg-blue-900"><i class="fas fa-hotel fa-2x fa-fw fa-inverse"></i>
                                </div>
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
                                <h3 class="font-bold text-3xl">{{ $totalUmkmKonstruksi }} <span class="text-gray-500"><i
                                            class="fas fa-hard-hat"></i></span></h3>
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
                                <h3 class="font-bold text-3xl">{{ $totalUmkmJasaLainnya }} <span class="text-red-500"><i
                                            class="fas fa-list"></i></span></h3>
                            </div>
                        </div>
                    </div>
                    <!--/Metric Card-->
                </div>
            </div>

            <!-- grafik -->
            <div class="flex flex-col mt-8" id="graph">
                <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                    <div class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
                        <hr class="border-b-2 border-gray-400 my-8 mx-4">
                        <div class="flex flex-row flex-wrap flex-grow mt-2">
                            <div class="w-full md:w-1/2 p-3">
                                <!--Graph Card-->
                                <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"
                                    integrity="sha256-XF29CBwU1MWLaGEnsELogU6Y6rcc5nCkhhx89nFMIDQ="
                                    crossorigin="anonymous"></script>
                                <div class="bg-white border rounded shadow h-full">
                                    <div class="border-b p-3">
                                        <h5 class="font-bold uppercase text-gray-600">Total Penduduk</h5>
                                    </div>
                                    <div class="p-5">
                                        <canvas id="donutChart" class="chart-canvas" width="300" height="300"></canvas>
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
                                        <canvas id="barChart" class="chart-canvas" width="500" height="300"></canvas>
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
                                        <canvas id="lineChart" class="chart-canvas" width="500" height="300"></canvas>
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
                data: [{{$totalLakiLaki}}, {{$totalPerempuan}}],
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
                    data: [{{$totalLahirLakiLaki}}, {{$totalLahirPerempuan}}],
                    borderColor: 'rgb(54, 162, 235)',
                    fill: false
                },
                {
                    label: 'Jumlah Meninggal',
                    data: [{{$totalMeninggalLakiLaki}}, {{$totalMeninggalPerempuan}}],
                    borderColor: 'rgb(255, 10, 32)',
                    fill: false
                },
                {
                    label: 'Jumlah Migrasi Masuk',
                    data: [{{$totalMigrasiMasukLakiLaki}}, {{$totalMigrasiMasukPerempuan}}],
                    borderColor: 'rgb(75, 200, 21)',
                    fill: false
                },
                {
                    label: 'Jumlah Migrasi Keluar',
                    data: [{{$totalMigrasiKeluarLakiLaki}}, {{$totalMigrasiKeluarPerempuan}}],
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
                        stepSize: 1,
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
                data: [{{$totalUmkmIndustri}}, {{$totalUmkmPerdagangan}}, {{$totalUmkmPenyediaAkomodasi}}, {{$totalUmkmKonstruksi}}, {{$totalUmkmJasaLainnya}}],
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
        <div class="containerg">
            <div class="cardg card0">
                <div class="borderg">
                    <div class="overlay">
                        <div class="overlay-text">Bill Gates - Chairman</div>
                    </div>
                    <h2>Bill Gates</h2>
                    <!-- <div class="icons">
                        <i class="fa fa-linkedin" aria-hidden="true"></i>
                        <i class="fa fa-instagram" aria-hidden="true"></i>
                        <i class="fa fa-youtube" aria-hidden="true"></i>
                        <i class="fa fa-facebook" aria-hidden="true"></i>
                    </div> -->
                </div>
            </div>
            <div class="card1 big-card">
                <div class="card1-border">
                    <div class="overlay">
                        <div class="overlay-text">EKO SAPUTRA SIREGAR, S.STP., M.A.P</div>
                    </div>
                    <h2>Lurah Kesambi</h2>
                    <!-- <div class="card1-icons">
                        <i class="fa fa-linkedin" aria-hidden="true"></i>
                        <i class="fa fa-instagram" aria-hidden="true"></i>
                        <i class="fa fa-youtube" aria-hidden="true"></i>
                        <i class="fa fa-facebook" aria-hidden="true"></i>
                    </div> -->
                </div>
            </div>
            <div class="cardg card2">
                <div class="borderg">
                    <div class="overlay">
                        <div class="overlay-text">Mark Zuckerberg - CEO</div>
                    </div>
                    <h2>Mark Zuckerberg</h2>
                    <!-- <div class="icons">
                        <i class="fa fa-linkedin" aria-hidden="true"></i>
                        <i class="fa fa-instagram" aria-hidden="true"></i>
                        <i class="fa fa-youtube" aria-hidden="true"></i>
                        <i class="fa fa-facebook" aria-hidden="true"></i>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
    <!--/table Card-->
</div>
    <!--/container-->

    <footer class="bg-white dark:bg-gray-900">
        <div class="mx-auto w-full max-w-screen-xl p-4 py-6 lg:py-8">
            <div class="md:flex md:justify-between">
                <div class="flex items-center justify-center">
                    <div class="flex items-center max-w-full mt-7">
                        <img src="{{ asset('/img/logo-kel-kesambi.png') }}" alt="sista-bijak" class="w-auto h-28 ml-2">
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
                        href="https://flowbite.com/" class="hover:underline">SISTA BIJAK</a>. All Rights Reserved.
                </span>
                <div class="flex mt-4 sm:justify-center sm:mt-0">
                    <a href="https://www.facebook.com/kelkesambi/" class="text-gray-500 hover:text-gray-900 dark:hover:text-white mx-2">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 8 19">
                            <path fill-rule="evenodd"
                                d="M6.135 3H8V0H6.135a4.147 4.147 0 0 0-4.142 4.142V6H0v3h2v9.938h3V9h2.021l.592-3H5V3.591A.6.6 0 0 1 5.592 3h.543Z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="sr-only">Facebook</span>
                    </a>
                    <a href="https://www.youtube.com/@kelurahankesambi2689" class="text-gray-500 hover:text-gray-900 dark:hover:text-white mx-2">
                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M23.498 6.186a2.999 2.999 0 0 0-2.118-2.118C19.5 3.5 12 3.5 12 3.5s-7.5 0-9.38.568a2.999 2.999 0 0 0-2.118 2.118C0 8.066 0 12 0 12s0 3.934.502 5.814a2.999 2.999 0 0 0 2.118 2.118C4.5 20.5 12 20.5 12 20.5s7.5 0 9.38-.568a2.999 2.999 0 0 0 2.118-2.118C24 15.934 24 12 24 12s0-3.934-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                            </svg>
                        <span class="sr-only">Youtube</span>
                    </a>
                    <a href="https://www.instagram.com/kelkesambi/" class="text-gray-500 hover:text-gray-900 dark:hover:text-white mx-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-4 h-4">
                            <path d="M12 2.2c3.2 0 3.6.012 4.85.07 1.17.054 1.97.24 2.43.41.59.23 1.01.51 1.46.96.45.45.73.87.96 1.46.17.46.36 1.26.41 2.43.058 1.25.07 1.65.07 4.85s-.012 3.6-.07 4.85c-.054 1.17-.24 1.97-.41 2.43-.23.59-.51 1.01-.96 1.46-.45.45-.87.73-1.46.96-.46.17-1.26.36-2.43.41-1.25.058-1.65.07-4.85.07s-3.6-.012-4.85-.07c-1.17-.054-1.97-.24-2.43-.41-.59-.23-1.01-.51-1.46-.96-.45-.45-.73-.87-.96-1.46-.17-.46-.36-1.26-.41-2.43C2.212 15.6 2.2 15.2 2.2 12s.012-3.6.07-4.85c.054-1.17.24-1.97.41-2.43.23-.59.51-1.01.96-1.46.45-.45.87-.73 1.46-.96.46-.17 1.26-.36 2.43-.41C8.4 2.212 8.8 2.2 12 2.2zm0 5.838a6.162 6.162 0 1 0 0 12.324 6.162 6.162 0 0 0 0-12.324zm0 10.162a3.999 3.999 0 1 1 0-7.998 3.999 3.999 0 0 1 0 7.998zM18.7 5.3a1.3 1.3 0 1 0 0-2.6 1.3 1.3 0 0 0 0 2.6z"/>
                        </svg>
                        <span class="sr-only">Instagram</span>
                    </a>
                        <!-- <a href="#" class="text-gray-500 hover:text-gray-900 dark:hover:text-white mx-2">
                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 20 17">
                                <path fill-rule="evenodd"
                                    d="M20 1.892a8.178 8.178 0 0 1-2.355.635 4.074 4.074 0 0 0 1.8-2.235 8.344 8.344 0 0 1-2.605.98A4.13 4.13 0 0 0 13.85 0a4.068 4.068 0 0 0-4.1 4.038 4 4 0 0 0 .105.919A11.705 11.705 0 0 1 1.4.734a4.006 4.006 0 0 0 1.268 5.392 4.165 4.165 0 0 1-1.859-.5v.05A4.057 4.057 0 0 0 4.1 9.635a4.19 4.19 0 0 1-1.856.07 4.108 4.108 0 0 0 3.831 2.807A8.36 8.36 0 0 1 0 14.184 11.732 11.732 0 0 0 6.291 16 11.502 11.502 0 0 0 17.964 4.5c0-.177 0-.35-.012-.523A8.143 8.143 0 0 0 20 1.892Z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="sr-only">Twitter page</span>
                        </a> -->
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