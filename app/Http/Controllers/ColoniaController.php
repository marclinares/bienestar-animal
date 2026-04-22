<?php

namespace App\Http\Controllers;

use App\Models\Colonia;
use Illuminate\Http\Request;

class ColoniaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $colonias = Colonia::latest()->get();
        return view('colonias.index', compact('colonias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('colonias.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'ubicacion' => 'required',
            'persona_responsable' => 'required',
        ]);

        Colonia::create($request->all());

        return redirect()->route('colonias.index')
            ->with('success', 'Colonia creada correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Colonia $colonia)
    {
        // Cargamos la colonia con sus gatos asociados
        $colonia->load('gatos'); 
        return view('colonias.show', compact('colonia'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Colonia $colonia)
    {
        return view('colonias.edit', compact('colonia'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Colonia $colonia)
    {
        $request->validate([
            'nombre' => 'required',
            'ubicacion' => 'required',
            'persona_responsable' => 'required',
        ]);

        $colonia->update($request->all());

        return redirect()->route('colonias.index')
            ->with('success', 'Colonia actualizada');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Colonia $colonia)
    {
        $colonia->delete();

        return redirect()->route('colonias.index')
            ->with('success', 'Colonia eliminada');
    }


    /**
     * Muestra el listado público de colonias para los ciudadanos.
     */
    public function publicIndex()
    {
        // Obtenemos las colonias y contamos cuántos gatos tiene cada una
        $colonias = \App\Models\Colonia::withCount('gatos')->get();
        
        return view('public.colonias.index', compact('colonias'));
    }

    /**
     * Muestra los gatos de una colonia específica al ciudadano.
     */
    public function publicShow(\App\Models\Colonia $colonia)
    {
        // Cargamos los gatos de esa colonia con sus fotos para la galería
        $colonia->load(['gatos' => function($query) {
            $query->where('estado', 'disponible')->with('fotos');
        }]);

        return view('public.colonias.show', compact('colonia'));
    }
}
