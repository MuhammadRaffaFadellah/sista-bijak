@extends('layouts.master')

@section('dashboard-title')
    @if (isset($umkm))
        Sista Bijak - Edit Data UMKM
    @else
        Sista Bijak - Tambah Data UMKM
    @endif
@endsection
@section('body')
    <div class="container mx-auto px-4 py-6">
    <div class="card shadow-lg rounded-lg overflow-hidden">
        <div class="bg-gray-800 text-white p-4">
            <h3 class="text-lg font-bold">
                @if (isset($umkm))
                    Edit Data UMKM
                @else
                    Tambah Data UMKM
                @endif
            </h3>
        </div>
        <div class="p-4">
            <form action="{{ isset($umkm) ? route('umkm.update', $umkm->id) : route('umkm.store') }}" method="POST">
                @csrf
                @if (isset($umkm))
                    @method('PUT')
                @endif
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                        <label for="nik" class="block text-sm font-medium text-gray-700">NIK</label>
                        @if (isset($umkm))
                            <input type="text" name="nik" id="nik" value="{{ $umkm->nik }}" readonly
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                            <span class="text-red-500 text-sm" id="nik-warning" style="display: none;">Tidak dapat mengubah NIK</span>
                        @else
                            <input type="text" name="nik" id="nik" placeholder="Silakan masukkan NIK"
                                required
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                        @endif
                    </div>
                    <div>
                        <label for="nama_rw" class="block text-sm font-medium text-gray-700">Nama RW</label>
                        <input type="text" name="nama_rw" id="nama_rw" placeholder="Silakan masukkan nama RW"
                            value="{{ $umkm->nama_rw ?? '' }}" required
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                    </div>
                    <!-- <div>
                        <label for="rw" class="block text-sm font-medium text-gray-700">RW</label>
                        <input type="text" name="rw" id="rw" placeholder="Silakan masukkan RW"
                            value="{{ $umkm->rw ?? '' }}" required
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                    </div> -->
                    <div>
                    <label for="rw" class="block text-sm font-medium text-gray-700">RW</label>
                        <select name="rw" id="rw" required
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500">
                            @if (Auth::user()->role->id === 1) <!-- Admin -->
                                <option value="1" {{ (isset($umkm) && $umkm->rw == '1') ? 'selected' : '' }}>1</option>
                                <option value="2" {{ (isset($umkm) && $umkm->rw == '2') ? 'selected' : '' }}>2</option>
                                <option value="3" {{ (isset($umkm) && $umkm->rw == '3') ? 'selected' : '' }}>3</option>
                                <option value="4" {{ (isset($umkm) && $umkm->rw == '4') ? 'selected' : '' }}>4</option>
                                <option value="5" {{ (isset($umkm) && $umkm->rw == '5') ? 'selected' : '' }}>5</option>
                                <option value="6" {{ (isset($umkm) && $umkm->rw == '6') ? 'selected' : '' }}>6</option>
                                <option value="7" {{ (isset($umkm) && $umkm->rw == '7') ? 'selected' : '' }}>7</option>
                            @else <!-- RW -->
                                <option value="{{ Auth::user()->rw->id }}" {{ (isset($umkm) && $umkm->rw == Auth::user()->rw->id) ? 'selected' : '' }}>
                                    {{ Auth::user()->rw->rukun_warga }}
                                </option>
                            @endif
                        </select>
                    </div>
                    <div>
                        <label for="jumlah_umkm" class="block text-sm font-medium text-gray-700">Jumlah UMKM</label>
                        <input type="number" name="jumlah_umkm" id="jumlah_umkm" placeholder="Silakan masukkan jumlah UMKM"
                            value="{{ $umkm->jumlah_umkm ?? '' }}" required
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                    </div>
                    <div>
                        <label for="jenis_umkm" class="block text-sm font-medium text-gray-700">Jenis UMKM</label>
                        <select name="jenis_umkm" id="jenis_umkm" required
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500">
                            <option value="Industri Pengolahan" {{ (isset($umkm) && $umkm->jenis_umkm == 'Industri Pengolahan') ? 'selected' : '' }}>Industri Pengolahan</option>
                            <option value="Perdagangan besar/eceran" {{ (isset($umkm) && $umkm->jenis_umkm == 'Perdagangan besar/eceran') ? 'selected' : '' }}>Perdagangan besar/eceran</option>
                            <option value="Penyedia Akomodasi & Makan Minum" {{ (isset($umkm) && $umkm->jenis_umkm == 'Penyedia Akomodasi & Makan Minum') ? 'selected' : '' }}>Penyedia Akomodasi & Makan Minum</option>
                            <option value="Konstruksi" {{ (isset($umkm) && $umkm->jenis_umkm == 'Konstruksi') ? 'selected' : '' }}>Konstruksi</option>
                            <option value="Jasa Lainnya" {{ (isset($umkm) && $umkm->jenis_umkm == 'Jasa Lainnya') ? 'selected' : '' }}>Jasa Lainnya</option>
                        </select>
                    </div>
                    <div>
                        <label for="kategori_umkm" class="block text-sm font-medium text-gray-700">Kategori UMKM</label>
                        <select name="kategori_umkm" id="kategori_umkm" required
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500">
                            <option value="Mikro" {{ (isset($umkm) && $umkm->kategori_umkm == 'Mikro') ? 'selected' : '' }}>Mikro</option>
                            <option value="Kecil" {{ (isset($umkm) && $umkm->kategori_umkm == 'Kecil') ? 'selected' : '' }}>Kecil</option>
                            <option value="Menengah" {{ (isset($umkm) && $umkm->kategori_umkm == 'Menengah') ? 'selected' : '' }}>Menengah</option>
                        </select>
                    </div>
                    <div>
                        <label for="nama_pemilik" class="block text-sm font-medium text-gray-700">Nama Pemilik</label>
                        <input type="text" name="nama_pemilik" id="nama_pemilik" placeholder="Silakan masukkan nama pemilik"
                            value="{{ $umkm->nama_pemilik ?? '' }}" required
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                    </div>
                    <div>
                        <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                        <input type="text" name="alamat" id="alamat" placeholder="Silakan masukkan alamat"
                            value="{{ $umkm->alamat ?? '' }}" required
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                    </div>
                </div>
                <div class="mt-4 flex justify-between">
                    <a href="{{ route('umkm') }}" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Kembali</a>
                    <button type="submit" onclick="editConfirm(event, this)"
                        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        @if (isset($umkm))
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
            icon: "question",
            confirmButtonText: "Ya, Simpan",
            confirmButtonColor: "#3085d6",
            cancelButtonText: "Tidak",
            cancelButtonColor: "#d33",
            showCancelButton: true
        }).then((result) => {
            if (result.isConfirmed) {
                // Jika pengguna menekan tombol "Ya, Simpan", submit form
                button.closest('form').submit();
            }
        });
    }
</script>
@endsection