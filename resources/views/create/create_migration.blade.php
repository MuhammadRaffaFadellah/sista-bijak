@extends('layouts.master')

@section('dashboard-title')
    @if(isset($migrasi))
        Edit Data Migrasi
    @else
        Tambah Data Migrasi
    @endif
@endsection

@section('body')
    <div class="container mx-auto px-4 py-6">
        <div class="card shadow-lg rounded-lg overflow-hidden">
            <div class="bg-gray-800 text-white p-4">
                <h3 class="text-lg font-bold">
                    @if(isset($migrasi))
                        Edit Data Migrasi
                    @else
                        Tambah Data Migrasi
                    @endif
                </h3>
            </div>
            <div class="p-4">
                <form action="{{ isset($migrasi) ? route('migrasi.update', $migrasi->id) : route('migrasi.store') }}" method="POST">
                    @csrf
                    @if(isset($migrasi))
                        @method('PUT')
                    @endif
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="jenis_migrasi" class="block text-sm font-medium text-gray-700">Jenis Migrasi</label>
                            <select name="jenis_migrasi" id="jenis_migrasi" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500">
                                <option value="masuk" {{ (isset($migrasi) && $migrasi->jenis_migrasi == 'masuk') ? 'selected' : '' }}>Masuk</option>
                                <option value="keluar" {{ (isset($migrasi) && $migrasi->jenis_migrasi == 'keluar') ? 'selected' : '' }}>Keluar</option>
                            </select>
                        </div>
                        <div>
                            <label for="nama_kepala_keluarga" class="block text-sm font-medium text-gray-700">Nama Kepala Keluarga</label>
                            <input type="text" name="nama_kepala_keluarga" id="nama_kepala_keluarga" placeholder="Silakan masukkan nama kepala keluarga" value="{{ $migrasi->nama_kepala_keluarga ?? '' }}" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                        </div>
                        <div>
                            <label for="nik" class="block text-sm font-medium text-gray-700">NIK</label>
                            <input type="text" name="nik" id="nik" placeholder="Silakan masukkan NIK" value="{{ $migrasi->nik ?? '' }}" {{ isset($migrasi) ? 'readonly' : '' }} required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                            @if(isset($migrasi))
                                <span class="text-red-500 text-sm" id="nik-warning" style="display: none;">Tidak dapat mengubah NIK</span>
                            @endif
                        </div>
                        <div>
                            <label for="rw" class="block text-sm font-medium text-gray-700">RW</label>
                            <input type="text" name="rw" id="rw" placeholder="Silakan masukkan RW" value="{{ $migrasi->rw ?? '' }}" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                        </div>
                        <div>
                            <label for="rt" class="block text-sm font-medium text-gray-700">RT</label>
                            <input type="text" name="rt" id="rt" placeholder="Silakan masukkan RT" value="{{ $migrasi->rt ?? '' }}" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                        </div>
                    </div>
                    <div class="mt-6">
                        <h4 class="text-lg font-bold mb-4">Anggota Keluarga yang Migrasi</h4>
                        <div id="anggotaContainer">
                            @if(isset($migrasi))
                                @foreach($migrasi->anggotaMigrasi as $index => $anggota)
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                                        <div>
                                            <label for="anggota[{{ $index }}][nama]" class="block text-sm font-medium text-gray-700">Nama</label>
                                            <input type="text" name="anggota[{{ $index }}][nama]" id="anggota[{{ $index }}][nama]" placeholder="Silakan masukkan nama" value="{{ $anggota->nama }}" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                                        </div>
                                        <div>
                                            <label for="anggota[{{ $index }}][tempat_lahir]" class="block text-sm font-medium text-gray-700">Tempat Lahir</label>
                                            <input type="text" name="anggota[{{ $index }}][tempat_lahir]" id="anggota[{{ $index }}][tempat_lahir]" placeholder="Silakan masukkan tempat lahir" value="{{ $anggota->tempat_lahir }}" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                                        </div>
                                        <div>
                                            <label for="anggota[{{ $index }}][tanggal_lahir]" class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                                            <input type="date" name="anggota[{{ $index }}][tanggal_lahir]" id="anggota[{{ $index }}][tanggal_lahir]" value="{{ $anggota->tanggal_lahir }}" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                                        </div>
                                        <div>
                                            <label for="anggota[{{ $index }}][jenis_kelamin]" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                                            <select name="anggota[{{ $index }}][jenis_kelamin]" id="anggota[{{ $index }}][jenis_kelamin]" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500">
                                                <option value="LAKI-LAKI" {{ $anggota->jenis_kelamin == 'LAKI-LAKI' ? 'selected' : '' }}>LAKI-LAKI</option>
                                                <option value="PEREMPUAN" {{ $anggota->jenis_kelamin == 'PEREMPUAN' ? 'selected' : '' }}>PEREMPUAN</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label for="anggota[{{ $index }}][hubungan_dengan_kk]" class="block text-sm font-medium text-gray-700">Hubungan dengan KK</label>
                                            <input type="text" name="anggota[{{ $index }}][hubungan_dengan_kk]" id="anggota[{{ $index }}][hubungan_dengan_kk]" placeholder="Silakan masukkan hubungan dengan KK" value="{{ $anggota->hubungan_dengan_kk }}" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                                        </div>
                                        <div>
                                            <label for="anggota[{{ $index }}][pendidikan]" class="block text-sm font-medium text-gray-700">Pendidikan</label>
                                            <input type="text" name="anggota[{{ $index }}][pendidikan]" id="anggota[{{ $index }}][pendidikan]" placeholder="Silakan masukkan pendidikan" value="{{ $anggota->pendidikan }}" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                                        </div>
                                        <div>
                                            <label for="anggota[{{ $index }}][pekerjaan]" class="block text-sm font-medium text-gray-700">Pekerjaan</label>
                                            <input type="text" name="anggota[{{ $index }}][pekerjaan]" id="anggota[{{ $index }}][pekerjaan]" placeholder="Silakan masukkan pekerjaan" value="{{ $anggota->pekerjaan }}" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                                    <!-- Jika tidak ada data, form kosong -->
                                    <div>
                                        <label for="anggota[0][nama]" class="block text-sm font-medium text-gray-700">Nama</label>
                                        <input type="text" name="anggota[0][nama]" id="anggota[0][nama]" placeholder="Silakan masukkan nama" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                                    </div>
                                    <div>
                                        <label for="anggota[0][tempat_lahir]" class="block text-sm font-medium text-gray-700">Tempat Lahir</label>
                                        <input type="text" name="anggota[0][tempat_lahir]" id="anggota[0][tempat_lahir]" placeholder="Silakan masukkan tempat lahir" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                                    </div>
                                    <div>
                                        <label for="anggota[0][tanggal_lahir]" class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                                        <input type="date" name="anggota[0][tanggal_lahir]" id="anggota[0][tanggal_lahir]" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                                    </div>
                                    <div>
                                        <label for="anggota[0][jenis_kelamin]" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                                        <select name="anggota[0][jenis_kelamin]" id="anggota[0][jenis_kelamin]" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500">
                                            <option value="LAKI-LAKI">LAKI-LAKI</option>
                                            <option value="PEREMPUAN">PEREMPUAN</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label for="anggota[0][hubungan_dengan_kk]" class="block text-sm font-medium text-gray-700">Hubungan dengan KK</label>
                                        <input type="text" name="anggota[0][hubungan_dengan_kk]" id="anggota[0][hubungan_dengan_kk]" placeholder="Silakan masukkan hubungan dengan KK" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                                    </div>
                                    <div>
                                        <label for="anggota[0][pendidikan]" class="block text-sm font-medium text-gray-700">Pendidikan</label>
                                        <input type="text" name="anggota[0][pendidikan]" id="anggota[0][pendidikan]" placeholder="Silakan masukkan pendidikan" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                                    </div>
                                    <div>
                                        <label for="anggota[0][pekerjaan]" class="block text-sm font-medium text-gray-700">Pekerjaan</label>
                                        <input type="text" name="anggota[0][pekerjaan]" id="anggota[0][pekerjaan]" placeholder="Silakan masukkan pekerjaan" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                                    </div>
                                </div>
                            @endif
                        </div>

                        <button type="button" id="tambahAnggota" class="mt-4 px-4 py-2 bg-blue-500 text-white font-bold rounded">Tambah Anggota</button>
                    </div>
                    <div class="mt-6">
                        <button type="submit" class="px-6 py-2 bg-green-500 text-white font-bold rounded">
                            Simpan Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let anggotaIndex = 0;

            document.getElementById('tambahAnggota').addEventListener('click', function () {
                let anggotaContainer = document.getElementById('anggotaContainer');
                let newRow = `
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                        <div>
                            <label for="anggota[\${anggotaIndex}][nama]" class="block text-sm font-medium text-gray-700">Nama</label>
                            <input type="text" name="anggota[\${anggotaIndex}][nama]" id="anggota[\${anggotaIndex}][nama]" placeholder="Silakan masukkan nama" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                        </div>
                        <div>
                            <label for="anggota[\${anggotaIndex}][tempat_lahir]" class="block text-sm font-medium text-gray-700">Tempat Lahir</label>
                            <input type="text" name="anggota[\${anggotaIndex}][tempat_lahir]" id="anggota[\${anggotaIndex}][tempat_lahir]" placeholder="Silakan masukkan tempat lahir" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                        </div>
                        <div>
                            <label for="anggota[\${anggotaIndex}][tanggal_lahir]" class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                            <input type="date" name="anggota[\${anggotaIndex}][tanggal_lahir]" id="anggota[\${anggotaIndex}][tanggal_lahir]" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                        </div>
                        <div>
                            <label for="anggota[\${anggotaIndex}][jenis_kelamin]" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                            <select name="anggota[\${anggotaIndex}][jenis_kelamin]" id="anggota[\${anggotaIndex}][jenis_kelamin]" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500">
                                <option value="LAKI-LAKI">LAKI-LAKI</option>
                                <option value="PEREMPUAN">PEREMPUAN</option>
                            </select>
                        </div>
                        <div>
                            <label for="anggota[\${anggotaIndex}][hubungan_dengan_kk]" class="block text-sm font-medium text-gray-700">Hubungan dengan KK</label>
                            <input type="text" name="anggota[\${anggotaIndex}][hubungan_dengan_kk]" id="anggota[\${anggotaIndex}][hubungan_dengan_kk]" placeholder="Silakan masukkan hubungan dengan KK" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                        </div>
                        <div>
                            <label for="anggota[\${anggotaIndex}][pendidikan]" class="block text-sm font-medium text-gray-700">Pendidikan</label>
                            <input type="text" name="anggota[\${anggotaIndex}][pendidikan]" id="anggota[\${anggotaIndex}][pendidikan]" placeholder="Silakan masukkan pendidikan" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                        </div>
                        <div>
                            <label for="anggota[\${anggotaIndex}][pekerjaan]" class="block text-sm font-medium text-gray-700">Pekerjaan</label>
                            <input type="text" name="anggota[\${anggotaIndex}][pekerjaan]" id="anggota[\${anggotaIndex}][pekerjaan]" placeholder="Silakan masukkan pekerjaan" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                        </div>
                    </div>
                `;
                anggotaContainer.insertAdjacentHTML('beforeend', newRow);
                anggotaIndex++;
            });
        });
    </script>
@endsection