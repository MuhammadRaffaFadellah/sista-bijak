@extends('layouts.master')
@section('dashboard-title')
    Sista Bijak - @if (isset($meninggal))
        Edit Data Meninggal
    @else
        Tambah Data Meninggal
    @endif
@endsection
@section('body')
    <div class="container mx-auto px-4 py-6">
        <div class="card shadow-lg rounded-lg overflow-hidden">
            <div class="bg-gray-800 text-white p-4">
                <h3 class="text-lg font-bold">
                    @if (isset($meninggal))
                        Edit Data Meninggal
                    @else
                        Tambah Data Meninggal
                    @endif
                </h3>
            </div>
            <div class="p-4">
                <form action="{{ isset($meninggal) ? route('meninggal.update', $meninggal->id) : route('meninggal.store') }}"
                    method="POST">
                    @csrf
                    @if (isset($meninggal))
                        @method('PUT')
                    @endif
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <input type="hidden" name="penduduk_id" value="{{ $penduduk->id ?? $meninggal->penduduk_id }}">
                        <!-- NIK Penduduk -->
                        <div>
                            <label for="nik" class="block text-sm font-medium text-gray-700">NIK Penduduk</label>
                            <input type="text" name="nik" id="nik"
                                value="{{ $penduduk->nik ?? $meninggal->nik }}" readonly
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                        </div>
                        <!-- Nama Almarhum/Almarhumah -->
                        <div>
                            <label for="nama_almarhum" class="block text-sm font-medium text-gray-700">Nama
                                Almarhum/Almarhumah</label>
                            <input type="text" name="nama_almarhum" id="nama_almarhum"
                                placeholder="Masukkan nama almarhum"
                                value="{{ $penduduk->nama_lengkap ?? $meninggal->nama_almarhum }}"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                        </div>
                        <!-- Hubungan Dengan KK -->
                        <div>
                            <label for="hubungan_dengan_kk" class="block text-sm font-medium text-gray-700">Hubungan Dengan
                                KK</label>
                            <input type="text" name="hubungan_dengan_kk" id="hubungan_dengan_kk"
                                placeholder="Masukkan hubungan dengan KK"
                                value="{{ $penduduk->status_hubkel ?? $meninggal->hubungan_dengan_kk }}"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                        </div>
                        <!-- Tempat Lahir -->
                        <div>
                            <label for="tempat_lahir" class="block text-sm font-medium text-gray-700">Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" id="tempat_lahir" placeholder="Masukkan tempat lahir"
                                value="{{ $penduduk->tempat_lahir ?? $meninggal->tempat_lahir }}"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                        </div>
                        <!-- Tanggal Lahir -->
                        <div>
                            <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" id="tanggal_lahir"
                                value="{{ $penduduk->tanggal_lahir ?? $meninggal->tanggal_lahir }}"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                        </div>
                        <!-- Tempat Meninggal -->
                        <div>
                            <label for="tempat_meninggal" class="block text-sm font-medium text-gray-700">Tempat
                                Meninggal</label>
                            <input type="text" name="tempat_meninggal" id="tempat_meninggal"
                                placeholder="Masukkan tempat meninggal" value="{{ $meninggal->tempat_meninggal ?? '' }}"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                        </div>
                        <!-- Tanggal Meninggal -->
                        <div>
                            <label for="tanggal_meninggal" class="block text-sm font-medium text-gray-700">Tanggal
                                Meninggal</label>
                            <input type="date" name="tanggal_meninggal" id="tanggal_meninggal"
                                value="{{ $meninggal->tanggal_meninggal ?? '' }}"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                        </div>
                        <!-- Alamat -->
                        <div>
                            <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                            <input type="text" name="alamat" id="alamat" placeholder="Masukkan alamat"
                                value="{{ $penduduk->alamat ?? $meninggal->alamat }}"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                        </div>
                        <!-- RW -->
                        <div>
                            <label for="rw" class="block text-sm font-medium text-gray-700">RW</label>
                            <select name="rw" id="rw"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500">
                                <option value="">Pilih RW</option>
                                @foreach ($rws as $rw)
                                    <option value="{{ $rw->id }}"
                                        {{ ($penduduk->rw ?? $meninggal->rw) == $rw->id ? 'selected' : '' }}>
                                        {{ $rw->rukun_warga }} <!-- Menggunakan kolom rukun_warga -->
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <!-- RT -->
                        <div>
                            <label for="rt" class="block text-sm font-medium text-gray-700">RT</label>
                            <input type="text" name="rt" id="rt" placeholder="Masukkan RT"
                                value="{{ $penduduk->rt ?? $meninggal->rt }}"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                        </div>
                        <!-- Jenis Kelamin -->
                        <div>
                            <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                            <?php
                            $genderOptions = ['LAKI-LAKI', 'PEREMPUAN'];
                            ?>
                            <select name="jenis_kelamin" id="jenis_kelamin"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500">
                                @foreach ($genderOptions as $gender)
                                    <option value="{{ $gender }}"
                                        {{ old('jenis_kelamin', isset($meninggal) ? strtoupper($meninggal->jenis_kelamin) : (isset($penduduk) ? strtoupper($penduduk->jenis_kelamin) : '')) == $gender ? 'selected' : '' }}>
                                        {{ $gender }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <!-- Status Kependudukan -->
                        <div class="hidden">
                            <label for="status_kependudukan" class="block text-sm font-medium text-gray-700">Status
                                Kependudukan</label>
                            <select name="status_kependudukan" id="status_kependudukan"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500">
                                <option value="MENINGGAL"
                                    {{ isset($meninggal) && $meninggal->status_kependudukan == 'MENINGGAL' ? 'selected' : '' }}>
                                    MENINGGAL</option>
                            </select>
                        </div>
                    </div>
                    <div class="mt-10 flex justify-between">
                        <a href="{{ route('resident-table') }}"
                            class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 focus:ring-red-500 focus:outline-none focus:ring-2 focus:ring-offset-2">Kembali</a>
                        <button type="submit"
                            onclick="{{ isset($meninggal) ? 'editConfirm(event, this)' : 'addConfirm(event, this)' }}"
                            class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 focus:ring-blue-500 focus:outline-none focus:ring-2 focus:ring-offset-2">
                            @if (isset($meninggal))
                                Update
                            @else
                                Simpan
                            @endif
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('sweetalert')
    <script>
        document.getElementById('nik').addEventListener('blur', function() {
            const nik = this.value;
            // Memanggil endpoint untuk mendapatkan data penduduk berdasarkan NIK
            if (nik) {
                fetch(`/penduduk/${nik}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data) {
                            // Mengisi field dengan data dari tabel penduduk
                            document.getElementById('nama_almarhum').value = data.nama_lengkap || '';
                            document.getElementById('hubungan_dengan_kk').value = data.status_hubkel || '';
                            document.getElementById('tanggal_lahir').value = data.tanggal_lahir || '';
                            document.getElementById('tempat_lahir').value = data.tempat_lahir || '';
                        } else {
                            // Jika data tidak ditemukan, kosongkan input
                            document.getElementById('nama_almarhum').value = '';
                            document.getElementById('hubungan_dengan_kk').value = '';
                            document.getElementById('tanggal_lahir').value = '';
                            document.getElementById('tempat_lahir').value = '';
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching data:', error);
                    });
            }
        });

        function addConfirm(event, button) {
            event.preventDefault();
            // Validasi apakah semua input tidak kosong
            let form = button.closest('form');
            let inputs = form.querySelectorAll('input, textarea, select');
            let isEmpty = false;
            inputs.forEach(function(input) {
                if (input.value.trim() === '') {
                    isEmpty = true;
                }
            });
            if (isEmpty) {
                // SweetAlert untuk input kosong
                Swal.fire({
                    icon: 'warning',
                    title: 'Input Kosong!',
                    text: 'Harap isi semua field sebelum melanjutkan.',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#3085d6',
                });
            } else {
                // SweetAlert untuk konfirmasi simpan
                Swal.fire({
                    icon: 'question',
                    title: 'Apakah Anda yakin?',
                    text: 'Data akan disimpan.',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Simpan',
                    confirmButtonColor: '#3085d6',
                    cancelButtonText: 'Batal',
                    cancelButtonColor: '#d33',
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Simpan data setelah konfirmasi
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Data berhasil disimpan.',
                            confirmButtonText: 'OK',
                            confirmButtonColor: '#3085d6',
                        }).then(() => {
                            // Submit form setelah konfirmasi sukses
                            form.submit();
                        });
                    }
                });
            }
        }

        function editConfirm(event, button) {
            event.preventDefault(); // Mencegah form submit secara langsung
            Swal.fire({
                title: "Simpan?",
                text: "Periksa ulang perubahan jika ragu!",
                icon: "question",
                confirmButtonText: "Ya, Simpan",
                confirmButtonColor: "#3085d6",
                cancelButtonText: "Tidak",
                cancelButtonColor: "#d33",
                showCancelButton: true
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "Berhasil",
                        text: "Perubahan berhasil disimpan!",
                        icon: "success",
                        confirmButtonText: "OK",
                        confirmButtonColor: "#3085d6"
                    }).then(() => {
                        // Submit the form setelah pesan sukses muncul
                        event.target.closest('form').submit();
                    });
                }
            });
        }
    </script>
@endsection
