@extends('layouts.master')

@section('dashboard-title')
    @if (isset($penduduk))
        Sista Bijak - Edit Data Penduduk
    @else
        Sista Bijak - Tambah Data Penduduk
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
            <div class="p-4">
                <form action="{{ isset($penduduk) ? route('penduduk.update', $penduduk->id) : route('penduduk.store') }}"
                    method="POST">
                    @csrf
                    @if (isset($penduduk))
                        @method('PUT')
                    @endif
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="nik" class="block text-sm font-medium text-gray-700">NIK</label>
                            @if (isset($penduduk))
                                <input type="text" name="nik" id="nik" value="{{ $penduduk->nik }}" readonly
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                                <span class="text-red-500 text-sm" id="nik-warning" style="display: none;">Tidak dapat
                                    merubah NIK</span>
                            @else
                                <input type="text" name="nik" id="nik" placeholder="Silakan masukkan NIK"
                                    required
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                            @endif
                        </div>
                        <div>
                            <label for="nama_lengkap" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" id="nama_lengkap"
                                placeholder="Silakan masukkan nama lengkap" value="{{ $penduduk->nama_lengkap ?? '' }}"
                                required
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                        </div>
                        <div>
                            <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                            <select name="jenis_kelamin" id="jenis_kelamin" required
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500">
                                <option value="LAKI-LAKI"
                                    {{ isset($penduduk) && $penduduk->jenis_kelamin == 'LAKI-LAKI' ? 'selected' : '' }}>
                                    LAKI-LAKI</option>
                                <option value="PEREMPUAN"
                                    {{ isset($penduduk) && $penduduk->jenis_kelamin == 'PEREMPUAN' ? 'selected' : '' }}>
                                    PEREMPUAN</option>
                            </select>
                        </div>
                        <div>
                            <label for="tempat_lahir" class="block text-sm font-medium text-gray-700">Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" id="tempat_lahir"
                                placeholder="Silakan masukkan tempat lahir" value="{{ $penduduk->tempat_lahir ?? '' }}"
                                required
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                        </div>
                        <div>
                            <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" id="tanggal_lahir"
                                value="{{ $penduduk->tanggal_lahir ?? '' }}" required
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                        </div>
                        <div>
                            <label for="status_hubkel" class="block text-sm font-medium text-gray-700">Status Hubungan
                                Keluarga</label>
                            <select name="status_hubkel" id="status_hubkel" required
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500">
                                @foreach ($hubkelOptions as $option)
                                    <option value="{{ $option }}"
                                        {{ isset($penduduk) && $penduduk->status_hubkel == $option ? 'selected' : '' }}>
                                        {{ $option }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="pendidikan_terakhir" class="block text-sm font-medium text-gray-700">Pendidikan
                                Terakhir</label>
                            <select name="pendidikan_terakhir" id="pendidikan_terakhir" required
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500">
                                @foreach ($pendidikanOptions as $option)
                                    <option value="{{ $option }}"
                                        {{ isset($penduduk) && $penduduk->pendidikan_terakhir == $option ? 'selected' : '' }}>
                                        {{ $option }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="jenis_pekerjaan" class="block text-sm font-medium text-gray-700">Jenis
                                Pekerjaan</label>
                            <input type="text" name="jenis_pekerjaan" id="jenis_pekerjaan"
                                placeholder="Silakan masukkan jenis pekerjaan"
                                value="{{ $penduduk->jenis_pekerjaan ?? '' }}"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                        </div>
                        <div>
                            <label for="agama" class="block text-sm font-medium text-gray-700">Agama</label>
                            <select name="agama" id="agama" required
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500">
                                @foreach ($agamaOptions as $option)
                                    <option value="{{ $option }}"
                                        {{ isset($penduduk) && $penduduk->agama == $option ? 'selected' : '' }}>
                                        {{ $option }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="status_perkawinan" class="block text-sm font-medium text-gray-700">Status
                                Perkawinan</label>
                            <select name="status_perkawinan" id="status_perkawinan" required
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500">
                                @foreach ($statusOptions as $option)
                                    <option value="{{ $option }}"
                                        {{ isset($penduduk) && $penduduk->status_perkawinan == $option ? 'selected' : '' }}>
                                        {{ $option }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                            <input type="text" name="alamat" id="alamat" placeholder="Silakan masukkan alamat"
                                value="{{ $penduduk->alamat ?? '' }}" required
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                        </div>
                        <div>
                            <label for="rw" class="block text-sm font-medium text-gray-700">RW</label>
                            <input type="text" name="rw" id="rw" placeholder="Silakan masukkan RW"
                                value="{{ $penduduk->rw ?? '' }}" required
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                        </div>
                        <div>
                            <label for="rt" class="block text-sm font-medium text-gray-700">RT</label>
                            <input type="text" name="rt" id="rt" placeholder="Silakan masukkan RT"
                                value="{{ $penduduk->rt ?? '' }}" required
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                        </div>
                        <div>
                            <label for="kelurahan" class="block text-sm font-medium text-gray-700">Kelurahan</label>
                            <select name="kelurahan" id="kelurahan" required
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500">
                                <option value="Kesambi"
                                    {{ isset($penduduk) && $penduduk->kelurahan == 'Kesambi' ? 'selected' : '' }}>KESAMBI
                                </option>
                            </select>
                        </div>
                        <div>
                            <label for="status_kependudukan" class="block text-sm font-medium text-gray-700">Status
                                Kependudukan</label>
                            <select name="status_kependudukan" id="status_kependudukan" required
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500">
                                @foreach ($statusKependudukanOptions as $option)
                                    <option value="{{ $option }}"
                                        {{ isset($penduduk) && $penduduk->status_kependudukan == $option ? 'selected' : '' }}>
                                        {{ $option }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mt-4 flex justify-between">
                        <a href="{{ route('resident.table') }}"
                            class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Kembali</a>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"
                            onclick="editConfirm(event)">
                            @if (isset($penduduk))
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
    @include("sweetalert")
    <script>
        function editConfirm(event) {
            event.preventDefault(); // Mencegah submit form secara default
            Swal.fire({
                title: "Apakah kamu yakin?",
                text: "Apakah kamu ingin menyimpan perubahan?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, simpan perubahan!",
                cancelButtonText: "Tidak, batalkan"
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "Berhasil!",
                        text: "User berhasil diubah.",
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
