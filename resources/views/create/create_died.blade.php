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
                        Data Meninggal
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
                        <input type="hidden" name="id" value="{{ $penduduk->id ?? $meninggal->id }}">
                        <!-- NIK Penduduk -->
                        <div>
                            <label for="nik" class="block text-sm font-medium text-gray-700">NIK</label>
                            <input type="text" name="nik" id="nik"
                                value="{{ $penduduk->nik ?? $meninggal->nik }}" readonly
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                        </div>

                        <!-- Nama Almarhum/Almarhumah -->
                        <div>
                            <label for="nama_lengkap" class="block text-sm font-medium text-gray-700">Nama
                                Almarhum/Almarhumah</label>
                            <input type="text" name="nama_lengkap" id="nama_lengkap"
                                placeholder="Masukkan nama almarhum"
                                value="{{ $penduduk->nama_lengkap ?? $meninggal->nama_lengkap }}"
                                class="mt-1 uppercase block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                        </div>
                        <!-- Jenis Kelamin -->
                        <div>
                            <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700">Jenis
                                Kelamin</label>
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

                        <!-- Hubungan dengan Kepala Keluarga -->
                        <div>
                            <label for="status_hubkel" class="block text-sm font-medium text-gray-700">Status Hubungan
                                Keluarga</label>
                            <select name="status_hubkel" id="status_hubkel"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500">
                                <option value="" disabled
                                    {{ !isset($penduduk) && !isset($meninggal) ? 'selected' : '' }}>
                                    Pilih Hubungan
                                </option>

                                @php
                                    $hubunganKeluarga = [
                                        'KEPALA KELUARGA',
                                        'ISTRI',
                                        'ANAK',
                                        'CUCU',
                                        'FAMILI LAIN',
                                        'LAINNYA',
                                        'MENANTU',
                                        'MERTUA',
                                        'ORANG TUA',
                                        'PEMBANTU',
                                    ];
                                @endphp

                                @foreach ($hubunganKeluarga as $hubkk)
                                    <option value="{{ $hubkk }}" @if (
                                        (isset($penduduk) && $penduduk->status_hubkel == $hubkk) ||
                                            (isset($meninggal) && $meninggal->status_hubkel == $hubkk)) selected @endif>
                                        {{ ucfirst(strtolower($hubkk)) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Tempat Lahir -->
                        <div>
                            <label for="tempat_lahir" class="block text-sm font-medium text-gray-700">Tempat
                                Lahir</label>
                            <input type="text" name="tempat_lahir" id="tempat_lahir" placeholder="Masukkan tempat lahir"
                                value="{{ $penduduk->tempat_lahir ?? $meninggal->tempat_lahir }}"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                        </div>
                        <!-- Tanggal Lahir -->
                        <div>
                            <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700">Tanggal
                                Lahir</label>
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
                                class="mt-1 uppercase block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                        </div>
                        <!-- Tanggal Meninggal -->
                        <div>
                            <label for="tanggal_meninggal" class="block text-sm font-medium text-gray-700">Tanggal
                                Meninggal</label>
                            <input type="date" name="tanggal_meninggal" id="tanggal_meninggal"
                                value="{{ $meninggal->tanggal_meninggal ?? '' }}"
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
                                        {{ $rw->rukun_warga }}
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

                        <!-- Alamat -->
                        <div>
                            <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                            <input type="text" name="alamat" id="alamat" placeholder="Masukkan alamat"
                                value="{{ $penduduk->alamat ?? $meninggal->alamat }}"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                        </div>

                        <!-- Status Kependudukan -->
                        <div>
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
                    <div class="mt-10 mb-4 flex justify-between">
                        <a href="{{ isset($meninggal) ? route('resident-died') : route('resident-table') }}"
                            class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 focus:ring-red-500 focus:outline-none focus:ring-2 focus:ring-offset-2">
                            Kembali
                        </a>
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
                form.submit(); // Use form.submit() directly
                Swal.fire({
                    title: "Berhasil!",
                    text: "Perubahan berhasil disimpan.",
                    icon: "success",
                    confirmButtonText: "OK",
                    confirmButtonColor: "#3085d6"
                });
            }
        });
    }
}

function editConfirm(event, button) {
    event.preventDefault();
    let form = button.closest('form');
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
            form.submit(); // Use form.submit() directly
            Swal.fire({
                title: "Berhasil!",
                text: "Perubahan berhasil disimpan.",
                icon: "success",
                confirmButtonText: "OK",
                confirmButtonColor: "#3085d6"
            });
        }
    });
}
    </script>
@endsection