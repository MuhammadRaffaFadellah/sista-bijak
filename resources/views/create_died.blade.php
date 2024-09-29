@extends('layouts.master')

@section('dashboard-title')
    @if (isset($meninggal))
        Sista Bijak - Edit Data Meninggal
    @else
        Sista Bijak - Tambah Data Meninggal
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
                        <div>
                            <label for="nama_kepala_keluarga" class="block text-sm font-medium text-gray-700">Nama Kepala
                                Keluarga</label>
                            <input type="text" name="nama_kepala_keluarga" id="nama_kepala_keluarga"
                                placeholder="Silakan masukkan nama kepala keluarga"
                                value="{{ $meninggal->nama_kepala_keluarga ?? '' }}" required
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                        </div>
                        <div>
                            <label for="nik" class="block text-sm font-medium text-gray-700">NIK</label>
                            @if (isset($meninggal))
                                <input type="text" name="nik" id="nik" value="{{ $meninggal->nik }}" readonly
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                                <span class="text-red-500 text-sm" id="nik-warning" style="display: none;">Tidak dapat
                                    mengubah NIK</span>
                            @else
                                <input type="text" name="nik" id="nik" placeholder="Silakan masukkan NIK"
                                    required
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                            @endif
                        </div>
                        <div>
                            <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                            <input type="text" name="alamat" id="alamat" placeholder="Silakan masukkan alamat"
                                value="{{ $meninggal->alamat ?? '' }}" required
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                        </div>
                        <div>
                        <label for="rw" class="block text-sm font-medium text-gray-700">RW</label>
                        <select name="rw" id="rw" required
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500">
                            <option value="1" {{ (isset($meninggal) && $meninggal->rw == '1') ? 'selected' : '' }}>1</option>
                            <option value="2" {{ (isset($meninggal) && $meninggal->rw == '2') ? 'selected' : '' }}>2</option>
                            <option value="3" {{ (isset($meninggal) && $meninggal->rw == '3') ? 'selected' : '' }}>3</option>
                            <option value="4" {{ (isset($meninggal) && $meninggal->rw == '4') ? 'selected' : '' }}>4</option>
                            <option value="5" {{ (isset($meninggal) && $meninggal->rw == '5') ? 'selected' : '' }}>5</option>
                            <option value="6" {{ (isset($meninggal) && $meninggal->rw == '6') ? 'selected' : '' }}>6</option>
                            <option value="7" {{ (isset($meninggal) && $meninggal->rw == '7') ? 'selected' : '' }}>7</option>
                        </select>
                    </div>
                        <div>
                            <label for="rt" class="block text-sm font-medium text-gray-700">RT</label>
                            <input type="text" name="rt" id="rt" placeholder="Silakan masukkan RT"
                                value="{{ $meninggal->rt ?? '' }}" required
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                        </div>
                        <div>
                            <label for="nama_almarhum" class="block text-sm font-medium text-gray-700">Nama
                                Almarhum/Almarhumah</label>
                            <input type="text" name="nama_almarhum" id="nama_almarhum"
                                placeholder="Silakan masukkan nama almarhum/almarhumah"
                                value="{{ $meninggal->nama_almarhum ?? '' }}" required
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                        </div>
                        <div>
                            <label for="hubungan_dengan_kk" class="block text-sm font-medium text-gray-700">Hubungan dengan
                                KK</label>
                            <input type="text" name="hubungan_dengan_kk" id="hubungan_dengan_kk"
                                placeholder="Silakan masukkan hubungan dengan KK"
                                value="{{ $meninggal->hubungan_dengan_kk ?? '' }}" required
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                        </div>
                        <div>
                            <label for="tempat_lahir" class="block text-sm font-medium text-gray-700">Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" id="tempat_lahir"
                                placeholder="Silakan masukkan tempat lahir" value="{{ $meninggal->tempat_lahir ?? '' }}"
                                required
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                        </div>
                        <div>
                            <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" id="tanggal_lahir"
                                value="{{ $meninggal->tanggal_lahir ?? '' }}" required
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                        </div>
                        <div>
                            <label for="tempat_meninggal" class="block text-sm font-medium text-gray-700">Tempat
                                Meninggal</label>
                            <input type="text" name="tempat_meninggal" id="tempat_meninggal"
                                placeholder="Silakan masukkan tempat meninggal"
                                value="{{ $meninggal->tempat_meninggal ?? '' }}" required
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                        </div>
                        <div>
                            <label for="tanggal_meninggal" class="block text-sm font-medium text-gray-700">Tanggal
                                Meninggal</label>
                            <input type="date" name="tanggal_meninggal" id="tanggal_meninggal"
                                value="{{ $meninggal->tanggal_meninggal ?? '' }}" required
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                        </div>
                        <div>
                            <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700">Jenis
                                Kelamin</label>
                            <select name="jenis_kelamin" id="jenis_kelamin" required
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500">
                                <option value="LAKI-LAKI"
                                    {{ isset($meninggal) && $meninggal->jenis_kelamin == 'LAKI-LAKI' ? 'selected' : '' }}>
                                    LAKI-LAKI</option>
                                <option value="PEREMPUAN"
                                    {{ isset($meninggal) && $meninggal->jenis_kelamin == 'PEREMPUAN' ? 'selected' : '' }}>
                                    PEREMPUAN</option>
                            </select>
                        </div>
                        <div>
                            <label for="status_kependudukan" class="block text-sm font-medium text-gray-700">Status
                                Kependudukan</label>
                            <select name="status_kependudukan" id="status_kependudukan" required
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500">
                                <option value="MENINGGAL"
                                    {{ isset($meninggal) && $meninggal->status_kependudukan == 'MENINGGAL' ? 'selected' : '' }}>
                                    MENINGGAL</option>
                            </select>
                        </div>
                    </div>
                    <div class="mt-4 flex justify-between">
                        <a href="{{ route('resident-died') }}"
                            class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Kembali</a>
                        <button type="submit" onclick="editConfirm(event, this)"
                            class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                            @if (isset($meninggal))
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
        document.getElementById('nik').addEventListener('click', function() {
            if (this.readOnly) {
                document.getElementById('nik-warning').style.display = 'block';
                setTimeout(function() {
                    document.getElementById('nik-warning').style.display = 'none';
                }, 3000);
            }
        });

        function editConfirm(event, button) {
            event.preventDefault(); // Mencegah form submit secara langsung
            Swal.fire({
                title: "Simpan?",
                text: "Periksa ulang perubahan jika ragu!",
                icon: "question", // Perbaiki ikon dengan tanda koma
                confirmButtonText: "Ya, Simpan",
                confirmButtonColor: "#3085d6",
                cancelButtonText: "Tidak",
                cancelButtonColor: "#d33",
                showCancelButton: true // Menampilkan tombol batal
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika pengguna menekan tombol "Ya, Simpan", submit form
                    button.closest('form').submit();
                }
            });
        }
    </script>
@endsection
