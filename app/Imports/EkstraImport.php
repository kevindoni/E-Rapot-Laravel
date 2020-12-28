<?php

namespace App\Imports;

use App\Models\Siswa;
use App\Models\Tahun;
use App\Models\Ekstra;
use App\Models\NilaiEkstra;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class EkstraImport implements ToModel, WithHeadingRow
{
    use Importable;

    public function model(array $row)
    {
        $siswa = Siswa::where('no_induk', $row['no_induk_siswa'])->first();
        $ekstra = Ekstra::where('nama_ekstra', $row['nama_ekstra'])->first();
        $tahun = Tahun::where('status', 'Aktif')->first();

        return new NilaiEkstra([
            'siswa_id' => $siswa->id,
            'ekstra_id' => $ekstra->id,
            'nilai' => $row['nilai'],
            'tahun_id' => $tahun->id,
        ]);
    }

    public function headingRow(): int
    {
        return 1;
    }
}
