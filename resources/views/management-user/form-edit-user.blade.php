@extends('layouts.master')
@section('dashboard-title')
    Sista Bijak - Form Edit User
@endsection
@section('body')
    <div class="max-w-md mx-auto bg-white shadow-lg rounded-lg overflow-hidden mt-5">
        <div class="px-6 py-4">
            <h3 class="text-gray-700 text-2xl font-semibold mb-4">Form Edit User</h3>
            <form action="/process-edit-users" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- ID user (hidden) -->
                <input type="hidden" name="id" value="{{ $users->id }}">

                <!-- role_id (hidden) dengan default 2 (operator) -->
                <input type="hidden" name="role_id" value="2">

                <!-- Nama -->
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Nama</label>
                    <input id="name" name="name" type="text" value="{{ $users->name }}"
                        class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        required>
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="email">Email</label>
                    <input id="email" name="email" type="email" value="{{ $users->email }}"
                        class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        required>
                </div>

                <!-- Password (Kosong jika tidak ingin mengubah) -->
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="password">Password (kosongkan jika tidak
                        ingin diubah)</label>
                    <input id="password" name="password" type="password" placeholder="Kosongkan jika tidak diubah"
                        class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                <!-- Pilih RW -->
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="rw_id">Pilih RW</label>
                    <select id="rw_id" name="rw_id"
                        class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        required>
                        @foreach ($rw as $row)
                            <option value="{{ $row->id }}" {{ $row->id == $users->rw_id ? 'selected' : '' }}>
                                {{ $row->rukun_warga }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Tombol Kembali dan Simpan -->
                <div class="flex justify-between pt-4 mb-4">
                    <a href="/user-management" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">
                        Kembali
                    </a>
                    <button type="submit" onclick="editConfirm(event)"
                        class="bg-green-500 text-white px-4 py-2 rounded-md font-bold hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        Edit User
                    </button>
                </div>
            </form>
        </div>
    </div>
    @include('sweetalert')
    <script>
    function editConfirm(event) {
        event.preventDefault(); // Prevent the default form submission
        Swal.fire({
            title: "Are you sure?",
            text: "Do you want to save changes?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, save changes!",
            cancelButtonText: "No, cancel"
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: "Sip!",
                    text: "User berhasil diubah.",
                    icon: "success"
                    confirmButtonText: "OK",
                    confirmButtonColor: "#D5ED9F",
                }).then(() => {
                    // Submit the form after success message
                    event.target.closest('form').submit();
                });
            }
        });
    }
</script>
@endsection
