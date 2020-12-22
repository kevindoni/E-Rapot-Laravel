<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tahun extends Model
{
    use HasFactory;

    protected $fillable = [
        'semester',
        'tahun',
        'kpl_sklh',
        'nip_kespek',
        'status'
    ];

    protected $table = 'tahun';
}
