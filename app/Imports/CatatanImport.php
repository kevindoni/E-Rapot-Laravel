<?php

namespace App\Imports;

use App\Models\Catatan;
use App\Models\Siswa;
use App\Models\Tahun;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CatatanImport implements ToModel, WithHeadingRow
{
    use Importable;

    public function model(array $row)
    {
        $siswa = Siswa::where('no_induk', $row['no_induk_siswa'])->first();
        $tahun = Tahun::where('status', 'Aktif')->first();

        return new Catatan([
            'siswa_id' => $siswa->id,
            'catatan' => $row['catatan_akademik'],
            'tahun_id' => $tahun->id,
        ]);
    }

    public function headingRow(): int
    {
        return 1;
    }
}
