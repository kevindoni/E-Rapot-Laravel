<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $fillable = [
        'kelas',
        'prodi_id',
        'nama',
        'nama_kelas',
        'wali_kelas',
        'status'
    ];

    public function prodi()
    {
        return $this->belongsTo('App\Models\Prodi', 'prodi_id');
    }

    public function wali()
    {
        return $this->belongsTo('App\Models\Guru', 'wali_kelas');
    }

    public function user($id)
    {
        return User::where('level', 'Wali Kelas')->where('data_id', $id)->first();
    }

    public function siswa()
    {
        return $this->belongsToMany('App\Models\Siswa');
    }

    public function mapel()
    {
        return $this->belongsToMany('App\Models\Mapel');
    }

    public function kelasMapel($id)
    {
        $data = json_decode($id, true);
        return KelasMapel::where('kelas_id', $data['kelas'])->where('mapel_id', $data['mapel'])->first();
    }

    public function kelasSiswa($id)
    {
        $data = json_decode($id, true);
        return KelasSiswa::where('kelas_id', $data['kelas'])->where('siswa_id', $data['siswa'])->first();
    }

    protected $table = 'kelas';
}
