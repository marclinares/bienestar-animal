<?php

namespace App\Http\Controllers;

use App\Models\MensajeContacto;
use Illuminate\Http\Request;

class MensajeGeneralController extends Controller
{
    // 1. Vista pública
    public function index() {
        return view('public.contacto');
    }

    // 2. Guardar mensaje del ciudadano
    public function store(Request $request) {
        $data = $request->validate([
            'nombre'  => 'required|string|max:255',
            'email'   => 'required|email',
            'telefono' => 'nullable|string|max:20',
            'asunto'  => 'required|string',
            'mensaje' => 'required|string',
        ]);

        MensajeContacto::create($data);

        // Usamos redirect a la ruta index para asegurar que el mensaje de éxito cargue bien
        return redirect()->route('contacto.index')->with('success', 'Tu mensaje ha sido enviado al Ayuntamiento. Gracias.');
    }

    // 3. Listado para el Admin
    public function adminIndex() {
        $mensajes = MensajeContacto::orderBy('leido', 'asc')
                    ->latest()
                    ->get();
                    
        return view('admin.mensajes.index', compact('mensajes'));
    }

    // 4. Marcar como leído
    public function markAsRead(MensajeContacto $mensaje) {
        $mensaje->update(['leido' => true]);
        return back()->with('success', 'Mensaje marcado como gestionado.');
    }

    // 5. Borrar mensaje (ESTE ES EL QUE FALTABA)
    public function destroy(MensajeContacto $mensaje) {
        $mensaje->delete();
        return back()->with('success', 'Mensaje eliminado correctamente.');
    }
}