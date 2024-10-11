<?php

namespace App\Exports;

use App\Models\Lahir;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class LahirExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        $query = Lahir::query();

        if (request()->has('search')) {
            $query->where('nama_anak_lahir', 'like', '%' . request('search') . '%')
                ->orWhere('nik', 'like', '%' . request('search') . '%');
        }

        $data = $query->get();

        // Add sequential numbers
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
            'Nama Anak Lahir',
            'Jenis Kelamin',
            'Nama Ayah Kandung',
            'Nama Ibu Kandung',
            'Alamat',
            'RW',
            'RT',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Status Kependudukan',
        ];
    }

    public function map($lahir): array
    {
        return [
            $lahir->no,
            "'" . $lahir->nik,
            $lahir->nama_anak_lahir,
            $lahir->jenis_kelamin,
            $lahir->nama_ayah_kandung,
            $lahir->nama_ibu_kandung,
            $lahir->alamat,
            $lahir->rw,
            $lahir->rt,
            $lahir->tempat_lahir,
            $lahir->tanggal_lahir,
            $lahir->status_kependudukan,
        ];
    }
}