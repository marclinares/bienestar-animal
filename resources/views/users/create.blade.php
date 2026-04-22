@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto py-10">
    <div class="mb-8 px-4">
        <a href="{{ route('dashboard') }}" class="text-[#7A4F2D] text-xs font-bold uppercase tracking-widest hover:text-[#D94F3D] mb-4 inline-block transition-colors">
            ← Volver al Panel
        </a>
        <h1 class="text-3xl font-serif font-bold text-[#4A2810]">Nuevo Usuario</h1>
        <p class="text-[#7A4F2D]/70">Crea una cuenta de acceso para un nuevo gestor municipal.</p>
    </div>

    <form action="{{ route('users.store') }}" method="POST" class="bg-white p-6 md:p-10 rounded-[2.5rem] border border-[#F0DEC4] shadow-xl space-y-6">
        @csrf

        <div>
            <label class="block text-xs font-bold uppercase tracking-widest text-[#7A4F2D] mb-2 ml-1">Nombre Completo</label>
            <input type="text" name="name" value="{{ old('name') }}" 
                class="w-full bg-[#F5E6D3]/30 border-2 {{ $errors->has('name') ? 'border-red-300 ring-red-100' : 'border-transparent' }} rounded-2xl p-4 focus:ring-2 focus:ring-[#D94F3D] focus:bg-white transition-all outline-none" 
                placeholder="Ej. Juan Pérez" required>
            @error('name')
                <p class="mt-2 ml-2 text-[10px] text-red-500 font-bold uppercase tracking-wider">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-xs font-bold uppercase tracking-widest text-[#7A4F2D] mb-2 ml-1">Correo Electrónico</label>
            <input type="email" name="email" value="{{ old('email') }}" 
                class="w-full bg-[#F5E6D3]/30 border-2 {{ $errors->has('email') ? 'border-red-300 ring-red-100' : 'border-transparent' }} rounded-2xl p-4 focus:ring-2 focus:ring-[#D94F3D] focus:bg-white transition-all outline-none" 
                placeholder="correo@ayuntamiento.es" required>
            @error('email')
                <p class="mt-2 ml-2 text-[10px] text-red-500 font-bold uppercase tracking-wider">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-xs font-bold uppercase tracking-widest text-[#7A4F2D] mb-2 ml-1">Contraseña</label>
                <input type="password" name="password" 
                    class="w-full bg-[#F5E6D3]/30 border-2 {{ $errors->has('password') ? 'border-red-300 ring-red-100' : 'border-transparent' }} rounded-2xl p-4 focus:ring-2 focus:ring-[#D94F3D] focus:bg-white transition-all outline-none" 
                    required>
                @error('password')
                    <p class="mt-2 ml-2 text-[10px] text-red-500 font-bold uppercase tracking-wider">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="block text-xs font-bold uppercase tracking-widest text-[#7A4F2D] mb-2 ml-1">Confirmar Contraseña</label>
                <input type="password" name="password_confirmation" 
                    class="w-full bg-[#F5E6D3]/30 border-2 border-transparent rounded-2xl p-4 focus:ring-2 focus:ring-[#D94F3D] focus:bg-white transition-all outline-none" 
                    required>
            </div>
        </div>

        <div class="pt-6 flex flex-col md:flex-row items-center justify-between gap-4">
            <a href="{{ route('dashboard') }}" class="text-[#7A4F2D] text-xs font-bold uppercase tracking-widest hover:text-[#D94F3D] transition-colors">
                Cancelar operación
            </a>
            <button type="submit" class="w-full md:w-auto bg-[#D94F3D] text-white px-10 py-4 rounded-2xl font-bold text-xs uppercase tracking-widest hover:bg-[#4A2810] transition-all shadow-lg shadow-[#D94F3D]/20">
                Registrar Usuario
            </button>
        </div>
    </form>
</div>
@endsection