@extends('layouts.master')
@section('dashboard-title')
Sista Bijak - Tabel Migrasi Keluar
@endsection
@section('body')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
    @keyframes modalIn {
        from {
            opacity: 0;
            transform: scale(0.9);
        }

        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    @keyframes modalOut {
        from {
            opacity: 1;
            transform: scale(1);
        }

        to {
            opacity: 0;
            transform: scale(0.9);
        }
    }

    .modal-enter {
        animation: modalIn 0.3s ease-out forwards;
    }

    .modal-leave {
        animation: modalOut 0.2s ease-in forwards;
    }

    @keyframes fadeInModal {
        from {
            opacity: 0;
            transform: scale(0.9);
        }

        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    @keyframes fadeOutModal {
        from {
            opacity: 1;
            transform: scale(1);
        }

        to {
            opacity: 0;
            transform: scale(0.9);
        }
    }

    .fadeIn {
        animation: fadeInModal 0.3s ease-out forwards;
    }

    .fadeOut {
        animation: fadeOutModal 0.2s ease-in forwards;
    }
</style>
<div class="container mx-auto px-4 py-6">
    <div class="card shadow-lg rounded-lg overflow-hidden">
        <div class="bg-gray-800 text-white p-4 flex justify-between items-center">
            <h3 class="text-lg font-bold">Tabel Migrasi Keluar</h3>
            <div class="flex items-center space-x-2">
                @if (Auth::user()->role->id === 1) <!-- Tampilkan tombol download hanya untuk admin -->
                <button onclick="window.location='{{ route('migrasi-keluar.download') }}'" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 flex items-center">
                    <i class="fas fa-download"></i>
                </button>
                @endif
                <button id="addDataButton"
                    class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 flex items-center">
                    <i class="fas fa-plus"></i>
                </button>
            </div>
        </div>
        <div class="p-4">
            @if(session('error'))
            <script>
                Swal.fire({
                    title: "Error!",
                    text: "{{ session('error') }}",
                    icon: "error",
                    confirmButtonText: "OK",
                    confirmButtonColor: "#3085d6",
                });
            </script>
            @endif
            <form method="GET" action="{{ route('resident-migration-out') }}" class="mb-4">
                <div class="flex items-center">
                    <input type="text" name="search"
                        placeholder="Cari Nama Lengkap Atau NIK"
                        class="border border-gray-300 rounded-md p-2 w-full" value="{{ request('search') }}">
                    @if (Auth::user()->role->id === 1)
                    <!-- Tampilkan filter RW hanya untuk admin -->
                    <select name="filter_rw" class="border border-gray-300 rounded-md p-2 ml-2">
                        <option value="">Semua</option>
                        @for ($i = 1; $i <= 7; $i++)
                            <option value="{{ $i }}" {{ request('filter_rw') == $i ? 'selected' : '' }}>RW {{ $i }}</option>
                            @endfor
                    </select>
                    @endif
                    <button type="submit"
                        class="bg-blue-500 text-white px-4 py-2 rounded ml-2 hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                    <a href="{{ route('resident-migration-out') }}"
                        class="bg-red-500 text-white px-4 py-2 rounded ml-2 hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        <i class="fa-solid fa-xmark"></i>
                    </a>
                </div>
            </form>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white divide-y divide-gray-200 w-full">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">No</th>
                            <th class="px-4 py-2 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">NIK</th>
                            <th class="px-4 py-2 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">Nama Lengkap</th>
                            <th class="px-4 py-2 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">Jenis Kelamin</th>
                            <th class="px-4 py-2 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">Tempat Lahir</th>
                            <th class="px-4 py-2 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">Tanggal Lahir</th>
                            <th class="px-4 py-2 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">Status Hubkel</th>
                            <th class="px-4 py-2 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">Pendidikan Terakhir</th>
                            <th class="px-4 py-2 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">Jenis Pekerjaan</th>
                            <th class="px-4 py-2 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">Agama</th>
                            <th class="px-4 py-2 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">Status Perkawinan</th>
                            <th class="px-4 py-2 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">Alamat</th>
                            <th class="px-4 py-2 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">RW</th>
                            <th class="px-4 py-2 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">RT</th>
                            <th class="px-4 py-2 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">Kelurahan</th>
                            <th class="px-4 py-2 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">Status Kependudukan</th>
                            <th class="px-4 py-2 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @if ($migrasiKeluar->isEmpty())
                        <tr>
                            <td colspan="16" class="text-center px-4 py-2 font-bold">TIDAK ADA DATA</td>
                        </tr>
                        @else
                        @foreach ($migrasiKeluar as $index => $migrasi)
                        <tr class="hover:bg-gray-100 transition duration-200">
                            <td class="px-4 py-2 whitespace-nowrap text-center uppercase">{{ $migrasiKeluar->firstItem() + $index }}.</td>
                            <td class="px-4 py-2 whitespace-nowrap text-center uppercase">{{ $migrasi->nik }}</td>
                            <td class="px-4 py-2 whitespace-nowrap uppercase">{{ $migrasi->nama_lengkap }}</td>
                            <td class="px-4 py-2 whitespace-nowrap text-center uppercase">{{ $migrasi->jenis_kelamin }}</td>
                            <td class="px-4 py-2 whitespace-nowrap text-center uppercase">{{ $migrasi->tempat_lahir }}</td>
                            <td class="px-4 py-2 whitespace-nowrap text-center uppercase">{{ $migrasi->tanggal_lahir }}</td>
                            <td class="px-4 py-2 whitespace-nowrap text-center uppercase">{{ $migrasi->status_hubkel }}</td>
                            <td class="px-4 py-2 whitespace-nowrap text-center uppercase">{{ $migrasi->pendidikan_terakhir }}</td>
                            <td class="px-4 py-2 whitespace-nowrap text-center uppercase">{{ $migrasi->jenis_pekerjaan }}</td>
                            <td class="px-4 py-2 whitespace-nowrap text-center uppercase">{{ $migrasi->agama }}</td>
                            <td class="px-4 py-2 whitespace-nowrap text-center uppercase">{{ $migrasi->status_perkawinan }}</td>
                            <td class="px-4 py-2 whitespace-nowrap uppercase">
                                <button
                                    class="bg-blue-500 text-white px-4 py-2 rounded ml-2 hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition ease-in-out duration-150"
                                    onclick="showAddressModal('{{ $migrasi->alamat }}')">
                                    Lihat
                                </button>
                            </td>
                            <td class="px-4 py-2 whitespace-nowrap text-center uppercase">{{ $migrasi->rw }}</td>
                            <td class="px-4 py-2 whitespace-nowrap text-center uppercase">{{ $migrasi->rt }}</td>
                            <td class="px-4 py-2 whitespace-nowrap text-center uppercase">{{ $migrasi->kelurahan }}</td>
                            <td class="px-4 py-2 whitespace-nowrap text-center uppercase">{{ $migrasi->status_kependudukan }}</td>
                            <td class="px-4 py-2 whitespace-nowrap text-center space-x-2">
                                <a href="{{ route('migrasikeluar.edit', $migrasi->id) }}" title="Edit data" class="text-blue-500 hover:text-blue-600 px-2 py-1 border border-blue-500 rounded focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('migrasikeluar.destroy', $migrasi->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="deleteConfirm(event, this)" title="Hapus data" class="text-red-500 hover:text-red-600 px-2 py-1 border border-red-500 rounded focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $migrasiKeluar->links() }} <!-- Pagination links -->
            </div>
        </div>
    </div>

    <!-- Modal Pencarian Penduduk -->
    <div id="searchPendudukModal" class="fixed inset-0 z-10 flex items-center justify-center bg-gray-800 bg-opacity-60 hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg relative w-full max-w-xl">
            <button id="closeSearchModalButton" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">
                <i class="fas fa-times"></i>
            </button>
            <h2 class="text-lg font-bold mb-4">Cari Penduduk</h2>
            <input type="text" id="searchInput" placeholder="Cari berdasarkan NIK atau Nama" class="block w-full border border-gray-300 rounded-md p-2 mb-4">
            <button id="searchButton" onclick="searchValidate(event, this)" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Cari</button>
            <div id="searchResults" class="mt-4">
                <!-- Hasil pencarian akan ditampilkan di sini -->
            </div>
        </div>
    </div>

    <!-- Modal Tambah Data -->
    <div id="dataEntryModal" class="fixed inset-0 z-10 flex items-center justify-center bg-gray-800 bg-opacity-60 hidden">
        <div id="dataEntryContent" class="bg-white p-6 rounded-lg shadow-lg relative w-full max-w-xl opacity-0 scale-90 transition-transform duration-300">
            <button id="closeDataEntryModalButton" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">
                <i class="fas fa-times"></i>
            </button>
            <h2 class="text-lg font-bold mb-4">Masukan Data Penduduk</h2>
            <form id="dataForm" action="{{ route('migrasi-keluar.store') }}" method="POST">
                @csrf
                <input type="hidden" id="penduduk_id" name="penduduk_id" value="{{ old('penduduk_id') }}">
                <input type="number" id="nik" name="nik" placeholder="NIK" class="block w-full border border-gray-300 rounded-md p-2 mb-4" maxlength="16" oninput="this.value = this.value.slice(0, 16)">
                <input type="text" id="nama_lengkap" name="nama_lengkap" placeholder="Nama Lengkap" class="block w-full border border-gray-300 rounded-md p-2 mb-4">
                <button type="button" onclick="validateFormFields()" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Konfirmasi</button>
            </form>
        </div>
    </div>

    <!-- Modal untuk Konfirmasi Data -->
    <div id="dataConfirmationModal" class="fixed inset-0 z-10 flex items-center justify-center bg-gray-800 bg-opacity-60 hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg relative w-full max-w-xl">
            <button id="closeConfirmationModalButton" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">
                <i class="fas fa-times"></i>
            </button>
            <h2 class="text-lg font-bold mb-4">Konfirmasi Data</h2>
            <div id="confirmationDetails" class="mb-4">
                <!-- Detail data akan dimasukkan di sini -->
            </div>
            <button id="confirmDataButton" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Konfirmasi</button>
        </div>
    </div>

    @include('sweetalert')
    <!-- Script untuk membuka dan menutup modal pencarian dan tambah data -->
    <script>
        // Deklarasi variabel allFilled
        let allFilled = true;

        // Event listener untuk membuka modal tambah data
        document.getElementById('addDataButton').addEventListener('click', function(event) {
            event.preventDefault();
            const modal = document.getElementById('dataEntryModal');
            const modalContent = document.getElementById('dataEntryContent');
            modal.classList.remove('hidden');
            setTimeout(() => {
                modalContent.classList.remove('opacity-0', 'scale-90');
            }, 10);
        });

        // Event listener untuk menutup modal tambah data
        document.getElementById('closeDataEntryModalButton').addEventListener('click', () => {
            const modal = document.getElementById('dataEntryModal');
            const modalContent = document.getElementById('dataEntryContent');
            modalContent.classList.add('opacity-0', 'scale-90');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
        });

        // Fungsi untuk memvalidasi form
        function validateFormFields() {
            const requiredFields = ['nik', 'nama_lengkap']; // Tambahkan ID field yang diperlukan di sini
            allFilled = requiredFields.every(fieldId => {
                const field = document.getElementById(fieldId);
                return field && field.value.trim() !== "";
            });

            if (!allFilled) {
                Swal.fire({
                    title: "Error!",
                    text: "Semua data harus diisi!",
                    icon: "error",
                    confirmButtonText: "OK",
                    confirmButtonColor: "#3085d6",
                });
            } else {
                // Tampilkan modal konfirmasi dengan data
                const nik = document.getElementById('nik').value;
                const namaLengkap = document.getElementById('nama_lengkap').value;
                const confirmationDetails = `
                <p><strong>NIK:</strong> ${nik}</p>
                <p><strong>Nama Lengkap:</strong> ${namaLengkap}</p>
            `;
                document.getElementById('confirmationDetails').innerHTML = confirmationDetails;
                document.getElementById('dataConfirmationModal').classList.remove('hidden');
            }
        }

        // Fungsi pencarian
        async function searchValidate(event) {
            event.preventDefault(); // Mencegah form dari submit secara default
            const searchInput = document.getElementById('searchInput').value;
            // Validasi input
            if (!searchInput) {
                Swal.fire({
                    title: "Input Kosong!",
                    text: "Silakan masukkan NIK atau Nama.",
                    icon: "warning",
                    confirmButtonText: "OK",
                    confirmButtonColor: "#d33",
                });
                return; // Keluar dari fungsi
            }
            // Panggil fungsi untuk memeriksa apakah data ditemukan
            const exists = await checkDataExists(searchInput); // Menggunakan nik atau nama
            if (exists) {
                Swal.fire({
                    title: "Data Ditemukan!",
                    text: "Data penduduk berhasil ditemukan.",
                    icon: "success",
                    confirmButtonText: "OK",
                    confirmButtonColor: "#3085d6",
                });
            } else {
                Swal.fire({
                    title: "Data Tidak Ditemukan!",
                    text: "Data dengan NIK atau Nama tersebut tidak ditemukan.",
                    icon: "error",
                    confirmButtonText: "OK",
                    confirmButtonColor: "#d33",
                });
            }
        }

        // Fungsi untuk memeriksa apakah data ditemukan
        async function checkDataExists(searchInput) {
            try {
                const response = await fetch(`/search-penduduk?query=${searchInput}`);
                const data = await response.json();
                console.log(data); // Menampilkan data respons di konsol untuk debugging
                return data.exists; // Mengembalikan true jika data ada, false jika tidak
            } catch (error) {
                console.error('Error:', error);
                return false; // Jika terjadi error, anggap data tidak ditemukan
            }
        }

        // SweetAlert deleteConfirm
        function deleteConfirm(event, button) {
            event.preventDefault();
            Swal.fire({
                title: "Kamu yakin hapus ini?",
                text: "Kamu tidak akan bisa mengulang ini!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, hapus",
                cancelButtonText: "Tidak"
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

        // Event listener untuk menutup modal konfirmasi
        document.getElementById('closeConfirmationModalButton').addEventListener('click', () => {
            document.getElementById('dataConfirmationModal').classList.add('hidden');
        });

        // Event listener untuk mengonfirmasi data
        document.getElementById('confirmDataButton').addEventListener('click', async () => {
            const nik = document.getElementById('nik').value; // Asumsi Anda memiliki input NIK dengan ID 'nik'

            // Panggil fungsi untuk memeriksa apakah data ditemukan
            const exists = await checkDataExists(nik);

            // Jika data ditemukan
            if (exists) {
                // Jika data ditemukan, tampilkan SweetAlert
                Swal.fire({
                    title: "Data Ditemukan!",
                    text: `Data penduduk ditemukan dengan NIK: ${nik}`, // Ganti dengan informasi yang sesuai
                    icon: "success",
                    confirmButtonText: "OK",
                    confirmButtonColor: "#3085d6",
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Kirim form jika diperlukan
                        document.getElementById('dataForm').submit();
                    }
                });
            } else {
                // Jika data tidak ditemukan
                Swal.fire({
                    title: "Data Tidak Ditemukan!",
                    text: "Data dengan NIK atau Nama tersebut tidak ditemukan.",
                    icon: "error",
                    confirmButtonText: "OK",
                    confirmButtonColor: "#d33",
                });
            }
        });

        // SweetAlert formValidate
        function formValidate(event) {
            event.preventDefault();
            let dataAmount = document.getElementById('dataAmount').value;
            let formContainer = document.getElementById('formContainer');
            let formActions = document.getElementById('formActions');

            if (dataAmount === "" || dataAmount <= 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Input kosong!',
                    text: 'Masukkan jumlah input yang valid!',
                    confirmButtonText: 'OK',
                    confirmButtonColor: "#3085d6",
                });
                formActions.classList.add('hidden');
                return;
            }

            formContainer.innerHTML = '';
            for (let i = 0; i < dataAmount; i++) {
                const form = createForm(i);
                formContainer.insertAdjacentHTML('beforeend', form);
            }
            formActions.classList.remove('hidden');
        }

        document.getElementById('createFormButton').addEventListener('click', formValidate);
        // Modal Alamat
        function showAddressModal(address) {
            const modal = document.getElementById('addressModal');
            const modalContent = document.getElementById('modalContent');
            // Mengisi modal dengan data alamat
            document.getElementById('addressModalContent').textContent = address;
            // Menampilkan modal dengan animasi masuk
            modal.classList.remove('hidden');
            modalContent.classList.remove('opacity-0', 'modal-leave');
            modalContent.classList.add('modal-enter');
        }

        function closeAddressModal() {
            const modal = document.getElementById('addressModal');
            const modalContent = document.getElementById('modalContent');
            // Menambahkan animasi keluar
            modalContent.classList.remove('modal-enter');
            modalContent.classList.add('modal-leave');
            // Menyembunyikan modal setelah animasi keluar selesai
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 200); // durasi animasi "modalOut"
        }
    </script>
</div>
<!-- Modal Show -->
<div id="addressModal"
    class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50 transition-opacity">
    <div id="modalContent"
        class="bg-white rounded-lg shadow-lg w-11/12 max-w-lg max-h-[80vh] overflow-y-auto modal-enter">
        <div class="flex justify-between items-center p-4 border-b">
            <h5 class="text-lg font-bold">Alamat</h5>
            <button onclick="closeAddressModal()" class="text-gray-400 hover:text-gray-600">&times;</button>
        </div>
        <div class="p-4">
            <p id="addressModalContent" class="break-words"></p>
        </div>
        <div class="flex justify-end p-4 border-t">
            <button onclick="closeAddressModal()"
                class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Tutup</button>
        </div>
    </div>
</div>
@endsection