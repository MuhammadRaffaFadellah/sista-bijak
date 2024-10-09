@extends('layouts.master')

@section('dashboard-title')
    Sista Bijak - @if (isset($penduduk))
        Edit Data Penduduk
    @else
        Tambah Data Penduduk
    @endif
@endsection

@section('body')
    <div class="container mx-auto px-4 py-6">
        <div class="card shadow-lg rounded-lg overflow-hidden">
            <div class="bg-gray-800 text-white p-4">
                <h3 class="text-lg font-bold">
                    @if (isset($penduduk))
                        Edit Data Penduduk
                    @else
                        Tambah Data Penduduk
                    @endif
                </h3>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="p-4">
                <form action="{{ isset($penduduk) ? route('penduduk.update', $penduduk->id) : route('penduduk.store') }}"
                    method="POST">
                    @csrf
                    @if (isset($penduduk))
                        @method('PUT')
                    @endif
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- NIK -->
                        <div>
                            <label for="nik" class="block text-sm font-medium text-gray-700">NIK</label>
                            <input type="text" name="nik" id="nik"
                                value="{{ $lahir->nik ?? ($penduduk->nik ?? '') }}" readonly
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                        </div>
                        <!-- Nama Lengkap -->
                        <div>
                            <label for="nama_lengkap" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" id="nama_lengkap" placeholder="Masukkan nama lengkap"
                                value="{{ $lahir->nama_anak_lahir ?? ($penduduk->nama_lengkap ?? '') }}"
                                class="mt-1 uppercase block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                        </div>
                        <!-- Jenis Kelamin -->
                        <div>
                            <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                            <select name="jenis_kelamin" id="jenis_kelamin"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500">
                                <option value="LAKI-LAKI"
                                    {{ (isset($lahir) && $lahir->jenis_kelamin == 'LAKI-LAKI') || (isset($penduduk) && $penduduk->jenis_kelamin == 'LAKI-LAKI') ? 'selected' : '' }}>
                                    LAKI-LAKI
                                </option>
                                <option value="PEREMPUAN"
                                    {{ (isset($lahir) && $lahir->jenis_kelamin == 'PEREMPUAN') || (isset($penduduk) && $penduduk->jenis_kelamin == 'PEREMPUAN') ? 'selected' : '' }}>
                                    PEREMPUAN
                                </option>
                            </select>
                        </div>
                        <!-- Tempat Lahir -->
                        <div>
                            <label for="tempat_lahir" class="block text-sm font-medium text-gray-700">Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" id="tempat_lahir" placeholder="Masukkan tempat lahir"
                                value="{{ $lahir->tempat_lahir ?? ($penduduk->tempat_lahir ?? '') }}"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                        </div>
                        <!-- Tanggal Lahir -->
                        <div>
                            <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" id="tanggal_lahir"
                                value="{{ $lahir->tanggal_lahir ?? ($penduduk->tanggal_lahir ?? '') }}"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                        </div>
                        <!-- Status Hubungan Keluarga -->
                        <div>
                            <label for="status_hubkel" class="block text-sm font-medium text-gray-700">Status Hubungan
                                Keluarga</label>
                            <select name="status_hubkel" id="status_hubkel"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500">
                                <option value="" disabled {{ empty($lahir->status_hubkel) ? 'selected' : '' }}>Pilih
                                    Status Hubungan Keluarga</option>
                                @foreach (['KEPALA KELUARGA', 'ISTRI', 'ANAK', 'CUCU', 'FAMILI LAIN', 'LAINNYA', 'MENANTU', 'MERTUA', 'ORANG TUA', 'PEMBANTU'] as $hubkel)
                                    <option value="{{ $hubkel }}"
                                        {{ ($lahir->status_hubkel ?? ($penduduk->status_hubkel ?? '')) == $hubkel ? 'selected' : '' }}>
                                        {{ ucfirst(strtolower($hubkel)) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- Pendidikan Terakhir -->
                        <div>
                            <label for="pendidikan_terakhir" class="block text-sm font-medium text-gray-700">Pendidikan
                                Terakhir</label>
                            <select name="pendidikan_terakhir" id="pendidikan_terakhir"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500">
                                <option value="" disabled {{ empty($lahir->pendidikan_terakhir) ? 'selected' : '' }}>
                                    Pilih Pendidikan Terakhir</option>
                                @foreach (['TAMAT SD/SEDERAJAT', 'BELUM TAMAT SD/SEDERAJAT', 'TIDAK TAMAT SD/SEDERAJAT', 'TIDAK/BELUM SEKOLAH', 'DIPLOMA I/II', 'AKADEMI/DIPLOMA III/S. MUDA', 'DIPLOMA IV/STRATA I', 'STRATA II', 'STRATA III', 'SLTA/SEDERAJAT', 'SLTP/SEDERAJAT'] as $pendidikan)
                                    <option value="{{ $pendidikan }}"
                                        {{ ($lahir->pendidikan_terakhir ?? ($penduduk->pendidikan_terakhir ?? '')) == $pendidikan ? 'selected' : '' }}>
                                        {{ $pendidikan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- Jenis Pekerjaan -->
                        <div>
                            <label for="jenis_pekerjaan" class="block text-sm font-medium text-gray-700">Jenis
                                Pekerjaan</label>
                            <select name="jenis_pekerjaan" id="jenis_pekerjaan"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500">
                                <option value="" disabled {{ empty($lahir->jenis_pekerjaan) ? 'selected' : '' }}>
                                    Pilih Jenis Pekerjaan</option>
                                @foreach (['Dokter', 'Apoteker', 'Dosen', 'Guru', 'Anggota DPRD Kabupaten/Kota', 'Karyawan BUMN', 'Karyawan BUMD', 'Bidan', 'Juru Masak', 'Buruh Harian Lepas', 'Buruh Nelayan/Perikanan', 'Buruh Tani/Perkebunan', 'Pegawai Negeri Sipil (PNS)', 'Kepolisian RI', 'Karyawan Swasta', 'Konsultan', 'Notaris', 'Pedagang', 'Mekanik', 'Nelayan/Perikanan', 'Penata Rias', 'Pendeta', 'Pelajar/Mahasiswa', 'Pelaut', 'Karyawan Honorer', 'Pembantu Rumah Tangga', 'Pengacara', 'Perawat', 'Penyiar Radio', 'Wartawan', 'Ustadz/Mubaligh', 'Seniman', 'Perdagangan', 'Sopir', 'Tukang Cukur', 'Tukang Jahit', 'Tukang Kayu', 'Tukang Listrik'] as $pekerjaan)
                                    <option value="{{ $pekerjaan }}"
                                        {{ ($lahir->jenis_pekerjaan ?? '') == $pekerjaan ? 'selected' : '' }}>
                                        {{ $pekerjaan }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <!-- Agama -->
                        <div>
                            <label for="agama" class="block text-sm font-medium text-gray-700">Agama</label>
                            <select name="agama" id="agama"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500">
                                <option value="" disabled
                                    {{ empty($lahir->agama ?? $penduduk->agama) ? 'selected' : '' }}>Pilih Agama
                                </option>
                                @foreach (['ISLAM', 'KRISTEN', 'KATOLIK', 'HINDU', 'BUDDHA', 'KONGHUCU', 'LAINNYA'] as $agama)
                                    <option value="{{ $agama }}"
                                        {{ ($lahir->agama ?? ($penduduk->agama ?? '')) == $agama ? 'selected' : '' }}>
                                        {{ ucfirst(strtolower($agama)) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Status Perkawinan -->
                        <div>
                            <label for="status_perkawinan" class="block text-sm font-medium text-gray-700">Status
                                Perkawinan</label>
                            <select name="status_perkawinan" id="status_perkawinan"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500">
                                <option value="" disabled
                                    {{ empty($lahir->status_perkawinan ?? $penduduk->status_perkawinan) ? 'selected' : '' }}>
                                    Pilih Status Perkawinan
                                </option>
                                @foreach (['BELUM MENIKAH', 'MENIKAH', 'CERAI HIDUP', 'CERAI MATI', 'DULU PERNAH MENIKAH'] as $status_perkawinan)
                                    <option value="{{ $status_perkawinan }}"
                                        {{ ($lahir->status_perkawinan ?? ($penduduk->status_perkawinan ?? '')) == $status_perkawinan ? 'selected' : '' }}>
                                        {{ ucfirst(strtolower($status_perkawinan)) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Alamat -->
                        <div>
                            <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                            <input type="text" name="alamat" id="alamat" placeholder="Masukkan alamat"
                                value="{{ $lahir->alamat ?? ($penduduk->alamat ?? '') }}"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                        </div>
                        <!-- RW -->
                        <div>
                            <label for="rw" class="block text-sm font-medium text-gray-700">RW</label>
                            <input type="text" name="rw" id="rw" placeholder="Masukkan RW"
                                value="{{ $lahir->rw ?? ($penduduk->rw ?? '') }}"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                        </div>
                        <!-- RT -->
                        <div>
                            <label for="rt" class="block text-sm font-medium text-gray-700">RT</label>
                            <input type="text" name="rt" id="rt" placeholder="Masukkan RT"
                                value="{{ $lahir->rt ?? ($penduduk->rt ?? '') }}"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                        </div>
                        <!-- Status Perkawinan -->
                        <div>
                            <label for="status_kependudukan" class="block text-sm font-medium text-gray-700">Status
                                Kependudukan</label>
                            <select name="status_kependudukan" id="status_kependudukan"
                                class="mt-1 uppercase block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500">
                                <option value="" disabled
                                    {{ empty($lahir->status_kependudukan ?? $penduduk->status_kependudukan) ? 'selected' : '' }}>
                                    Pilih Status Kependudukan
                                </option>
                                @foreach (['MASUK', 'LAHIR', 'MENETAP', 'KELUAR'] as $status_kependudukan)
                                    <option value="{{ $status_kependudukan }}"
                                        {{ ($lahir->status_kependudukan ?? ($penduduk->status_kependudukan ?? '')) == $status_kependudukan ? 'selected' : '' }}>
                                        {{ ucfirst(strtolower($status_kependudukan)) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mt-20 flex justify-between">
                        <a href="{{ isset($resident) ? route('resident-table') : route('resident-born') }}"
                            class="inline-flex justify-center py-2 px-4 border border-transparent rounded-md shadow-md text-sm font-medium text-white bg-red-500 hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            Kembali
                        </a>
                        <button type="submit"
                            class="inline-flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            {{ isset($resident) ? 'Simpan' : 'Tambah' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('sweetalert')
    <script>
        // Fungsi konfirmasi untuk menyimpan data
        function addConfirm(event, button) {
            event.preventDefault();
            let form = button.closest('form');
            let inputs = form.querySelectorAll('input, textarea, select');
            let isEmpty = false;
            inputs.forEach(function(input) {
                if (input.value.trim() === '') {
                    isEmpty = true;
                }
            });
            if (isEmpty) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Input Kosong!',
                    text: 'Harap isi semua field sebelum melanjutkan.',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#3085d6',
                });
            } else {
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
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Data berhasil disimpan.',
                            confirmButtonText: 'OK',
                            confirmButtonColor: '#3085d6',
                        }).then(() => {
                            form.submit();
                        });
                    }
                });
            }
        }

        function editConfirm(event, button) {
            event.preventDefault();
            let form = button.closest('form');
            Swal.fire({
                icon: 'question',
                title: 'Apakah Anda yakin?',
                text: 'Data akan diperbarui.',
                showCancelButton: true,
                confirmButtonText: 'Ya, Perbarui',
                confirmButtonColor: '#3085d6',
                cancelButtonText: 'Batal',
                cancelButtonColor: '#d33',
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Data berhasil diperbarui.',
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#3085d6',
                    }).then(() => {
                        form.submit();
                    });
                }
            });
        }
    </script>
@endsection
