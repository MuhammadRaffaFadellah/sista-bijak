@extends('layouts.master')
@section('dashboard-title')
    Sista Bijak - Manajemen Gambar
@endsection
@section('body')
    <style>
        /* Animasi untuk fade-in dan fade-out */
        .modal-enter-active,
        .modal-leave-active {
            transition: opacity 0.3s ease;
        }

        .modal-enter,
        .modal-leave-to

        /* .modal-leave-active in <2.1.8 */
            {
            opacity: 0;
        }
    </style>
    <div class="container mx-auto px-4 py-6">
        <div class="card shadow-lg rounded-lg overflow-hidden">
            <div class="bg-gray-800 text-white p-4 flex justify-between items-center">
                <h3 class="text-lg font-bold">Manajemen Gambar</h3>
                <div class="flex items-center space-x-2">
                    <a href="{{ route('images.create') }}"
                        class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 flex items-center focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 ">
                        <i class="fas fa-plus"></i>
                    </a>
                </div>
            </div>
            <div class="p-4">
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white divide-y divide-gray-200 w-full">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">
                                    No</th>
                                <th class="px-4 py-2 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">
                                    Gambar</th>
                                <th class="px-4 py-2 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">
                                    Nama</th>
                                <th class="px-4 py-2 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @if ($images->isEmpty())
                                <tr>
                                    <td colspan="4" class="text-center px-4 py-2 uppercase font-bold">Tidak ada data</td>
                                </tr>
                            @else
                                @foreach ($images as $index => $image)
                                    <tr class="hover:bg-gray-100 transition duration-200">
                                        <td class="px-4 py-2 whitespace-nowrap text-center align-middle">
                                            {{ $images->firstItem() + $index }}.</td>
                                        <td class="px-4 py-2 whitespace-nowrap flex justify-center items-center">
                                            <!-- Tombol untuk membuka modal -->
                                            <button onclick="openModal('modal-{{ $image->id }}')"
                                                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 ">
                                                <i class="far fa-eye"></i>
                                            </button>
                                        </td>
                                        <td class="px-4 py-2 whitespace-nowrap text-center align-middle uppercase">
                                            {{ $image->image_name }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap flex justify-center items-center space-x-2">
                                            <div class="flex justify-center items-center space-x-2">
                                                <a href="{{ route('images.edit', $image->id) }}" title="Edit data"
                                                    class="inline-flex px-2 py-2 text-blue-500 hover:text-blue-600 border border-blue-500 rounded focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('images.destroy', $image->id) }}" method="POST"
                                                    class="inline" id="deleteForm">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" onclick="deleteConfirm(event, this)"
                                                        title="Hapus data"
                                                        class="text-red-500 hover:text-red-600 px-2 py-1 border border-red-500 rounded focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Modal -->
                                    <div id="modal-{{ $image->id }}" class="fixed inset-0 z-50 hidden overflow-y-auto">
                                        <div class="flex items-center justify-center min-h-screen px-4">
                                            <!-- Background gelap -->
                                            <div class="fixed inset-0 bg-black opacity-50 transition-opacity duration-300">
                                            </div>

                                            <div class="relative bg-white rounded-lg shadow-lg w-64 transition-all duration-300 transform scale-0 opacity-0"
                                                id="modal-content-{{ $image->id }}">
                                                <!-- Konten Modal -->
                                                <div class="p-4">
                                                    <h2 class="text-lg font-semibold text-center">Nama :
                                                        {{ $image->image_name }}</h2>
                                                    <img src="{{ asset('storage/' . $image->image_path) }}"
                                                        alt="{{ $image->image_name }}"
                                                        class="w-full h-auto mt-4 object-cover rounded">
                                                </div>
                                                <!-- Tombol untuk menutup modal -->
                                                <div class="p-4 text-center">
                                                    <button onclick="closeModal('modal-{{ $image->id }}')"
                                                        class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 ">
                                                        Tutup
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">
                    {{ $images->appends(request()->except('page'))->links() }} <!-- Pagination links -->
                </div>
            </div>
        </div>
    </div>

    <script>
        function openModal(modalId) {
            const modal = document.getElementById(modalId);
            const modalContent = document.getElementById('modal-content-' + modalId.split('-')[1]);

            modal.classList.remove('hidden');
            // Trigger animasi fade-in dan tampilkan modal
            setTimeout(() => {
                modalContent.classList.remove('scale-0', 'opacity-0');
                modalContent.classList.add('scale-100', 'opacity-100');
            }, 10);
        }

        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            const modalContent = document.getElementById('modal-content-' + modalId.split('-')[1]);

            // Trigger animasi fade-out
            modalContent.classList.remove('scale-100', 'opacity-100');
            modalContent.classList.add('scale-0', 'opacity-0');

            // Sembunyikan modal setelah animasi selesai
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300); // Sesuaikan dengan durasi animasi
        }
    </script>
@endsection
