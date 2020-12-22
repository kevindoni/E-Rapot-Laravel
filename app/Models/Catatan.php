<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'siswa_id',
        'catatan',
        'tahun_id'
    ];

    protected $table = 'catatan';
}
