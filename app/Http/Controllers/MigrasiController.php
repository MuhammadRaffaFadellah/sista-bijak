<?php

namespace App\Http\Controllers;

use App\Models\Migrasi;
use App\Models\rw;
use App\Models\AnggotaMigrasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MigrasiController extends Controller
{
    public function resident_migration(Request $request)
    {
        $user = Auth::user();
        $rws = Rw::all();
        $query = Migrasi::query();
        // Pencarian berdasarkan nama atau NIK
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('jenis_migrasi', 'like', "%{$search}%")
                    ->orWhere('nik', 'like', "%{$search}%")
                    ->orWhere('nama_kepala_keluarga', 'like', "%{$search}%");
            });
        }
        // Filter berdasarkan RW
        if ($request->has('filter_rw') && $request->input('filter_rw') != '') {
            $query->where('rw', $request->input('filter_rw'));
        }
        // Filter berdasarkan role user
        if ($user->role->id !== 1) {
            $query->where('rw', $user->rw_id);
        }
        $dataMigrasi = $query->paginate(10);
        return view('resident.resident-migration', compact('dataMigrasi', 'rws'));
    }

    public function store(Request $request)
    {
        // Validasi data yang diinput
        $validatedData = $request->validate([
            'jenis_migrasi.*' => 'required|string',
            'nama_kepala_keluarga.*' => 'required|string',
            'nik.*' => 'required|string|min:16|max:16',
            'rw.*' => 'required|string',
            'rt.*' => 'required|string',
            'jumlah_anggota_keluarga.*' => 'required|integer|min:1',
            // Tambahkan validasi untuk anggota jika diperlukan
        ]);

        // Simpan data ke database
        foreach ($request->input('jenis_migrasi') as $index => $jenis_migrasi) {
            // Simpan setiap record migrasi
            $migrasi = Migrasi::create([
                'jenis_migrasi' => $jenis_migrasi,
                'nama_kepala_keluarga' => $request->input('nama_kepala_keluarga')[$index],
                'nik' => $request->input('nik')[$index],
                'rw' => $request->input('rw')[$index],
                'rt' => $request->input('rt')[$index],
                'jumlah_anggota_keluarga' => $request->input('jumlah_anggota_keluarga')[$index],
            ]);

            // Simpan anggota keluarga setelah migrasi disimpan
            if (isset($request->anggota[$index])) {
                foreach ($request->anggota[$index] as $anggotaData) {
                    // Pastikan $anggotaData adalah array
                    if (is_array($anggotaData)) {
                        $migrasi->anggotaMigrasi()->create($anggotaData);
                    }
                }
            }
        }

        return redirect()->route('resident-migration')->with('success', 'Data berhasil disimpan.');
    }


    public function show($id)
    {
        $migrasi = Migrasi::with('anggotaMigrasi')->findOrFail($id);
        return view('resident.resident-migration', compact('migrasi'));
    }

    public function edit($id)
    {
        $migrasi = Migrasi::with('anggotaMigrasi')->findOrFail($id);
        return view('create.create_migration', compact('migrasi'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            // Validasi untuk data migrasi
            'jenis_migrasi' => 'required',
            'nama_kepala_keluarga' => 'required|string',
            // Validasi untuk anggota
            'anggota.*.nama' => 'required|string',
            'anggota.*.tempat_lahir' => 'required|string',
            'anggota.*.tanggal_lahir' => 'required|date',
            'anggota.*.jenis_kelamin' => 'required|string',
            'anggota.*.hubungan_dengan_kk' => 'required|string',
            'anggota.*.pendidikan' => 'required|string',
            'anggota.*.pekerjaan' => 'required|string',
        ]);

        // Temukan dan update data migrasi
        $migrasi = Migrasi::findOrFail($id);
        $migrasi->update($request->only([
            'jenis_migrasi',
            'nama_kepala_keluarga',
            'nik',
            'rw',
            'rt'
        ]));

        if ($request->has('anggota')) {
            $this->updateAnggotaMigrasi($migrasi, $request->anggota, $id);
        }

        // Redirect ke tabel migrasi
        return redirect()->route('resident-migration')->with('success', 'Data migrasi berhasil diperbarui.');
    }
    
    private function updateAnggotaMigrasi(Migrasi $migrasi, array $anggotaData, $id)
    {
        foreach ($anggotaData as $anggota) {
            if (isset($anggota['id'])) {
                // Temukan dan update anggota yang sudah ada
                $anggotaModel = $migrasi->anggotaMigrasi()->find($anggota['id']);
                if ($anggotaModel) {
                    $anggotaModel->update($anggota);
                }
            } else {
                // Tambahkan anggota baru jika ID tidak ada
                $migrasi->anggotaMigrasi()->create($anggota);
            }
        }
    }


    public function destroy($id)
    {
        $migrasi = Migrasi::findOrFail($id);
        $migrasi->delete();
        return redirect()->route('resident-migration')->with('success', 'Data berhasil dihapus');
    }

    // Validasi data input migrasi
    protected function validateMigration(Request $request, $id = null)
    {
        $uniqueNikRule = $id ? 'unique:migrasi,nik,' . $id : 'unique:migrasi,nik';
        return $request->validate([
            'jenis_migrasi.*' => 'required|in:MASUK,KELUAR',
            'nama_kepala_keluarga.*' => 'required|string',
            'nik.*' => ['required', 'numeric', $uniqueNikRule],
            'rw.*' => 'required|numeric',
            'rt.*' => 'required|numeric',
            'anggota.*.*.id' => 'required|exists:anggota_migrasi,id',
            'anggota.*.*.nama' => 'required|string',
            'anggota.*.*.tempat_lahir' => 'required|string',
            'anggota.*.*.tanggal_lahir' => 'required|date',
            'anggota.*.*.jenis_kelamin' => 'required|in:LAKI-LAKI,PEREMPUAN',
            'anggota.*.*.hubungan_dengan_kk' => 'required|string',
            'anggota.*.*.pendidikan' => 'required|string',
            'anggota.*.*.pekerjaan' => 'required|string',
        ]);
    }
}
