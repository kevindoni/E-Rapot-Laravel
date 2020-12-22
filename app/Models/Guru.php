<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;

    protected $fillable = [
        'nip',
        'nama_guru',
        'status'
    ];

    public function user($id)
    {
        return User::where('level', 'Guru')->where('data_id', $id)->first();
    }

    public function cekWali($id)
    {
        $setSiswa = Kelas::where('wali_kelas', $id)->count();
        if ($setSiswa > 0) {
            return false;
        } else {
            return true;
        }
    }

    protected $table = 'guru';
}
