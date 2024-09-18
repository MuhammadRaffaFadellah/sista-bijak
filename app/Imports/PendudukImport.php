<?php

namespace App\Imports;

use App\Models\Penduduk;
use Maatwebsite\Excel\Concerns\ToModel;

class PendudukImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Penduduk([
            'nik'                   => $row[0],
            'nama_lengkap'          => $row[1],
            'jenis_kelamin'         => $row[2],
            'tempat_lahir'          => $row[3],
            'tanggal_lahir'         =>  \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[4]),
            'status_hubkel'         => $row[5],
            'pendidikan_terakhir'   => $row[6],
            'jenis_pekerjaan'       => $row[7],
            'agama'                 => $row[8],
            'status_perkawinan'     => $row[9],
            'alamat'                => $row[10],
            'rw'                    => $row[11],
            'rt'                    => $row[12],
            'kelurahan'             => $row[13],
            'status_kependudukan'   => $row[14],
        ]);
    }
}
