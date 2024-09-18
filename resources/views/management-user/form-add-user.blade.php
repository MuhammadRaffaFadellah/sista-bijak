@extends('layouts.master')
@section('dashboard-title')
    Sista Bijak - Form Tambah User
@endsection
@section('body')
    <div class="max-w-md mx-auto bg-white shadow-lg rounded-lg overflow-hidden mt-5">
        <div class="px-6 py-4">
            <h3 class="text-gray-700 text-2xl font-semibold mb-4">Form Tambah User</h3>
            <form action="/process-add-users" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- Nama -->
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                        Nama
                    </label>
                    <input id="name" name="name" type="text" placeholder="Masukkan nama"
                        class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        required>
                </div>
                <!-- Email -->
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                        Email
                    </label>
                    <input id="email" name="email" type="email" placeholder="Masukkan email"
                        class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        required>
                </div>
                <!-- Password -->
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                        Password
                    </label>
                    <input id="password" name="password" type="password" placeholder="Masukkan password"
                        class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="rw_id">
                        Pilih RW
                    </label>
                    <select id="rw_id" name="rw_id"
                        class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        required>
                        <option value="">Pilih RW</option>
                        @foreach ($rw_id as $rw)
                            <option value="{{ $rw->id }}">
                                {{ $rw->rukun_warga }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <!-- Tombol Kembali dan Tambah -->
                <div class="flex justify-between pt-4 mb-4">
                    <a href="/user-management" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">
                        Kembali
                    </a>
                    <button type="submit"
                        class="bg-green-500 text-white px-4 py-2 rounded-md font-bold hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"
                        onclick="addConfirm(event)">
                        Tambah User
                    </button>
                </div>
            </form>
        </div>
    </div>
    @include('sweetalert')
    <script>
        function addConfirm(event) {
            event.preventDefault();
            // Ambil nilai dari input yang wajib diisi
            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const rw = document.getElementById('rw_id').value;
            // Cek apakah semua input sudah terisi
            if (name === "" || email === "" || password === "" || rw === "") {
                Swal.fire({
                    title: "Error!",
                    text: "Semua data harus diisi!",
                    icon: "error",
                    confirmButtonText: "OK"
                });
            } else {
                // Jika semua data terisi
                Swal.fire({
                    title: "Sip!",
                    text: "User berhasil ditambahkan!",
                    icon: "success",
                    confirmButtonText: "OK",
                    confirmButtonColor: "#D5ED9F",
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Submit form setelah konfirmasi
                        event.target.closest('form').submit();
                    }
                });
            }
        }
    </script>
@endsection

