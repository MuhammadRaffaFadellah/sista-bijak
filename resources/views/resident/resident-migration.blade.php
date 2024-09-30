@extends('layouts.master')
@section('dashboard-title')
    Sista Bijak - Tabel Migrasi
@endsection
@section('body')
    <style>
        .addFadeIn {
            animation: fadeIn 0.2s forwards;
        }
        .addFadeOut {
            animation: fadeOut 0.2s forwards;
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
                visibility: visible;
            }
            to {
                opacity: 1;
                visibility: visible;
            }
        }
        @keyframes fadeOut {
            from {
                opacity: 1;
                visibility: visible;
            }
            to {
                opacity: 0;
                visibility: hidden;
                /* Hilangkan visibilitas di akhir animasi */
            }
        }

        .show {
            visibility: visible;
            /* Gunakan visibility, bukan display */
            opacity: 1;
        }

        .hidden {
            visibility: hidden;
            /* Gunakan visibility alih-alih display */
            opacity: 0;
        }

        #AddDataModal {
            z-index: 1100;
        }
    </style>
    <div class="container mx-auto px-4 py-6">
        @if ($errors->any())
            <div class="bg-red-500 text-white p-4 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="card shadow-lg rounded-lg overflow-hidden">
            <div class="bg-gray-800 text-white p-4 flex justify-between items-center">
                <h3 class="text-lg font-bold">Tabel Migrasi</h3>
                <button id="addDataButton" title="Tambah Data"
                    class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 flex items-center">
                    <i class="fas fa-plus"></i> <!-- Ikon tambah -->
                </button>
            </div>
            <div class="p-4">
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white divide-y divide-gray-200 w-full">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">
                                    No</th>
                                <th class="px-4 py-2 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">
                                    Jenis Migrasi</th>
                                <th class="px-4 py-2 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">
                                    Nama Kepala Keluarga</th>
                                <th class="px-4 py-2 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">
                                    NIK</th>
                                <th class="px-4 py-2 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">
                                    RW</th>
                                <th class="px-4 py-2 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">
                                    RT</th>
                                <th class="px-4 py-2 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">
                                    Jumlah Anggota Keluarga</th>
                                <th class="px-4 py-2 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @if ($dataMigrasi->isEmpty())
                                <tr>
                                    <td colspan="8" class="text-center px-4 py-2 font-bold uppercase">Tidak ada data</td>
                                </tr>
                            @else
                                @foreach ($dataMigrasi as $index => $migrasi)
                                    <tr class="hover:bg-gray-100 transition duration-200">
                                        <td class="px-4 py-2 whitespace-nowrap text-center">
                                            {{ $dataMigrasi->firstItem() + $index }}.</td>
                                        <td class="px-4 py-2 whitespace-nowrap text-center uppercase">
                                            <span
                                                class="
                                                    @if ($migrasi->jenis_migrasi == 'masuk')
                                                        bg-green-500 
                                                    @elseif($migrasi->jenis_migrasi == 'keluar') 
                                                        bg-red-500 
                                                    @else 
                                                        bg-gray-200 
                                                    @endif
                                                    text-white font-medium px-2 py-1 rounded-xl">
                                                {{ $migrasi->jenis_migrasi }}
                                            </span>
                                        </td>
                                        </td>
                                        <td class="px-4 py-2 whitespace-nowrap text-center">
                                            {{ $migrasi->nama_kepala_keluarga }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap text-center">{{ $migrasi->nik }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap text-center">{{ $migrasi->rw }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap text-center">{{ $migrasi->rt }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap text-center">
                                            {{ $migrasi->anggotaMigrasi->count() }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap flex space-x-2">
                                            <button title="View Anggota Keluarga"
                                                class="showModalButton text-blue-500 hover:text-blue-600 px-2 py-1 border border-blue-500 rounded"
                                                data-id="{{ $migrasi->id }}"
                                                data-anggota="{{ json_encode($migrasi->anggotaMigrasi) }}">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <a href="{{ route('migrasi.edit', $migrasi->id) }}" title="Edit"
                                                class="text-blue-500 hover:text-blue-600 px-2 py-1 border border-blue-500 rounded">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('migrasi.destroy', $migrasi->id) }}" method="POST"
                                                class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="deleteConfirm(event, this)" title="Hapus"
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
                    {{ $dataMigrasi->links() }} <!-- Pagination links -->
                </div>
            </div>
        </div>

        <!-- Modal Tambah Data -->
        <div id="modalOverlay" class="fixed inset-0 bg-black bg-opacity-50 hidden"></div>
        <div id="AddDataModal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
            <div class="bg-white p-6 rounded-lg shadow-lg relative w-1/2">
                <button id="closeModalButton" onclick="closeAddDataModal()"
                    class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times"></i>
                </button>
                <h2 class="text-lg font-bold mb-4">Berapa banyak data yang ingin ditambah?</h2>
                <input type="number" id="dataCount" min="1"
                    class="border border-gray-300 rounded-md p-2 w-full mb-4" placeholder="Masukkan jumlah data">
                <button id="generateFormButton" onclick="formValidate(event, this)"
                    class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">Buat
                    Form</button>
            </div>
        </div>

        <form id="multiForm" action="{{ route('migrasi.store') }}" method="POST">
            @csrf
            <div id="formContainer" class="mt-6"></div>
            <div id="formActions" class="mt-6 flex justify-between hidden">
                <button id="cancelButton" type="button"
                    class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">Batal</button>
                <button id="saveAllButton" type="submit" onclick="addConfirm(event, this)"
                    class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Simpan Semua</button>
            </div>
        </form>
    </div>

    <!-- Modal Lihat Anggota -->
    <div id="showModal"
        class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50 transition-opacity modal-enter">
        <div class="bg-white p-6 rounded-lg shadow-lg relative w-1/2 max-h-screen overflow-y-auto addFadeIn">
            <button id="closeModalShowButton" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">
                <i class="fas fa-times"></i>
            </button>
            <h2 class="text-lg font-bold mb-4">Data Anggota Keluarga Migrasi</h2>
            <div id="modalContent" class="max-h-[70vh] overflow-y-auto">
                <!-- Data anggota keluarga migrasi akan ditampilkan di sini -->
            </div>
        </div>
    </div>

    @include('sweetalert')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Fungsi untuk menutup modal dan menghilangkan overlay
            function closeModal() {
                const modal = document.getElementById('AddDataModal');
                const overlay = document.getElementById('modalOverlay');

                // Tambahkan animasi fade out
                modal.classList.remove('addFadeIn');
                modal.classList.add('addFadeOut');

                // Setelah animasi selesai, sembunyikan modal dan overlay
                setTimeout(() => {
                    modal.classList.add('hidden');
                    overlay.classList.add('hidden'); // Sembunyikan overlay setelah animasi
                }, 200); // Sesuaikan durasi ini dengan durasi animasi di CSS (0.2s)
            }

            // Event listener untuk tombol tambah data
            document.getElementById('addDataButton').addEventListener('click', function() {
                const modal = document.getElementById('AddDataModal');
                const overlay = document.getElementById('modalOverlay');

                // Tampilkan modal dan overlay dengan animasi
                overlay.classList.remove('hidden');
                overlay.classList.add('show');
                modal.classList.remove('hidden', 'addFadeOut');
                modal.classList.add('addFadeIn');
            });

            // Event listener untuk tombol tutup modal
            document.getElementById('closeModalButton').addEventListener('click', closeModal);

            // Event listener untuk tombol buat form
            document.getElementById('generateFormButton').addEventListener('click', function() {
                const dataCount = document.getElementById('dataCount').value;
                const formContainer = document.getElementById('formContainer');
                formContainer.innerHTML = ''; // Hapus form sebelumnya

                // Buat form dinamis
                for (let i = 0; i < dataCount; i++) {
                    const form = `
                <div class="card shadow-lg rounded-lg overflow-hidden mb-4">
                    <div class="bg-gray-800 text-white p-4">
                        <h3 class="text-lg font-bold">Data Migrasi ${i + 1}</h3>
                    </div>
                    <div class="p-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="jenis_migrasi_${i}" class="block text-sm font-medium text-gray-700">Jenis Migrasi</label>
                                <select name="jenis_migrasi[]" id="jenis_migrasi_${i}" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500">
                                    <option value="masuk">Masuk</option>
                                    <option value="keluar">Keluar</option>
                                </select>
                            </div>
                            <div>
                                <label for="nama_kepala_keluarga_${i}" class="block text-sm font-medium text-gray-700">Nama Kepala Keluarga</label>
                                <input type="text" name="nama_kepala_keluarga[]" id="nama_kepala_keluarga_${i}" placeholder="Silakan masukkan nama kepala keluarga" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                            </div>
                            <div>
                                <label for="nik_${i}" class="block text-sm font-medium text-gray-700">NIK</label>
                                <input type="number" maxlength="16" name="nik[]" id="nik_${i}" placeholder="Silakan masukkan NIK" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                            </div>
                            <div>
                                <label for="rw_${i}" class="block text-sm font-medium text-gray-700">RW</label>
                                <input type="text" name="rw[]" id="rw_${i}" placeholder="Silakan masukkan RW" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                            </div>
                            <div>
                                <label for="rt_${i}" class="block text-sm font-medium text-gray-700">RT</label>
                                <input type="text" name="rt[]" id="rt_${i}" placeholder="Silakan masukkan RT" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                            </div>
                            <div>
                                <label for="jumlah_anggota_keluarga_${i}" class="block text-sm font-medium text-gray-700">Jumlah Anggota Keluarga</label>
                                <input type="number" name="jumlah_anggota_keluarga[]" id="jumlah_anggota_keluarga_${i}" placeholder="Silakan masukkan jumlah anggota keluarga" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                            </div>
                            <div id="anggotaContainer_${i}" class="col-span-2">
                                <!-- Form anggota keluarga akan di-generate di sini -->
                            </div>
                        </div>
                    </div>
                </div>
            `;
                    formContainer.insertAdjacentHTML('beforeend', form);
                }

                // Sembunyikan modal
                closeModal();
            });

            // Delegasi event listener untuk input jumlah anggota keluarga
            document.addEventListener('input', function(e) {
                if (e.target && e.target.matches('[id^="jumlah_anggota_keluarga_"]')) {
                    const i = e.target.id.split('_').pop();
                    const anggotaCount = e.target.value;
                    const anggotaContainer = document.getElementById(`anggotaContainer_${i}`);
                    anggotaContainer.innerHTML = ''; // Hapus form anggota sebelumnya

                    for (let j = 0; j < anggotaCount; j++) {
                        const anggotaForm = `
                    <div class="card shadow-lg rounded-lg overflow-hidden mb-4">
                        <div class="bg-gray-800 text-white p-4">
                            <h3 class="text-lg font-bold">Anggota Keluarga ${j + 1}</h3>
                        </div>
                        <div class="p-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="anggota_${i}_${j}_nama" class="block text-sm font-medium text-gray-700">Nama</label>
                                    <input type="text" name="anggota[${i}][${j}][nama]" id="anggota_${i}_${j}_nama" placeholder="Silakan masukkan nama" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                                </div>
                                <div>
                                    <label for="anggota_${i}_${j}_tempat_lahir" class="block text-sm font-medium text-gray-700">Tempat Lahir</label>
                                    <input type="text" name="anggota[${i}][${j}][tempat_lahir]" id="anggota_${i}_${j}_tempat_lahir" placeholder="Silakan masukkan tempat lahir" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                                </div>
                                <div>
                                    <label for="anggota_${i}_${j}_tanggal_lahir" class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                                    <input type="date" name="anggota[${i}][${j}][tanggal_lahir]" id="anggota_${i}_${j}_tanggal_lahir" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                                </div>
                                <div>
                                    <label for="anggota_${i}_${j}_jenis_kelamin" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                                    <select name="anggota[${i}][${j}][jenis_kelamin]" id="anggota_${i}_${j}_jenis_kelamin" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500">
                                        <option value="LAKI-LAKI">LAKI-LAKI</option>
                                        <option value="PEREMPUAN">PEREMPUAN</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="anggota_${i}_${j}_hubungan_dengan_kk" class="block text-sm font-medium text-gray-700">Hubungan dengan KK</label>
                                    <input type="text" name="anggota[${i}][${j}][hubungan_dengan_kk]" id="anggota_${i}_${j}_hubungan_dengan_kk" placeholder="Silakan masukkan hubungan dengan KK" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                                </div>
                                <div>
                                    <label for="anggota_${i}_${j}_pendidikan" class="block text-sm font-medium text-gray-700">Pendidikan</label>
                                    <input type="text" name="anggota[${i}][${j}][pendidikan]" id="anggota_${i}_${j}_pendidikan" placeholder="Silakan masukkan pendidikan" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                                </div>
                                <div>
                                    <label for="anggota_${i}_${j}_pekerjaan" class="block text-sm font-medium text-gray-700">Pekerjaan</label>
                                    <input type="text" name="anggota[${i}][${j}][pekerjaan]" id="anggota_${i}_${j}_pekerjaan" placeholder="Silakan masukkan pekerjaan" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                        anggotaContainer.insertAdjacentHTML('beforeend', anggotaForm);
                    }
                }
            });

            // Event listener untuk tombol Batal
            document.getElementById('cancelButton').addEventListener('click', function() {
                document.getElementById('formContainer').innerHTML = ''; // Hapus form yang di-generate
                document.getElementById('formActions').classList.add(
                    'hidden'); // Sembunyikan tombol simpan dan batal
            });
        });

        // Lihat Anggota Keluarga 
        document.addEventListener('DOMContentLoaded', function() {
            // Menggunakan ID dan kelas baru
            var showFamilyMemberButtons = document.querySelectorAll('.show-family-member');
            var familyMemberModal = document.getElementById('familyMemberModal');
            var closeFamilyModalButtons = document.querySelectorAll('.close-family-modal');
            var familyMemberTableBody = document.getElementById('familyMemberTableBody');

            showFamilyMemberButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    var migrasiId = this.getAttribute('data-id');
                    console.log('Tombol untuk melihat anggota diklik, ID: ',
                        migrasiId); // Debug log

                    fetch(`/resident-migration/${migrasiId}`)
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok ' + response
                                    .statusText);
                            }
                            return response.json();
                        })
                        .then(data => {
                            console.log(data); // Cek data yang diterima
                            familyMemberTableBody.innerHTML = '';
                            // Pastikan data.anggota_migrasi ada
                            if (data.anggota_migrasi) {
                                data.anggota_migrasi.forEach(function(anggota) {
                                    var row = `
                            <tr>
                                <td class="border border-gray-300 px-4 py-2">${anggota.nama}</td>
                                <td class="border border-gray-300 px-4 py-2">${anggota.tempat_lahir}</td>
                                <td class="border border-gray-300 px-4 py-2">${anggota.tanggal_lahir}</td>
                                <td class="border border-gray-300 px-4 py-2">${anggota.jenis_kelamin}</td>
                                <td class="border border-gray-300 px-4 py-2">${anggota.hubungan_dengan_kk}</td>
                                <td class="border border-gray-300 px-4 py-2">${anggota.pendidikan}</td>
                                <td class="border border-gray-300 px-4 py-2">${anggota.pekerjaan}</td>
                            </tr>
                        `;
                                    familyMemberTableBody.innerHTML += row;
                                });
                            } else {
                                console.error('Data anggota migrasi tidak ditemukan');
                            }
                            familyMemberModal.classList.remove('hidden'); // Tampilkan modal
                        })
                        .catch(error => console.error('Error:', error));
                });
            });

            closeFamilyModalButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    familyMemberModal.classList.add('hidden'); // Sembunyikan modal
                });
            });

            window.addEventListener('click', function(event) {
                if (event.target === familyMemberModal) {
                    familyMemberModal.classList.add('hidden'); // Sembunyikan modal jika area luar diklik
                }
            });
        });

        // SweetAlert addConfirm
        function addConfirm(event, button) {
            event.preventDefault(); // Mencegah pengiriman form secara default
            // Mengambil semua input dalam form
            const inputs = document.querySelectorAll('input, select, textarea');
            let isEmpty = false;
            // Memeriksa apakah ada input yang kosong
            inputs.forEach(input => {
                if (input.value.trim() === '') {
                    isEmpty = true;
                }
            });
            // Jika ada input yang kosong, tampilkan SweetAlert error
            if (isEmpty) {
                Swal.fire({
                    icon: 'error',
                    title: 'Data masih kosong!',
                    text: 'Silakan lengkapi semua input sebelum menyimpan.',
                    confirmButtonText: "OK",
                    confirmButtonColor: "#3085d6"
                });
            } else {
                // Jika semua input terisi, tampilkan konfirmasi
                Swal.fire({
                    title: 'Konfirmasi',
                    text: 'Apakah Anda yakin semua data sudah benar?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, simpan!',
                    confirmButtonColor: "#3085d6",
                    cancelButtonText: 'Tidak, batalkan',
                    cancelButtonColor: "#d33",
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Jika pengguna mengonfirmasi, kirim form
                        button.closest('form').submit(); // Mengirim form
                    }
                });
            }
        }

        // SweetAlert deleteConfirm()
        function deleteConfirm(event, button) {
            event.preventDefault(); // Mencegah pengiriman form atau penghapusan langsung
            // SweetAlert pertama untuk konfirmasi
            Swal.fire({
                title: 'Apakah kamu yakin?',
                text: "Data ini akan dihapus dan tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus!',
                confirmButtonColor: "#3085d6",
                cancelButtonText: 'Tidak',
                cancelButtonColor: "#d33",
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika pengguna mengonfirmasi, tampilkan SweetAlert kedua
                    Swal.fire({
                        title: 'Terhapus!',
                        text: 'Data berhasil terhapus.',
                        icon: 'success',
                        timer: 2000, // SweetAlert kedua akan otomatis tertutup setelah 2 detik
                        showConfirmButton: false
                    });
                    // Anda bisa menambahkan logika penghapusan data di sini.
                    // Jika penghapusan dilakukan melalui form, submit form.
                    button.closest('form').submit(); // Mengirim form untuk penghapusan
                }
            });
        }
        // SweetAlert formValidate()
        function formValidate(event, button) {
            event.preventDefault();
            const dataCountInput = document.getElementById('dataCount');
            const dataCount = parseInt(dataCountInput.value); // Ambil nilai dari input
            // Sembunyikan tombol simpan dan batal terlebih dahulu
            document.getElementById('formActions').classList.add('hidden');
            // Validasi input untuk jumlah data
            if (isNaN(dataCount) || dataCount <= 0) {
                // Jika input kosong atau tidak valid, tampilkan SweetAlert
                Swal.fire({
                    icon: 'error',
                    title: 'Input tidak valid!',
                    text: 'Silakan masukkan jumlah data yang valid.',
                    confirmButtonColor: "#3085d6"
                });
                return; // Hentikan eksekusi lebih lanjut
            }
            // Jika input valid, buat form baru
            const formContainer = document.getElementById('formContainer');
            formContainer.innerHTML = ''; // Hapus form sebelumnya
            for (let i = 0; i < dataCount; i++) {
                const form = `
        <div class="card shadow-lg rounded-lg overflow-hidden mb-4">
            <div class="bg-gray-800 text-white p-4">
                <h3 class="text-lg font-bold">Data Migrasi ${i + 1}</h3>
            </div>
            <div class="p-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="jenis_migrasi_${i}" class="block text-sm font-medium text-gray-700">Jenis Migrasi</label>
                        <select name="jenis_migrasi[]" id="jenis_migrasi_${i}" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500">
                            <option value="masuk">Masuk</option>
                            <option value="keluar">Keluar</option>
                        </select>
                    </div>
                    <div>
                        <label for="nama_kepala_keluarga_${i}" class="block text-sm font-medium text-gray-700">Nama Kepala Keluarga</label>
                        <input type="text" name="nama_kepala_keluarga[]" id="nama_kepala_keluarga_${i}" placeholder="Silakan masukkan nama kepala keluarga" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                    </div>
                    <!-- Tambahkan input lainnya di sini -->
                </div>
            </div>
        </div>
        `;
                formContainer.insertAdjacentHTML('beforeend', form);
            }
            // Tampilkan tombol simpan dan batal hanya setelah form di-generate
            document.getElementById('formActions').classList.remove('hidden');
        }
        // Menampilkan modal untuk melihat anggota migrasi
        document.querySelectorAll('.showModalButton').forEach(button => {
            button.addEventListener('click', function() {
                const anggotaMigrasi = JSON.parse(this.getAttribute('data-anggota'));
                const modalContent = document.getElementById('modalContent');
                const modal = document.getElementById('showModal');
                const overlay = document.getElementById('modalOverlay');

                // Kosongkan konten modal sebelumnya
                modalContent.innerHTML = '';

                // Menampilkan data anggota migrasi
                if (anggotaMigrasi.length > 0) {
                    anggotaMigrasi.forEach((anggota, index) => {
                        modalContent.innerHTML += `
                        <div class="mb-4">
                            <h3 class="font-bold">Anggota ${index + 1}</h3>
                            <p>Nama: ${anggota.nama}</p>
                            <p>Tempat Lahir: ${anggota.tempat_lahir}</p>
                            <p>Tanggal Lahir: ${anggota.tanggal_lahir}</p>
                            <p>Jenis Kelamin: ${anggota.jenis_kelamin}</p>
                            <p>Hubungan dengan KK: ${anggota.hubungan_dengan_kk}</p>
                            <p>Pendidikan: ${anggota.pendidikan}</p>
                            <p>Pekerjaan: ${anggota.pekerjaan}</p>
                        </div>
                    `;
                    });
                } else {
                    modalContent.innerHTML = '<p>Tidak ada anggota keluarga.</p>';
                }

                // Tampilkan modal dengan animasi fadeIn
                modal.classList.remove('hidden');
                modal.classList.remove('modal-leave');
                modal.classList.add('fadeIn');
                overlay.classList.remove('hidden'); // Tampilkan overlay
            });
        });

        // Menutup modal lihat anggota
        document.getElementById('closeModalShowButton').addEventListener('click', function() {
            console.log("Tombol tutup modal diklik"); // Debugging
            const modal = document.getElementById('showModal');
            const overlay = document.getElementById('modalOverlay');

            // Tambahkan animasi fadeOut
            modal.classList.remove('fadeIn');
            modal.classList.add('fadeOut');

            // Sembunyikan modal dan overlay setelah animasi selesai
            setTimeout(() => {
                modal.classList.add('hidden');
                overlay.classList.add('hidden'); // Sembunyikan overlay gelap
            }, 200); // Durasi harus sama dengan durasi fadeOut di CSS
        });
        // Fungsi menutup modal tambah data
        function closeAddDataModal() {
            const modal = document.getElementById('AddDataModal');
            modal.classList.add('modal-leave');
            setTimeout(() => {
                modal.classList.add('hidden');
                modal.classList.remove('modal-leave');
            }, 200);
        }
        // Fungsi untuk menampilkan modal tambah data
        function openAddDataModal() {
            const modal = document.getElementById('AddDataModal');
            const overlay = document.getElementById('modalOverlay');

            // Tampilkan overlay dan modal dengan animasi addFadeIn
            overlay.classList.remove('hidden');
            overlay.classList.add('show'); // Tampilkan overlay
            modal.classList.remove('hidden');
            modal.classList.remove('addFadeOut'); // Hapus kelas addFadeOut jika ada
            modal.classList.add('addFadeIn'); // Tambahkan animasi addFadeIn
        }
    </script>
@endsection
