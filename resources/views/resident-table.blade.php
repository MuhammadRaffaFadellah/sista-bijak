@extends('layouts.master')
@section('dashboard-title')
    Sista Bijak - Tabel Penduduk
@endsection
@section('body')

    <div class="container mx-auto px-4 py-6">
        <div class="card shadow-lg rounded-lg overflow-hidden">
            <div class="bg-gray-800 text-white p-4 flex justify-between items-center">
                <h3 class="text-lg font-bold">Tabel Penduduk</h3>
                <a href="{{ route('penduduk.create') }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 flex items-center">
                    <i class="fas fa-plus mr-2"></i> <!-- Ikon tambah -->
                    Tambah Data
                </a>
            </div>
            <div class="p-4">
                <div class="overflow-x-auto">
                <table class="min-w-full bg-white divide-y divide-gray-200 w-full">
    <thead class="bg-gray-100">
        <tr>
            <th class="px-4 py-2 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">No</th>
            <th class="px-4 py-2 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">NIK</th>
            <th class="px-4 py-2 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Nama Lengkap</th>
            <th class="px-4 py-2 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Jenis Kelamin</th>
            <th class="px-4 py-2 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Tempat Lahir</th>
            <th class="px-4 py-2 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Tanggal Lahir</th>
            <th class="px-4 py-2 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Status Hubkel</th>
            <th class="px-4 py-2 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Pendidikan Terakhir</th>
            <th class="px-4 py-2 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Jenis Pekerjaan</th>
            <th class="px-4 py-2 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Agama</th>
            <th class="px-4 py-2 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Status Perkawinan</th>
            <th class="px-4 py-2 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Alamat</th>
            <th class="px-4 py-2 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">RW</th>
            <th class="px-4 py-2 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">RT</th>
            <th class="px-4 py-2 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Kelurahan</th>
            <th class="px-4 py-2 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Status Kependudukan</th>
            <th class="px-4 py-2 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Aksi</th>
        </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">
        @if($penduduks->isEmpty())
            <tr>
                <td colspan="15" class="text-center px-4 py-2">Tidak ada data penduduk.</td>
            </tr>
        @else
            @foreach($penduduks as $index => $penduduk)
                <tr class="hover:bg-gray-100 transition duration-200">
                    <td class="px-4 py-2 whitespace-nowrap">{{ $penduduks->firstItem() + $index }}.</td>
                    <td class="px-4 py-2 whitespace-nowrap">{{ $penduduk->nik }}</td>
                    <td class="px-4 py-2 whitespace-nowrap">{{ $penduduk->nama_lengkap }}</td>
                    <td class="px-4 py-2 whitespace-nowrap">{{ $penduduk->jenis_kelamin }}</td>
                    <td class="px-4 py-2 whitespace-nowrap">{{ $penduduk->tempat_lahir }}</td>
                    <td class="px-4 py-2 whitespace-nowrap">{{ $penduduk->tanggal_lahir }}</td>
                    <td class="px-4 py-2 whitespace-nowrap">{{ $penduduk->status_hubkel }}</td>
                    <td class="px-4 py-2 whitespace-nowrap">{{ $penduduk->pendidikan_terakhir }}</td>
                    <td class="px-4 py-2 whitespace-nowrap">{{ $penduduk->jenis_pekerjaan }}</td>
                    <td class="px-4 py-2 whitespace-nowrap">{{ $penduduk->agama }}</td>
                    <td class="px-4 py-2 whitespace-nowrap">{{ $penduduk->status_perkawinan }}</td>
                    <td class="px-4 py-2 whitespace-nowrap">{{ $penduduk->alamat }}</td>
                    <td class="px-4 py-2 whitespace-nowrap">{{ $penduduk->rw }}</td>
                    <td class="px-4 py-2 whitespace-nowrap">{{ $penduduk->rt }}</td>
                    <td class="px-4 py-2 whitespace-nowrap">{{ $penduduk->kelurahan }}</td>
                    <td class="px-4 py-2 whitespace-nowrap">{{ $penduduk->status_kependudukan }}</td>
                    <td class="px-4 py-2 whitespace-nowrap flex space-x-2">
                        <a href="{{ route('penduduk.edit', $penduduk->id) }}" class="text-blue-500 hover:text-blue-600 px-2 py-1 border border-blue-500 rounded">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('penduduk.destroy', $penduduk->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-600 px-2 py-1 border border-red-500 rounded">
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
                <div class="mt-4">
                    {{ $penduduks->links() }} <!-- Pagination links -->
                </div>
            </div>
        </div>
    </div>
@endsection