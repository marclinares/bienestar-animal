<?php

namespace App\Http\Controllers;

use App\Models\Perro;
use App\Models\Foto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PerroController extends Controller
{
    /**
     * Listado general de perros.
     */
    public function index()
    {
        // Cargamos los perros con sus fotos para evitar el problema de consultas N+1
        $perros = Perro::with('fotos')->latest()->get();
        return view('perros.index', compact('perros'));
    }

    /**
     * Formulario de alta de perro.
     */
    public function create()
    {
        return view('perros.create');
    }

    /**
     * Guardar nuevo perro.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre'      => 'required|string|max:255',
            'raza'        => 'nullable|string|max:255',
            'edad'        => 'nullable|integer|min:0|max:30',
            'estado'      => 'required|in:disponible,adoptado',
            'descripcion' => 'nullable|string',
            'fotos'       => 'required|array|min:1|max:3',
            'fotos.*'     => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Crear el registro del perro
        $perro = Perro::create([
            'nombre'      => $request->nombre,
            'raza'        => $request->raza,
            'edad'        => $request->edad,
            'estado'      => $request->estado,
            'descripcion' => $request->descripcion,
        ]);

        // Procesar fotos iniciales
        if ($request->hasFile('fotos')) {
            foreach ($request->file('fotos') as $file) {
                $path = $file->store('fotos/perros', 'public');
                $perro->fotos()->create(['ruta' => $path]);
            }
        }

        return redirect()->route('perros.index')
            ->with('success', 'El canino ' . $perro->nombre . ' ha sido dado de alta correctamente.');
    }

    /**
     * Ver ficha detallada (si decides usarla).
     */
    public function show(Perro $perro)
    {
        $perro->load('fotos');
        return view('perros.show', compact('perro'));
    }

    /**
     * Formulario de edición.
     */
    public function edit(Perro $perro)
    {
        return view('perros.edit', compact('perro'));
    }

    /**
     * Actualizar perro y gestión de galería.
     */
    public function update(Request $request, Perro $perro)
    {
        $request->validate([
            'nombre'           => 'required|string|max:255',
            'raza'             => 'nullable|string|max:255',
            'edad'             => 'nullable|integer|min:0|max:30',
            'estado'           => 'required|in:disponible,adoptado',
            'descripcion'      => 'nullable|string',
            'fotos.*'          => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'eliminar_fotos'   => 'array',
            'eliminar_fotos.*' => 'exists:fotos,id',
        ]);

        // 1. Eliminar fotos marcadas para borrar
        if ($request->has('eliminar_fotos')) {
            foreach ($request->eliminar_fotos as $fotoId) {
                $foto = Foto::find($fotoId);
                // Verificamos que la foto pertenezca a este perro por seguridad
                if ($foto && $foto->perro_id === $perro->id) {
                    Storage::disk('public')->delete($foto->ruta);
                    $foto->delete();
                }
            }
            // Refrescamos la relación para el conteo posterior
            $perro->unsetRelation('fotos');
        }

        // 2. Subir nuevas fotos (hasta completar el cupo de 3)
        if ($request->hasFile('fotos')) {
            $fotosActualesCount = $perro->fotos()->count();
            $huecosLibres = 3 - $fotosActualesCount;

            if ($huecosLibres > 0) {
                $nuevasFotos = array_slice($request->file('fotos'), 0, $huecosLibres);
                foreach ($nuevasFotos as $archivo) {
                    $ruta = $archivo->store('fotos/perros', 'public');
                    $perro->fotos()->create(['ruta' => $ruta]);
                }
            }
        }

        // 3. Actualizar datos básicos
        $perro->update([
            'nombre'      => $request->nombre,
            'raza'        => $request->raza,
            'edad'        => $request->edad,
            'estado'      => $request->estado,
            'descripcion' => $request->descripcion,
        ]);

        return redirect()->route('perros.index')
            ->with('success', 'Ficha de ' . $perro->nombre . ' actualizada con éxito.');
    }

    /**
     * Eliminar perro y todos sus archivos.
     */
    public function destroy(Perro $perro)
    {
        // Borrado preventivo de archivos físicos
        foreach ($perro->fotos as $foto) {
            Storage::disk('public')->delete($foto->ruta);
        }

        $perro->delete();

        return redirect()->route('perros.index')
            ->with('success', 'Registro canino eliminado del sistema.');
    }

    //MOstrar los perros a los usuarios públicos, solo los disponibles para adopción
    public function publicIndex()
    {
        // Obtenemos solo los perros disponibles para adopción
        $perros = Perro::where('estado', 'disponible')->with('fotos')->get();
        
        return view('public.perros.index', compact('perros'));
    }
}