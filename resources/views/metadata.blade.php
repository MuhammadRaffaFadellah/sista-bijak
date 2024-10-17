@extends('layouts.master')
@section('dashboard-title')
    Sista Bijak - Metadata
@endsection
@section('body')
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <div class="flex h-screen font-roboto">
        <div class="w-1/5 bg-gray-100 p-4 shadow-lg rounded-tl-lg rounded-bl-lg"> <!-- Menambahkan rounded-lg -->
            <h2 class="text-xl font-bold mb-1">Metadata</h2>
            <hr class="pb-3">
            <div class="nav-item cursor-pointer text-sm py-2 px-3 mb-2 rounded-lg border border-gray-300 transition duration-300 ease-in-out transform hover:bg-blue-500 hover:text-white hover:scale-105"
                onclick="showArticle(0)">
                Latar Belakang Kegiatan dan Tujuan
            </div>
            <div class="nav-item cursor-pointer text-sm py-2 px-3 mb-2 rounded-lg border border-gray-300 transition duration-300 ease-in-out transform hover:bg-blue-500 hover:text-white hover:scale-105"
                onclick="showArticle(1)">
                Rencana Jadwal Kegiatan
            </div>
            <div class="nav-item cursor-pointer text-sm py-2 px-3 mb-2 rounded-lg border border-gray-300 transition duration-300 ease-in-out transform hover:bg-blue-500 hover:text-white hover:scale-105"
                onclick="showArticle(2)">
                Variabel (Karakteristik) <br> yang Dikumpulkan
            </div>
            <div class="nav-item cursor-pointer text-sm py-2 px-3 mb-2 rounded-lg border border-gray-300 transition duration-300 ease-in-out transform hover:bg-blue-500 hover:text-white hover:scale-105"
                onclick="showArticle(3)">
                Desain Kegiatan
            </div>
        </div>

        <div class="content w-4/5 p-4 bg-white shadow-lg rounded-tr-lg rounded-br-lg overflow-auto">
            <!-- Artikel 1 -->
            <div class="article hidden px-2" id="article-0">
                <p>
                    <span class="font-bold text-xl">
                        Latar Belakang Kegiatan
                    </span>
                    <br>
                    <hr class="py-2">
                    <span class="text-md">
                        Berdasarkan Undang-undang Republik Indonesia Nomor 23 Tahun 2014 tentang Pemerintah Daerah,
                        menegaskan
                        bahwa dalam perencanaan pembangunan daerah harus didasarkan pada data dan informasi yang akurat dan
                        dapat dipertanggungjawabkan, baik tentang kependudukan, masalah potensi sumberdaya daerah maupun
                        informasi tentang kewilayahan lainnya. Oleh karena itu, ketersediaan perkembangan data kependudukan
                        memegang peranan penting dalam pelaksanaan pelayanan publik, pengalokasian anggaran dan perencanaan
                        pembangunan.<br>
                        Dengan ditetapkannya alur standar operasional pengajuan administrasi kependudukan tidak lagi melalui
                        ijin dari Kelurahan setempat, Kelurahan dan satuan lingkungan setempat di bawahnya kehilangan
                        informasi
                        penting terkait perkembangan data kependudukan. Untuk itu, pengembangan sistem informasi
                        kependudukan
                        yang bisa diakses dan dimanfaatkan oleh berbagai pihak yang berkepentingan sangat diperlukan. Dalam
                        rangka menjawab kepentingan tersebut Kelurahan Kesambi berkolaborasi dengan tim pembina
                        Desa/Kelurahan
                        Cinta Statistik dari BPS Kota Cirebon membangun sebuah sistem yang diberi nama <span
                            class="font-semibold">
                            SISTA BIJAK (Sistem Statistik Kesambi Juara dalam Angka).</span>
                        <br>
                        Selain data kependudukan, dalam SISTA BIJAK juga dirancang untuk dapat mengupdate perkembangan UMKM
                        di
                        wilayah Kelurahan Kesambi, mengingat pentingnya data UMKM sebagai dasar penentu kebijakan
                        perekonomian
                        di bidang ekonomi masyarakat khususnya di wilayah Kelurahan Kesambi. <br><br>
                    </span>
                    <span class="font-bold text-xl mb-1">
                        Tujuan
                    </span>
                    <br>
                    <hr class="pb-2">
                    Adapun tujuan dibangunnya SISTA BIJAK adalah sebagai salah satu informasi yang digunakan sebagai
                    perencanaan pembangunan khususnya di wilayah Kelurahan Kesambi, dan umumnya bagi seluruh pihak baik
                    swasta maupun dunia usaha yang memerlukan data terkait.
                </p>
            </div>
            <!-- Artikel 2 -->
            <div class="article hidden px-2" id="article-1">
                <p>
                    <span class="font-bold text-xl mb-1">
                        Rencana Jadwal Kegiatan
                    </span>
                    <br>
                    <hr class="pb-4">
                </p>
                <table class="min-w-full border-collapse border border-gray-300 text-left">
                    <thead>
                        <tr>
                            <th class="border text-center border-gray-300 px-4 py-2 bg-gray-100">Kegiatan</th>
                            <th class="border text-center border-gray-300 px-4 py-2 bg-gray-100">Tanggal Mulai</th>
                            <th class="border text-center border-gray-300 px-4 py-2 bg-gray-100">Tanggal Selesai</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="border border-gray-300 px-4 py-2">Perencanaan Kegiatan</td>
                            <td class="border text-center border-gray-300 px-4 py-2">2024-09-01</td>
                            <td class="border text-center border-gray-300 px-4 py-2">2024-09-15</td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 px-4 py-2">Desain</td>
                            <td class="border text-center border-gray-300 px-4 py-2">2024-09-16</td>
                            <td class="border text-center border-gray-300 px-4 py-2">2024-10-06</td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 px-4 py-2">Uji coba Pengumpulan Data</td>
                            <td class="border text-center border-gray-300 px-4 py-2">2024-10-07</td>
                            <td class="border text-center border-gray-300 px-4 py-2">2024-10-11</td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 px-4 py-2">Pengumpulan Data</td>
                            <td class="border text-center border-gray-300 px-4 py-2">2024-12-01</td>
                            <td class="border text-center border-gray-300 px-4 py-2">2024-12-29</td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 px-4 py-2">Pengolahan Data</td>
                            <td class="border text-center border-gray-300 px-4 py-2">2025-01-01</td>
                            <td class="border text-center border-gray-300 px-4 py-2">2025-01-31</td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 px-4 py-2">Analisis</td>
                            <td class="border text-center border-gray-300 px-4 py-2">2025-02-01</td>
                            <td class="border text-center border-gray-300 px-4 py-2">2025-02-28</td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 px-4 py-2">Diseminasi Hasil</td>
                            <td class="border text-center border-gray-300 px-4 py-2">2025-03-10</td>
                            <td class="border text-center border-gray-300 px-4 py-2">2025-03-15</td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 px-4 py-2">Evaluasi</td>
                            <td class="border text-center border-gray-300 px-4 py-2">2025-03-16</td>
                            <td class="border text-center border-gray-300 px-4 py-2">2025-03-31</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Artikel 3 -->
            <div class="article hidden" id="article-2">
                <p>
                    <span class="font-bold text-xl mb-1">
                        Variabel (Karakteristik) yang Dikumpulkan
                    </span>
                    <br>
                    <hr class="pb-4">
                </p>
                <table class="table-auto w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="border border-gray-300 px-4 py-2">Nama Variabel</th>
                            <th class="border border-gray-300 px-4 py-2">Konsep</th>
                            <th class="border border-gray-300 px-4 py-2">Definisi</th>
                            <th class="border border-gray-300 px-4 py-2">Referensi Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="border border-gray-300 px-4 py-2">Jumlah Penduduk</td>
                            <td class="border border-gray-300 px-4 py-2">Penduduk</td>
                            <td class="border border-gray-300 px-4 py-2">
                                Pengertian Penduduk Berdasar UU RI Nomor 24 Tahun 2013 tentang Perubahan Atas UU Nomor 23
                                Tahun 2013 tentang Administrasi Kependudukan, penduduk adalah warga negara Indonesia dan
                                orang asing yang bertempat tinggal di Indonesia. Perhitungan berpedoman pada Lampiran
                                Permendagri No 65 Tahun 2010
                            </td>
                            <td class="border border-gray-300 px-4 py-2">Triwulanan</td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 px-4 py-2">Lahir hidup</td>
                            <td class="border border-gray-300 px-4 py-2">Lahir hidup</td>
                            <td class="border border-gray-300 px-4 py-2">
                                Kelahiran seorang bayi tanpa memperhitungkan lamanya di dalam kandungan, di mana si bayi
                                menunjukkan tanda-tanda kehidupan pada saat dilahirkan.
                            </td>
                            <td class="border border-gray-300 px-4 py-2">Triwulanan</td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 px-4 py-2">Jumlah Kelahiran</td>
                            <td class="border border-gray-300 px-4 py-2">Penduduk</td>
                            <td class="border border-gray-300 px-4 py-2">
                                Jumlah kelahiran didefinisikan sebagai banyaknya kelahiran hidup yang terjadi pada waktu
                                tertentu pada wilayah tertentu.
                            </td>
                            <td class="border border-gray-300 px-4 py-2">Triwulanan</td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 px-4 py-2">Jumlah Kematian</td>
                            <td class="border border-gray-300 px-4 py-2">Penduduk</td>
                            <td class="border border-gray-300 px-4 py-2">
                                Banyaknya kematian yang terjadi pada suatu daerah pada waktu tertentu.
                            </td>
                            <td class="border border-gray-300 px-4 py-2">Triwulanan</td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 px-4 py-2">Angka Migrasi Masuk</td>
                            <td class="border border-gray-300 px-4 py-2">Penduduk</td>
                            <td class="border border-gray-300 px-4 py-2">
                                Angka yang menunjukkan banyaknya yang masuk per 1.000 penduduk di suatu kabupaten/kota
                                tujuan dalam waktu satu tahun.
                            </td>
                            <td class="border border-gray-300 px-4 py-2">Triwulanan</td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 px-4 py-2">Angka Migrasi Keluar</td>
                            <td class="border border-gray-300 px-4 py-2">Penduduk</td>
                            <td class="border border-gray-300 px-4 py-2">
                                Angka yang menunjukkan banyaknya migran keluar dari suatu kabupaten/kota per 1.000 penduduk
                                daerah asal dalam waktu satu tahun.
                            </td>
                            <td class="border border-gray-300 px-4 py-2">Triwulanan</td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 px-4 py-2">Usaha Mikro</td>
                            <td class="border border-gray-300 px-4 py-2">Usaha</td>
                            <td class="border border-gray-300 px-4 py-2">
                                Usaha dengan kriteria memiliki kekayaan bersih paling banyak lima puluh juta rupiah tidak
                                termasuk tanah dan bangunan, atau memiliki omset penjualan paling banyak tiga ratus juta
                                rupiah.
                            </td>
                            <td class="border border-gray-300 px-4 py-2">Triwulanan</td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 px-4 py-2">Usaha Kecil</td>
                            <td class="border border-gray-300 px-4 py-2">Usaha</td>
                            <td class="border border-gray-300 px-4 py-2">
                                Usaha dengan kriteria memiliki kekayaan bersih lebih dari lima puluh juta sampai dengan
                                paling banyak lima ratus juta rupiah, tidak termasuk tanah dan bangunan, atau memiliki omset
                                penjualan lebih dari tiga ratus juta rupiah sampai dengan 2.5 miliar rupiah.
                            </td>
                            <td class="border border-gray-300 px-4 py-2">Triwulanan</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Artikel 4 -->
            <div class="article hidden" id="article-3">
                <p>
                    <span class="font-bold text-xl mb-1">
                        Desain Kegiatan
                    </span>
                    <br>
                    <hr class="pb-4">
                </p>
                <table class="table-auto w-full border-collapse border border-gray-300">
                    <tbody>
                        <tr>
                            <td class="border border-gray-300 px-4 py-2 font-semibold">Kegiatan Ini Dilakukan</td>
                            <td class="border border-gray-300 px-4 py-2">Berulang</td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 px-4 py-2 font-semibold">Frekuensi Penyelenggaraan</td>
                            <td class="border border-gray-300 px-4 py-2">Triwulanan</td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 px-4 py-2 font-semibold">Tipe Pengumpulan Data</td>
                            <td class="border border-gray-300 px-4 py-2">Longitudinal Cross Sectional</td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 px-4 py-2 font-semibold">Cakupan Wilayah Pengumpulan Data
                            </td>
                            <td class="border border-gray-300 px-4 py-2">Sebagian Wilayah Indonesia</td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 px-4 py-2 font-semibold">Wilayah Kegiatan</td>
                            <td class="border border-gray-300 px-4 py-2">
                                <ul class="list-disc pl-5">
                                    <li>Provinsi: Jawa Barat</li>
                                    <li>Kota: Kota Cirebon</li>
                                    <li>Kecamatan: Kesambi</li>
                                    <li>Kelurahan: Kesambi</li>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 px-4 py-2 font-semibold">Metode Pengumpulan Data</td>
                            <td class="border border-gray-300 px-4 py-2">Pengumpulan data sekunder</td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 px-4 py-2 font-semibold">Sarana Pengumpulan Data</td>
                            <td class="border border-gray-300 px-4 py-2">CAPI (Computer-Assisted Personal Interviewing)
                            </td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 px-4 py-2 font-semibold">Unit Pengumpulan Data</td>
                            <td class="border border-gray-300 px-4 py-2">RW di Kelurahan Kesambi</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        // Fungsi untuk menampilkan artikel berdasarkan indeks
        function showArticle(index) {
            const articles = document.querySelectorAll('.article');
            const navItems = document.querySelectorAll('.nav-item');
            // Sembunyikan semua artikel
            articles.forEach((article) => {
                article.classList.add('hidden');
            });
            // Hilangkan class .active dari semua nav item
            navItems.forEach((item) => {
                item.classList.remove('bg-blue-500', 'text-white');
            });
            // Tampilkan artikel yang sesuai dan tambahkan class .active pada nav item
            articles[index].classList.remove('hidden');
            navItems[index].classList.add('bg-blue-500', 'text-white');
        }

        // Memanggil fungsi showArticle(0) saat halaman dimuat
        window.onload = function() {
            showArticle(0);
        };
    </script>
@endsection

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
