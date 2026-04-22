@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-8 px-4">
    <div class="mb-8 flex flex-col md:flex-row justify-between items-end gap-4">
        <div>
            <a href="{{ route('dashboard') }}" class="text-[#7A4F2D] text-sm font-bold flex items-center gap-1 hover:text-[#D94F3D] mb-2 transition-colors">
                ← Volver al Panel
            </a>
            <h1 class="text-4xl font-serif font-bold text-[#4A2810]">Censo Canino</h1>
            <p class="text-[#7A4F2D]/60 text-xs font-bold uppercase tracking-[3px] mt-1">Gestión de Perros en Adopción</p>
        </div>

        <a href="{{ route('perros.create') }}" class="bg-[#D94F3D] text-white px-8 py-4 rounded-2xl font-bold text-xs uppercase tracking-widest hover:bg-[#4A2810] transition-all shadow-lg flex items-center gap-2 group">
            <svg class="w-4 h-4 group-hover:rotate-90 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 4v16m8-8H4" stroke-width="2.5" stroke-linecap="round"/></svg>
            Nuevo Registro Canino
        </a>
    </div>

    <div class="bg-white rounded-[2.5rem] border border-[#F0DEC4] shadow-sm overflow-hidden mb-8">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-[#F5E6D3]/30 text-[#7A4F2D] text-[10px] uppercase tracking-[2px] font-bold">
                        <th class="px-8 py-5 border-b border-[#F0DEC4]">Canino</th>
                        <th class="px-8 py-5 border-b border-[#F0DEC4]">Raza / Capa</th>
                        <th class="px-8 py-5 border-b border-[#F0DEC4]">Edad</th>
                        <th class="px-8 py-5 border-b border-[#F0DEC4]">Estado</th>
                        <th class="px-8 py-5 border-b border-[#F0DEC4] text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#F0DEC4]">
                    @forelse($perros as $perro)
                    <tr class="hover:bg-[#F5E6D3]/10 transition-colors group">
                        <td class="px-8 py-5">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-2xl overflow-hidden border-2 border-[#F0DEC4] shadow-sm bg-[#F5E6D3]/20 flex-shrink-0">
                                    @if($perro->fotos->isNotEmpty())
                                        <img src="{{ asset('storage/' . $perro->fotos->first()->ruta) }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-xl">🐶</div>
                                    @endif
                                </div>
                                <div>
                                    <span class="block font-bold text-[#4A2810] group-hover:text-[#D94F3D] transition-colors">{{ $perro->nombre }}</span>
                                    <span class="text-[9px] text-[#7A4F2D]/50 uppercase font-bold">ID: #PE-{{ $perro->id }}</span>
                                </div>
                            </div>
                        </td>
                        <td class="px-8 py-5 text-[#7A4F2D] text-sm font-medium">
                            {{ $perro->raza ?? 'Mestizo' }}
                        </td>
                        <td class="px-8 py-5 text-[#7A4F2D] text-sm italic">
                            {{ $perro->edad }} años
                        </td>
                        <td class="px-8 py-5">
                            <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-tighter {{ $perro->estado == 'disponible' ? 'bg-green-100 text-green-700' : 'bg-blue-100 text-blue-700' }}">
                                {{ $perro->estado }}
                            </span>
                        </td>
                        <td class="px-8 py-5 text-right">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('perros.edit', $perro) }}" class="p-2 text-[#7A4F2D] hover:bg-[#F5E6D3] hover:text-[#4A2810] rounded-xl transition-all" title="Editar">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                </a>

                                <form action="{{ route('perros.destroy', $perro) }}" method="POST" class="inline" onsubmit="return confirm('¿Eliminar registro de {{ $perro->nombre }}? Esta acción no se puede deshacer.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-[#7A4F2D] hover:bg-red-50 hover:text-[#D94F3D] rounded-xl transition-all" title="Eliminar">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-8 py-20 text-center">
                            <div class="flex flex-col items-center gap-3">
                                <div class="bg-[#F5E6D3]/30 p-4 rounded-full">
                                    <svg class="w-8 h-8 text-[#7A4F2D]/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" stroke-width="2"/></svg>
                                </div>
                                <p class="text-[#7A4F2D]/50 italic font-serif">No se han encontrado perros registrados todavía.</p>
                                <a href="{{ route('perros.create') }}" class="text-[#D94F3D] text-xs font-bold uppercase tracking-widest hover:underline">Registrar el primero</a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="flex justify-between items-center px-8 text-[#7A4F2D]/40 text-[10px] font-bold uppercase tracking-[2px]">
        <span>Total Caninos: {{ $perros->count() }}</span>
        <span>Censo Actualizado: {{ date('d/m/Y') }}</span>
    </div>
</div>
@endsection