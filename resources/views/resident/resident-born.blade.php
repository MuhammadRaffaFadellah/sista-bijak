@extends('layouts.master')
@section('dashboard-title')
    Sista Bijak - Tabel Lahir
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
    </style>
    <style>
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
                <h3 class="text-lg font-bold">Tabel Lahir</h3>
                <button id="addDataButton"
                    class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 flex items-center">
                    <i class="fas fa-plus"></i>
                </button>
            </div>
            <div class="p-4">
                <form method="GET" action="{{ route('resident-born') }}" class="mb-4">
                    <div class="flex items-center">
                        <input type="text" name="search" placeholder="Cari Nama Kepala Keluarga, Nama Anak Lahir atau NIK" class="border border-gray-300 rounded-md p-2 w-full" value="{{ request('search') }}">
                        @if (Auth::user()->role->id === 1) <!-- Tampilkan filter RW hanya untuk admin -->
                            <select name="filter_rw" class="border border-gray-300 rounded-md p-2 ml-2">
                                <option value="">Semua</option>
                                @for ($i = 1; $i <= 10; $i++)
                                    <option value="{{ $i }}" {{ request('filter_rw') == $i ? 'selected' : '' }}>RW {{ $i }}</option>
                                @endfor
                            </select>
                        @endif
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded ml-2">Cari</button>
                        <a href="{{ route('resident-born') }}" class="bg-gray-500 text-white px-4 py-2 rounded ml-2">Reset</a>
                    </div>
                </form>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white divide-y divide-gray-200 w-full">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">No</th>
                                <th class="px-4 py-2 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">Nama Kepala Keluarga</th>
                                <th class="px-4 py-2 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">NIK</th>
                                <th class="px-4 py-2 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">Alamat</th>
                                <th class="px-4 py-2 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">RW</th>
                                <th class="px-4 py-2 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">RT</th>
                                <th class="px-4 py-2 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">Nama Ayah Kandung</th>
                                <th class="px-4 py-2 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">Nama Ibu Kandung</th>
                                <th class="px-4 py-2 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">Nama Anak Lahir</th>
                                <th class="px-4 py-2 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">Tempat Lahir</th>
                                <th class="px-4 py-2 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">Tanggal Lahir</th>
                                <th class="px-4 py-2 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">Jenis Kelamin</th>
                                <th class="px-4 py-2 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">Status Kependudukan</th>
                                <th class="px-4 py-2 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @if ($dataLahir->isEmpty())
                                <tr>
                                    <td colspan="14" class="text-center px-4 py-2 font-bold">TIDAK ADA DATA</td>
                                </tr>
                            @else
                                @foreach ($dataLahir as $index => $lahir)
                                    <tr class="hover:bg-gray-100 transition duration-200">
                                        <td class="px-4 py-2 whitespace-nowrap text-center">
                                            {{ $dataLahir->firstItem() + $index }}.</td>
                                        <td class="px-4 py-2 whitespace-nowrap text-center">
                                            {{ $lahir->nama_kepala_keluarga }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap text-center">{{ $lahir->nik }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap">
                                            <button class="bg-blue-500 text-white px-4 py-2 rounded"
                                                onclick="showAddressModal('{{ $lahir->alamat }}')">
                                                Lihat Alamat
                                            </button>
                                        </td>
                                        <td class="px-4 py-2 whitespace-nowrap text-center">{{ $lahir->rw }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap text-center">{{ $lahir->rt }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap text-center">{{ $lahir->nama_ayah_kandung }}
                                        </td>
                                        <td class="px-4 py-2 whitespace-nowrap text-center">{{ $lahir->nama_ibu_kandung }}
                                        </td>
                                        <td class="px-4 py-2 whitespace-nowrap text-center">{{ $lahir->nama_anak_lahir }}
                                        </td>
                                        <td class="px-4 py-2 whitespace-nowrap text-center">{{ $lahir->tempat_lahir }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap text-center">{{ $lahir->tanggal_lahir }}
                                        </td>
                                        <td class="px-4 py-2 whitespace-nowrap text-center">{{ $lahir->jenis_kelamin }}
                                        </td>
                                        <td class="px-4 py-2 whitespace-nowrap text-center">
                                            {{ $lahir->status_kependudukan }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap flex space-x-2">
                                            <a href="{{ route('lahir.edit', $lahir->id) }}"
                                                class="text-blue-500 hover:text-blue-600 px-2 py-1 border border-blue-500 rounded">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('lahir.destroy', $lahir->id) }}" method="POST"
                                                class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="deleteConfirm(event, this)"
                                                    class="text-red-500 hover:text-red-600 px-2 py-1 border border-red-500 rounded">
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
                    {{ $dataLahir->links() }} <!-- Pagination links -->
                </div>
            </div>
        </div>

        <!-- Modal Tambah Data -->
        <div id="dataEntryModal"
            class="fixed inset-0 z-10 flex items-center justify-center bg-gray-800 bg-opacity-60 hidden">
            <div id="dataEntryContent"
                class="bg-white p-6 rounded-lg shadow-lg relative w-full max-w-xl opacity-0 scale-90">
                <button id="closeDataModalButton" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times"></i>
                </button>
                <h2 class="text-lg font-bold mb-4">Berapa banyak data yang ingin ditambah?</h2>
                <form id="dataForm">
                    <input type="number" id="dataAmount" min="1"
                        class="border border-gray-300 rounded-md p-2 w-full mb-4" placeholder="Masukkan jumlah data">
                    <button id="createFormButton" type="button"
                        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        Buat Form
                    </button>
                </form>
            </div>
        </div>

        <!-- Tempat untuk Form -->
        <div id="formArea" class="mt-4"></div>
        <form id="multiForm" action="{{ route('lahir.store') }}" method="POST">
            @csrf
            <div id="formContainer" class="mt-6"></div>
            <div id="formActions" class="mt-6 justify-between flex hidden">
                <button id="cancelButton" type="button"
                    class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Batal</button>
                <button id="saveAllButton" type="submit" onclick="addConfirm(event)"
                    class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Simpan Semua</button>
            </div>
        </form>
        @include('sweetalert')
        <script>
            function showAddressModal(address) {
                const modal = document.getElementById('addressModal');
                const modalContent = document.getElementById('modalContent');
                // Mengisi modal dengan data alamat
                document.getElementById('addressModalContent').textContent = address;
                // Menampilkan modal dengan animasi masuk
                modal.classList.remove('hidden');
                modalContent.classList.remove('opacity-0', 'modal-leave'); // Reset kelas animasi
                modalContent.classList.add('modal-enter'); // Tambahkan kelas animasi masuk
            }
            function closeAddressModal() {
                const modal = document.getElementById('addressModal');
                const modalContent = document.getElementById('modalContent');
                // Menambahkan animasi keluar
                modalContent.classList.remove('modal-enter'); // Hapus kelas animasi masuk
                modalContent.classList.add('modal-leave'); // Tambahkan kelas animasi keluar
                // Menyembunyikan modal setelah animasi keluar selesai
                setTimeout(() => {
                    modal.classList.add('hidden');
                    modalContent.classList.remove('modal-leave'); // Reset kelas animasi
                }, 200); // Durasi animasi "modalOut"
            }

            // Event Listener untuk tombol "Batal"
            document.getElementById('cancelButton').addEventListener('click', () => {
                const formContainer = document.getElementById('formContainer');
                formContainer.innerHTML = ''; // Menghapus semua form yang dibuat
                document.getElementById('formActions').classList.add('hidden'); // Menyembunyikan aksi form
            });
            // Event Listener untuk tombol "Tambah Data"
            document.getElementById('addDataButton').addEventListener('click', () => {
                const modal = document.getElementById('dataEntryModal');
                const modalContent = document.getElementById('dataEntryContent');
                modal.classList.remove('hidden');
                modalContent.classList.remove('opacity-0', 'scale-90', 'fadeOut');
                modalContent.classList.add('fadeIn');
            });
            // Event Listener untuk tombol "Tutup"
            document.getElementById('closeDataModalButton').addEventListener('click', () => {
                const modal = document.getElementById('dataEntryModal');
                const modalContent = document.getElementById('dataEntryContent');
                modalContent.classList.remove('fadeIn');
                modalContent.classList.add('fadeOut');
                setTimeout(() => {
                    modal.classList.add('hidden');
                }, 200);
            });
            // Event Listener untuk tombol "Buat Form"
            document.getElementById('createFormButton').addEventListener('click', (event) => {
                event.preventDefault();
                const dataAmount = parseInt(document.getElementById('dataAmount').value, 10);
                if (isNaN(dataAmount) || dataAmount < 1) {
                    alert('Masukkan jumlah data yang valid.');
                    return;
                }
                const formArea = document.getElementById('formContainer');
                formArea.innerHTML = '';
                for (let i = 0; i < dataAmount; i++) {
                    const form = createForm(i);
                    formArea.insertAdjacentHTML('beforeend', form);
                }
                const modal = document.getElementById('dataEntryModal');
                const modalContent = document.getElementById('dataEntryContent');
                modalContent.classList.remove('fadeIn');
                modalContent.classList.add('fadeOut');
                setTimeout(() => {
                    modal.classList.add('hidden');
                }, 200);
                document.getElementById('formActions').classList.remove('hidden');
            });
            // Fungsi untuk membuat form
            function createForm(index) {
                return `
                <div class="card shadow-lg rounded-lg overflow-hidden mb-4">
                    <div class="bg-gray-800 text-white p-4">
                        <h3 class="text-lg font-bold">Data Lahir ${index + 1}</h3>
                    </div>
                    <div class="p-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            ${['nik', 'nama_kepala_keluarga', 'alamat', 'rw', 'rt', 'nama_ayah_kandung', 'nama_ibu_kandung', 'nama_anak_lahir', 'tempat_lahir', 'tanggal_lahir'].map(field => `
                                <div>
                                    <label for="${field}_${index}" class="block text-sm font-medium text-gray-700">${field.replace(/_/g, ' ').toUpperCase()}</label>
                                    ${field === 'rw' ? `
                                    <select name="${field}[]" id="${field}_${index}" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                    </select>
                                    ` : `
                                    <input type="${field === 'tanggal_lahir' ? 'date' : 'text'}" name="${field}[]" id="${field}_${index}" placeholder="Silakan masukkan ${field.replace(/_/g, ' ')}" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                                    `}
                                </div>
                            `).join('')}
                            <div>
                                <label for="jenis_kelamin_${index}" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                                <select name="jenis_kelamin[]" id="jenis_kelamin_${index}" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500">
                                    <option value="LAKI-LAKI">LAKI-LAKI</option>
                                    <option value="PEREMPUAN">PEREMPUAN</option>
                                </select>
                            </div>
                            <div>
                                <label for="status_kependudukan_${index}" class="block text-sm font-medium text-gray-700">Status Kependudukan</label>
                                <select name="status_kependudukan[]" id="status_kependudukan_${index}" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500">
                                    <option value="lahir">LAHIR</option>
                                    <option value="menetap">MENETAP</option>
                                    <option value="keluar">KELUAR</option>
                                    <option value="masuk">MASUK</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                `;
            }
            // SweetAlert addConfirm
            function addConfirm(event) {
                event.preventDefault();
                // Get all the dynamically generated forms
                const forms = document.querySelectorAll('#formContainer > .card');
                let allFilled = true;
                forms.forEach((form, index) => {
                    const requiredFields = [
                        `nik_${index}`, `nama_kepala_keluarga_${index}`, `alamat_${index}`,
                        `rw_${index}`, `rt_${index}`, `nama_ayah_kandung_${index}`, `nama_ibu_kandung_${index}`,
                        `nama_anak_lahir_${index}`, `tempat_lahir_${index}`,
                        `tanggal_lahir_${index}`, `status_kependudukan_${index}`,
                        `jenis_kelamin_${index}`
                    ];
                    // Check if all fields in the current form are filled
                    const filled = requiredFields.every(fieldId => {
                        const field = document.getElementById(fieldId);
                        return field && field.value.trim() !== "";
                    });
                    if (!filled) {
                        allFilled = false;
                        return; // Exit the loop if any field is not filled
                    }
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
                    Swal.fire({
                        title: "Sip!",
                        text: "Data berhasil ditambahkan!",
                        icon: "success",
                        confirmButtonText: "OK",
                        confirmButtonColor: "#3085d6",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            event.target.closest('form').submit();
                        }
                    });
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
        </script>
    </div>
    <!-- Modal (hidden by default) -->
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
