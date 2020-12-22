<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_siswa',
        'no_induk',
        'nisn',
        'jk',
        'agama',
        'status_keluarga',
        'anak_ke',
        'alamat',
        'telp',
        'asal_sekolah',
        'nama_ayah',
        'nama_ibu',
        'alamat_ortu',
        'telp_ortu',
        'pekerjaan_ayah',
        'pekerjaan_ibu',
        'nama_wali',
        'alamat_wali',
        'telp_wali',
        'pekerjaan_wali',
        'status',
        'lulus'
    ];

    public function user($id)
    {
        return User::where('level', 'Siswa')->where('data_id', $id)->first();
    }

    public function kelas()
    {
        return $this->belongsToMany('App\Models\Kelas');
    }

    public function cekSiswa($id)
    {
        $cekSiswa = KelasSiswa::where('siswa_id', $id)->count();
        if ($cekSiswa > 0) {
            return false;
        } else {
            return true;
        }
    }

    protected $table = 'siswa';
}
