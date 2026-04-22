<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gato extends Model
{
    use HasFactory;

    protected $fillable = [
        'colonia_id',
        'nombre',
        'edad',
        'raza',
        'descripcion',
        'estado',
    ];

    public function fotos()
    {
        return $this->hasMany(Foto::class);
    }

    public function colonia()
    {
        return $this->belongsTo(Colonia::class);
    }
}
