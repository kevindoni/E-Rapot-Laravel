<?php

namespace App\Imports;

use App\Models\Mapel;
use App\Models\Siswa;
use App\Models\KelasSiswa;
use App\Models\NilaiMapel;
use App\Models\Tahun;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class NilaiImport implements ToModel, WithHeadingRow
{
    use Importable;

    public function model(array $row)
    {
        $siswa = Siswa::where('no_induk', $row['no_induk_siswa'])->first();
        $kelas = KelasSiswa::with('kelas')->where('siswa_id', $siswa->id)->first();
        $mapel = Mapel::where('nama_mapel', $row['mata_pelajaran'])->first();
        $tahun = Tahun::where('status', 'Aktif')->first();

        return new NilaiMapel([
            'siswa_id' => $siswa->id,
            'kelas_id' => $kelas->kelas_id,
            'wali_kelas' => $kelas->kelas->wali_kelas,
            'mapel_id' => $mapel->id,
            'nilai_p' => $row['nilai_pengetahuan'],
            'nilai_k' => $row['nilai_keterampilan'],
            'tahun_id' => $tahun->id,
            'kelompok' => $mapel->kelompok,
        ]);
    }

    public function headingRow(): int
    {
        return 1;
    }
}
