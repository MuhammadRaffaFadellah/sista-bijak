@extends('layouts.master')
@section('dashboard-title')
    Sista Bijak - Tambah Gambar
@endsection
@section('body')
    <div class="container mx-auto px-4 py-6">
        <div class="card shadow-lg rounded-lg overflow-hidden">
            <div class="bg-gray-800 text-white p-4 flex justify-between items-center">
                <h3 class="text-lg font-bold">Tambah Gambar</h3>
            </div>
            <div class="p-4">
                <form id="imageForm" action="{{ route('images.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4 my-2">
                        <label for="image_path" class="block text-sm font-medium text-gray-700">Unggah Gambar :</label>
                        <div class="mt-1 flex items-center">
                            <input type="file" name="image_path" id="image_path" class="hidden" required
                                onchange="updateFileName()">
                            <label for="image_path"
                                class="cursor-pointer inline-flex items-center justify-center w-full p-2 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-100">
                                <span id="file-name">Pilih Gambar</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4" />
                                </svg>
                            </label>
                        </div>
                    </div>
                    <div class="my-4">
                        <label for="image_name" class="block text-sm font-medium text-gray-700">Nama :</label>
                        <input type="text" name="image_name" id="image_name"
                            placeholder="Masukan nama orang yang ada di gambar..."
                            class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                    </div>
                    <div class="mb-2 mt-10 flex justify-between">
                        <a href="{{ route('images.index') }}"
                            class="bg-red-500 text-white py-2 px-4 rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 ">Kembali
                        </a>
                        <button type="submit" onclick="addconfirm(event)"
                            class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 ">Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @include('sweetalert')
    <script>
        function addconfirm(event) {
            event.preventDefault(); // Mencegah form untuk submit secara default
            // Ambil nilai dari input
            const imageName = document.getElementById('image_name').value;
            const imagePath = document.getElementById('image_path').files.length;

            // Periksa apakah input kosong
            if (!imageName || imagePath === 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Input Kosong',
                    text: 'Silakan isi semua field sebelum melanjutkan.',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#3085d6',
                });
                return; // Hentikan eksekusi lebih lanjut
            }

            // Jika semua input terisi, tanyakan konfirmasi
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Pastikan semua data sudah benar!",
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                confirmButtonColor: '#3085d6',
                cancelButtonText: 'Tidak',
                cancelButtonColor: '#d33',
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika user memilih 'Ya'
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Data telah disimpan!',
                        showConfirmButton: false, // Menghilangkan tombol konfirmasi
                        timer: 2000 // Menghilang setelah 2 detik
                    }).then(() => {
                        // Submit form setelah alert berhasil ditutup
                        document.getElementById('imageForm').submit();
                    });
                }
            });
        }

        function updateFileName() {
            const input = document.getElementById('image_path');
            const fileName = input.files.length > 0 ? input.files[0].name : 'Pilih Gambar';
            document.getElementById('file-name').textContent = fileName;
        }
    </script>
@endsection
