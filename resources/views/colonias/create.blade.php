@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-8 px-4 sm:px-6">
    <div class="mb-8">
        <a href="{{ route('colonias.index') }}" class="text-[#7A4F2D] text-sm font-bold flex items-center gap-1 hover:text-[#D94F3D] transition-colors mb-4">
            ← Volver al listado
        </a>
        <h1 class="text-3xl font-serif font-bold text-[#4A2810]">Registrar Nueva Colonia</h1>
        <p class="text-[#7A4F2D]/70">Introduzca los datos para el censo municipal de colonias felinas.</p>
    </div>

    <div class="bg-white rounded-[2.5rem] shadow-xl border border-[#F0DEC4] overflow-hidden">
        <div class="bg-[#F5E6D3]/30 px-8 py-6 border-b border-[#F0DEC4]">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-[#7A4F2D] rounded-full flex items-center justify-center text-[#F5E6D3]">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" stroke-width="2" stroke-linecap="round"/></svg>
                </div>
                <span class="text-xs font-bold uppercase tracking-widest text-[#7A4F2D]">Formulario de Registro Oficial</span>
            </div>
        </div>

        <form action="{{ route('colonias.store') }}" method="POST" class="p-8 space-y-8">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-2">
                    <label for="nombre" class="block text-xs font-bold uppercase tracking-widest text-[#7A4F2D] ml-1">
                        Nombre de la Colonia
                    </label>
                    <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}" required
                        class="block w-full rounded-2xl border-[#F0DEC4] bg-[#F5E6D3]/10 px-4 py-3 text-[#4A2810] focus:border-[#D94F3D] focus:ring-[#D94F3D] transition-all placeholder-[#7A4F2D]/30"
                        placeholder="Ej: Colonia del Parque Central">
                    @error('nombre')
                        <p class="text-[#D94F3D] text-xs font-bold mt-1 ml-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label for="persona_responsable" class="block text-xs font-bold uppercase tracking-widest text-[#7A4F2D] ml-1">
                        Persona Responsable (Gestor/a)
                    </label>
                    <input type="text" name="persona_responsable" id="persona_responsable" value="{{ old('persona_responsable') }}" required
                        class="block w-full rounded-2xl border-[#F0DEC4] bg-[#F5E6D3]/10 px-4 py-3 text-[#4A2810] focus:border-[#D94F3D] focus:ring-[#D94F3D] transition-all placeholder-[#7A4F2D]/30"
                        placeholder="Nombre completo del voluntario">
                    @error('persona_responsable')
                        <p class="text-[#D94F3D] text-xs font-bold mt-1 ml-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label for="telefono" class="block text-xs font-bold uppercase tracking-widest text-[#7A4F2D] ml-1 flex items-center gap-1">
                        Teléfono de Contacto 
                        <span class="normal-case text-[10px] tracking-normal opacity-60">(Opcional)</span>
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-[#7A4F2D]/40">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        </span>
                        <input type="tel" name="telefono" id="telefono" value="{{ old('telefono') }}"
                            class="block w-full rounded-2xl border-[#F0DEC4] bg-[#F5E6D3]/10 pl-11 pr-4 py-3 text-[#4A2810] focus:border-[#D94F3D] focus:ring-[#D94F3D] transition-all placeholder-[#7A4F2D]/30"
                            placeholder="Ej: 600 123 456">
                    </div>
                    @error('telefono')
                        <p class="text-[#D94F3D] text-xs font-bold mt-1 ml-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label for="ubicacion" class="block text-xs font-bold uppercase tracking-widest text-[#7A4F2D] ml-1">
                        Ubicación Exacta
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-[#7A4F2D]/40">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" stroke-width="2"/><path d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" stroke-width="2"/></svg>
                        </span>
                        <input type="text" name="ubicacion" id="ubicacion" value="{{ old('ubicacion') }}" required
                            class="block w-full rounded-2xl border-[#F0DEC4] bg-[#F5E6D3]/10 pl-11 pr-4 py-3 text-[#4A2810] focus:border-[#D94F3D] focus:ring-[#D94F3D] transition-all placeholder-[#7A4F2D]/30"
                            placeholder="Calle, número o referencia">
                    </div>
                    @error('ubicacion')
                        <p class="text-[#D94F3D] text-xs font-bold mt-1 ml-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="bg-[#E8937A]/5 border border-[#E8937A]/20 rounded-2xl p-4">
                <p class="text-xs text-[#7A4F2D] leading-relaxed">
                    <span class="font-bold text-[#D94F3D]">Nota:</span> Al crear una colonia, se generará un registro en el censo municipal. Posteriormente podrá añadir los gatos asociados desde el panel de control de la propia colonia.
                </p>
            </div>

            <div class="flex items-center justify-end gap-4 pt-4 border-t border-[#F0DEC4]">
                <a href="{{ route('colonias.index') }}" class="text-sm font-bold text-[#7A4F2D] hover:text-[#4A2810]">
                    Cancelar
                </a>
                <button type="submit" class="bg-[#7A4F2D] text-[#F5E6D3] px-10 py-4 rounded-2xl font-bold shadow-lg hover:bg-[#4A2810] transition-all active:scale-95 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    Confirmar y Registrar
                </button>
            </div>
        </form>
    </div>
</div>
@endsection