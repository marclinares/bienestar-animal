<?php

namespace App\Http\Controllers;

use App\Models\Gato;
use App\Models\Colonia;
use App\Models\Foto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GatoController extends Controller
{
    public function index()
    {
        $gatos = Gato::with('colonia')->latest()->get();
        return view('gatos.index', compact('gatos'));
    }

    public function create(Request $request)
    {
        $colonia_id = $request->query('colonia_id');
        $colonias = Colonia::all();

        return view('gatos.create', compact('colonias', 'colonia_id'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre'      => 'required|string|max:255',
            'colonia_id'  => 'required|exists:colonias,id',
            'raza'        => 'nullable|string|max:255',
            'edad'        => 'nullable|integer|min:0',
            'estado'      => 'required|in:disponible,adoptado',
            'descripcion' => 'nullable|string',
            'fotos'       => 'required|array|min:1|max:3',
            'fotos.*'     => 'image|max:2048',
        ]);

        $gato = Gato::create([
            'nombre'      => $request->nombre,
            'colonia_id'  => $request->colonia_id,
            'raza'        => $request->raza,
            'edad'        => $request->edad,
            'estado'      => $request->estado,
            'descripcion' => $request->descripcion,
        ]);

        if ($request->hasFile('fotos')) {
            foreach ($request->file('fotos') as $file) {
                $path = $file->store('fotos/gatos', 'public');
                $gato->fotos()->create(['ruta' => $path]);
            }
        }

        return redirect()->route('colonias.show', $gato->colonia_id)
            ->with('success', 'Gato registrado correctamente.');
    }

    public function show(Gato $gato)
    {
        $gato->load('colonia', 'fotos');
        return view('gatos.show', compact('gato'));
    }

    public function edit(Gato $gato)
    {
        $colonias = Colonia::all();
        return view('gatos.edit', compact('gato', 'colonias'));
    }

    public function update(Request $request, Gato $gato)
    {
        $request->validate([
            'nombre'           => 'required|string|max:255',
            'colonia_id'       => 'required|exists:colonias,id',
            'raza'             => 'nullable|string|max:255',
            'edad'             => 'nullable|integer|min:0|max:30',
            'estado'           => 'required|in:disponible,adoptado',
            'descripcion'      => 'nullable|string',
            'fotos.*'          => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'eliminar_fotos'   => 'array',
            'eliminar_fotos.*' => 'exists:fotos,id',
        ]);

        // 1. PRIMERO eliminar las fotos marcadas
        if ($request->has('eliminar_fotos')) {
            foreach ($request->eliminar_fotos as $fotoId) {
                $foto = Foto::find($fotoId);
                if ($foto && $foto->gato_id === $gato->id) { // Seguridad: que sea de este gato
                    Storage::disk('public')->delete($foto->ruta);
                    $foto->delete();
                }
            }
        }

        // 2. DESPUÉS contar las fotos que quedan realmente
        if ($request->hasFile('fotos')) {
            $fotosActualesCount = $gato->fotos()->count(); // Ahora sí es el conteo actualizado
            $huecosLibres = 3 - $fotosActualesCount;

            if ($huecosLibres > 0) {
                $nuevasFotos = array_slice($request->file('fotos'), 0, $huecosLibres);

                foreach ($nuevasFotos as $archivo) {
                    $ruta = $archivo->store('fotos/gatos', 'public');
                    $gato->fotos()->create(['ruta' => $ruta]);
                }
            }
        }

        // 3. Actualizar datos del gato
        $gato->update([
            'nombre'      => $request->nombre,
            'colonia_id'  => $request->colonia_id,
            'raza'        => $request->raza,
            'edad'        => $request->edad,
            'estado'      => $request->estado,
            'descripcion' => $request->descripcion,
        ]);

        return redirect()->route('colonias.show', $gato->colonia_id)
            ->with('success', 'Gato modificado correctamente.');
    }

    public function destroy(Gato $gato)
    {
        foreach ($gato->fotos as $foto) {
            Storage::disk('public')->delete($foto->ruta);
        }

        $gato->delete();

        return redirect()->route('colonias.show', $gato->colonia_id)
            ->with('success', 'Registro eliminado del censo municipal.');
    }
}