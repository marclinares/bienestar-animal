<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Colonia extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'ubicacion',
        'persona_responsable',
        'telefono',
    ];

    public function gatos()
    {
        return $this->hasMany(Gato::class);
    }
}
