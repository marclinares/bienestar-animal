@extends('layouts.app')

@section('content')
<div class="mb-10 flex flex-col md:flex-row md:items-center justify-between gap-4">
    <div>
        <h1 class="text-3xl font-serif font-bold text-[#4A2810]">Panel de Gestión: Colonias Felinas</h1>
        <p class="text-[#7A4F2D]/70 font-medium">Administración de poblaciones y control del método CER</p>
    </div>
    <a href="{{ route('colonias.create') }}" class="bg-[#D94F3D] text-white px-6 py-3 rounded-xl font-bold shadow-lg hover:bg-[#b93d2f] transition-all flex items-center gap-2 w-fit">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 4v16m8-8H4" stroke-width="2" stroke-linecap="round"/></svg>
        Nueva Colonia
    </a>
</div>

@if(session('success'))
    <div class="mb-6 bg-green-50 border border-green-200 rounded-2xl px-5 py-4 flex items-center gap-3">
        <span class="text-green-500 text-lg">✓</span>
        <p class="text-sm font-bold text-green-700">{{ session('success') }}</p>
    </div>
@endif

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($colonias as $colonia)
    <div class="bg-white rounded-2xl border border-[#F0DEC4] shadow-sm hover:shadow-md transition-all overflow-hidden group">
        <div class="p-6">
            <div class="flex justify-between items-start mb-4">
                <div class="bg-[#F5E6D3] p-3 rounded-lg text-[#7A4F2D]">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" stroke-width="2"/></svg>
                </div>
                <div class="flex gap-2">
                    <a href="{{ route('colonias.edit', $colonia) }}" class="text-[#7A4F2D] hover:text-[#D94F3D] p-1 transition-colors" title="Editar colonia">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" stroke-width="2"/></svg>
                    </a>
                    <form action="{{ route('colonias.destroy', $colonia) }}" method="POST"
                        onsubmit="return confirm('¿Eliminar la colonia {{ $colonia->nombre }}? Se eliminarán todos sus gatos asociados.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-[#7A4F2D] hover:text-[#D94F3D] p-1 transition-colors" title="Eliminar colonia">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </button>
                    </form>
                </div>
            </div>

            <h3 class="text-xl font-bold text-[#4A2810] mb-1">{{ $colonia->nombre }}</h3>
            <p class="text-xs text-[#D94F3D] font-bold uppercase tracking-widest mb-4 flex items-center gap-1">
                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"/></svg>
                {{ $colonia->ubicacion }}
            </p>

            <div class="border-t border-[#F0DEC4] pt-4 mt-4 space-y-2">
                <div class="flex justify-between items-center text-sm">
                    <span class="text-[#7A4F2D]/60 font-medium flex items-center gap-1">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" stroke-width="2"/></svg>
                        Responsable:
                    </span>
                    <span class="text-[#4A2810] font-bold">{{ $colonia->persona_responsable }}</span>
                </div>

                <div class="flex justify-between items-center text-sm">
                    <span class="text-[#7A4F2D]/60 font-medium flex items-center gap-1">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" stroke-width="2"/></svg>
                        Teléfono:
                    </span>
                    <span class="text-[#4A2810] font-bold italic">
                        {{ $colonia->telefono ?? 'No aportado' }}
                    </span>
                </div>
            </div>
        </div>

        <a href="{{ route('colonias.show', $colonia) }}" class="block bg-[#F5E6D3]/50 hover:bg-[#7A4F2D] hover:text-white transition-all text-center py-3 font-bold text-[#7A4F2D] text-sm">
            Ver Gatos Asociados →
        </a>
    </div>
    @endforeach
</div>
@endsection