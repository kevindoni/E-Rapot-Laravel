<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiEkstra extends Model
{
    use HasFactory;

    protected $fillable = [
        'siswa_id',
        'ekstra_id',
        'nilai',
        'tahun_id'
    ];

    public function ekstra()
    {
        return $this->belongsTo('App\Models\Ekstra', 'ekstra_id');
    }

    protected $table = 'nilai_ekstra';
}
