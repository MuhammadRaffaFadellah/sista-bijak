@extends('layouts.master')
@section('dashboard-title')
    Sista Bijak - Tabel UMKM
@endsection
@section('body')
    <div class="container mx-auto px-4 py-6">
        <div class="card shadow-lg rounded-lg overflow-hidden">
            <div class="bg-gray-800 text-white p-4 flex justify-between items-center">
                <h3 class="text-lg font-bold">Tabel Penduduk</h3>
                <a href="/form-add-umkm"
                    class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 flex items-center">
                    <i class="fas fa-plus"></i>
                </a>
            </div>
            <div class="p-4">
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white divide-y divide-gray-200 w-full">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">
                                    No.
                                </th>
                                <th class="px-4 py-2 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">
                                    Nama RW
                                </th>
                                <th class="px-4 py-2 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">
                                    RW
                                </th>
                                <th class="px-4 py-2 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">
                                    Jumlah UMKM
                                </th>
                                <th class="px-4 py-2 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">
                                    Jenis UMKM
                                </th>
                                <th class="px-4 py-2 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">
                                    Nama Pemilik
                                </th>
                                <th class="px-4 py-2 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">
                                    NIK
                                </th>
                                <th class="px-4 py-2 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">
                                    Alamat
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @if ($umkms->isEmpty())
                                <tr>
                                    <td colspan="15" class="text-center px-4 py-2 uppercase font-bold">Tidak ada data</td>
                                </tr>
                            @else
                                @foreach ($umkms as $umkm)
                                    <tr class="hover:bg-gray-100 transition duration-200">
                                        <td class="px-4 py-2 whitespace-nowrap text-center">
                                            {{ $umkm->firstItem() + $index }}.</td>
                                        <td class="px-4 py-2 whitespace-nowrap text-center">{{ $umkm->nama_rw }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap text-center">{{ $umkm->rw }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap text-center">{{ $umkm->jumlah_umkm }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap text-center">{{ $umkm->jenis_umkm }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap text-center">{{ $umkm->nama_pemilik }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap text-center">{{ $umkm->nik }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap text-center">
                                            <button class="bg-gray-500 text-white px-4 py-2 rounded"
                                                onclick="showAddressModal('{{ $lahir->alamat }}')">
                                                Lihat Alamat
                                            </button>
                                        </td>
                                        <td class="px-4 py-2 whitespace-nowrap flex space-x-2">
                                            <a href="{{ route('umkm.edit', $umkm->id) }}"
                                                class="text-blue-500 hover:text-blue-600 px-2 py-1 border border-blue-500 rounded">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('umkm.destroy', $umkm->id) }}" method="POST"
                                                class="inline" id="deleteForm">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="deleteConfirm(event, this)"
                                                    class="text-red-500 hover:text-red-600 px-2 py-1 border border-red-500 rounded">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
