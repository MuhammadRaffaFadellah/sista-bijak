<?php

namespace App\Exports;

use App\Models\MigrasiKeluar;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class MigrasiKeluarExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        $query = MigrasiKeluar::query();

        if (request()->has('search')) {
            $query->where('nama_lengkap', 'like', '%' . request('search') . '%')
                ->orWhere('nik', 'like', '%' . request('search') . '%');
        }

        if (request()->has('filter_rw')) {
            $query->where('rw', request('filter_rw'));
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
            'Nama Lengkap',
            'Jenis Kelamin',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Status Hubkel',
            'Pendidikan Terakhir',
            'Jenis Pekerjaan',
            'Agama',
            'Status Perkawinan',
            'Alamat',
            'RW',
            'RT',
            'Kelurahan',
            'Status Kependudukan',
        ];
    }

    public function map($migrasi): array
    {
        return [
            $migrasi->no,
            "'" . $migrasi->nik,
            $migrasi->nama_lengkap,
            $migrasi->jenis_kelamin,
            $migrasi->tempat_lahir,
            $migrasi->tanggal_lahir,
            $migrasi->status_hubkel,
            $migrasi->pendidikan_terakhir,
            $migrasi->jenis_pekerjaan,
            $migrasi->agama,
            $migrasi->status_perkawinan,
            $migrasi->alamat,
            $migrasi->rw,
            $migrasi->rt,
            $migrasi->kelurahan,
            $migrasi->status_kependudukan,
        ];
    }
}