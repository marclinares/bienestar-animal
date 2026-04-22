<?php

namespace App\Http\Controllers;

use App\Models\SolicitudContacto;
use Illuminate\Http\Request;

class ContactoController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telefono' => 'nullable|string|max:20', // Validación opcional
            'mensaje' => 'required|string',
            'interesado_en' => 'required|string',
            'especie' => 'required|string' // Recibimos 'gato' o 'perro'
        ]);

        SolicitudContacto::create([
            'nombre' => $request->nombre,
            'email' => $request->email,
            'telefono' => $request->telefono,
            'gato_nombre' => $request->interesado_en,
            'mensaje' => $request->mensaje,
            'especie' => $request->especie,
        ]);

        return back()->with('success', '¡Gracias! Tu solicitud ha sido recibida.');
    }
    
    public function index()
    {
        // Obtenemos todas las solicitudes, las no leídas primero
        $solicitudes = SolicitudContacto::orderBy('leido', 'asc')
                        ->orderBy('created_at', 'desc')
                        ->get();

        return view('admin.solicitudes.index', compact('solicitudes'));
    }

    public function markAsRead(\App\Models\SolicitudContacto $solicitud)
    {
        $solicitud->update(['leido' => true]);
        return back()->with('success', 'Solicitud marcada como gestionada correctamente.');
    }

    public function destroy(\App\Models\SolicitudContacto $solicitud)
    {
        $solicitud->delete();
        return back()->with('success', 'Solicitud eliminada.');
    }
}