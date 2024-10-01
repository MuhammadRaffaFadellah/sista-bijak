@extends('layouts.master')
@section('dashboard-title')
    Sista Bijak - Manajemen User
@endsection
@section('body')
    <div class="container mx-auto">
        <!-- Card -->
        <div class="bg-white p-6 rounded-lg shadow-md ">
            <!-- Add User -->
            <div class="flex justify-between mb-7">
                <h3 class="text-gray-700 text-3xl font-medium items-center align-center">Manajemen User</h3>
                <a href="/form-add-user" title="Tambah User"
                    class="inline-flex items-center px-2 mr-1 py-1 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition ease-in-out duration-150">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                </a>
            </div>
            <!-- Table -->
            <div class="overflow-x-auto rounded-t-lg rounded-b-md">
                <table class="min-w-full divide-y divide-gray-200 border ">
                    <thead>
                        <tr class="text-xs text-white uppercase bg-gray-800 ">
                            <th class="px-6 py-3 text-center text-xs font-medium uppercase tracking-wider">
                                <b>No.</b>
                            </th>
                            <th class="px-6 py-3 text-center text-xs font-medium uppercase tracking-wider">
                                <b>Name</b>
                            </th>
                            <th class="px-6 py-3 text-center text-xs font-medium uppercase tracking-wider">
                                <b>Email</b>
                            </th>
                            <th class="px-6 py-3 text-center text-xs font-medium uppercase tracking-wider">
                                <b>RW</b>
                            </th>
                            <th class="px-6 py-3 text-center text-xs font-medium uppercase tracking-wider">
                                <b>Role</b>
                            </th>
                            <th class="px-6 py-3 text-center text-xs font-medium uppercase tracking-wider">
                                <b>Actions</b>
                            </th>
                        </tr>
                    </thead>
                    <tbody id="table-body" class="bg-white divide-y divide-gray-200">
                        @php $no = ($users->currentPage() - 1) * $users->perPage() + 1; @endphp
                        @foreach ($users as $user)
                            <tr class="{{ $loop->even ? 'bg-gray-50' : 'bg-white' }}">
                                <td class="text-center px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-500">
                                    {{ $no++ }}.
                                </td>
                                <td class="text-center px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $user->name }}
                                </td>
                                <td class="text-center px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $user->email }}
                                </td>
                                <td class="text-center px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    @if ($user->role_id == 1)
                                        -
                                    @elseif ($user->role_id == 2)
                                        {{ $user->rw_id }}
                                    @else
                                    -
                                    @endif
                                </td>
                                <td class="text-center px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    @if ($user->role_id == 1)
                                        Admin
                                    @elseif ($user->role_id == 2)
                                        Operator
                                    @else
                                        Tidak Diketahui
                                    @endif
                                </td>                                
                                <td class="text-center flex justify-center py-3 space-x-4">
                                    <a href="{{ url('user-management/' . $user->id . '/editUser') }}" title="Edit User"
                                        class="text-blue-500 hover:text-blue-600 px-2 py-1 border border-blue-500 rounded">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="{{ url('user-management/' . $user->id . '/deleteUser') }}" title="Hapus User"
                                        onclick="deleteConfirm(event, this.href)"
                                        class="text-red-500 hover:text-red-600 px-2 py-1 border border-red-500 rounded">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- Pagination -->
            <div class="mt-10 mb-3 flex justify-center">
                {{ $users->links() }}
            </div>
        </div>
    </div>
    <p class="text-gray-400 mt-2 ml-1">Copyright &copy; SISTA BIJAK 2024.</p>
    @include('sweetalert')
    <script>
        function deleteConfirm(event, url) {
            event.preventDefault(); // Mencegah aksi default
            Swal.fire({
                title: "Kamu yakin hapus user ini?",
                text: "Kamu tidak akan bisa mengulang ini!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, hapus",
                cancelButtonText: "Tidak"
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika dikonfirmasi, redirect ke URL penghapusan
                    Swal.fire({
                        title: "Berhasil!",
                        text: "User berhasil dihapus.",
                        icon: "success",
                        confirmButtonText: "OK",
                        confirmButtonColor: "#3085d6",
                    }).then(() => {
                        // Submit the form after success message
                        window.location.href = url;
                    });
                }
            });
        }
    </script>
@endsection
