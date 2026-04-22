<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Colonia;
use App\Models\Gato;
use App\Models\Perro;
use App\Models\SolicitudContacto; // El de adopciones
use App\Models\MensajeContacto;   // <--- ASEGÚRATE DE IMPORTAR EL NUEVO MODELO

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Contamos los registros para las tarjetas de arriba
        $totalColonias = Colonia::count();
        $totalGatos = Gato::count();
        $totalPerros = Perro::count();

        // 2. Contamos las solicitudes de adopción pendientes (coral)
        $solicitudesPendientes = SolicitudContacto::where('leido', false)->count();

        // 3. Contamos los mensajes del buzón general pendientes (azul)
        // ESTA ES LA VARIABLE QUE TE FALTA 👇
        $mensajesGeneralesPendientes = MensajeContacto::where('leido', false)->count();

        // 4. Enviamos TODO a la vista
        return view('dashboard', compact(
            'totalColonias', 
            'totalGatos', 
            'totalPerros', 
            'solicitudesPendientes',
            'mensajesGeneralesPendientes' // <--- PASAMOS LA VARIABLE AQUÍ
        ));
    }
}