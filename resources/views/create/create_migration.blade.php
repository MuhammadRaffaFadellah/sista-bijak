@extends('layouts.master')
@section('dashboard-title')
    @if (isset($migrasi))
        Sista Bijak - Edit Data Migrasi
    @else
        Sista Bijak - Tambah Data Migrasi
    @endif
@endsection
@section('body')
    <div class="container mx-auto px-4 py-6">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="card shadow-lg rounded-lg overflow-hidden">
            <div class="bg-gray-800 text-white p-4">
                <h3 class="text-lg font-bold">{{ isset($migrasi) ? 'Edit Data Migrasi' : 'Tambah Data Migrasi' }}</h3>
            </div>
            <div class="p-4">
                <form action="{{ isset($migrasi) ? route('migrasi.update', $migrasi->id) : route('migrasi.store') }}"
                    method="POST">
                    @csrf
                    @if (isset($migrasi))
                        @method('PUT')
                    @endif
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach ([['jenis_migrasi', 'Jenis Migrasi', 'select', ['masuk' => 'Masuk', 'keluar' => 'Keluar'], $migrasi->jenis_migrasi ?? null], ['nama_kepala_keluarga', 'Nama Kepala Keluarga', 'text', '', $migrasi->nama_kepala_keluarga ?? ''], ['nik', 'NIK', 'text', '', $migrasi->nik ?? '', isset($migrasi) ? 'readonly' : ''], ['rw', 'RW', 'text', '', $migrasi->rw ?? ''], ['rt', 'RT', 'text', '', $migrasi->rt ?? '']] as $input)
                            <div>
                                <label for="{{ $input[0] }}"
                                    class="block text-sm font-medium text-gray-700">{{ $input[1] }}</label>
                                @if ($input[2] === 'select')
                                    <select name="{{ $input[0] }}" id="{{ $input[0] }}" required
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500">
                                        @foreach ($input[3] as $value => $label)
                                            <option value="{{ $value }}" {{ $value == $input[4] ? 'selected' : '' }}>
                                                {{ $label }}</option>
                                        @endforeach
                                    </select>
                                @elseif ($input[0] === 'jenis_kelamin')
                                    <select name="{{ $input[0] }}" id="{{ $input[0] }}" required
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500">
                                        <option value="LAKI-LAKI" {{ $input[4] == 'LAKI-LAKI' ? 'selected' : '' }}>
                                            LAKI-LAKI</option>
                                        <option value="PEREMPUAN" {{ $input[4] == 'PEREMPUAN' ? 'selected' : '' }}>
                                            PEREMPUAN</option>
                                    </select>
                                @else
                                    <input type="{{ $input[2] }}" name="{{ $input[0] }}" id="{{ $input[0] }}"
                                        placeholder="Silakan masukkan {{ strtolower($input[1]) }}"
                                        value="{{ $input[4] }}" {{ $input[5] ?? '' }} required
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                                    @if (isset($migrasi) && $input[0] == 'nik')
                                        <span class="text-red-500 text-sm" id="nik-warning" style="display: none;">Tidak
                                            dapat mengubah NIK</span>
                                    @endif
                                @endif
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-20">
                        <h4 class="text-lg font-bold mb-4">Anggota Keluarga yang Migrasi</h4>
                        <div id="anggotaContainer">
                            @foreach ($migrasi->anggotaMigrasi ?? [$anggotaDefaults] as $index => $anggota)
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
                                    <input type="hidden" name="anggota[{{ $index }}][id]"
                                        value="{{ $anggota['id'] ?? '' }}" />
                                    @foreach ([['nama', 'Nama', 'text', $anggota['nama'] ?? ''], ['tempat_lahir', 'Tempat Lahir', 'text', $anggota['tempat_lahir'] ?? ''], ['tanggal_lahir', 'Tanggal Lahir', 'date', $anggota['tanggal_lahir'] ?? ''], ['jenis_kelamin', 'Jenis Kelamin', 'select', ['LAKI-LAKI', 'PEREMPUAN'], $anggota['jenis_kelamin'] ?? 'LAKI-LAKI'], ['hubungan_dengan_kk', 'Hubungan dengan KK', 'text', $anggota['hubungan_dengan_kk'] ?? ''], ['pendidikan', 'Pendidikan', 'text', $anggota['pendidikan'] ?? ''], ['pekerjaan', 'Pekerjaan', 'text', $anggota['pekerjaan'] ?? '']] as $input)
                                        <div>
                                            <label for="anggota[{{ $index }}][{{ $input[0] }}]"
                                                class="block text-sm font-medium text-gray-700">{{ $input[1] }}</label>
                                            @if ($input[2] === 'select')
                                                <select name="anggota[{{ $index }}][{{ $input[0] }}]"
                                                    id="anggota[{{ $index }}][{{ $input[0] }}]" required
                                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500">
                                                    @foreach ($input[3] as $value)
                                                        <option value="{{ $value }}"
                                                            {{ $value == $input[4] ? 'selected' : '' }}>
                                                            {{ $value }}</option>
                                                    @endforeach
                                                </select>
                                            @else
                                                <input type="{{ $input[2] }}"
                                                    name="anggota[{{ $index }}][{{ $input[0] }}]"
                                                    id="anggota[{{ $index }}][{{ $input[0] }}]"
                                                    placeholder="Silakan masukkan {{ strtolower($input[1]) }}"
                                                    value="{{ $input[3] }}" required
                                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="mt-20 flex justify-between items-center">
                        <a href="{{ route('resident-migration') }}"
                            class="ml-4 inline-flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-500 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">Kembali</a>
                        <div class="flex items-center">
                            <button type="button" id="hapusAnggota" style="display: none;"
                                class="mr-4 inline-flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                Hapus Anggota Keluarga
                            </button>
                            <button type="button" id="tambahAnggota"
                                class="inline-flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Tambah Anggota Keluarga
                            </button>
                        </div>
                        <button type="submit" onclick="editConfirm(event, this)"
                            class="inline-flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 ">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('sweetalert')
    <script>
        // Counter untuk menghitung berapa banyak form yang ditambahkan
        let formCounter = 0;
        let lastFormId = null; // Variabel untuk menyimpan ID form terbaru

        // Fungsi untuk menambah form anggota baru
        document.getElementById('tambahAnggota').addEventListener('click', function() {
            let anggotaContainer = document.getElementById('anggotaContainer');
            let index = formCounter; // gunakan formCounter untuk index

            let newAnggotaHtml = `
        <div class="form-anggota grid grid-cols-1 md:grid-cols-2 gap-6 mb-4" id="form-anggota-${index}">
            <input type="hidden" name="anggota[${index}][id]" />
            ${['nama', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 'hubungan_dengan_kk', 'pendidikan', 'pekerjaan'].map((field) => `
                            <div>
                                <label for="anggota[${index}][${field}]" class="block text-sm font-medium text-gray-700">${field.replace('_', ' ').toUpperCase()}</label>
                                ${field === 'jenis_kelamin' ? `
                        <select name="anggota[${index}][${field}]" id="anggota[${index}][${field}]" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500">
                            <option value="LAKI-LAKI">LAKI-LAKI</option>
                            <option value="PEREMPUAN">PEREMPUAN</option>
                        </select>
                    ` : `
                        <input type="${field === 'tanggal_lahir' ? 'date' : 'text'}" name="anggota[${index}][${field}]" id="anggota[${index}][${field}]" placeholder="Silakan masukkan ${field.replace('_', ' ')}" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                    `}
                            </div>
                        `).join('')}
        </div>
    `;

            // Tambahkan form baru ke dalam container
            anggotaContainer.insertAdjacentHTML('beforeend', newAnggotaHtml);
            // Simpan ID form terbaru
            lastFormId = `form-anggota-${index}`;
            // Tingkatkan counter form
            formCounter++;
            // Tampilkan tombol "Hapus Anggota" setelah form ditambahkan
            document.getElementById('hapusAnggota').style.display = 'inline-block';
        });

        // Fungsi untuk menghapus form anggota terbaru
        document.getElementById('hapusAnggota').addEventListener('click', function() {
            if (lastFormId) {
                // Hapus form anggota terbaru berdasarkan ID
                const formToRemove = document.getElementById(lastFormId);
                if (formToRemove) {
                    formToRemove.remove();
                }
                // Reset variabel lastFormId
                lastFormId = null;
                // Sembunyikan tombol "Hapus Anggota" jika tidak ada form baru yang tersisa
                if (document.querySelectorAll('.form-anggota').length === 0) {
                    document.getElementById('hapusAnggota').style.display = 'none';
                }
            }
        });

        // Fungsi untuk memeriksa apakah form sudah lengkap
        function isFormComplete() {
            // Pilih semua input, select, dan textarea yang tidak tersembunyi atau disabled
            const inputs = document.querySelectorAll(
                'input:not([type="hidden"]):not(:disabled), select:not(:disabled), textarea:not(:disabled)'
            );
            let isComplete = true;
            inputs.forEach(input => {
                // Periksa apakah input terlihat (visible) dan apakah kosong setelah di-trim
                if (input.offsetParent !== null && input.value.trim() === '') {
                    isComplete = false;
                }
            });
            return isComplete;
        }

        // Fungsi konfirmasi saat user ingin menyimpan perubahan
        function editConfirm(event, button) {
            event.preventDefault(); // Mencegah form dikirim langsung
            // Tampilkan SweetAlert untuk konfirmasi
            Swal.fire({
                title: 'Yakin ingin menyimpan perubahan?',
                text: "Pastikan semua data sudah benar sebelum menyimpan.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, simpan!',
                confirmButtonColor: "#3085d6",
                cancelButtonText: 'Tidak',
                cancelButtonColor: "#d33"
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika user yakin, periksa apakah data form lengkap
                    if (isFormComplete()) {
                        // Jika semua data sudah lengkap, simpan form dan tampilkan notifikasi berhasil
                        Swal.fire({
                            title: 'Berhasil!',
                            text: 'Perubahan berhasil disimpan.',
                            icon: 'success',
                            confirmButtonColor: "#3085d6"
                        }).then(() => {
                            // Kirim form setelah SweetAlert ditutup
                            button.closest('form').submit();
                        });
                    } else {
                        // Jika ada data yang belum diisi, tampilkan notifikasi error
                        Swal.fire({
                            icon: 'error',
                            title: 'Data belum lengkap!',
                            text: 'Silakan isi semua data sebelum menyimpan.',
                            confirmButtonText: "OK",
                            confirmButtonColor: "#3085d6"
                        });
                    }
                }
            });
        }
    </script>
@endsection
