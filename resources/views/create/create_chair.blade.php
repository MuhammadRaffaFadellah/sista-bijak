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
                            <input type="text" name="nik" id="nik" value="{{ $lahir->nik ?? '' }}" readonly
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                        </div>
                        <!-- Nama Lengkap -->
                        <div>
                            <label for="nama_lengkap" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" id="nama_lengkap" placeholder="Masukkan nama lengkap"
                                value="{{ $lahir->nama_anak_lahir ?? $penduduk->nama_lengkap ?? '' }}"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                        </div>
                        <!-- Jenis Kelamin -->
                        <div>
                            <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                            <select name="jenis_kelamin" id="jenis_kelamin"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500">
                                <option value="LAKI-LAKI"
                                    {{ isset($lahir) && $lahir->jenis_kelamin == 'LAKI-LAKI' ? 'selected' : '' }}>
                                    LAKI-LAKI</option>
                                <option value="PEREMPUAN"
                                    {{ isset($lahir) && $lahir->jenis_kelamin == 'PEREMPUAN' ? 'selected' : '' }}>
                                    PEREMPUAN</option>
                            </select>
                        </div>
                        <!-- Tempat Lahir -->
                        <div>
                            <label for="tempat_lahir" class="block text-sm font-medium text-gray-700">Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" id="tempat_lahir" placeholder="Masukkan tempat lahir"
                                value="{{ $lahir->tempat_lahir ?? '' }}"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                        </div>
                        <!-- Tanggal Lahir -->
                        <div>
                            <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" id="tanggal_lahir"
                                value="{{ $lahir->tanggal_lahir ?? '' }}"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                        </div>
                        <!-- Status Hubungan Keluarga -->
                        <div>
                            <label for="status_hubkel" class="block text-sm font-medium text-gray-700">
                                Status Hubungan Keluarga</label>
                            <select name="status_hubkel" id="status_hubkel"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500">
                                <option value="" disabled selected>Pilih Status Hubungan Keluarga</option>
                                <option value="KEPALA KELUARGA">Kepala Keluarga</option>
                                <option value="ISTRI">Istri</option>
                                <option value="ANAK">Anak</option>
                                <option value="CUCU">Cucu</option>
                                <option value="FAMILI LAIN">Famili Lain</option>
                                <option value="LAINNYA">Lainnya</option>
                                <option value="MENANTU">Menantu</option>
                                <option value="MERTUA">Mertua</option>
                                <option value="ORANG TUA">Orang Tua</option>
                                <option value="PEMBANTU">Pembantu</option>
                            </select>
                        </div>

                        <!-- Pendidikan Terakhir -->
                        <div>
                            <label for="pendidikan_terakhir" class="block text-sm font-medium text-gray-700">Pendidikan
                                Terakhir</label>
                            <select name="pendidikan_terakhir" id="pendidikan_terakhir"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500">
                                <option value="" disabled
                                    {{ $lahir->pendidikan_terakhir ?? '' == '' ? 'selected' : '' }}>Pilih Pendidikan
                                    Terakhir
                                </option>
                                <option value="TAMAT SD/SEDERAJAT" {{ $lahir->pendidikan_terakhir == 'TAMAT SD/SEDERAJAT' ? 'selected' : '' }}>
                                    TAMAT SD/SEDERAJAT
                                </option>
                                <option value="BELUM TAMAT SD/SEDERAJAT" {{ $lahir->pendidikan_terakhir == 'BELUM TAMAT SD/SEDERAJAT' ? 'selected' : '' }}>
                                    BELUM TAMAT SD/SEDERAJAT
                                </option>
                                <option value="TIDAK TAMAT SD/SEDERAJAT" {{ $lahir->pendidikan_terakhir == 'TIDAK TAMAT SD/SEDERAJAT' ? 'selected' : '' }}>
                                    TIDAK TAMAT SD/SEDERAJAT
                                </option>
                                <option value="TIDAK/BELUM SEKOLAH" {{ $lahir->pendidikan_terakhir == 'TIDAK/BELUM SEKOLAH' ? 'selected' : '' }}>
                                    TIDAK/BELUM SEKOLAH
                                </option>
                                <option value="DIPLOMA I/II" {{ $lahir->pendidikan_terakhir == 'DIPLOMA I/II' ? 'selected' : '' }}>
                                    DIPLOMA I/II
                                </option>
                                <option value="AKADEMI/DIPLOMA III/S. MUDA" {{ $lahir->pendidikan_terakhir == 'AKADEMI/DIPLOMA III/S. MUDA' ? 'selected' : '' }}>
                                    AKADEMI/DIPLOMA III/S. MUDA
                                </option>
                                <option value="DIPLOMA IV/STRATA I" {{ $lahir->pendidikan_terakhir == 'DIPLOMA IV/STRATA I' ? 'selected' : '' }}>
                                    DIPLOMA IV/STRATA I
                                </option>
                                <option value="STRATA II" {{ $lahir->pendidikan_terakhir == 'STRATA II' ? 'selected' : '' }}>
                                    STRATA II
                                </option>
                                <option value="STRATA III" {{ $lahir->pendidikan_terakhir == 'STRATA III' ? 'selected' : '' }}>
                                    STRATA III
                                </option>
                                <option value="SLTA/SEDERAJAT" {{ $lahir->pendidikan_terakhir == 'SLTA/SEDERAJAT' ? 'selected' : '' }}>
                                    SLTA/SEDERAJAT
                                </option>
                                <option value="SLTP/SEDERAJAT" {{ $lahir->pendidikan_terakhir == 'SLTP/SEDERAJAT' ? 'selected' : '' }}>
                                    SLTP/SEDERAJAT
                                </option>                                
                            </select>
                        </div>
                        <!-- Jenis Pekerjaan -->
                        <div>
                            <label for="jenis_pekerjaan" class="block text-sm font-medium text-gray-700">Jenis
                                Pekerjaan</label>
                            <select name="jenis_pekerjaan" id="jenis_pekerjaan"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500">
                                <option value="" disabled
                                    {{ $lahir->jenis_pekerjaan ?? '' == '' ? 'selected' : '' }}>Pilih Jenis Pekerjaan
                                </option>
                                <option value="Dokter" {{ $lahir->jenis_pekerjaan ?? '' == 'Dokter' ? 'selected' : '' }}>
                                    Dokter</option>
                                <option value="Apoteker"
                                    {{ $lahir->jenis_pekerjaan ?? '' == 'Apoteker' ? 'selected' : '' }}>Apoteker</option>
                                <option value="Dosen" {{ $lahir->jenis_pekerjaan ?? '' == 'Dosen' ? 'selected' : '' }}>
                                    Dosen</option>
                                <option value="Guru" {{ $lahir->jenis_pekerjaan ?? '' == 'Guru' ? 'selected' : '' }}>Guru
                                </option>
                                <option value="Anggota DPRD Kabupaten/Kota"
                                    {{ $lahir->jenis_pekerjaan ?? '' == 'Anggota DPRD Kabupaten/Kota' ? 'selected' : '' }}>
                                    Anggota DPRD Kabupaten/Kota</option>
                                <option value="Karyawan BUMN"
                                    {{ $lahir->jenis_pekerjaan ?? '' == 'Karyawan BUMN' ? 'selected' : '' }}>Karyawan BUMN
                                </option>
                                <option value="Karyawan BUMD"
                                    {{ $lahir->jenis_pekerjaan ?? '' == 'Karyawan BUMD' ? 'selected' : '' }}>Karyawan BUMD
                                </option>
                                <option value="Bidan" {{ $lahir->jenis_pekerjaan ?? '' == 'Bidan' ? 'selected' : '' }}>
                                    Bidan</option>
                                <option value="Juru Masak"
                                    {{ $lahir->jenis_pekerjaan ?? '' == 'Juru Masak' ? 'selected' : '' }}>Juru Masak
                                </option>
                                <option value="Buruh Harian Lepas"
                                    {{ $lahir->jenis_pekerjaan ?? '' == 'Buruh Harian Lepas' ? 'selected' : '' }}>Buruh
                                    Harian Lepas</option>
                                <option value="Buruh Nelayan/Perikanan"
                                    {{ $lahir->jenis_pekerjaan ?? '' == 'Buruh Nelayan/Perikanan' ? 'selected' : '' }}>
                                    Buruh Nelayan/Perikanan</option>
                                <option value="Buruh Tani/Perkebunan"
                                    {{ $lahir->jenis_pekerjaan ?? '' == 'Buruh Tani/Perkebunan' ? 'selected' : '' }}>Buruh
                                    Tani/Perkebunan</option>
                                <option value="Belum/Tidak Bekerja"
                                    {{ $lahir->jenis_pekerjaan ?? '' == 'Belum/Tidak Bekerja' ? 'selected' : '' }}>
                                    Belum/Tidak Bekerja</option>
                                <option value="Pegawai Negeri Sipil (PNS)"
                                    {{ $lahir->jenis_pekerjaan ?? '' == 'Pegawai Negeri Sipil (PNS)' ? 'selected' : '' }}>
                                    Pegawai Negeri Sipil (PNS)</option>
                                <option value="Kepolisian RI"
                                    {{ $lahir->jenis_pekerjaan ?? '' == 'Kepolisian RI' ? 'selected' : '' }}>Kepolisian RI
                                </option>
                                <option value="Karyawan Swasta"
                                    {{ $lahir->jenis_pekerjaan ?? '' == 'Karyawan Swasta' ? 'selected' : '' }}>Karyawan
                                    Swasta</option>
                                <option value="Konsultan"
                                    {{ $lahir->jenis_pekerjaan ?? '' == 'Konsultan' ? 'selected' : '' }}>Konsultan</option>
                                <option value="Notaris"
                                    {{ $lahir->jenis_pekerjaan ?? '' == 'Notaris' ? 'selected' : '' }}>
                                    Notaris</option>
                                <option value="Pedagang"
                                    {{ $lahir->jenis_pekerjaan ?? '' == 'Pedagang' ? 'selected' : '' }}>Pedagang</option>
                                <option value="Mekanik"
                                    {{ $lahir->jenis_pekerjaan ?? '' == 'Mekanik' ? 'selected' : '' }}>
                                    Mekanik</option>
                                <option value="Nelayan/Perikanan"
                                    {{ $lahir->jenis_pekerjaan ?? '' == 'Nelayan/Perikanan' ? 'selected' : '' }}>
                                    Nelayan/Perikanan</option>
                                <option value="Penata Rias"
                                    {{ $lahir->jenis_pekerjaan ?? '' == 'Penata Rias' ? 'selected' : '' }}>Penata Rias
                                </option>
                                <option value="Pelajar/Mahasiswa"
                                    {{ $lahir->jenis_pekerjaan ?? '' == 'Pelajar/Mahasiswa' ? 'selected' : '' }}>
                                    Pelajar/Mahasiswa</option>
                                <option value="Pelaut" {{ $lahir->jenis_pekerjaan ?? '' == 'Pelaut' ? 'selected' : '' }}>
                                    Pelaut</option>
                                <option value="Karyawan Honorer"
                                    {{ $lahir->jenis_pekerjaan ?? '' == 'Karyawan Honorer' ? 'selected' : '' }}>Karyawan
                                    Honorer</option>
                                <option value="Mengelola Rumah Tangga"
                                    {{ $lahir->jenis_pekerjaan ?? '' == 'Mengelola Rumah Tangga' ? 'selected' : '' }}>
                                    Mengelola Rumah Tangga</option>
                                <option value="Pembantu Rumah Tangga"
                                    {{ $lahir->jenis_pekerjaan ?? '' == 'Pembantu Rumah Tangga' ? 'selected' : '' }}>
                                    Pembantu Rumah Tangga</option>
                                <option value="Pengacara"
                                    {{ $lahir->jenis_pekerjaan ?? '' == 'Pengacara' ? 'selected' : '' }}>Pengacara</option>
                                <option value="Perawat"
                                    {{ $lahir->jenis_pekerjaan ?? '' == 'Perawat' ? 'selected' : '' }}>Perawat</option>
                                <option value="Penyiar Radio"
                                    {{ $lahir->jenis_pekerjaan ?? '' == 'Penyiar Radio' ? 'selected' : '' }}>Penyiar Radio
                                </option>
                                <option value="Wartawan"
                                    {{ $lahir->jenis_pekerjaan ?? '' == 'Wartawan' ? 'selected' : '' }}>Wartawan</option>
                                <option value="Ustadz/Mubaligh"
                                    {{ $lahir->jenis_pekerjaan ?? '' == 'Ustadz/Mubaligh' ? 'selected' : '' }}>
                                    Ustadz/Mubaligh</option>
                                <option value="Seniman"
                                    {{ $lahir->jenis_pekerjaan ?? '' == 'Seniman' ? 'selected' : '' }}>Seniman</option>
                                <option value="Perdagangan"
                                    {{ $lahir->jenis_pekerjaan ?? '' == 'Perdagangan' ? 'selected' : '' }}>Perdagangan
                                </option>
                                <option value="Sopir" {{ $lahir->jenis_pekerjaan ?? '' == 'Sopir' ? 'selected' : '' }}>
                                    Sopir</option>
                                <option value="Tukang Cukur"
                                    {{ $lahir->jenis_pekerjaan ?? '' == 'Tukang Cukur' ? 'selected' : '' }}>Tukang Cukur
                                </option>
                                <option value="Tukang Jahit"
                                    {{ $lahir->jenis_pekerjaan ?? '' == 'Tukang Jahit' ? 'selected' : '' }}>Tukang Jahit
                                </option>
                                <option value="Tukang Kayu"
                                    {{ $lahir->jenis_pekerjaan ?? '' == 'Tukang Kayu' ? 'selected' : '' }}>Tukang Kayu
                                </option>
                                <option value="Tukang Listrik"
                                    {{ $lahir->jenis_pekerjaan ?? '' == 'Tukang Listrik' ? 'selected' : '' }}>Tukang
                                    Listrik</option>
                                <option value="Tentara Nasional Indonesia"
                                    {{ $lahir->jenis_pekerjaan ?? '' == 'Tentara Nasional Indonesia' ? 'selected' : '' }}>
                                    Tentara Nasional Indonesia</option>
                                <option value="Wiraswasta"
                                    {{ $lahir->jenis_pekerjaan ?? '' == 'Wiraswasta' ? 'selected' : '' }}>Wiraswasta
                                </option>
                                <option value="Pensiunan"
                                    {{ $lahir->jenis_pekerjaan ?? '' == 'Pensiunan' ? 'selected' : '' }}>Pensiunan</option>
                            </select>
                        </div>

                        <!-- Agama -->
                        <div>
                            <label for="agama" class="block text-sm font-medium text-gray-700">Agama</label>
                            <select name="agama" id="agama"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500">
                                <option value="" disabled {{ $lahir->agama ?? '' == '' ? 'selected' : '' }}>Pilih
                                    Agama</option>
                                <option value="ISLAM" {{ $lahir->agama ?? '' == 'Islam' ? 'selected' : '' }}>Islam
                                </option>
                                <option value="KRISTEN" {{ $lahir->agama ?? '' == 'Kristen' ? 'selected' : '' }}>Kristen
                                </option>
                                <option value="KATOLIK" {{ $lahir->agama ?? '' == 'Katolik' ? 'selected' : '' }}>Katolik
                                </option>
                                <option value="HINDU" {{ $lahir->agama ?? '' == 'Hindu' ? 'selected' : '' }}>Hindu
                                </option>
                                <option value="BUDDHA" {{ $lahir->agama ?? '' == 'Buddha' ? 'selected' : '' }}>Buddha
                                </option>
                                <option value="KONGHUCU" {{ $lahir->agama ?? '' == 'Konghucu' ? 'selected' : '' }}>
                                    Konghucu
                                </option>
                            </select>
                        </div>
                        <!-- Status Perkawinan -->
                        <div>
                            <label for="status_perkawinan" class="block text-sm font-medium text-gray-700">Status
                                Perkawinan</label>
                            <select name="status_perkawinan" id="status_perkawinan"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500">
                                <option value="" disabled
                                    {{ $lahir->status_perkawinan ?? '' == '' ? 'selected' : '' }}>Pilih Status Perkawinan
                                </option>
                                <option value="BELUM MENIKAH"
                                    {{ $lahir->status_perkawinan ?? '' == 'Belum Menikah' ? 'selected' : '' }}>Belum
                                    Menikah</option>
                                <option value="MENIKAH"
                                    {{ $lahir->status_perkawinan ?? '' == 'Menikah' ? 'selected' : '' }}>Menikah</option>
                                <option value="CERAI HIDUP"
                                    {{ $lahir->status_perkawinan ?? '' == 'Cerai Hidup' ? 'selected' : '' }}>Cerai Hidup
                                </option>
                                <option value="CERAI MATI"
                                    {{ $lahir->status_perkawinan ?? '' == 'Cerai Mati' ? 'selected' : '' }}>Cerai Mati
                                </option>
                            </select>
                        </div>
                        <!-- Alamat -->
                        <div>
                            <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                            <input type="text" name="alamat" id="alamat" placeholder="Masukkan alamat"
                                value="{{ $lahir->alamat ?? '' }}"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                        </div>
                        <!-- RW -->
                        <div>
                            <label for="rw" class="block text-sm font-medium text-gray-700">RW</label>
                            <select name="rw" id="rw"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500">
                                @foreach ($rws as $rw)
                                    <option value="{{ $rw->id }}"
                                        {{ isset($penduduk) && $penduduk->rw == $rw->id ? 'selected' : '' }}>
                                        {{ $rw->rukun_warga }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <!-- RT -->
                        <div>
                            <label for="rt" class="block text-sm font-medium text-gray-700">RT</label>
                            <input type="text" name="rt" id="rt" placeholder="Masukkan RT"
                                value="{{ $lahir->rt ?? '' }}"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                        </div>
                        <!-- Kelurahan -->
                        <div>
                            <label for="kelurahan" class="block text-sm font-medium text-gray-700">Kelurahan</label>
                            <select name="kelurahan" id="kelurahan"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500">
                                <option value="" disabled {{ $lahir->kelurahan ?? '' == '' ? 'selected' : '' }}>
                                    Pilih Kelurahan</option>
                                <option value="KESAMBI"
                                    {{ $lahir->kelurahan ?? '' == 'Kesambi' ? 'selected' : '' }}>Kesambi
                                </option>
                            </select>
                        </div>
                        <!-- Status Kependudukan -->
                        <div class="hidden">
                            <label for="status_kependudukan" class="block text-sm font-medium text-gray-700">Status
                                Kependudukan</label>
                            <select name="status_kependudukan" id="status_kependudukan"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500">
                                <option value="LAHIR"
                                    {{ isset($penduduk) && $penduduk->status_kependudukan == 'LAHIR' ? 'selected' : '' }}>
                                    LAHIR</option>
                            </select>
                        </div>
                    </div>
                    <div class="mt-10 flex justify-between">
                        <a href="{{ route('resident-born') }}"
                            class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 focus:ring-red-500 focus:outline-none focus:ring-2 focus:ring-offset-2">Kembali</a>
                        <button type="submit"
                            onclick="{{ isset($penduduk) ? 'editConfirm(event, this)' : 'addConfirm(event, this)' }}"
                            class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 focus:ring-blue-500 focus:outline-none focus:ring-2 focus:ring-offset-2">
                            @if (isset($penduduk))
                                Update
                            @else
                                Tambah
                            @endif
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
