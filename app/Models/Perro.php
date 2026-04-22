<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perro extends Model
{
    use HasFactory;

    protected $fillable = [
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
}
