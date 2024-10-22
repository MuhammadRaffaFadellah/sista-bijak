<?php

namespace App\Http\Controllers;

use App\Models\Penduduk;
use App\Models\Meninggals;
use App\Models\Lahir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\rw;
use App\Exports\MeninggalExport;
use Maatwebsite\Excel\Facades\Excel;

class MeninggalController extends Controller
{
    public function download()
    {
        return Excel::download(new MeninggalExport, 'table_meninggal_data.xlsx');
    }

    public function resident_died(Request $request)
    {
        $user = Auth::user();
        $rws = rw::all();

        if ($user->role->id === 1) {
            $dataMeninggal = Meninggals::query();
        } else {
            $dataMeninggal = Meninggals::where('rw', $user->rw_id);
        }

        if ($request->has('search')) {
            $search = $request->input('search');
            $dataMeninggal->where(function ($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%")
                    ->orWhere('nik', 'like', "%{$search}%");
            });
        }

        if ($request->has('filter_rw') && $request->input('filter_rw') != '') {
            $dataMeninggal->where('rw', $request->input('filter_rw'));
        }

        $dataMeninggal = $dataMeninggal->paginate(10);
        return view('resident.resident-died', compact('dataMeninggal', 'rws'));
    }

    public function index()
    {
        $dataMeninggal = Meninggals::paginate(10);
        return view('resident.resident-died', compact('dataMeninggal'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|string',
            'nama_lengkap' => 'required|string',
            'tempat_meninggal' => 'required|string',
            'tanggal_meninggal' => 'required|date',
        ]);

        $penduduk = Penduduk::where('nik', $request->nik)->first();

        if (!$penduduk) {
            return redirect()->route('resident-died')->with('error', 'Penduduk tidak ditemukan.');
        }

        $meninggal = new Meninggals();
        $meninggal->nik = $penduduk->nik;
        $meninggal->nama_lengkap = $penduduk->nama_lengkap;
        $meninggal->tempat_meninggal = $request->input('tempat_meninggal');
        $meninggal->tanggal_meninggal = $request->input('tanggal_meninggal');
        $meninggal->status_hubkel = $request->input('status_hubkel');
        $meninggal->alamat = $penduduk->alamat;
        $meninggal->rw = $penduduk->rw;
        $meninggal->rt = $penduduk->rt;
        $meninggal->status_kependudukan = 'Meninggal';
        $meninggal->jenis_kelamin = $penduduk->jenis_kelamin;
        $meninggal->tempat_lahir = $penduduk->tempat_lahir;
        $meninggal->tanggal_lahir = $penduduk->tanggal_lahir;
        $meninggal->save();

        $penduduk->delete();

        return redirect()->route('resident-died')->with('success', 'Data meninggal berhasil ditambahkan dan penduduk dihapus.');
    }

    public function checkDataExists(Request $request)
    {
        $nik = $request->query('nik');
        if (empty($nik)) {
            return response()->json(['exists' => false]);
        }

        $pendudukExists = Penduduk::where('nik', $nik)->exists();
        return response()->json(['exists' => $pendudukExists]);
    }

    public function edit($id)
    {
        try {
            $rws = rw::all();
            Log::info('Edit method called with ID: ' . $id);
            $meninggal = Meninggals::findOrFail($id);
            Log::info('Meninggal data found', ['data' => $meninggal->toArray()]);

            $penduduk = Penduduk::where('nik', $meninggal->nik)->first();
            Log::info('Penduduk data found', ['data' => $penduduk ? $penduduk->toArray() : null]);
            Log::info('Jenis Kelamin Penduduk:', ['jenis_kelamin' => $penduduk->jenis_kelamin ?? null]);

            return view('create.create_died', compact('meninggal', 'penduduk', 'rws'));
        } catch (\Exception $e) {
            Log::error('Error in edit method', ['error' => $e->getMessage()]);
            return redirect()->route('resident-died')
                ->with('error', 'Data tidak ditemukan');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nik' => 'required|numeric',
            'nama_lengkap' => 'required|string',
            'status_hubkel' => 'required|string',
            'alamat' => 'required|string',
            'rw' => 'required|numeric',
            'rt' => 'required|numeric',
            'jenis_kelamin' => 'required|string',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'tempat_meninggal' => 'required|string',
            'tanggal_meninggal' => 'required|date',
            'status_kependudukan' => 'required|string',
        ]);

        $meninggal = Meninggals::findOrFail($id);
        $meninggal->update($request->all());

        return redirect()->route('resident-died')->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        $meninggal = Meninggals::findOrFail($id);
        $meninggal->delete();
        return redirect()->route('resident-died')->with('success', 'Data berhasil dihapus');
    }

    public function create(Request $request)
    {
        $nik = $request->query('nik');
        $penduduk = Penduduk::where('nik', $nik)->first();
        $rws = RW::all(); // Ambil data RW dari model

        if (!$penduduk) {
            return redirect()->route('resident-died')->with('error', 'Penduduk tidak ditemukan.');
        }

        return view('create.create_died', compact('penduduk', 'rws'));
    }
}

