<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ColoniaController;
use App\Http\Controllers\GatoController;
use App\Http\Controllers\PerroController;
use App\Http\Controllers\FotoController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController; // <--- Importante añadir esta línea
use Illuminate\Support\Facades\Route;

// --- ZONA PÚBLICA ---
Route::get('/', function () {
    return view('home');
})->name('home');

// Rutas para ciudadanos (Públicas)
Route::get('/adopcion/gatos', [ColoniaController::class, 'publicIndex'])->name('public.colonias');
Route::get('/adopcion/gatos/colonia/{colonia}', [ColoniaController::class, 'publicShow'])->name('public.colonias.show');
Route::post('/contacto-adopcion', [App\Http\Controllers\ContactoController::class, 'store'])->name('contacto.store');


// --- ZONA PRIVADA (AYUNTAMIENTO) ---
Route::middleware(['auth', 'verified'])->group(function () {
    
    // El Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Gestión de Recursos Principales
    Route::resource('colonias', ColoniaController::class);
    Route::resource('perros', PerroController::class);
    Route::resource('gatos', GatoController::class);

    // Gestión de Fotos
    Route::post('/perros/{perro}/fotos', [FotoController::class, 'storePerro'])->name('perros.fotos.store');
    Route::post('/gatos/{gato}/fotos', [FotoController::class, 'storeGato'])->name('gatos.fotos.store');
    Route::delete('/fotos/{foto}', [FotoController::class, 'destroy'])->name('fotos.destroy');

    // Gestión de Usuarios (NUEVO)
    // Usamos resource para simplificar, pero limitamos a lo que necesitas
    Route::get('/usuarios/crear', [UserController::class, 'create'])->name('users.create');
    Route::post('/usuarios', [UserController::class, 'store'])->name('users.store');

    // Perfil de Usuario
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';