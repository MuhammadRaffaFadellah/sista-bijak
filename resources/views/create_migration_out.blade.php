@extends('layouts.master')

@section('dashboard-title')
    Sista Bijak - Edit Data Migrasi Keluar
@endsection

@section('body')
<div class="container mx-auto px-4 py-6">
    <div class="card shadow-lg rounded-lg overflow-hidden">
        <div class="bg-gray-800 text-white p-4">
            <h3 class="text-lg font-bold">Edit Data Migrasi Keluar</h3>
        </div>
        <div class="p-4">
            <form action="{{ isset($migrasiKeluar) ? route('migrasikeluar.update', $migrasiKeluar->id) : route('migrasikeluar.store') }}" method="POST">
                @csrf
                @if(isset($migrasiKeluar))
                    @method('PUT')
                @endif
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach(['nik', 'nama_lengkap', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir', 'status_hubkel', 'pendidikan_terakhir', 'jenis_pekerjaan', 'agama', 'status_perkawinan', 'alamat', 'rw', 'rt', 'kelurahan', 'status_kependudukan'] as $field)
                        <div>
                            <label for="{{ $field }}" class="block text-sm font-medium text-gray-700">{{ ucwords(str_replace('_', ' ', $field)) }}</label>
                            @if($field === 'nik')
                                <input type="text" name="{{ $field }}" id="{{ $field }}" value="{{ old($field, $migrasiKeluar->$field) }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" readonly />
                                <span class="text-red-500 text-sm" id="nik-warning" style="display: none;">Tidak dapat merubah NIK</span>
                            @elseif($field === 'jenis_kelamin')
                                <select name="{{ $field }}" id="{{ $field }}" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500">
                                    <option value="Laki-laki" {{ old($field, $migrasiKeluar->$field) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="Perempuan" {{ old($field, $migrasiKeluar->$field) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            @elseif($field === 'agama')
                                <select name="{{ $field }}" id="{{ $field }}" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500">
                                    <option value="Islam" {{ old($field, $migrasiKeluar->$field) == 'Islam' ? 'selected' : '' }}>Islam</option>
                                    <option value="Kristen" {{ old($field, $migrasiKeluar->$field) == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                    <option value="Hindu" {{ old($field, $migrasiKeluar->$field) == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                    <option value="Buddha" {{ old($field, $migrasiKeluar->$field) == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                    <option value="Konghucu" {{ old($field, $migrasiKeluar->$field) == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                                </select>
                            @elseif($field === 'status_hubkel')
                                <select name="{{ $field }}" id="{{ $field }}" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500">
                                    <option value="Kepala Keluarga" {{ old($field, $migrasiKeluar->$field) == 'Kepala Keluarga' ? 'selected' : '' }}>Kepala Keluarga</option>
                                    <option value="Istri" {{ old($field, $migrasiKeluar->$field) == 'Istri' ? 'selected' : '' }}>Istri</option>
                                    <option value="Anak" {{ old($field, $migrasiKeluar->$field) == 'Anak' ? 'selected' : '' }}>Anak</option>
                                    <option value="Famili Lain" {{ old($field, $migrasiKeluar->$field) == 'Famili Lain' ? 'selected' : '' }}>Famili Lain</option>
                                    <option value="Sepupu" {{ old($field, $migrasiKeluar->$field) == 'Sepupu' ? 'selected' : '' }}>Sepupu</option>
                                    <option value="Mertua" {{ old($field, $migrasiKeluar->$field) == 'Mertua' ? 'selected' : '' }}>Mertua</option>
                                    <option value="Orang Tua" {{ old($field, $migrasiKeluar->$field) == 'Orang Tua' ? 'selected' : '' }}>Orang Tua</option>
                                    <option value="Cucu" {{ old($field, $migrasiKeluar->$field) == 'Cucu' ? 'selected' : '' }}>Cucu</option>
                                    <option value="Pembantu" {{ old($field, $migrasiKeluar->$field) == 'Pembantu' ? 'selected' : '' }}>Pembantu</option>
                                    <option value="Lainnya" {{ old($field, $migrasiKeluar->$field) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                </select>
                            @elseif($field === 'status_perkawinan')
                                <select name="{{ $field }}" id="{{ $field }}" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500">
                                    <option value="Belum Menikah" {{ old($field, $migrasiKeluar->$field) == 'Belum Menikah' ? 'selected' : '' }}>Belum Menikah</option>
                                    <option value="Menikah" {{ old($field, $migrasiKeluar->$field) == 'Menikah' ? 'selected' : '' }}>Menikah</option>
                                    <option value="Cerai Hidup" {{ old($field, $migrasiKeluar->$field) == 'Cerai Hidup' ? 'selected' : '' }}>Cerai Hidup</option>
                                    <option value="Cerai Mati" {{ old($field, $migrasiKeluar->$field) == 'Cerai Mati' ? 'selected' : '' }}>Cerai Mati</option>
                                </select>
                            @elseif($field === 'jenis_pekerjaan')
                                <select name="{{ $field }}" id="{{ $field }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500">
                                    <option value="Tidak Bekerja" {{ old($field, $migrasiKeluar->$field) == 'Tidak Bekerja' ? 'selected' : '' }}>Tidak Bekerja</option>
                                    <option value="PNS" {{ old($field, $migrasiKeluar->$field) == 'PNS' ? 'selected' : '' }}>PNS</option>
                                    <option value="Swasta" {{ old($field, $migrasiKeluar->$field) == 'Swasta' ? 'selected' : '' }}>Swasta</option>
                                    <option value="Wirausaha" {{ old($field, $migrasiKeluar->$field) == 'Wirausaha' ? 'selected' : '' }}>Wirausaha</option>
                                    <option value="Lainnya" {{ old($field, $migrasiKeluar->$field) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                </select>
                            @elseif($field === 'pendidikan_terakhir')
                                <select name="{{ $field }}" id="{{ $field }}" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500">
                                    <option value="AKADEMI/DIPLOMA III/S.MUDA" {{ old($field, $migrasiKeluar->$field) == 'AKADEMI/DIPLOMA III/S.MUDA' ? 'selected' : '' }}>AKADEMI/DIPLOMA III/S.MUDA</option>
                                    <option value="BELUM TAMAT SD/SEDERAJAT" {{ old($field, $migrasiKeluar->$field) == 'BELUM TAMAT SD/SEDERAJAT' ? 'selected' : '' }}>BELUM TAMAT SD/SEDERAJAT</option>
                                    <option value="DIPLOMA I/II" {{ old($field, $migrasiKeluar->$field) == 'DIPLOMA I/II' ? 'selected' : '' }}>DIPLOMA I/II</option>
                                    <option value="DIPLOMA IV/STRATA I" {{ old($field, $migrasiKeluar->$field) == 'DIPLOMA IV/STRATA I' ? 'selected' : '' }}>DIPLOMA IV/STRATA I</option>
                                    <option value="SLTA/SEDERAJAT" {{ old($field, $migrasiKeluar->$field) == 'SLTA/SEDERAJAT' ? 'selected' : '' }}>SLTA/SEDERAJAT</option>
                                    <option value="STRATA II" {{ old($field, $migrasiKeluar->$field) == 'STRATA II' ? 'selected' : '' }}>STRATA II</option>
                                    <option value="STRATA III" {{ old($field, $migrasiKeluar->$field) == 'STRATA III' ? 'selected' : '' }}>STRATA III</option>
                                    <option value="TAMAT SD/SEDERAJAT" {{ old($field, $migrasiKeluar->$field) == 'TAMAT SD/SEDERAJAT' ? 'selected' : '' }}>TAMAT SD/SEDERAJAT</option>
                                    <option value="TIDAK TAMAT SD/SEDERAJAT" {{ old($field, $migrasiKeluar->$field) == 'TIDAK TAMAT SD/SEDERAJAT' ? 'selected' : '' }}>TIDAK TAMAT SD/SEDERAJAT</option>
                                    <option value="TIDAK/BELUM SEKOLAH" {{ old($field, $migrasiKeluar->$field) == 'TIDAK/BELUM SEKOLAH' ? 'selected' : '' }}>TIDAK/BELUM SEKOLAH</option>
                                </select>
                            @elseif($field === 'rw')
                                <select name="{{ $field }}" id="{{ $field }}" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500">
                                    @if (Auth::user()->role->id === 1) <!-- Admin -->
                                        @foreach ($rws as $rw)
                                            <option value="{{ $rw->id }}" {{ old($field, $migrasiKeluar->$field) == $rw->id ? 'selected' : '' }}>{{ $rw->rukun_warga }}</option>
                                        @endforeach
                                    @else <!-- RW -->
                                        <option value="{{ Auth::user()->rw->id }}" {{ old($field, $migrasiKeluar->$field) == Auth::user()->rw->id ? 'selected' : '' }}>{{ Auth::user()->rw->rukun_warga }}</option>
                                    @endif
                                </select>
                            @elseif($field === 'kelurahan')
                                <input type="text" name="{{ $field }}" id="{{ $field }}" value="Kesambi" readonly class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                            @elseif($field === 'status_kependudukan')
                                <input type="text" name="{{ $field }}" id="{{ $field }}" value="Keluar" readonly class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                            @else
                                <input type="{{ $field === 'tanggal_lahir' ? 'date' : 'text' }}" name="{{ $field }}" id="{{ $field }}" value="{{ old($field, $migrasiKeluar->$field) }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" required>
                            @endif
                        </div>
                    @endforeach
                </div>
                <div class="mt-4 flex justify-between">
                    <a href="{{ route('resident-migration-out') }}" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">Kembali</a>
                    <button type="submit" onclick="editConfirm(event)" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
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
    function editConfirm(event) {
        event.preventDefault(); // Mencegah submit form secara default
        Swal.fire({
            title: "Apakah kamu yakin?",
            text: "Apakah kamu ingin menyimpan perubahan?",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, Simpan",
            cancelButtonText: "Tidak"
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: "Berhasil!",
                    text: "Perubahan berhasil disimpan",
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