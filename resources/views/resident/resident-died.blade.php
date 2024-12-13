@extends('layouts.master')
@section('dashboard-title')
    Sista Bijak - Tabel Meninggal
@endsection
@section('body')
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

    #dataConfirmationModal {
        z-index: 20; /* Ensure this is higher than the search modal */
    }

    #searchPendudukModal {
        z-index: 10;
    }
</style>
    <div class="container mx-auto px-4 py-6">
        <div class="card shadow-lg rounded-lg overflow-hidden">
            <div class="bg-gray-800 text-white p-4 flex justify-between items-center">
                <h3 class="text-lg font-bold">Tabel Meninggal</h3>
                <div class="flex items-center space-x-2">
                    @if (Auth::user()->role->id === 1)
                        <button onclick="window.location='{{ route('table-meninggal.download') }}'" title="Download data"
                            class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 flex items-center">
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
                <form method="GET" action="{{ route('resident-died') }}" class="mb-4">
                    <div class="flex items-center relative">
                        <input type="text" id="searchInput" name="search"
                            placeholder="Cari Nama Almarhum/Almarhumah atau NIK"
                            class="border border-gray-300 rounded-md p-2 w-full pr-10" value="{{ request('search') }}">
                        <button type="button" id="clearSearch" class="absolute right-2 top-2 text-gray-500 hidden"
                            style="cursor: pointer;">&times;
                        </button>
                        @if (Auth::user()->role->id === 1)
                            <select name="filter_rw" class="border border-gray-300 rounded-md p-2 ml-2" id="filterRw">
                                <option value="">Semua</option>
                                @for ($i = 1; $i <= 7; $i++)
                                    <option value="{{ $i }}" {{ request('filter_rw') == $i ? 'selected' : '' }}>
                                        RW {{ $i }}</option>
                                @endfor
                            </select>
                        @endif
                        <button type="submit"
                            class="bg-blue-500 text-white px-4 py-2 rounded ml-2 hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                        <a href="{{ route('resident-died') }}"
                            class="bg-red-500 text-white px-4 py-2 rounded ml-2 hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            <i class="fa-solid fa-xmark"></i>
                        </a>
                    </div>
                </form>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white divide-y divide-gray-200 w-full">
                        <thead class="bg-gray-100">
                            <tr>
                                @foreach (['No', 'NIK', 'Nama Almarhum/Almarhumah', 'Jenis Kelamin', 'Alamat', 'RW', 'RT', 'Hubungan dengan Kepala Keluarga', 'Tempat Lahir', 'Tanggal Lahir', 'Tempat Meninggal', 'Tanggal Meninggal', 'Status Kependudukan', 'Aksi'] as $header)
                                    <th
                                        class="px-4 py-2 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">
                                        {{ $header }}
                                    </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @if ($dataMeninggal->isEmpty())
                                <tr>
                                    <td colspan="15" class="text-center px-4 py-2 font-bold">TIDAK ADA DATA</td>
                                </tr>
                            @else
                                @foreach ($dataMeninggal as $index => $meninggal)
                                    <tr class="hover:bg-gray-100 transition duration-200">
                                        <td class="px-4 py-2 whitespace-nowrap text-center">
                                            {{ $dataMeninggal->firstItem() + $index }}.
                                        </td>
                                        <td class="px-4 py-2 whitespace-nowrap text-center">{{ $meninggal->nik }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap uppercase">{{ $meninggal->nama_lengkap }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap text-center">{{ $meninggal->jenis_kelamin }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap">
                                            <button
                                                class="bg-blue-500 text-white px-4 py-2 rounded ml-2 hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition ease-in-out duration-150"
                                                onclick="showAddressModal('{{ $meninggal->alamat }}')">
                                                Lihat
                                            </button>
                                        </td>
                                        <td class="px-4 py-2 whitespace-nowrap text-center">{{ $meninggal->rw }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap text-center">{{ $meninggal->rt }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap text-center">
                                            {{ $meninggal->status_hubkel }}
                                        </td>
                                        <td class="px-4 py-2 whitespace-nowrap text-center uppercase">{{ $meninggal->tempat_lahir }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap text-center">{{ $meninggal->tanggal_lahir }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap text-center uppercase">
                                            {{ $meninggal->tempat_meninggal }}
                                        </td>
                                        <td class="px-4 py-2 whitespace-nowrap text-center">
                                            {{ $meninggal->tanggal_meninggal }}
                                        </td>
                                        <td class="px-4 py-2 whitespace-nowrap text-center uppercase">
                                            <span class="bg-gray-600 text-white font-medium px-2 py-1 rounded-xl">
                                                {{ $meninggal->status_kependudukan }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-2 whitespace-nowrap flex space-x-2">
                                            <a href="{{ route('meninggal.edit', $meninggal->id) }}" title="Edit data"
                                                class="text-blue-500 hover:text-blue-600 px-2 py-1 border border-blue-500 rounded ml-2 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition ease-in-out duration-150">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('meninggal.destroy', $meninggal->id) }}" method="POST"
                                                class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="deleteConfirm(event, this)"
                                                    title="Hapus data"
                                                    class="text-red-500 hover:text-red-600 px-2 py-1 border border-red-500 rounded ml-2 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition ease-in-out duration-150">
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
                <div class="mt-4">{{ $dataMeninggal->links() }}</div>
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
    <div id="dataEntryModal" class="fixed inset-0 z-20 flex items-center justify-center bg-gray-800 bg-opacity-60 hidden">
        <div id="dataEntryContent" class="bg-white p-6 rounded-lg shadow-lg relative w-full max-w-xl opacity-0 scale-90 transition-transform duration-300">
            <button id="closeDataEntryModalButton" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">
                <i class="fas fa-times"></i>
            </button>
            <h2 class="text-lg font-bold mb-4">Masukan Data Penduduk</h2>
            <form id="dataForm" action="{{ route('meninggal.store') }}" method="POST">
                @csrf
                <input type="hidden" id="penduduk_id" name="penduduk_id" value="{{ old('penduduk_id') }}">
                <input type="number" id="nik" name="nik" placeholder="NIK" class="block w-full border border-gray-300 rounded-md p-2 mb-4" maxlength="16" oninput="this.value = this.value.slice(0, 16)">
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
    <script>
    // auto submit
    document.getElementById('filterRw').addEventListener('change', function() {
                document.getElementById('filterForm').submit(); // Otomatis submit form saat RW dipilih
            });
            // filter rw menjadi tetap walaupun di paginate
            document.getElementById('filterRw').addEventListener('change', function() {
                this.form.submit(); // Otomatis submit form saat RW dipilih
            });
            // X di input search
            const searchInput = document.getElementById('searchInput');
            const clearButton = document.getElementById('clearSearch');
            // Tampilkan tombol "X" jika ada teks di input
            searchInput.addEventListener('input', function() {
                console.log(this.value); // Debug untuk cek apakah event input berjalan
                if (this.value.length > 0) {
                    clearButton.classList.remove('hidden');
                } else {
                    clearButton.classList.add('hidden');
                }
            });
            // Bersihkan input ketika tombol "X" diklik
            clearButton.addEventListener('click', function() {
                searchInput.value = '';
                clearButton.classList.add('hidden');
            });

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
            const requiredFields = ['nik']; // Tambahkan ID field yang diperlukan di sini
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
                const confirmationDetails = `
                <p><strong>NIK:</strong> ${nik}</p>
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
                    text: "Silakan masukkan NIK.",
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
                    text: "Data dengan NIK tersebut tidak ditemukan.",
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
            const nik = document.getElementById('nik').value;

            // Panggil fungsi untuk memeriksa apakah data ditemukan
            const exists = await checkDataExists(nik);

            if (exists) {
                // Jika data ditemukan, arahkan ke halaman create_migration_out
                window.location.href = `/create_died?nik=${nik}`;
            } else {
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
    <div id="addressModal"
        class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50 transition-opacity">
        <div id="modalContent"
            class="bg-white rounded-lg shadow-lg w-11/12 max-w-lg max-h-[80vh] overflow-y-auto opacity-0">
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
