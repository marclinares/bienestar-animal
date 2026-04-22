<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    use HasFactory;

    protected $fillable = [
        'ruta',
        'perro_id',
        'gato_id',
    ];

    public function perro()
    {
        return $this->belongsTo(Perro::class);
    }

    public function gato()
    {
        return $this->belongsTo(Gato::class);
    }
    
}
