<?php

namespace App\Imports;

use App\Models\Magang;
use App\Models\Siswa;
use App\Models\Tahun;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MagangImport implements ToModel, WithHeadingRow
{
    use Importable;

    public function model(array $row)
    {
        $siswa = Siswa::where('no_induk', $row['no_induk_siswa'])->first();
        $tahun = Tahun::where('status', 'Aktif')->first();

        return new Magang([
            'siswa_id' => $siswa->id,
            'mitra' => $row['mitra_dudi'],
            'lokasi' => $row['lokasi'],
            'lamanya' => $row['lamanya'],
            'ket' => $row['keterangan'],
            'tahun_id' => $tahun->id,
        ]);
    }

    public function headingRow(): int
    {
        return 1;
    }
}
