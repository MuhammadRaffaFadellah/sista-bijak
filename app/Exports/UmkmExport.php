<?php

namespace App\Exports;

use App\Models\Umkm;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UmkmExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        $query = Umkm::select([
            'id',
            'nik',
            'nama_rw',
            'rw',
            'kategori_umkm',
            'jumlah_umkm',
            'jenis_umkm',
            'nama_pemilik',
            'alamat',
        ]);

        // Tambahkan filter jika ada
        if (request()->has('search')) {
            $query->where('nama_pemilik', 'like', '%' . request('search') . '%')
                ->orWhere('nik', 'like', '%' . request('search') . '%');
        }

        if (request()->has('filter_rw')) {
            $query->where('rw', request('filter_rw'));
        }

        $data = $query->get();

        // Tambahkan nomor urut
        $data->each(function ($item, $key) {
            $item->setAttribute('no', $key + 1);
        });

        return $data;
    }

    public function headings(): array
    {
        return [
            'NO',
            'NIK',
            'Nama RW',
            'RW',
            'Kategori UMKM',
            'Jumlah UMKM',
            'Jenis UMKM',
            'Nama Pemilik',
            'Alamat',
        ];
    }

    public function map($umkm): array
    {
        return [
            $umkm->no,
            "'" . $umkm->nik, // Tambahkan tanda kutip untuk memformat sebagai teks
            $umkm->nama_rw,
            $umkm->rw,
            $umkm->kategori_umkm,
            $umkm->jumlah_umkm,
            $umkm->jenis_umkm,
            $umkm->nama_pemilik,
            $umkm->alamat,
        ];
    }
}