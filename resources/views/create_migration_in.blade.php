@extends('layouts.master')

@section('dashboard-title')
    Sista Bijak - Edit Data Migrasi Masuk
@endsection

@section('body')
<div class="container mx-auto px-4 py-6">
    <div class="card shadow-lg rounded-lg overflow-hidden">
        <div class="bg-gray-800 text-white p-4">
            <h3 class="text-lg font-bold">Edit Data Migrasi Masuk</h3>
        </div>
        <div class="p-4">
    <form action="{{ isset($migrasiMasuk) ? route('migrasimasuk.update', $migrasiMasuk->id) : route('migrasimasuk.store') }}" method="POST">
        @csrf
        @if(isset($migrasiMasuk))
            @method('PUT')
        @endif
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach(['nik', 'nama_lengkap', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir', 'status_hubkel', 'pendidikan_terakhir', 'jenis_pekerjaan', 'agama', 'status_perkawinan', 'alamat', 'rw', 'rt', 'kelurahan', 'status_kependudukan'] as $field)
                <div>
                    <label for="{{ $field }}" class="block text-sm font-medium text-gray-700">{{ ucwords(str_replace('_', ' ', $field)) }}</label>
                    @if($field === 'nik')
                        <input type="text" name="{{ $field }}" id="{{ $field }}" value="{{ old($field, $migrasiMasuk->$field) }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" readonly />
                        <span class="text-red-500 text-sm" id="nik-warning" style="display: none;">Tidak dapat merubah NIK</span>
                    @elseif($field === 'jenis_kelamin')
                        <select name="{{ $field }}" id="{{ $field }}" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500">
                            <option value="Laki-laki" {{ old($field, $migrasiMasuk->$field) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ old($field, $migrasiMasuk->$field) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    @elseif($field === 'agama')
                        <select name="{{ $field }}" id="{{ $field }}" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500">
                            <option value="Islam" {{ old($field, $migrasiMasuk->$field) == 'Islam' ? 'selected' : '' }}>Islam</option>
                            <option value="Kristen" {{ old($field, $migrasiMasuk->$field) == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                            <option value="Hindu" {{ old($field, $migrasiMasuk->$field) == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                            <option value="Buddha" {{ old($field, $migrasiMasuk->$field) == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                            <option value="Konghucu" {{ old($field, $migrasiMasuk->$field) == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                        </select>
                    @elseif($field === 'status_hubkel')
                        <select name="{{ $field }}" id="{{ $field }}" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500">
                            <option value="Kepala Keluarga" {{ old($field, $migrasiMasuk->$field) == 'Kepala Keluarga' ? 'selected' : '' }}>Kepala Keluarga</option>
                            <option value="Istri" {{ old($field, $migrasiMasuk->$field) == 'Istri' ? 'selected' : '' }}>Istri</option>
                            <option value="Anak" {{ old($field, $migrasiMasuk->$field) == 'Anak' ? 'selected' : '' }}>Anak</option>
                            <option value="Famili Lain" {{ old($field, $migrasiMasuk->$field) == 'Famili Lain' ? 'selected' : '' }}>Famili Lain</option>
                            <option value="Sepupu" {{ old($field, $migrasiMasuk->$field) == 'Sepupu' ? 'selected' : '' }}>Sepupu</option>
                            <option value="Mertua" {{ old($field, $migrasiMasuk->$field) == 'Mertua' ? 'selected' : '' }}>Mertua</option>
                            <option value="Orang Tua" {{ old($field, $migrasiMasuk->$field) == 'Orang Tua' ? 'selected' : '' }}>Orang Tua</option>
                            <option value="Cucu" {{ old($field, $migrasiMasuk->$field) == 'Cucu' ? 'selected' : '' }}>Cucu</option>
                            <option value="Pembantu" {{ old($field, $migrasiMasuk->$field) == 'Pembantu' ? 'selected' : '' }}>Pembantu</option>
                            <option value="Lainnya" {{ old($field, $migrasiMasuk->$field) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                    @elseif($field === 'status_perkawinan')
                        <select name="{{ $field }}" id="{{ $field }}" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500">
                            <option value="Belum Menikah" {{ old($field, $migrasiMasuk->$field) == 'Belum Menikah' ? 'selected' : '' }}>Belum Menikah</option>
                            <option value="Menikah" {{ old($field, $migrasiMasuk->$field) == 'Menikah' ? 'selected' : '' }}>Menikah</option>
                            <option value="Cerai Hidup" {{ old($field, $migrasiMasuk->$field) == 'Cerai Hidup' ? 'selected' : '' }}>Cerai Hidup</option>
                            <option value="Cerai Mati" {{ old($field, $migrasiMasuk->$field) == 'Cerai Mati' ? 'selected' : '' }}>Cerai Mati</option>
                        </select>
                    @elseif($field === 'jenis_pekerjaan')
                        <select name="{{ $field }}" id="{{ $field }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500">
                            <option value="Tidak Bekerja" {{ old($field, $migrasiMasuk->$field) == 'Tidak Bekerja' ? 'selected' : '' }}>Tidak Bekerja</option>
                            <option value="PNS" {{ old($field, $migrasiMasuk->$field) == 'PNS' ? 'selected' : '' }}>PNS</option>
                            <option value="Swasta" {{ old($field, $migrasiMasuk->$field) == 'Swasta' ? 'selected' : '' }}>Swasta</option>
                            <option value="Wirausaha" {{ old($field, $migrasiMasuk->$field) == 'Wirausaha' ? 'selected' : '' }}>Wirausaha</option>
                            <option value="Lainnya" {{ old($field, $migrasiMasuk->$field) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                    @elseif($field === 'pendidikan_terakhir')
                        <select name="{{ $field }}" id="{{ $field }}" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500">
                            <option value="AKADEMI/DIPLOMA III/S.MUDA" {{ old($field, $migrasiMasuk->$field) == 'AKADEMI/DIPLOMA III/S.MUDA' ? 'selected' : '' }}>AKADEMI/DIPLOMA III/S.MUDA</option>
                            <option value="BELUM TAMAT SD/SEDERAJAT" {{ old($field, $migrasiMasuk->$field) == 'BELUM TAMAT SD/SEDERAJAT' ? 'selected' : '' }}>BELUM TAMAT SD/SEDERAJAT</option>
                            <option value="DIPLOMA I/II" {{ old($field, $migrasiMasuk->$field) == 'DIPLOMA I/II' ? 'selected' : '' }}>DIPLOMA I/II</option>
                            <option value="DIPLOMA IV/STRATA I" {{ old($field, $migrasiMasuk->$field) == 'DIPLOMA IV/STRATA I' ? 'selected' : '' }}>DIPLOMA IV/STRATA I</option>
                            <option value="SLTA/SEDERAJAT" {{ old($field, $migrasiMasuk->$field) == 'SLTA/SEDERAJAT' ? 'selected' : '' }}>SLTA/SEDERAJAT</option>
                            <option value="STRATA II" {{ old($field, $migrasiMasuk->$field) == 'STRATA II' ? 'selected' : '' }}>STRATA II</option>
                            <option value="STRATA III" {{ old($field, $migrasiMasuk->$field) == 'STRATA III' ? 'selected' : '' }}>STRATA III</option>
                            <option value="TAMAT SD/SEDERAJAT" {{ old($field, $migrasiMasuk->$field) == 'TAMAT SD/SEDERAJAT' ? 'selected' : '' }}>TAMAT SD/SEDERAJAT</option>
                            <option value="TIDAK TAMAT SD/SEDERAJAT" {{ old($field, $migrasiMasuk->$field) == 'TIDAK TAMAT SD/SEDERAJAT' ? 'selected' : '' }}>TIDAK TAMAT SD/SEDERAJAT</option>
                            <option value="TIDAK/BELUM SEKOLAH" {{ old($field, $migrasiMasuk->$field) == 'TIDAK/BELUM SEKOLAH' ? 'selected' : '' }}>TIDAK/BELUM SEKOLAH</option>
                        </select>
                    @elseif($field === 'rw')
                        <select name="{{ $field }}" id="{{ $field }}" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500">
                            @if (Auth::user()->role->id === 1) <!-- Admin -->
                                @foreach ($rws as $rw)
                                    <option value="{{ $rw->id }}" {{ old($field, $migrasiMasuk->$field) == $rw->id ? 'selected' : '' }}>{{ $rw->rukun_warga }}</option>
                                @endforeach
                            @else <!-- RW -->
                                <option value="{{ Auth::user()->rw->id }}" {{ old($field, $migrasiMasuk->$field) == Auth::user()->rw->id ? 'selected' : '' }}>{{ Auth::user()->rw->rukun_warga }}</option>
                            @endif
                        </select>
                    @elseif($field === 'kelurahan')
                        <input type="text" name="{{ $field }}" id="{{ $field }}" value="Kesambi" readonly class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                    @elseif($field === 'status_kependudukan')
                        <input type="text" name="{{ $field }}" id="{{ $field }}" value="Masuk" readonly class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                    @else
                        <input type="{{ $field === 'tanggal_lahir' ? 'date' : 'text' }}" name="{{ $field }}" id="{{ $field }}" value="{{ old($field, $migrasiMasuk->$field) }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" required>
                    @endif
                </div>
            @endforeach
        </div>
        <div class="mt-4 flex justify-between">
            <a href="{{ route('resident-migration-in') }}" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">Kembali</a>
            <button type="submit" onclick="editConfirm(event)" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                @if(isset($migrasiMasuk))
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