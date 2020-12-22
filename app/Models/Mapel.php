<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_mapel',
        'kelompok',
        'kkm',
        'bobot_p',
        'bobot_k'
    ];

    protected $table = 'mapel';
}
