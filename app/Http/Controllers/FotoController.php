<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Perro;
use App\Models\Gato;
use App\Models\Foto;
use Illuminate\Support\Facades\Storage;

class FotoController extends Controller
{

    public function storePerro(Request $request, Perro $perro)
    {
        $request->validate([
            'foto' => 'required|image|max:2048'
        ]);

        $path = $request->file('foto')->store('fotos/perros', 'public');

        $foto = $perro->fotos()->create([
            'ruta' => $path
        ]);

        return response()->json([
            'message' => 'Foto de perro subida correctamente',
            'data' => $foto
        ]);
    }

    public function storeGato(Request $request, Gato $gato)
    {
        $request->validate([
            'foto' => 'required|image|max:2048'
        ]);

        $path = $request->file('foto')->store('fotos/gatos', 'public');

        $foto = $gato->fotos()->create([
            'ruta' => $path
        ]);

        return response()->json([
            'message' => 'Foto de gato subida correctamente',
            'data' => $foto
        ]);
    }

    public function destroy(Foto $foto)
    {
        // borrar archivo físico
        \Storage::disk('public')->delete($foto->ruta);

        $foto->delete();

        return response()->json([
            'message' => 'Foto eliminada correctamente'
        ]);
    }

}
