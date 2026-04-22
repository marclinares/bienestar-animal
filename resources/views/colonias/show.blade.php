@extends('layouts.app')

@section('content')
<div class="mb-8">
    <a href="{{ route('colonias.index') }}" class="text-[#7A4F2D] text-sm font-bold flex items-center gap-1 hover:text-[#D94F3D] transition-colors">
        ← Volver al listado de colonias
    </a>
</div>

{{-- Success message --}}
@if(session('success'))
    <div class="mb-6 bg-green-50 border border-green-200 rounded-2xl px-5 py-4 flex items-center gap-3">
        <span class="text-green-500 text-lg">✓</span>
        <p class="text-sm font-bold text-green-700">{{ session('success') }}</p>
    </div>
@endif

<div class="bg-[#4A2810] rounded-3xl p-8 text-[#F5E6D3] mb-10 flex flex-col md:flex-row justify-between items-center shadow-xl">
    <div>
        <span class="bg-[#E8937A] text-[#4A2810] px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-widest">Ficha de Colonia</span>
        <h2 class="text-4xl font-serif font-bold mt-2">{{ $colonia->nombre }}</h2>
        <div class="opacity-80 flex flex-wrap items-center gap-x-4 gap-y-2 mt-2 text-sm">
            <span class="flex items-center gap-1">📍 {{ $colonia->ubicacion }}</span>
            <span class="hidden md:inline text-white/30">|</span>
            <span class="flex items-center gap-1">👤 {{ $colonia->persona_responsable }}</span>
            <span class="hidden md:inline text-white/30">|</span>
            <span class="flex items-center gap-1 italic text-[#E8937A]">📞 {{ $colonia->telefono ?? 'Sin teléfono' }}</span>
        </div>
    </div>
    <div class="mt-6 md:mt-0 bg-white/10 px-6 py-4 rounded-2xl backdrop-blur-sm border border-white/10 text-center">
        <span class="block text-4xl font-bold">{{ $colonia->gatos->count() }}</span>
        <span class="text-[10px] uppercase font-bold tracking-widest opacity-60">Gatos censados</span>
    </div>
</div>

<div class="bg-white rounded-3xl border border-[#F0DEC4] shadow-sm overflow-hidden">
    <div class="px-8 py-6 border-b border-[#F0DEC4] flex flex-col sm:flex-row justify-between items-center bg-[#F5E6D3]/20 gap-4">
        <h3 class="text-xl font-bold text-[#4A2810]">Población Felina</h3>

        <a href="{{ route('gatos.create', ['colonia_id' => $colonia->id]) }}"
           class="bg-[#D94F3D] text-white text-xs font-bold uppercase tracking-widest px-6 py-3 rounded-xl hover:bg-[#4A2810] transition-all flex items-center gap-2 shadow-lg shadow-[#D94F3D]/20">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 4v16m8-8H4" stroke-width="2" stroke-linecap="round"/></svg>
            Nuevo Gato
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-[#F5E6D3]/10 text-[#7A4F2D] text-[10px] uppercase tracking-[2px] font-bold">
                    <th class="px-8 py-4">Nombre</th>
                    <th class="px-8 py-4">Raza/Tipo</th>
                    <th class="px-8 py-4">Estado</th>
                    <th class="px-8 py-4">Edad aprox.</th>
                    <th class="px-8 py-4 text-right">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-[#F0DEC4]">
                @forelse($colonia->gatos as $gato)
                <tr class="hover:bg-[#F5E6D3]/5 transition-colors group">
                    <td class="px-8 py-5">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-xl overflow-hidden border-2 border-[#F0DEC4] bg-[#F5E6D3]/20 flex-shrink-0">
                                @if($gato->fotos && $gato->fotos->isNotEmpty())
                                    <img src="{{ asset('storage/' . $gato->fotos->first()->ruta) }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-lg">😺</div>
                                @endif
                            </div>
                            <span class="font-bold text-[#4A2810]">{{ $gato->nombre }}</span>
                        </div>
                    </td>
                    <td class="px-8 py-5 text-[#7A4F2D] text-sm">{{ $gato->raza ?? 'Común' }}</td>
                    <td class="px-8 py-5">
                        @if($gato->estado == 'disponible')
                            <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-[10px] font-bold uppercase tracking-wider">Disponible</span>
                        @else
                            <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-[10px] font-bold uppercase tracking-wider">Adoptado</span>
                        @endif
                    </td>
                    <td class="px-8 py-5 text-[#7A4F2D] text-sm">{{ $gato->edad }} años</td>
                    <td class="px-8 py-5 text-right">
                        <div class="flex justify-end gap-3">
                            <a href="{{ route('gatos.edit', $gato) }}"
                                class="text-[#7A4F2D] hover:text-[#4A2810] transition-colors p-1" title="Editar información">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" stroke-width="2"/></svg>
                            </a>
                            <form action="{{ route('gatos.destroy', $gato) }}" method="POST"
                                onsubmit="return confirm('¿Eliminar a {{ $gato->nombre }} del censo? Esta acción no se puede deshacer.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-[#7A4F2D] hover:text-[#D94F3D] transition-colors p-1" title="Eliminar gato">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-8 py-10 text-center text-[#7A4F2D]/50 italic">
                        No hay gatos registrados en esta colonia actualmente.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection