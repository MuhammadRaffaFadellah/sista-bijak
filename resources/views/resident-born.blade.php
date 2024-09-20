@extends('layouts.master')

@section('dashboard-title')
    Sista Bijak - Tabel Lahir
@endsection

@section('body')
    <div class="container mx-auto px-4 py-6">
        <div class="card shadow-lg rounded-lg overflow-hidden">
            <div class="bg-gray-800 text-white p-4 flex justify-between items-center">
                <h3 class="text-lg font-bold">Tabel Lahir</h3>
                <button id="addDataButton" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 flex items-center">
                    <i class="fas fa-plus mr-2"></i> <!-- Ikon tambah -->
                    Tambah Data
                </button>
            </div>
            <div class="p-4">
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white divide-y divide-gray-200 w-full">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">No</th>
                                <th class="px-4 py-2 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">Nama Kepala Keluarga</th>
                                <th class="px-4 py-2 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">NIK</th>
                                <th class="px-4 py-2 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">Alamat</th>
                                <th class="px-4 py-2 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">RW</th>
                                <th class="px-4 py-2 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">RT</th>
                                <th class="px-4 py-2 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">Nama Ayah Kandung</th>
                                <th class="px-4 py-2 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">Nama Ibu Kandung</th>
                                <th class="px-4 py-2 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">Nama Anak Lahir</th>
                                <th class="px-4 py-2 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">Tempat Lahir</th>
                                <th class="px-4 py-2 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">Tanggal Lahir</th>
                                <th class="px-4 py-2 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">Jenis Kelamin</th>
                                <th class="px-4 py-2 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">Status Kependudukan</th>
                                <th class="px-4 py-2 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @if($dataLahir->isEmpty())
                                <tr>
                                    <td colspan="14" class="text-center px-4 py-2">Tidak ada data lahir.</td>
                                </tr>
                            @else
                                @foreach($dataLahir as $index => $lahir)
                                    <tr class="hover:bg-gray-100 transition duration-200">
                                        <td class="px-4 py-2 whitespace-nowrap">{{ $dataLahir->firstItem() + $index }}.</td>
                                        <td class="px-4 py-2 whitespace-nowrap">{{ $lahir->nama_kepala_keluarga }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap">{{ $lahir->nik }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap">{{ $lahir->alamat }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap">{{ $lahir->rw }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap">{{ $lahir->rt }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap">{{ $lahir->nama_ayah_kandung }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap">{{ $lahir->nama_ibu_kandung }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap">{{ $lahir->nama_anak_lahir }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap">{{ $lahir->tempat_lahir }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap">{{ $lahir->tanggal_lahir }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap">{{ $lahir->jenis_kelamin }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap">{{ $lahir->status_kependudukan }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap flex space-x-2">
                                            <a href="{{ route('lahir.edit', $lahir->id) }}" class="text-blue-500 hover:text-blue-600 px-2 py-1 border border-blue-500 rounded">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('lahir.destroy', $lahir->id) }}" method="POST" class="inline">
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
                    {{ $dataLahir->links() }} <!-- Pagination links -->
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div id="dataModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
            <div class="flex items-center justify-center min-h-screen">
                <div class="bg-white p-6 rounded-lg shadow-lg relative">
                    <button id="closeModalButton" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">
                        <i class="fas fa-times"></i>
                    </button>
                    <h2 class="text-lg font-bold mb-4">Berapa banyak data yang ingin ditambah?</h2>
                    <input type="number" id="dataCount" min="1" class="border border-gray-300 rounded-md p-2 w-full mb-4" placeholder="Masukkan jumlah data">
                    <button id="generateFormButton" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Generate Form</button>
                </div>
            </div>
        </div>

        <form id="multiForm" action="{{ route('lahir.store') }}" method="POST">
            @csrf
            <div id="formContainer" class="mt-6">
                <!-- Form akan di-generate di sini -->
            </div>

            <div id="formActions" class="mt-6 flex justify-between hidden">
                <button id="cancelButton" type="button" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Batal</button>
                <button id="saveAllButton" type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Simpan Semua</button>
            </div>
        </form>

        <script>
            document.getElementById('addDataButton').addEventListener('click', function() {
                document.getElementById('dataModal').classList.remove('hidden');
            });

            document.getElementById('closeModalButton').addEventListener('click', function() {
                document.getElementById('dataModal').classList.add('hidden');
            });

            document.getElementById('generateFormButton').addEventListener('click', function() {
                const dataCount = document.getElementById('dataCount').value;
                const formContainer = document.getElementById('formContainer');
                formContainer.innerHTML = ''; // Hapus form sebelumnya

                for (let i = 0; i < dataCount; i++) {
                    const form = `
                        <div class="card shadow-lg rounded-lg overflow-hidden mb-4">
                            <div class="bg-gray-800 text-white p-4">
                                <h3 class="text-lg font-bold">Data Lahir ${i + 1}</h3>
                            </div>
                            <div class="p-4">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label for="nik_${i}" class="block text-sm font-medium text-gray-700">NIK</label>
                                        <input type="text" name="nik[]" id="nik_${i}" placeholder="Silakan masukkan NIK" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                                    </div>
                                    <div>
                                        <label for="nama_kepala_keluarga_${i}" class="block text-sm font-medium text-gray-700">Nama Kepala Keluarga</label>
                                        <input type="text" name="nama_kepala_keluarga[]" id="nama_kepala_keluarga_${i}" placeholder="Silakan masukkan nama kepala keluarga" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                                    </div>
                                    <div>
                                        <label for="alamat_${i}" class="block text-sm font-medium text-gray-700">Alamat</label>
                                        <input type="text" name="alamat[]" id="alamat_${i}" placeholder="Silakan masukkan alamat" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                                    </div>
                                    <div>
                                        <label for="rw_${i}" class="block text-sm font-medium text-gray-700">RW</label>
                                        <input type="text" name="rw[]" id="rw_${i}" placeholder="Silakan masukkan RW" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                                    </div>
                                    <div>
                                        <label for="rt_${i}" class="block text-sm font-medium text-gray-700">RT</label>
                                        <input type="text" name="rt[]" id="rt_${i}" placeholder="Silakan masukkan RT" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                                    </div>
                                    <div>
                                        <label for="nama_ayah_kandung_${i}" class="block text-sm font-medium text-gray-700">Nama Ayah Kandung</label>
                                        <input type="text" name="nama_ayah_kandung[]" id="nama_ayah_kandung_${i}" placeholder="Silakan masukkan nama ayah" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                                    </div>
                                    <div>
                                        <label for="nama_ibu_kandung_${i}" class="block text-sm font-medium text-gray-700">Nama Ibu Kandung</label>
                                        <input type="text" name="nama_ibu_kandung[]" id="nama_ibu_kandung_${i}" placeholder="Silakan masukkan nama ibu" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                                    </div>
                                    <div>
                                        <label for="nama_anak_lahir_${i}" class="block text-sm font-medium text-gray-700">Nama Anak Lahir</label>
                                        <input type="text" name="nama_anak_lahir[]" id="nama_anak_lahir_${i}" placeholder="Silakan masukkan nama anak" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                                    </div>
                                    <div>
                                        <label for="tempat_lahir_${i}" class="block text-sm font-medium text-gray-700">Tempat Lahir</label>
                                        <input type="text" name="tempat_lahir[]" id="tempat_lahir_${i}" placeholder="Silakan masukkan tempat lahir" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                                    </div>
                                    <div>
                                        <label for="tanggal_lahir_${i}" class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                                        <input type="date" name="tanggal_lahir[]" id="tanggal_lahir_${i}" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                                    </div>
                                    <div>
                                        <label for="jenis_kelamin_${i}" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                                        <select name="jenis_kelamin[]" id="jenis_kelamin_${i}" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500">
                                            <option value="LAKI-LAKI">LAKI-LAKI</option>
                                            <option value="PEREMPUAN">PEREMPUAN</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label for="status_kependudukan_${i}" class="block text-sm font-medium text-gray-700">Status Kependudukan</label>
                                        <select name="status_kependudukan[]" id="status_kependudukan_${i}" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500">
                                            @foreach($statusKependudukanOptions as $option)
                                                <option value="{{ $option }}">{{ $option }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                    formContainer.insertAdjacentHTML('beforeend', form);
                }

                document.getElementById('dataModal').classList.add('hidden');
                document.getElementById('formActions').classList.remove('hidden');
            });

            document.getElementById('saveAllButton').addEventListener('click', function() {
                document.getElementById('multiForm').submit();
            });

            document.getElementById('cancelButton').addEventListener('click', function() {
                document.getElementById('formContainer').innerHTML = '';
                document.getElementById('formActions').classList.add('hidden');
            });
        </script>
    </div>
@endsection