@extends('layouts.master')
@section('dashboard-title')
    Sista Bijak - Tabel Migrasi Masuk
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
                <h3 class="text-lg font-bold">Tabel Migrasi Masuk</h3>
                <div class="flex items-center space-x-2">
                    @if (Auth::user()->role->id === 1)
                        <!-- Tampilkan tombol download hanya untuk admin -->
                        <button onclick="window.location='{{ route('migrasi-masuk.download') }}'" title="Download data"
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
                <form method="GET" action="{{ route('resident-migration-in') }}" class="mb-4">
                    <div class="flex items-center">
                        <input type="text" name="search" placeholder="Cari Nama Lengkap atau NIK"
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
                            class="bg-blue-500 text-white px-4 py-2 rounded ml-2 hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                        <a href="{{ route('resident-migration-in') }}"
                            class="bg-red-500 text-white px-4 py-2 rounded ml-2 hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
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
                            @if ($migrasiMasuk->isEmpty())
                                <tr>
                                    <td colspan="16" class="text-center px-4 py-2 font-bold">TIDAK ADA DATA</td>
                                </tr>
                            @else
                                @foreach ($migrasiMasuk as $index => $migrasi)
                                    <tr class="hover:bg-gray-100 transition duration-200">
                                        <td class="px-4 py-2 whitespace-nowrap text-center">
                                            {{ $migrasiMasuk->firstItem() + $index }}.</td>
                                        <td class="px-4 py-2 whitespace-nowrap text-center">{{ $migrasi->nik }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap">{{ $migrasi->nama_lengkap }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap text-center">{{ $migrasi->jenis_kelamin }}
                                        </td>
                                        <td class="px-4 py-2 whitespace-nowrap text-center">{{ $migrasi->tempat_lahir }}
                                        </td>
                                        <td class="px-4 py-2 whitespace-nowrap text-center">{{ $migrasi->tanggal_lahir }}
                                        </td>
                                        <td class="px-4 py-2 whitespace-nowrap text-center">{{ $migrasi->status_hubkel }}
                                        </td>
                                        <td class="px-4 py-2 whitespace-nowrap text-center">
                                            {{ $migrasi->pendidikan_terakhir }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap text-center">{{ $migrasi->jenis_pekerjaan }}
                                        </td>
                                        <td class="px-4 py-2 whitespace-nowrap text-center">{{ $migrasi->agama }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap text-center">
                                            {{ $migrasi->status_perkawinan }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap">
                                            <button
                                                class="bg-blue-500 text-white px-4 py-2 rounded ml-2 hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition ease-in-out duration-150"
                                                onclick="showAddressModal('{{ $meninggal->alamat }}')">
                                                Lihat
                                            </button>
                                        </td>
                                        <td class="px-4 py-2 whitespace-nowrap text-center">{{ $migrasi->rw }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap text-center">{{ $migrasi->rt }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap text-center">{{ $migrasi->kelurahan }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap text-center">
                                            {{ $migrasi->status_kependudukan }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap text-center space-x-2">
                                            <a href="{{ route('migrasimasuk.edit', $migrasi->id) }}" title="Edit data"
                                                class="text-blue-500 hover:text-blue-600 px-2 py-1 border border-blue-500 rounded focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('migrasimasuk.destroy', $migrasi->id) }}" method="POST"
                                                class="inline" id="deleteForm">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="deleteConfirm(event, this)"
                                                    title="Hapus data"
                                                    class="text-red-500 hover:text-red-600 px-2 py-1 border border-red-500 rounded focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
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
                    {{ $migrasiMasuk->appends(request()->except('page'))->links() }} <!-- Pagination links -->
                </div>
            </div>
        </div>

        <!-- Modal Tambah Data -->
        <div id="dataEntryModal"
            class="fixed inset-0 z-10 flex items-center justify-center bg-gray-800 bg-opacity-60 hidden">
            <div id="dataEntryContent" class="bg-white p-6 rounded-lg shadow-lg relative w-full max-w-xl fadeIn">
                <button id="closeDataModalButton" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times"></i>
                </button>
                <h2 class="text-lg font-bold mb-4">Berapa banyak data yang ingin ditambah?</h2>
                <form id="dataForm">
                    <input type="number" id="dataAmount" min="1"
                        class="border border-gray-300 rounded-md p-2 w-full mb-4" placeholder="Masukkan jumlah data">
                    <button id="createFormButton" type="button" onclick="formValidate(event, this)"
                        class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600  focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        Buat Form
                    </button>
                </form>
            </div>
        </div>

        <!-- Tempat untuk Form -->
        <div id="formArea" class="mt-4"></div>
        <form id="multiForm" action="{{ route('migrasimasuk.store') }}" method="POST">
            @csrf
            <div id="formContainer" class="mt-6"></div>
            <div id="formActions" class="mt-6 justify-between flex hidden">
                <button id="cancelButton" type="button"
                    class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">Batal</button>
                <button id="saveAllButton" type="submit" onclick="addConfirm(event)"
                    class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Simpan
                    Semua</button>
            </div>
        </form>
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
            // Fungsi buat form
            function createForm(index) {
                return `
    <div class="card shadow-lg rounded-lg overflow-hidden mb-4">
        <div class="bg-gray-800 text-white p-4">
            <h3 class="text-lg font-bold">Data Migrasi ${index + 1}</h3>
        </div>
        <div class="p-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                ${['nik', 'nama_lengkap', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir', 'status_hubkel', 'pendidikan_terakhir', 'jenis_pekerjaan', 'agama', 'status_perkawinan', 'alamat', 'rw', 'rt', 'kelurahan', 'status_kependudukan'].map(field => `
                                <div>
                                    <label for="${field}_${index}" class="block text-sm font-medium text-gray-700">${field.replace(/_/g, ' ').toUpperCase()}</label>
                                    ${field === 'nik' ? `
                    <input type="number" name="${field}[]" id="${field}_${index}" placeholder="Silakan masukkan NIK" required maxlength="16" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" oninput="this.value = this.value.slice(0, 16)" />
                    ` : field === 'nama_lengkap' ? `
                    <input type="text" name="${field}[]" id="${field}_${index}" placeholder="Silakan masukkan Nama Lengkap" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                    ` : field === 'jenis_kelamin' ? `
                    <select name="${field}[]" id="${field}_${index}" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500">
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                    ` : field === 'agama' ? `
                    <select name="${field}[]" id="${field}_${index}" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500">
                        <option value="Islam">Islam</option>
                        <option value="Kristen">Kristen</option>
                        <option value="Hindu">Hindu</option>
                        <option value="Buddha">Buddha</option>
                        <option value="Konghucu">Konghucu</option>
                    </select>
                    ` : field === 'status_hubkel' ? `
                    <select name="${field}[]" id="${field}_${index}" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500">
                        <option value="Kepala Keluarga">Kepala Keluarga</option>
                        <option value="Istri">Istri</option>
                        <option value="Anak">Anak</option>
                        <option value="Famili Lain">Famili Lain</option>
                        <option value="Sepupu">Sepupu</option>
                        <option value="Mertua">Mertua</option>
                        <option value="Orang Tua">Orang Tua</option>
                        <option value="Cucu">Cucu</option>
                        <option value="Pembantu">Pembantu</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                    ` : field === 'status_perkawinan' ? `
                    <select name="${field}[]" id="${field}_${index}" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500">
                        <option value="Belum Menikah">Belum Menikah</option>
                        <option value="Menikah">Menikah</option>
                        <option value="Cerai Hidup">Cerai Hidup</option>
                        <option value="Cerai Mati">Cerai Mati</option>
                    </select>
                    ` : field === 'jenis_pekerjaan' ? `
                    <select name="${field}[]" id="${field}_${index}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500">
                        <option value="Tidak Bekerja">Tidak Bekerja</option>
                        <option value="PNS">PNS</option>
                        <option value="Swasta">Swasta</option>
                        <option value="Wirausaha">Wirausaha</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                    ` : field === 'pendidikan_terakhir' ? `
                    <select name="${field}[]" id="${field}_${index}" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500">
                        <option value="AKADEMI/DIPLOMA III/S.MUDA">AKADEMI/DIPLOMA III/S.MUDA</option>
                        <option value="BELUM TAMAT SD/SEDERAJAT">BELUM TAMAT SD/SEDERAJAT</option>
                        <option value="DIPLOMA I/II">DIPLOMA I/II</option>
                        <option value="DIPLOMA IV/STRATA I">DIPLOMA IV/STRATA I</option>
                        <option value="SLTA/SEDERAJAT">SLTA/SEDERAJAT</option>
                        <option value="STRATA II">STRATA II</option>
                        <option value="STRATA III">STRATA III</option>
                        <option value="TAMAT SD/SEDERAJAT">TAMAT SD/SEDERAJAT</option>
                        <option value="TIDAK TAMAT SD/SEDERAJAT">TIDAK TAMAT SD/SEDERAJAT</option>
                        <option value="TIDAK/BELUM SEKOLAH">TIDAK/BELUM SEKOLAH</option>
                    </select>
                    ` : field === 'rw' ? `
                    <select name="${field}[]" id="${field}_${index}" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500">
                        @if (Auth::user()->role->id === 1) <!-- Admin -->
                            @foreach ($rws as $rw)
                                <option value="{{ $rw->id }}">{{ $rw->rukun_warga }}</option>
                            @endforeach
                        @else <!-- RW -->
                            <option value="{{ Auth::user()->rw->id }}">{{ Auth::user()->rw->rukun_warga }}</option>
                        @endif
                    </select>
                    ` : field === 'kelurahan' ? `
                    <input type="text" name="${field}[]" id="${field}_${index}" value="Kesambi" readonly class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                    ` : field === 'status_kependudukan' ? `
                    <input type="text" name="${field}[]" id="${field}_${index}" value="Masuk" readonly class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                    ` : field === 'rt' ? `
                    <input type="number" name="${field}[]" id="${field}_${index}" placeholder="Silakan masukkan RT" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                    ` : `
                    <input type="${field === 'tanggal_lahir' ? 'date' : 'text'}" name="${field}[]" id="${field}_${index}" placeholder="Silakan masukkan ${field.replace(/_/g, ' ')}" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                    `}
                                                </div>
                                                `).join('')}
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
                        `nik_${index}`, `nama_lengkap_${index}`, `jenis_kelamin_${index}`,
                        `tempat_lahir_${index}`, `tanggal_lahir_${index}`, `status_hubkel_${index}`,
                        `pendidikan_terakhir_${index}`, `jenis_pekerjaan_${index}`, `agama_${index}`,
                        `status_perkawinan_${index}`, `alamat_${index}`, `rw_${index}`,
                        `rt_${index}`, `kelurahan_${index}`, `status_kependudukan_${index}`
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
                        title: "Berhasil!",
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
            // SweetAlert formValidate()
            function formValidate(event) {
                event.preventDefault(); // Cegah default form submission
                let dataAmount = document.getElementById('dataAmount').value;
                let formContainer = document.getElementById('formContainer');
                let formActions = document.getElementById('formActions');
                // Cek jika input jumlah data kosong atau kurang dari 1
                if (dataAmount === "" || dataAmount <= 0) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Input kosong!',
                        text: 'Masukkan jumlah input yang valid!',
                        confirmButtonText: 'OK',
                        confirmButtonColor: "#3085d6",
                    });
                    // Sembunyikan tombol jika input kosong
                    formActions.classList.add('hidden');
                    return; // Hentikan proses di sini, jangan buat form
                }
                // Jika input valid, lanjutkan membuat form
                formContainer.innerHTML = ''; // Kosongkan form yang sudah ada sebelumnya
                for (let i = 0; i < dataAmount; i++) {
                    const form = createForm(i);
                    formContainer.insertAdjacentHTML('beforeend', form);
                }
                // Tampilkan tombol "Simpan Semua" dan "Batal"
                formActions.classList.remove('hidden');
            }
            // Pasang event listener pada tombol buat form
            document.getElementById('createFormButton').addEventListener('click', formValidate);
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
