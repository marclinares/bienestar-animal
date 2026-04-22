<?php

namespace App\Http\Controllers;

use App\Models\Colonia;
use App\Models\Gato;
use App\Models\Perro;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Contamos los registros para las tarjetas del Dashboard
        $stats = [
            'totalColonias' => Colonia::count(),
            'totalGatos'    => Gato::count(),
            // Filtramos para contar solo los que tienen el estado 'disponible'
            'totalPerros'   => Perro::where('estado', 'disponible')->count(),
        ];

        return view('dashboard', $stats);
    }
}