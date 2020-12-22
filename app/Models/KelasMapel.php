<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelasMapel extends Model
{
    use HasFactory;

    protected $fillable = [
        'kelas_id',
        'mapel_id'
    ];

    public function mapel()
    {
        return $this->belongsTo('App\Models\Mapel', 'mapel_id');
    }

    protected $table = 'kelas_mapel';
}
