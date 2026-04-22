<?php

namespace App\Http\Controllers;

use App\Models\Colonia;
use App\Models\Gato;
use App\Models\Perro;
use App\Models\SolicitudContacto; // <--- Importante añadir el modelo
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Recopilamos todos los datos necesarios para las tarjetas
        $data = [
            'totalColonias'        => Colonia::count(),
            'totalGatos'           => Gato::count(),
            // Filtramos para contar solo los perros en adopción
            'totalPerros'          => Perro::where('estado', 'disponible')->count(),
            // Contamos solo las solicitudes que el admin aún no ha gestionado
            'solicitudesPendientes' => SolicitudContacto::where('leido', false)->count(),
        ];
        
        // Pasamos el array completo a la vista
        return view('dashboard', $data);
    }
}