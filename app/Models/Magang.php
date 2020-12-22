<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Magang extends Model
{
    use HasFactory;

    protected $fillable = [
        'siswa_id',
        'mitra',
        'lokasi',
        'lamanya',
        'ket',
        'tahun_id'
    ];

    protected $table = 'magang';
}
