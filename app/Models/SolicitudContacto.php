<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SolicitudContacto extends Model
{
    protected $table = 'solicitudes_contacto';
    protected $fillable = ['nombre', 'email', 'gato_nombre', 'mensaje', 'leido', 'telefono', 'especie'];
}