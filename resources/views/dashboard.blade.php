@extends('layouts.master')
@section('dashboard-title')
    Sista Bijak - Dashboard
@endsection
@section('body')
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
<link rel="stylesheet" href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<!--Replace with your tailwind.css once created-->
<h3 class="text-gray-700 text-3xl font-medium">Dashboard</h3>

<div class="mt-4">
<div class="flex flex-wrap -mx-6">
        <div class="w-full px-6 sm:w-1/2 xl:w-1/3">
            <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
                <div class="flex items-center justify-center p-3 rounded-full bg-purple-600 bg-opacity-75 h-16 w-16">
                    <i class="fas fa-users text-white text-3xl"></i>
                </div>
                <div class="mx-5">
                    <h4 class="text-2xl font-semibold text-gray-700">{{ $totalPenduduk }}</h4>
                    <div class="text-gray-500">Total Keseluruhan Penduduk</div>
                </div>
            </div>
        </div>

        <div class="w-full mt-6 px-6 sm:w-1/2 xl:w-1/3 xl:mt-0">
        <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
            <div class="flex items-center justify-center p-3 rounded-full bg-orange-600 bg-opacity-75 h-16 w-16">
                <i class="fas fa-male text-white text-4xl"></i>
            </div>
            <div class="mx-5">
                <h4 class="text-2xl font-semibold text-gray-700">{{ $totalLakiLaki }}</h4>
                <div class="text-gray-500">Jumlah Keseluruhan Laki-Laki</div>
            </div>
        </div>
    </div>

    <div class="w-full mt-6 px-6 sm:w-1/2 xl:w-1/3 xl:mt-0">
        <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
            <div class="flex items-center justify-center p-3 rounded-full bg-pink-600 bg-opacity-75 h-16 w-16">
                <i class="fas fa-female text-white text-4xl"></i>
            </div>
            <div class="mx-5">
                <h4 class="text-2xl font-semibold text-gray-700">{{ $totalPerempuan }}</h4>
                <div class="text-gray-500">Jumlah Keseluruhan Perempuan</div>
            </div>
        </div>
    </div>
</div>
</div>

<div class="mt-4">
    <div class="flex flex-wrap -mx-6">
        <div class="w-full px-6 sm:w-1/2 xl:w-1/3">
            <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
                <div class="flex items-center justify-center p-3 rounded-full bg-green-600 bg-opacity-75 h-16 w-16">
                    <i class="fas fa-baby text-white text-3xl"></i>
                </div>
                <div class="mx-5">
                    <h4 class="text-2xl font-semibold text-gray-700">{{ $totalLahir }}</h4>
                    <div class="text-gray-500">Total Keseluruhan Lahir</div>
                </div>
            </div>
        </div>

        <div class="w-full mt-6 px-6 sm:w-1/2 xl:w-1/3 sm:mt-0">
            <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
                <div class="flex items-center justify-center p-3 rounded-full bg-red-600 bg-opacity-75 h-16 w-16">
                    <i class="fas fa-monument text-white text-3xl"></i>
                </div>
                <div class="mx-5">
                    <h4 class="text-2xl font-semibold text-gray-700">{{ $totalMeninggal }}</h4>
                    <div class="text-gray-500">Total Keseluruhan Meninggal</div>
                </div>
            </div>
        </div>

        <div class="w-full mt-6 px-6 sm:w-1/2 xl:w-1/3 xl:mt-0">
            <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
                <div class="flex items-center justify-center p-3 rounded-full bg-blue-600 bg-opacity-75 h-16 w-16">
                    <i class="fas fa-sign-in-alt text-white text-3xl"></i>
                </div>
                <div class="mx-5">
                    <h4 class="text-2xl font-semibold text-gray-700">{{ $totalMigrasiMasuk }}</h4>
                    <div class="text-gray-500">Total Keseluruhan Migrasi Masuk</div>
                </div>
            </div>
        </div>
        
    </div>
</div>

<div class="mt-4">
    <div class="flex flex-wrap -mx-6">
        <div class="w-full mt-6 px-6 sm:w-1/2 xl:w-1/3 xl:mt-0">
            <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
                <div class="flex items-center justify-center p-3 rounded-full bg-yellow-600 bg-opacity-75 h-16 w-16">
                    <i class="fas fa-sign-out-alt text-white text-3xl"></i>
                </div>
                <div class="mx-5">
                    <h4 class="text-2xl font-semibold text-gray-700">{{ $totalMigrasiKeluar }}</h4>
                    <div class="text-gray-500">Total Keseluruhan Migrasi Keluar</div>
                </div>
            </div>
        </div>

        <div class="w-full mt-6 px-6 sm:w-1/2 xl:w-1/3 xl:mt-0">
                <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
                    <div class="flex items-center justify-center p-3 rounded-full bg-pink-600 bg-opacity-75 h-16 w-16">
                        <i class="fas fa-store text-white text-3xl"></i>
                    </div>
                    <div class="mx-5">
                        <h4 class="text-2xl font-semibold text-gray-700">{{ $totalUmkm }}</h4>
                        <div class="text-gray-500">Jumlah Keseluruhan UMKM</div>
                    </div>
                </div>
            </div>

            <div class="w-full mt-6 px-6 sm:w-1/2 xl:w-1/3 xl:mt-0">
                <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
                    <div class="flex items-center justify-center p-3 rounded-full bg-red-900 bg-opacity-75 h-16 w-16">
                        <i class="fas fa-warehouse  text-white text-3xl"></i>
                    </div>
                    <div class="mx-5">
                        <h4 class="text-2xl font-semibold text-gray-700">{{ $totalUmkmIndustri }}</h4>
                        <div class="text-gray-500">Total Keseluruhan UMKM Industri</div>
                    </div>
            </div>
    </div>
