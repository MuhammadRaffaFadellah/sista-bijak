@extends('layouts.master')
@section('dashboard-title')
    Sista Bijak - Dashboard
@endsection
@section('body')
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
        integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css" />
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
            <div class="w-full h-auto px-6 sm:w-1/2 xl:w-1/3">
                <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
                    <div class="flex items-center justify-center p-3 rounded-full bg-green-600 bg-opacity-75 h-16 w-16">
                        <i class="fas fa-baby text-white text-3xl"></i>
                    </div>
                    <div class="mx-5">
                        <h4 class="text-2xl font-semibold text-gray-700">{{ $totalLahir }}</h4>
                        <div class="text-gray-500">Total Keseluruhan <br> Lahir</div>
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
                        <div class="text-gray-500">Total Keseluruhan <br> Migrasi Masuk</div>
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
                        <div
                            class="flex items-center justify-center p-3 rounded-full bg-purple-900 bg-opacity-75 h-16 w-16">
                            <i class="fas fa-hotel text-white text-3xl"></i>
                        </div>
                        <div class="mx-5">
                            <h4 class="text-2xl font-semibold text-gray-700">{{ $totalUmkmPenyediaAkomodasi }}</h4>
                            <div class="text-gray-500">Total Keseluruhan UMKM Penyedia Akomodasi</div>
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
                            <div class="text-gray-500">Total Keseluruhan <br> UMKM Perdagangan</div>
                        </div>
                    </div>
                </div>

                <div class="w-full mt-6 px-6 sm:w-1/2 xl:w-1/3 xl:mt-0">
                    <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
                        <div
                            class="flex items-center justify-center p-3 rounded-full bg-yellow-900 bg-opacity-75 h-16 w-16">
                            <i class="fas fa-hard-hat text-white text-3xl"></i>
                        </div>
                        <div class="mx-5">
                            <h4 class="text-2xl font-semibold text-gray-700">{{ $totalUmkmKonstruksi }}</h4>
                            <div class="text-gray-500">Total Keseluruhan <br> UMKM Konstruksi</div>
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
                            <div class="text-gray-500">Total Keseluruhan <br> UMKM Jasa Lainnya</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- grafik -->
        <div class="flex flex-col mt-8">
    <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
        <div class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
            <hr class="border-b-2 border-gray-400 my-8 mx-4">

            <div class="flex flex-row flex-wrap flex-grow mt-2">
                <div class="w-full md:w-1/2 p-3">
                    <!--Graph Card-->
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"
                        integrity="sha256-XF29CBwU1MWLaGEnsELogU6Y6rcc5nCkhhx89nFMIDQ=" crossorigin="anonymous"></script>
                    <div class="bg-white border rounded shadow h-full">
                        <div class="border-b p-3">
                            <h5 class="font-bold uppercase text-gray-600">Jenis Kelamin</h5>
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
                            <h5 class="font-bold uppercase text-gray-600">Lahir, Meninggal, Migrasi</h5>
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
                            <h5 class="font-bold uppercase text-gray-600">Jumlah UMKM Menurut Jenis Usaha</h5>
                        </div>
                        <div class="p-5">
                            <canvas id="horizontalBarChart" class="chart-canvas" width="500" height="300"></canvas>
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
            datasets: [
                {
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
            datasets: [
                {
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
                data: [{{ $totalUmkmIndustri }}, {{ $totalUmkmPerdagangan }}, {{ $totalUmkmPenyediaAkomodasi }}, {{ $totalUmkmKonstruksi }}, {{ $totalUmkmJasaLainnya }}],
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

    @endsection