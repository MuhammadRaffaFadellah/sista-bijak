<?php

namespace App\Exports;

use App\Models\Penduduk;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PendudukExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        $query = Penduduk::query();

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

    public function map($penduduk): array
    {
        return [
            $penduduk->no,
            "'" . $penduduk->nik,
            $penduduk->nama_lengkap,
            $penduduk->jenis_kelamin,
            $penduduk->tempat_lahir,
            $penduduk->tanggal_lahir,
            $penduduk->status_hubkel,
            $penduduk->pendidikan_terakhir,
            $penduduk->jenis_pekerjaan,
            $penduduk->agama,
            $penduduk->status_perkawinan,
            $penduduk->alamat,
            $penduduk->rw,
            $penduduk->rt,
            $penduduk->kelurahan,
            $penduduk->status_kependudukan,
        ];
    }
}