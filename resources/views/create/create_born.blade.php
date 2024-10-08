@extends('layouts.master')

@section('dashboard-title')
    @if(isset($lahir))
        Sista Bijak - Edit Data Lahir
    @else
        Sista Bijak - Tambah Data Lahir
    @endif
@endsection
@section('body')
    <div class="container mx-auto px-4 py-6">
        <div class="card shadow-lg rounded-lg overflow-hidden">
            <div class="bg-gray-800 text-white p-4">
                <h3 class="text-lg font-bold">
                    @if(isset($lahir))
                        Edit Data Lahir
                    @else
                        Tambah Data Lahir
                    @endif
                </h3>
            </div>
            <div class="p-4">
                <form action="{{ isset($lahir) ? route('lahir.update', $lahir->id) : route('lahir.store') }}" method="POST">
                    @csrf
                    @if(isset($lahir))
                        @method('PUT')
                    @endif
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="nik" class="block text-sm font-medium text-gray-700">NIK</label>
                            @if(isset($lahir))
                                <input type="text" name="nik" id="nik" value="{{ $lahir->nik }}" readonly class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500"/>
                                <span class="text-red-500 text-sm" id="nik-warning" style="display: none;">Tidak dapat merubah NIK</span>
                            @else
                                <input type="text" name="nik" id="nik" placeholder="Silakan masukkan NIK" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" oninput="this.value = this.value.slice(0, 16)" />
                            @endif
                        </div>
                        <div>
                            <label for="nama_kepala_keluarga" class="block text-sm font-medium text-gray-700">Nama Kepala Keluarga</label>
                            <input type="text" name="nama_kepala_keluarga" id="nama_kepala_keluarga" placeholder="Silakan masukkan nama kepala keluarga" value="{{ $lahir->nama_kepala_keluarga ?? '' }}" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                        </div>
                        <div>
                            <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                            <input type="text" name="alamat" id="alamat" placeholder="Silakan masukkan alamat" value="{{ $lahir->alamat ?? '' }}" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                        </div>
                        <div>
                        <label for="rw" class="block text-sm font-medium text-gray-700">RW</label>
                        <select name="rw" id="rw" required
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500">
                            @if (Auth::user()->role->id === 1) <!-- Admin -->
                                <option value="1" {{ (isset($lahir) && $lahir->rw == '1') ? 'selected' : '' }}>1</option>
                                <option value="2" {{ (isset($lahir) && $lahir->rw == '2') ? 'selected' : '' }}>2</option>
                                <option value="3" {{ (isset($lahir) && $lahir->rw == '3') ? 'selected' : '' }}>3</option>
                                <option value="4" {{ (isset($lahir) && $lahir->rw == '4') ? 'selected' : '' }}>4</option>
                                <option value="5" {{ (isset($lahir) && $lahir->rw == '5') ? 'selected' : '' }}>5</option>
                                <option value="6" {{ (isset($lahir) && $lahir->rw == '6') ? 'selected' : '' }}>6</option>
                                <option value="7" {{ (isset($lahir) && $lahir->rw == '7') ? 'selected' : '' }}>7</option>
                            @else <!-- RW -->
                                <option value="{{ Auth::user()->rw->id }}" {{ (isset($lahir) && $lahir->rw == Auth::user()->rw->id) ? 'selected' : '' }}>
                                    {{ Auth::user()->rw->rukun_warga }}
                                </option>
                            @endif
                        </select>
                    </div>
                        <div>
                            <label for="rt" class="block text-sm font-medium text-gray-700">RT</label>
                            <input type="text" name="rt" id="rt" placeholder="Silakan masukkan RT" value="{{ $lahir->rt ?? '' }}" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                        </div>
                        <div>
                            <label for="nama_ayah_kandung" class="block text-sm font-medium text-gray-700">Nama Ayah Kandung</label>
                            <input type="text" name="nama_ayah_kandung" id="nama_ayah_kandung" placeholder="Silakan masukkan nama ayah" value="{{ $lahir->nama_ayah_kandung ?? '' }}" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                        </div>
                        <div>
                            <label for="nama_ibu_kandung" class="block text-sm font-medium text-gray-700">Nama Ibu Kandung</label>
                            <input type="text" name="nama_ibu_kandung" id="nama_ibu_kandung" placeholder="Silakan masukkan nama ibu" value="{{ $lahir->nama_ibu_kandung ?? '' }}" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                        </div>
                        <div>
                            <label for="nama_anak_lahir" class="block text-sm font-medium text-gray-700">Nama Anak Lahir</label>
                            <input type="text" name="nama_anak_lahir" id="nama_anak_lahir" placeholder="Silakan masukkan nama anak" value="{{ $lahir->nama_anak_lahir ?? '' }}" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                        </div>
                        <div>
                            <label for="tempat_lahir" class="block text-sm font-medium text-gray-700">Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" id="tempat_lahir" placeholder="Silakan masukkan tempat lahir" value="{{ $lahir->tempat_lahir ?? '' }}" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                        </div>
                        <div>
                            <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" id="tanggal_lahir" value="{{ $lahir->tanggal_lahir ?? '' }}" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                        </div>
                        <div>
                            <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                            <select name="jenis_kelamin" id="jenis_kelamin" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500">
                                <option value="LAKI-LAKI" {{ (isset($lahir) && $lahir->jenis_kelamin == 'LAKI-LAKI') ? 'selected' : '' }}>LAKI-LAKI</option>
                                <option value="PEREMPUAN" {{ (isset($lahir) && $lahir->jenis_kelamin == 'PEREMPUAN') ? 'selected' : '' }}>PEREMPUAN</option>
                            </select>
                        </div>
                        <div>
                        <label for="status_kependudukan" class="block text-sm font-medium text-gray-700">Status Kependudukan</label>
                        <select name="status_kependudukan" id="status_kependudukan" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500">
                                @foreach($statusKependudukanOptions as $option)
                                    <option value="{{ $option }}" {{ (isset($lahir) && $lahir->status_kependudukan == $option) ? 'selected' : '' }}>{{ $option }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mt-4 flex justify-between">
                        <a href="{{ route('resident-born') }}" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">Kembali</a>
                        <button type="submit" onclick="editConfirm(event)" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600  focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 ">
                            @if(isset($lahir))
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
                title: "Simpan?",
                text: "Periksa ulang perubahan jika ragu!",
                icon: "question",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, Simpan",
                cancelButtonText: "Tidak"
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