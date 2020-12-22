<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $fillable = [
        'kelas_id',
        'guru_id',
        'mapel_id'
    ];

    public function kelas()
    {
        return $this->belongsTo('App\Models\Kelas', 'kelas_id');
    }

    public function guru()
    {
        return $this->belongsTo('App\Models\Guru', 'guru_id');
    }

    public function mapel()
    {
        return $this->belongsTo('App\Models\Mapel', 'mapel_id');
    }

    protected $table = 'jadwal';
}