</div>

<div class="mt-4">
    <div class="flex flex-wrap -mx-6">
            <div class="w-full mt-6 px-6 sm:w-1/2 xl:w-1/3 xl:mt-0">
                <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
                    <div class="flex items-center justify-center p-3 rounded-full bg-purple-900 bg-opacity-75 h-16 w-16">
                        <i class="fas fa-hotel text-white text-3xl"></i>
                    </div>
                    <div class="mx-5">
                        <h4 class="text-2xl font-semibold text-gray-700">{{ $totalUmkmPenyediaAkomodasi }}</h4>
                        <div class="text-gray-500">Total UMKM Penyedia Akomodasi</div>
                    </div>
                </div>
            </div>

            <div class="w-full mt-6 px-6 sm:w-1/2 xl:w-1/3 xl:mt-0">
                <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
                    <div class="flex items-center justify-center p-3 rounded-full bg-green-900 bg-opacity-75 h-16 w-16">
                        <i class="fas fa-shopping-cart text-white text-3xl"></i>
                    </div>
                    <div class="mx-5">
                        <h4 class="text-2xl font-semibold text-gray-700">{{ $totalUmkmPerdagangan }}</h4>
                        <div class="text-gray-500">Total Keseluruhan UMKM Perdagangan</div>
                    </div>
                </div>
            </div>

            <div class="w-full mt-6 px-6 sm:w-1/2 xl:w-1/3 xl:mt-0">
                <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
                    <div class="flex items-center justify-center p-3 rounded-full bg-yellow-900 bg-opacity-75 h-16 w-16">
                        <i class="fas fa-hard-hat text-white text-3xl"></i>
                    </div>
                    <div class="mx-5">
                        <h4 class="text-2xl font-semibold text-gray-700">{{ $totalUmkmKonstruksi }}</h4>
                        <div class="text-gray-500">Total Keseluruhan UMKM Konstruksi</div>
                    </div>
                </div>
            </div>
    </div>
</div>

<div class="mt-4">
    <div class="flex flex-wrap -mx-6">
        <div class="w-full mt-6 px-6 sm:w-1/2 xl:w-1/3 xl:mt-0">
            <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
                <div class="flex items-center justify-center p-3 rounded-full bg-gray-600 bg-opacity-75 h-16 w-16">
                    <i class="fas fa-list text-white text-3xl"></i>
                </div>
                <div class="mx-5">
                    <h4 class="text-2xl font-semibold text-gray-700">{{ $totalUmkmJasaLainnya }}</h4>
                    <div class="text-gray-500">Total Keseluruhan UMKM Jasa Lainnya</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="flex flex-col mt-8">
    <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
        <div class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
            <hr class="border-b-2 border-gray-400 my-8 mx-4">

            <div class="flex flex-row flex-wrap flex-grow mt-2">
                <div class="w-1/2 md:w-1/2 p-3">
                    <!--Graph Card-->
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js" integrity="sha256-XF29CBwU1MWLaGEnsELogU6Y6rcc5nCkhhx89nFMIDQ=" crossorigin="anonymous"></script>
                    <div class="bg-white border rounded shadow">
                        <div class="border-b p-3">
                            <h5 class="font-bold uppercase text-gray-600">Graph</h5>
                        </div>
                        <div class="p-5">
                            <canvas id="chartjs-7" class="chartjs" width="undefined" height="undefined"></canvas>
                            <script>
                            new Chart(document.getElementById("chartjs-7"), {
                                "type": "bar",
                                "data": {
                                    "labels": ["January", "February", "March", "April"],
                                    "datasets": [{
                                        "label": "Page Impressions",
                                        "data": [10, 20, 30, 40],
                                        "borderColor": "rgb(255, 99, 132)",
                                        "backgroundColor": "rgba(255, 99, 132, 0.2)"
                                    }, {
                                        "label": "Adsense Clicks",
                                        "data": [5, 15, 10, 30],
                                        "type": "line",
                                        "fill": false,
                                        "borderColor": "rgb(54, 162, 235)"
                                    }]
                                },
                                "options": {
                                    "scales": {
                                        "yAxes": [{
                                            "ticks": {
                                                "beginAtZero": true
                                            }
                                        }]
                                    }
                                }
                            });
                            </script>
                        </div>
                    </div>
                    <!--/Graph Card-->
                </div>
                <div class="w-1/2 md:w-1/2 p-3">
                    <!--Graph Card-->
                    <div class="bg-white border rounded shadow">
                        <div class="border-b p-3">
                            <h5 class="font-bold uppercase text-gray-600">Graph</h5>
                        </div>
                        <div class="p-5"><canvas id="chartjs-4" class="chartjs" width="undefined" height="undefined"></canvas>
                            <script>
                            new Chart(document.getElementById("chartjs-4"), {
                                "type": "doughnut",
                                "data": {
                                    "labels": ["Laki-Laki", "Perempuan"],
                                    "datasets": [{
                                        "label": "Issues",
                                        "data": [{{ $proporsiLK }},{{ $proporsiPR }}],
                                        "backgroundColor": ["rgb(54, 162, 235)", "rgb(255, 99, 132)"]
                                    }]
                                }
                            });
                            </script>
                        </div>
                    </div>
                    <!--/Graph Card-->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection