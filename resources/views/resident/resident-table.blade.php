@extends('layouts.master')
@section('dashboard-title')
    Sista Bijak - Tabel Penduduk
@endsection
@section('body')
    <div class="container mx-auto px-4 py-6">
        <div class="card shadow-lg rounded-lg overflow-hidden">
            <div class="bg-gray-800 text-white p-4 flex justify-between items-center">
                <h3 class="text-lg font-bold">Tabel Penduduk</h3>
                <div class="flex items-center space-x-2">
                    @if (Auth::user()->role->id === 1)
                        <!-- Tampilkan tombol download hanya untuk admin -->
                        <button onclick="window.location='{{ route('table-penduduk.download') }}'" title="Download data"
                            class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 flex items-center">
                            <i class="fas fa-download"></i>
                        </button>
                    @endif
                    <!-- <button id="addDataButton"
                            class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 flex items-center">
                            <i class="fas fa-plus"></i>
                        </button> -->
                </div>
            </div>
            <div class="p-4">
                <form method="GET" action="{{ route('resident-table') }}" class="mb-4" id="filterForm">
                    <div class="flex items-center">
                        <input type="text" name="search" placeholder="Cari Nama atau NIK"
                            class="border border-gray-300 rounded-md p-2 w-full" value="{{ request('search') }}">
                        @if (Auth::user()->role->id === 1)
                            <!-- Tampilkan filter RW hanya untuk admin -->
                            <select name="filter_rw" class="border border-gray-300 rounded-md p-2 ml-2" id="filterRw">
                                <option value="">Semua</option>
                                @for ($i = 1; $i <= 7; $i++)
                                    <option value="{{ $i }}" {{ request('filter_rw') == $i ? 'selected' : '' }}>
                                        RW {{ $i }}</option>
                                @endfor
                            </select>
                        @endif
                        <button type="submit"
                            class="bg-blue-500 text-white px-4 py-2 rounded ml-2 hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition ease-in-out duration-150">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                        <a href="{{ route('resident-table') }}"
                            class="bg-red-500 text-white px-4 py-2 rounded ml-2 hover:bg-red-600  focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition ease-in-out duration-150">
                            <i class="fa-solid fa-xmark"></i>
                        </a>
                    </div>
                </form>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white divide-y divide-gray-200 w-full">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">
                                    No</th>
                                <th class="px-4 py-2 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">
                                    NIK</th>
                                <th class="px-4 py-2 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">
                                    Nama Lengkap</th>
                                <th class="px-4 py-2 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">
                                    Jenis Kelamin</th>
                                <th class="px-4 py-2 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">
                                    Tempat Lahir</th>
                                <th class="px-4 py-2 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">
                                    Tanggal Lahir</th>
                                <th class="px-4 py-2 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">
                                    Status Hubkel</th>
                                <th class="px-4 py-2 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">
                                    Pendidikan Terakhir</th>
                                <th class="px-4 py-2 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">
                                    Jenis Pekerjaan</th>
                                <th class="px-4 py-2 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">
                                    Agama</th>
                                <th class="px-4 py-2 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">
                                    Status Perkawinan</th>
                                <th class="px-4 py-2 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">
                                    Alamat</th>
                                <th class="px-4 py-2 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">
                                    RW</th>
                                <th class="px-4 py-2 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">
                                    RT</th>
                                <th class="px-4 py-2 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">
                                    Kelurahan</th>
                                <th class="px-4 py-2 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">
                                    Status Kependudukan</th>
                                <th class="px-4 py-2 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @if ($penduduks->isEmpty())
                                <tr>
                                    <td colspan="16" class="text-center px-4 py-2 uppercase font-bold">Tidak ada data</td>
                                </tr>
                            @else
                                @foreach ($penduduks as $index => $penduduk)
                                    <tr class="hover:bg-gray-100 transition duration-200">
                                        <td class="px-4 py-2 whitespace-nowrap text-center">
                                            {{ $penduduks->firstItem() + $index }}.</td>
                                        <td class="px-4 py-2 whitespace-nowrap text-center">{{ $penduduk->nik }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap uppercase">{{ $penduduk->nama_lengkap }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap text-center">{{ $penduduk->jenis_kelamin }}
                                        </td>
                                        <td class="px-4 py-2 whitespace-nowrap text-center uppercase">
                                            {{ $penduduk->tempat_lahir }}
                                        </td>
                                        <td class="px-4 py-2 whitespace-nowrap text-center">{{ $penduduk->tanggal_lahir }}
                                        </td>
                                        <td class="px-4 py-2 whitespace-nowrap text-center uppercase">
                                            {{ $penduduk->status_hubkel }}
                                        </td>
                                        <td class="px-4 py-2 whitespace-nowrap text-center uppercase">
                                            {{ $penduduk->pendidikan_terakhir }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap text-center uppercase">
                                            {{ $penduduk->jenis_pekerjaan }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap text-center uppercase">
                                            {{ $penduduk->agama }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap text-center uppercase">
                                            {{ $penduduk->status_perkawinan }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap uppercase">{{ $penduduk->alamat }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap text-center">{{ $penduduk->rw }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap text-center">{{ $penduduk->rt }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap text-center uppercase">
                                            {{ $penduduk->kelurahan }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap text-center uppercase">
                                            {{ $penduduk->status_kependudukan }}
                                        </td>
                                        <td class="px-4 py-2 whitespace-nowrap flex space-x-2">
                                            <!-- Tambahkan 'inline-flex' untuk lebih fleksibel -->
                                            <a href="{{ route('penduduk.edit', $penduduk->id) }}" title="Edit data"
                                                class="inline-flex px-2 py-2 text-blue-500 hover:text-blue-600 border border-blue-500 rounded focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <!-- Tombol Hapus -->
                                            <form action="{{ route('penduduk.destroy', $penduduk->id) }}" method="POST"
                                                class="inline" id="deleteForm">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="deleteConfirm(event, this)"
                                                    title="Hapus data"
                                                    class="text-red-500 hover:text-red-600 px-2 py-1 border border-red-500 rounded focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>

                                            <!-- Tombol Meninggal -->
                                            <a href="{{ route('create_died', $penduduk->id) }}"
                                                onclick="diedConfirm(event, this)" title="Penduduk Meninggal"
                                                class="text-gray-500 hover:text-gray-600 px-2 py-1 border border-gray-500 rounded focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                                <i class="fas fa-skull"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">
                    {{ $penduduks->appends(request()->except('page'))->links() }} <!-- Pagination links -->
                </div>
            </div>
        </div>
        @include('sweetalert')
        <script>
            // auto submit
            document.getElementById('filterRw').addEventListener('change', function() {
                document.getElementById('filterForm').submit(); // Otomatis submit form saat RW dipilih
            });
            // filter rw menjadi tetap walaupun di paginate
            document.getElementById('filterRw').addEventListener('change', function() {
                this.form.submit(); // Otomatis submit form saat RW dipilih
            });

            // SweetAlert diedConfirm()
            function diedConfirm(event, element) {
                event.preventDefault(); // Mencegah redirect langsung
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data penduduk akan di hapus dan dinyatakan meninggal!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Batal',
                    cancelButtonColor: '#d33',
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Redirect ke URL yang ada di href tombol
                        window.location.href = element.getAttribute('href');
                    }
                });
            }

            // Fungsi deleteConfirm untuk konfirmasi sebelum menghapus
            function deleteConfirm(event, button) {
                event.preventDefault();
                Swal.fire({
                    title: "Kamu yakin hapus ini?",
                    text: "Kamu tidak akan bisa mengulang ini!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Hapus",
                    cancelButtonText: "Batal"
                }).then((result) => {
                    if (result.isConfirmed) {
                        event.preventDefault();
                        // Setelah penghapusan berhasil, tampilkan pesan
                        Swal.fire({
                            title: "Berhasil!",
                            text: "Data telah berhasil dihapus.",
                            icon: "success",
                            confirmButtonText: "OK",
                            confirmButtonColor: "#3085d6"
                        });
                        // Simulasi penghapusan data
                        button.closest('form').submit();
                    }
                });
            }
        </script>
    @endsection
