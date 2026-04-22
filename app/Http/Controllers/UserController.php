<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Muestra el formulario de creación.
     * Solo accesible por Administradores.
     */
    public function create()
    {
        // 1. Verificamos si es admin (Protección a nivel de servidor)
        if (!Auth::user()->isAdmin()) {
            abort(403, 'No tienes permisos para realizar esta acción.');
        }

        return view('users.create');
    }

    /**
     * Guarda el nuevo usuario en la base de datos.
     */
    public function store(Request $request)
    {
        // También protegemos el guardado por seguridad
        if (!Auth::user()->isAdmin()) {
            abort(403);
        }

        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'user', // Por defecto creamos usuarios normales
        ]);

        return redirect()->route('dashboard')->with('success', '¡Nuevo gestor registrado con éxito!');
    }
}