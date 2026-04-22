<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ColoniaController;
use App\Http\Controllers\GatoController;
use App\Http\Controllers\PerroController;
use App\Http\Controllers\FotoController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\MensajeGeneralController; // <--- NUEVO CONTROLADOR
use Illuminate\Support\Facades\Route;

// --- ZONA PÚBLICA ---
Route::get('/', function () {
    return view('home');
})->name('home');

// Rutas para ciudadanos (Gatos)
Route::get('/adopcion/gatos', [ColoniaController::class, 'publicIndex'])->name('public.colonias');
Route::get('/adopcion/gatos/colonia/{colonia}', [ColoniaController::class, 'publicShow'])->name('public.colonias.show');

// Rutas para ciudadanos (Perros)
Route::get('/adopcion/perros', [PerroController::class, 'publicIndex'])->name('public.perros');

// Formulario de Contacto General (Nueva Tabla/Lógica)
Route::get('/contacto', [MensajeGeneralController::class, 'index'])->name('contacto.index');
Route::post('/contacto', [MensajeGeneralController::class, 'store'])->name('contacto.general.store');

// Ruta de contacto específica para adopción (Gatos/Perros)
Route::post('/contacto-adopcion', [ContactoController::class, 'store'])->name('contacto.store');


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

    // Gestión de Usuarios
    Route::get('/usuarios/crear', [UserController::class, 'create'])->name('users.create');
    Route::post('/usuarios', [UserController::class, 'store'])->name('users.store');

    // Perfil de Usuario
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // --- BUZONES DE ENTRADA ---

    // 1. Gestión de Solicitudes de Adopción (Específicas de animales)
    Route::get('/admin/solicitudes', [ContactoController::class, 'index'])->name('admin.solicitudes.index');
    Route::patch('/admin/solicitudes/{solicitud}/leer', [ContactoController::class, 'markAsRead'])->name('admin.solicitudes.read');
    Route::delete('/admin/solicitudes/{solicitud}', [ContactoController::class, 'destroy'])->name('admin.solicitudes.destroy');

    // 2. Gestión de Mensajes Generales (Consultas, Voluntariado, etc.)
    Route::get('/admin/mensajes-generales', [MensajeGeneralController::class, 'adminIndex'])->name('admin.mensajes.index');
    Route::patch('/admin/mensajes-generales/{mensaje}/leer', [MensajeGeneralController::class, 'markAsRead'])->name('admin.mensajes.read');
    Route::delete('/admin/mensajes-generales/{mensaje}', [MensajeGeneralController::class, 'destroy'])->name('admin.mensajes.destroy');
});

require __DIR__.'/auth.php';