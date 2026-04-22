@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-8 px-4 sm:px-6">
    <div class="mb-8 flex flex-col md:flex-row md:items-end justify-between gap-4">
        <div>
            <a href="{{ route('colonias.index') }}" class="text-[#7A4F2D] text-sm font-bold flex items-center gap-1 hover:text-[#D94F3D] transition-colors mb-4">
                ← Cancelar y volver
            </a>
            <h1 class="text-3xl font-serif font-bold text-[#4A2810]">Editar Expediente</h1>
            <p class="text-[#7A4F2D]/70 font-medium italic">Actualizando información de: <span class="text-[#D94F3D]">{{ $colonia->nombre }}</span></p>
        </div>

        <form action="{{ route('colonias.destroy', $colonia) }}" method="POST" onsubmit="return confirm('¿Está seguro de que desea eliminar esta colonia y todos sus registros asociados? Esta acción es irreversible.');">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-[10px] font-bold text-[#D94F3D] border border-[#D94F3D]/30 px-4 py-2 rounded-xl hover:bg-[#D94F3D] hover:text-white transition-all uppercase tracking-widest">
                Eliminar Colonia
            </button>
        </form>
    </div>

    <div class="bg-white rounded-[2.5rem] shadow-xl border border-[#F0DEC4] overflow-hidden">
        <div class="bg-[#7A4F2D] px-8 py-5 border-b border-[#F0DEC4] flex justify-between items-center">
            <div class="flex items-center gap-3 text-[#F5E6D3]">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" stroke-width="2"/></svg>
                <span class="text-xs font-bold uppercase tracking-[3px]">Modo Edición Administrativa</span>
            </div>
            <span class="text-[10px] text-[#F5E6D3]/50 font-mono">ID: #COL-{{ $colonia->id }}</span>
        </div>

        <form action="{{ route('colonias.update', $colonia) }}" method="POST" class="p-8 space-y-8">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-2">
                    <label for="nombre" class="block text-xs font-bold uppercase tracking-widest text-[#7A4F2D] ml-1">
                        Nombre de la Colonia
                    </label>
                    <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $colonia->nombre) }}" required
                        class="block w-full rounded-2xl border-[#F0DEC4] bg-[#F5E6D3]/10 px-4 py-3 text-[#4A2810] focus:border-[#D94F3D] focus:ring-[#D94F3D] transition-all">
                    @error('nombre')
                        <p class="text-[#D94F3D] text-xs font-bold mt-1 ml-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label for="persona_responsable" class="block text-xs font-bold uppercase tracking-widest text-[#7A4F2D] ml-1">
                        Persona Responsable
                    </label>
                    <input type="text" name="persona_responsable" id="persona_responsable" value="{{ old('persona_responsable', $colonia->persona_responsable) }}" required
                        class="block w-full rounded-2xl border-[#F0DEC4] bg-[#F5E6D3]/10 px-4 py-3 text-[#4A2810] focus:border-[#D94F3D] focus:ring-[#D94F3D] transition-all">
                    @error('persona_responsable')
                        <p class="text-[#D94F3D] text-xs font-bold mt-1 ml-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label for="telefono" class="block text-xs font-bold uppercase tracking-widest text-[#7A4F2D] ml-1 flex items-center gap-1">
                        Teléfono de Contacto 
                        <span class="normal-case text-[10px] tracking-normal opacity-60">(Opcional)</span>
                    </label>
                    <input type="tel" name="telefono" id="telefono" value="{{ old('telefono', $colonia->telefono) }}"
                        class="block w-full rounded-2xl border-[#F0DEC4] bg-[#F5E6D3]/10 px-4 py-3 text-[#4A2810] focus:border-[#D94F3D] focus:ring-[#D94F3D] transition-all"
                        placeholder="Ej: 600 000 000">
                    @error('telefono')
                        <p class="text-[#D94F3D] text-xs font-bold mt-1 ml-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label for="ubicacion" class="block text-xs font-bold uppercase tracking-widest text-[#7A4F2D] ml-1">
                        Ubicación Exacta
                    </label>
                    <input type="text" name="ubicacion" id="ubicacion" value="{{ old('ubicacion', $colonia->ubicacion) }}" required
                        class="block w-full rounded-2xl border-[#F0DEC4] bg-[#F5E6D3]/10 px-4 py-3 text-[#4A2810] focus:border-[#D94F3D] focus:ring-[#D94F3D] transition-all">
                    @error('ubicacion')
                        <p class="text-[#D94F3D] text-xs font-bold mt-1 ml-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex items-center justify-end gap-4 pt-6 border-t border-[#F0DEC4]">
                <a href="{{ route('colonias.index') }}" class="text-sm font-bold text-[#7A4F2D]/60 hover:text-[#7A4F2D]">
                    Descartar cambios
                </a>
                <button type="submit" class="bg-[#D94F3D] text-white px-10 py-4 rounded-2xl font-bold shadow-lg hover:bg-[#b93d2f] transition-all active:scale-95 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    Guardar Cambios
                </button>
            </div>
        </form>
    </div>
</div>
@endsection