<?php

namespace App\Exports;

use App\Models\Meninggals;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class MeninggalExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        $query = Meninggals::query();

        if (request()->has('search')) {
            $query->where('nama_almarhum', 'like', '%' . request('search') . '%')
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
            'Nama Almarhum',
            'Hubungan dengan KK',
            'Jenis Kelamin',
            'RW',
            'RT',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Tempat Meninggal',
            'Tanggal Meninggal',
            'Alamat',
            'Status Kependudukan',
        ];
    }

    public function map($meninggal): array
    {
        return [
            $meninggal->no,
            "'" . $meninggal->nik,
            $meninggal->nama_almarhum,
            $meninggal->hubungan_dengan_kk,
            $meninggal->jenis_kelamin,
            $meninggal->rw,
            $meninggal->rt,
            $meninggal->tempat_lahir,
            $meninggal->tanggal_lahir,
            $meninggal->tempat_meninggal,
            $meninggal->tanggal_meninggal,
            $meninggal->alamat,
            $meninggal->status_kependudukan,
        ];
    }
}