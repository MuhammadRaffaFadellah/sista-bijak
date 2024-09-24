@extends('layouts.master')

@section('dashboard-title')
    Sista Bijak - Tabel Migrasi
@endsection

@section('body')
    <div class="container mx-auto px-4 py-6">
        <div class="card shadow-lg rounded-lg overflow-hidden">
            <div class="bg-gray-800 text-white p-4 flex justify-between items-center">
                <h3 class="text-lg font-bold">Tabel Migrasi</h3>
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
                                <th class="px-4 py-2 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">Jenis Migrasi</th>
                                <th class="px-4 py-2 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">Nama Kepala Keluarga</th>
                                <th class="px-4 py-2 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">NIK</th>
                                <th class="px-4 py-2 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">RW</th>
                                <th class="px-4 py-2 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">RT</th>
                                <th class="px-4 py-2 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">Jumlah Anggota Keluarga</th>
                                <th class="px-4 py-2 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @if($dataMigrasi->isEmpty())
                                <tr>
                                    <td colspan="8" class="text-center px-4 py-2">Tidak ada data migrasi.</td>
                                </tr>
                            @else
                                @foreach($dataMigrasi as $index => $migrasi)
                                    <tr class="hover:bg-gray-100 transition duration-200">
                                        <td class="px-4 py-2 whitespace-nowrap">{{ $dataMigrasi->firstItem() + $index }}.</td>
                                        <td class="px-4 py-2 whitespace-nowrap">{{ $migrasi->jenis_migrasi }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap">{{ $migrasi->nama_kepala_keluarga }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap">{{ $migrasi->nik }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap">{{ $migrasi->rw }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap">{{ $migrasi->rt }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap">{{ $migrasi->anggotaMigrasi->count() }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap flex space-x-2">
                                            <a href="{{ route('migrasi.show', $migrasi->id) }}" class="text-blue-500 hover:text-blue-600 px-2 py-1 border border-blue-500 rounded">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('migrasi.edit', $migrasi->id) }}" class="text-blue-500 hover:text-blue-600 px-2 py-1 border border-blue-500 rounded">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('migrasi.destroy', $migrasi->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:text-red-600 px-2 py-1 border border-red-500 rounded">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @foreach($migrasi->anggotaMigrasi as $anggota)
                                        <tr class="bg-gray-50">
                                            <td colspan="2" class="px-4 py-2 text-right">Nama:</td>
                                            <td colspan="6" class="px-4 py-2">{{ $anggota->nama }}</td>
                                        </tr>
                                        <tr class="bg-gray-50">
                                            <td colspan="2" class="px-4 py-2 text-right">Tempat Lahir:</td>
                                            <td colspan="6" class="px-4 py-2">{{ $anggota->tempat_lahir }}</td>
                                        </tr>
                                        <tr class="bg-gray-50">
                                            <td colspan="2" class="px-4 py-2 text-right">Tanggal Lahir:</td>
                                            <td colspan="6" class="px-4 py-2">{{ $anggota->tanggal_lahir }}</td>
                                        </tr>
                                        <tr class="bg-gray-50">
                                            <td colspan="2" class="px-4 py-2 text-right">Jenis Kelamin:</td>
                                            <td colspan="6" class="px-4 py-2">{{ $anggota->jenis_kelamin }}</td>
                                        </tr>
                                        <tr class="bg-gray-50">
                                            <td colspan="2" class="px-4 py-2 text-right">Hubungan dengan KK:</td>
                                            <td colspan="6" class="px-4 py-2">{{ $anggota->hubungan_dengan_kk }}</td>
                                        </tr>
                                        <tr class="bg-gray-50">
                                            <td colspan="2" class="px-4 py-2 text-right">Pendidikan:</td>
                                            <td colspan="6" class="px-4 py-2">{{ $anggota->pendidikan }}</td>
                                        </tr>
                                        <tr class="bg-gray-50">
                                            <td colspan="2" class="px-4 py-2 text-right">Pekerjaan:</td>
                                            <td colspan="6" class="px-4 py-2">{{ $anggota->pekerjaan }}</td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">
                    {{ $dataMigrasi->links() }} <!-- Pagination links -->
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div id="dataModal" class="fixed z-10 inset-0 flex items-center justify-center hidden">
            <div class="bg-white p-6 rounded-lg shadow-lg relative w-1/2">
                <button id="closeModalButton" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times"></i>
                </button>
                <h2 class="text-lg font-bold mb-4">Berapa banyak data yang ingin ditambah?</h2>
                <input type="number" id="dataCount" min="1" class="border border-gray-300 rounded-md p-2 w-full mb-4" placeholder="Masukkan jumlah data">
                <button id="generateFormButton" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Generate Form</button>
            </div>
        </div>

        <form id="multiForm" action="{{ route('migrasi.store') }}" method="POST">
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
                                <h3 class="text-lg font-bold">Data Migrasi ${i + 1}</h3>
                            </div>
                            <div class="p-4">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label for="jenis_migrasi_${i}" class="block text-sm font-medium text-gray-700">Jenis Migrasi</label>
                                        <select name="jenis_migrasi[]" id="jenis_migrasi_${i}" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500">
                                            <option value="masuk">Masuk</o  ption>
                                            <option value="keluar">Keluar</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label for="nama_kepala_keluarga_${i}" class="block text-sm font-medium text-gray-700">Nama Kepala Keluarga</label>
                                        <input type="text" name="nama_kepala_keluarga[]" id="nama_kepala_keluarga_${i}" placeholder="Silakan masukkan nama kepala keluarga" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                                    </div>
                                    <div>
                                        <label for="nik_${i}" class="block text-sm font-medium text-gray-700">NIK</label>
                                        <input type="text" name="nik[]" id="nik_${i}" placeholder="Silakan masukkan NIK" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
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
                                        <label for="jumlah_anggota_keluarga_${i}" class="block text-sm font-medium text-gray-700">Jumlah Anggota Keluarga</label>
                                        <input type="number" name="jumlah_anggota_keluarga[]" id="jumlah_anggota_keluarga_${i}" placeholder="Silakan masukkan jumlah anggota keluarga" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                                    </div>
                                    <div id="anggotaContainer_${i}" class="col-span-2">
                                        <!-- Form anggota keluarga akan di-generate di sini -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                    formContainer.insertAdjacentHTML('beforeend', form);

                    document.getElementById(`jumlah_anggota_keluarga_${i}`).addEventListener('input', function() {
                        const anggotaCount = this.value;
                        const anggotaContainer = document.getElementById(`anggotaContainer_${i}`);
                        anggotaContainer.innerHTML = ''; // Hapus form anggota sebelumnya

                        for (let j = 0; j < anggotaCount; j++) {
                            const anggotaForm = `
                                <div class="card shadow-lg rounded-lg overflow-hidden mb-4">
                                    <div class="bg-gray-800 text-white p-4">
                                        <h3 class="text-lg font-bold">Anggota Keluarga ${j + 1}</h3>
                                    </div>
                                    <div class="p-4">
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                            <div>
                                                <label for="anggota_${i}_${j}_nama" class="block text-sm font-medium text-gray-700">Nama</label>
                                                <input type="text" name="anggota[${i}][${j}][nama]" id="anggota_${i}_${j}_nama" placeholder="Silakan masukkan nama" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                                            </div>
                                            <div>
                                                <label for="anggota_${i}_${j}_tempat_lahir" class="block text-sm font-medium text-gray-700">Tempat Lahir</label>
                                                <input type="text" name="anggota[${i}][${j}][tempat_lahir]" id="anggota_${i}_${j}_tempat_lahir" placeholder="Silakan masukkan tempat lahir" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                                            </div>
                                            <div>
                                                <label for="anggota_${i}_${j}_tanggal_lahir" class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                                                <input type="date" name="anggota[${i}][${j}][tanggal_lahir]" id="anggota_${i}_${j}_tanggal_lahir" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                                            </div>
                                            <div>
                                                <label for="anggota_${i}_${j}_jenis_kelamin" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                                                <select name="anggota[${i}][${j}][jenis_kelamin]" id="anggota_${i}_${j}_jenis_kelamin" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500">
                                                    <option value="LAKI-LAKI">LAKI-LAKI</option>
                                                    <option value="PEREMPUAN">PEREMPUAN</option>
                                                </select>
                                            </div>
                                            <div>
                                                <label for="anggota_${i}_${j}_hubungan_dengan_kk" class="block text-sm font-medium text-gray-700">Hubungan dengan KK</label>
                                                <input type="text" name="anggota[${i}][${j}][hubungan_dengan_kk]" id="anggota_${i}_${j}_hubungan_dengan_kk" placeholder="Silakan masukkan hubungan dengan KK" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                                            </div>
                                            <div>
                                                <label for="anggota_${i}_${j}_pendidikan" class="block text-sm font-medium text-gray-700">Pendidikan</label>
                                                <input type="text" name="anggota[${i}][${j}][pendidikan]" id="anggota_${i}_${j}_pendidikan" placeholder="Silakan masukkan pendidikan" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                                            </div>
                                            <div>
                                                <label for="anggota_${i}_${j}_pekerjaan" class="block text-sm font-medium text-gray-700">Pekerjaan</label>
                                                <input type="text" name="anggota[${i}][${j}][pekerjaan]" id="anggota_${i}_${j}_pekerjaan" placeholder="Silakan masukkan pekerjaan" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `;
                            anggotaContainer.insertAdjacentHTML('beforeend', anggotaForm);
                        }
                    });
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