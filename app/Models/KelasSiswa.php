<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KelasSiswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'kelas_id',
        'siswa_id'
    ];

    public function kelas()
    {
        return $this->belongsTo('App\Models\Kelas', 'kelas_id');
    }

    public function siswa()
    {
        return $this->belongsTo('App\Models\Siswa', 'siswa_id');
    }

    public function cekNilaiMapel($id)
    {
        $data = json_decode($id, true);
        return NilaiMapel::where('siswa_id', $data['siswa'])->where('mapel_id', $data['mapel'])->where('tahun_id', $data['tahun'])->orderBy('id', 'desc')->first();
    }

    public function cekNilaiEkstra($id)
    {
        $data = json_decode($id, true);
        return NilaiEkstra::where('siswa_id', $data['siswa'])->where('ekstra_id', $data['ekstra'])->where('tahun_id', $data['tahun'])->orderBy('id', 'desc')->first();
    }

    public function cekCatatan($id)
    {
        $data = json_decode($id, true);
        return Catatan::where('siswa_id', $data['siswa'])->where('tahun_id', $data['tahun'])->orderBy('id', 'desc')->first();
    }

    public function cekMagang($id)
    {
        $data = json_decode($id, true);
        return Magang::where('siswa_id', $data['siswa'])->where('tahun_id', $data['tahun'])->orderBy('id', 'desc')->first();
    }

    protected $table = 'kelas_siswa';
}
