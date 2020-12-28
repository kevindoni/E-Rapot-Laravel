<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiMapel extends Model
{
    use HasFactory;

    protected $fillable = [
        'siswa_id',
        'kelas_id',
        'wali_kelas',
        'mapel_id',
        'nilai_p',
        'nilai_k',
        'tahun_id'
    ];

    public function kelas()
    {
        return $this->belongsTo('App\Models\Kelas', 'kelas_id');
    }

    public function wali()
    {
        return $this->belongsTo('App\Models\Guru', 'wali_kelas');
    }

    public function mapel()
    {
        return $this->belongsTo('App\Models\Mapel', 'mapel_id');
    }

    public function tahun()
    {
        return $this->belongsTo('App\Models\Tahun', 'tahun_id');
    }

    public function cekNilaiMapel($id)
    {
        $data = json_decode($id, true);
        return NilaiMapel::where('siswa_id', $data['siswa'])->where('mapel_id', $data['mapel'])->where('tahun_id', $data['tahun'])->orderBy('id', 'desc')->first();
    }

    public function cekPredikat($id)
    {
        $data = json_decode($id, true);
        if ($data['kelompok'] == 'Kompetensi Keahlian' || $data['kelompok'] == 'Dasar Program Keahlian') {
            return Predikat::orderBy('produktif', 'desc')->where('produktif', '<=', $data['nilai'])->first();
        } elseif ($data['kelompok'] == 'Muatan Nasional' || $data['kelompok'] == 'Muatan Kewilayahan' || $data['kelompok'] == 'Dasar Bidang Keahlian') {
            return Predikat::orderBy('normatif', 'desc')->where('normatif', '<=', $data['nilai'])->first();
        } else {
            return " - ";
        }
    }

    protected $table = 'nilai_mapel';
}
