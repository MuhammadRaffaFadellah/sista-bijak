@extends('layouts.master')

@section('dashboard-title')
    Sista Bijak - @if (isset($migrasiKeluar))
        Edit Data Migrasi Keluar
    @else
        Tambah Data Migrasi Keluar
    @endif
@endsection

@section('body')
<div class="container mx-auto px-4 py-6">
    <div class="card shadow-lg rounded-lg overflow-hidden">
        <div class="bg-gray-800 text-white p-4">
            <h3 class="text-lg font-bold">
                @if (isset($migrasiKeluar))
                    Edit Data Migrasi Keluar
                @else
                    Tambah Data Migrasi Keluar
                @endif
            </h3>
        </div>
        <div class="p-4">
            <form action="{{ isset($migrasiKeluar) ? route('migrasikeluar.update', $migrasiKeluar->id) : route('migrasikeluar.store') }}" method="POST">
                @csrf
                @if (isset($migrasiKeluar))
                    @method('PUT')
                @endif
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Form fields -->
                    @foreach(['nik', 'nama_lengkap', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir', 'status_hubkel', 'pendidikan_terakhir', 'jenis_pekerjaan', 'agama', 'status_perkawinan', 'alamat', 'rw', 'rt', 'kelurahan', 'status_kependudukan'] as $field)
                        <div>
                            <label for="{{ $field }}" class="block text-sm font-medium text-gray-700">{{ ucwords(str_replace('_', ' ', $field)) }}</label>
                            @if($field === 'nik')
                                <input type="text" name="{{ $field }}" id="{{ $field }}" value="{{ old($field, $migrasiKeluar->$field ?? $penduduk->$field ?? '') }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" readonly />
                                <span class="text-red-500 text-sm" id="nik-warning" style="display: none;">Tidak dapat merubah NIK</span>
                            @elseif($field === 'jenis_kelamin')
                                <select name="{{ $field }}" id="{{ $field }}" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500">
                                    <option value="Laki-laki" {{ old($field, $migrasiKeluar->$field ?? $penduduk->$field ?? '') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="Perempuan" {{ old($field, $migrasiKeluar->$field ?? $penduduk->$field ?? '') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            @elseif($field === 'agama')
                                <select name="{{ $field }}" id="{{ $field }}" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500">
                                    <option value="Islam" {{ old($field, $migrasiKeluar->$field ?? $penduduk->$field ?? '') == 'Islam' ? 'selected' : '' }}>Islam</option>
                                    <option value="Kristen" {{ old($field, $migrasiKeluar->$field ?? $penduduk->$field ?? '') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                    <option value="Hindu" {{ old($field, $migrasiKeluar->$field ?? $penduduk->$field ?? '') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                    <option value="Budha" {{ old($field, $migrasiKeluar->$field ?? $penduduk->$field ?? '') == 'Budha' ? 'selected' : '' }}>Budha</option>
                                    <option value="Konghucu" {{ old($field, $migrasiKeluar->$field ?? $penduduk->$field ?? '') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                                </select>
                            @elseif($field === 'status_hubkel')
                                <select name="{{ $field }}" id="{{ $field }}" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500">
                                    <option value="Kepala Keluarga" {{ old($field, $migrasiKeluar->$field ?? $penduduk->$field ?? '') == 'Kepala Keluarga' ? 'selected' : '' }}>Kepala Keluarga</option>
                                    <option value="Istri" {{ old($field, $migrasiKeluar->$field ?? $penduduk->$field ?? '') == 'Istri' ? 'selected' : '' }}>Istri</option>
                                    <option value="Anak" {{ old($field, $migrasiKeluar->$field ?? $penduduk->$field ?? '') == 'Anak' ? 'selected' : '' }}>Anak</option>
                                    <option value="Famili Lain" {{ old($field, $migrasiKeluar->$field ?? $penduduk->$field ?? '') == 'Famili Lain' ? 'selected' : '' }}>Famili Lain</option>
                                    <option value="Sepupu" {{ old($field, $migrasiKeluar->$field ?? $penduduk->$field ?? '') == 'Sepupu' ? 'selected' : '' }}>Sepupu</option>
                                    <option value="Mertua" {{ old($field, $migrasiKeluar->$field ?? $penduduk->$field ?? '') == 'Mertua' ? 'selected' : '' }}>Mertua</option>
                                    <option value="Orang Tua" {{ old($field, $migrasiKeluar->$field ?? $penduduk->$field ?? '') == 'Orang Tua' ? 'selected' : '' }}>Orang Tua</option>
                                    <option value="Cucu" {{ old($field, $migrasiKeluar->$field ?? $penduduk->$field ?? '') == 'Cucu' ? 'selected' : '' }}>Cucu</option>
                                    <option value="Pembantu" {{ old($field, $migrasiKeluar->$field ?? $penduduk->$field ?? '') == 'Pembantu' ? 'selected' : '' }}>Pembantu</option>
                                    <option value="Lainnya" {{ old($field, $migrasiKeluar->$field ?? $penduduk->$field ?? '') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                </select>
                            @elseif($field === 'status_perkawinan')
                                <select name="{{ $field }}" id="{{ $field }}" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500">
                                    <option value="Belum Menikah" {{ old($field, $migrasiKeluar->$field ?? $penduduk->$field ?? '') == 'Belum Menikah' ? 'selected' : '' }}>Belum Menikah</option>
                                    <option value="Menikah" {{ old($field, $migrasiKeluar->$field ?? $penduduk->$field ?? '') == 'Menikah' ? 'selected' : '' }}>Menikah</option>
                                    <option value="Cerai Hidup" {{ old($field, $migrasiKeluar->$field ?? $penduduk->$field ?? '') == 'Cerai Hidup' ? 'selected' : '' }}>Cerai Hidup</option>
                                    <option value="Cerai Mati" {{ old($field, $migrasiKeluar->$field ?? $penduduk->$field ?? '') == 'Cerai Mati' ? 'selected' : '' }}>Cerai Mati</option>
                                </select>
                            @elseif($field === 'jenis_pekerjaan')
                                <select name="{{ $field }}" id="{{ $field }}" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500">
                                    <option value="Tidak Bekerja" {{ old($field, $migrasiKeluar->$field ?? $penduduk->$field ?? '') == 'Tidak Bekerja' ? 'selected' : '' }}>Tidak Bekerja</option>
                                    <option value="PNS" {{ old($field, $migrasiKeluar->$field ?? $penduduk->$field ?? '') == 'PNS' ? 'selected' : '' }}>PNS</option>
                                    <option value="Swasta" {{ old($field, $migrasiKeluar->$field ?? $penduduk->$field ?? '') == 'Swasta' ? 'selected' : '' }}>Swasta</option>
                                    <option value="Wirausaha" {{ old($field, $migrasiKeluar->$field ?? $penduduk->$field ?? '') == 'Wirausaha' ? 'selected' : '' }}>Wirausaha</option>
                                    <option value="Lainnya" {{ old($field, $migrasiKeluar->$field ?? $penduduk->$field ?? '') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                </select>
                            @elseif($field === 'pendidikan_terakhir')
                                <select name="{{ $field }}" id="{{ $field }}" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500">
                                    <option value="AKADEMI/DIPLOMA III/S.MUDA" {{ old($field, $migrasiKeluar->$field ?? $penduduk->$field ?? '') == 'AKADEMI/DIPLOMA III/S.MUDA' ? 'selected' : '' }}>AKADEMI/DIPLOMA III/S.MUDA</option>
                                    <option value="BELUM TAMAT SD/SEDERAJAT" {{ old($field, $migrasiKeluar->$field ?? $penduduk->$field ?? '') == 'BELUM TAMAT SD/SEDERAJAT' ? 'selected' : '' }}>BELUM TAMAT SD/SEDERAJAT</option>
                                    <option value="DIPLOMA I/II" {{ old($field, $migrasiKeluar->$field ?? $penduduk->$field ?? '') == 'DIPLOMA I/II' ? 'selected' : '' }}>DIPLOMA I/II</option>
                                    <option value="DIPLOMA IV/STRATA I" {{ old($field, $migrasiKeluar->$field ?? $penduduk->$field ?? '') == 'DIPLOMA IV/STRATA I' ? 'selected' : '' }}>DIPLOMA IV/STRATA I</option>
                                    <option value="SLTA/SEDERAJAT" {{ old($field, $migrasiKeluar->$field ?? $penduduk->$field ?? '') == 'SLTA/SEDERAJAT' ? 'selected' : '' }}>SLTA/SEDERAJAT</option>
                                    <option value="STRATA II" {{ old($field, $migrasiKeluar->$field ?? $penduduk->$field ?? '') == 'STRATA II' ? 'selected' : '' }}>STRATA II</option>
                                    <option value="STRATA III" {{ old($field, $migrasiKeluar->$field ?? $penduduk->$field ?? '') == 'STRATA III' ? 'selected' : '' }}>STRATA III</option>
                                    <option value="TAMAT SD/SEDERAJAT" {{ old($field, $migrasiKeluar->$field ?? $penduduk->$field ?? '') == 'TAMAT SD/SEDERAJAT' ? 'selected' : '' }}>TAMAT SD/SEDERAJAT</option>
                                    <option value="TIDAK TAMAT SD/SEDERAJAT" {{ old($field, $migrasiKeluar->$field ?? $penduduk->$field ?? '') == 'TIDAK TAMAT SD/SEDERAJAT' ? 'selected' : '' }}>TIDAK TAMAT SD/SEDERAJAT</option>
                                    <option value="TIDAK/BELUM SEKOLAH" {{ old($field, $migrasiKeluar->$field ?? $penduduk->$field ?? '') == 'TIDAK/BELUM SEKOLAH' ? 'selected' : '' }}>TIDAK/BELUM SEKOLAH</option>
                                </select>
                            @elseif($field === 'rw')
                                <select name="{{ $field }}" id="{{ $field }}" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500">
                                    @if (Auth::user()->role->id === 1) <!-- Admin -->
                                        @foreach ($rws as $rw)
                                            <option value="{{ $rw->id }}" {{ old($field, $migrasiKeluar->$field ?? $penduduk->$field ?? '') == $rw->id ? 'selected' : '' }}>{{ $rw->rukun_warga }}</option>
                                        @endforeach
                                    @else <!-- RW -->
                                        <option value="{{ Auth::user()->rw->id }}" {{ old($field, $migrasiKeluar->$field ?? $penduduk->$field ?? '') == Auth::user()->rw->id ? 'selected' : '' }}>{{ Auth::user()->rw->rukun_warga }}</option>
                                    @endif
                                </select>
                            @elseif($field === 'status_kependudukan')
                                <input type="text" name="{{ $field }}" id="{{ $field }}" value="Keluar" readonly class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                            @else
                                <input type="{{ $field === 'tanggal_lahir' ? 'date' : 'text' }}" name="{{ $field }}" id="{{ $field }}" value="{{ old($field, $migrasiKeluar->$field ?? $penduduk->$field ?? '') }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" required>
                            @endif
                        </div>
                    @endforeach
                </div>
                <div class="mt-4 flex justify-between">
                    <a href="{{ route('resident-migration-out') }}" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">Kembali</a>
                    <button type="submit" onclick="{{ isset($migrasiKeluar) ? 'editConfirm(event, this)' : 'addConfirm(event, this)' }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        @if(isset($migrasiKeluar))
                            Update Data
                        @else
                            Simpan Data
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
            // Submit the form
            event.target.closest('form').submit();

            // Show success message
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

    function editConfirm(event, button) {
    event.preventDefault();
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
            // Submit the form
            event.target.closest('form').submit();

            // Show success message
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

    document.getElementById('nik').addEventListener('click', function() {
        if (this.readOnly) {
            document.getElementById('nik-warning').style.display = 'block';
            setTimeout(function() {
                document.getElementById('nik-warning').style.display = 'none';
            }, 3000);
        }
    });
</script>
@endsection