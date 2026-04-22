@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-10">
    <div class="mb-8 flex justify-between items-end">
        <div>
            <nav class="flex mb-4 text-[10px] font-bold uppercase tracking-widest text-[#7A4F2D]/40">
                <ol class="flex items-center space-x-2">
                    <li>Gestión</li>
                    <li>/</li>
                    <li class="text-[#D94F3D]">Buzón General</li>
                </ol>
            </nav>
            <h1 class="text-3xl font-serif font-bold text-[#4A2810]">Consultas Ciudadanas</h1>
            <p class="text-[#7A4F2D]/70 font-medium">Preguntas generales, voluntarios y avisos del ayuntamiento.</p>
        </div>

        <a href="{{ route('dashboard') }}" class="group flex items-center gap-3 bg-white border border-[#F0DEC4] px-6 py-3 rounded-2xl text-[#4A2810] font-bold text-xs uppercase tracking-widest hover:border-[#7A4F2D] hover:shadow-md transition-all">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Volver al Panel
        </a>
    </div>

    @if(session('success'))
        <div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-r-xl shadow-sm flex items-center gap-3">
            <span>✨</span> {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-[2.5rem] border border-[#F0DEC4] shadow-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-[#F5E6D3]/30 text-[#7A4F2D] text-[10px] uppercase tracking-[2px] font-bold">
                        <th class="px-8 py-5 border-b border-[#F0DEC4]">Estado</th>
                        <th class="px-8 py-5 border-b border-[#F0DEC4]">Remitente</th>
                        <th class="px-8 py-5 border-b border-[#F0DEC4]">Asunto / Motivo</th>
                        <th class="px-8 py-5 border-b border-[#F0DEC4]">Mensaje</th>
                        <th class="px-8 py-5 border-b border-[#F0DEC4] text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#F0DEC4]">
                    @forelse($mensajes as $mensaje)
                    <tr class="hover:bg-[#F5E6D3]/10 transition-colors {{ !$mensaje->leido ? 'bg-blue-50/30' : '' }}">
                        <td class="px-8 py-6">
                            @if(!$mensaje->leido)
                                <span class="inline-flex items-center px-3 py-1 bg-blue-500 text-white rounded-full text-[9px] font-bold uppercase tracking-widest">
                                    Pendiente
                                </span>
                            @else
                                <span class="inline-flex items-center px-3 py-1 bg-gray-100 text-gray-500 rounded-full text-[9px] font-bold uppercase tracking-widest">
                                    Leído
                                </span>
                            @endif
                        </td>
                        <td class="px-8 py-6">
                            <div class="flex flex-col">
                                <span class="font-bold text-[#4A2810] text-sm">{{ $mensaje->nombre }}</span>
                                <span class="text-[11px] text-[#7A4F2D] opacity-80">{{ $mensaje->email }}</span>
                                @if($mensaje->telefono)
                                    <span class="text-[11px] font-bold text-blue-600 mt-1 italic">📞 {{ $mensaje->telefono }}</span>
                                @endif
                            </div>
                        </td>
                        <td class="px-8 py-6">
                            <span class="bg-[#F5E6D3] text-[#7A4F2D] px-3 py-1 rounded-lg text-[10px] font-bold uppercase border border-[#F0DEC4]">
                                ✉️ {{ $mensaje->asunto }}
                            </span>
                            <span class="block text-[9px] text-[#7A4F2D]/50 mt-1 font-bold">
                                {{ $mensaje->created_at->diffForHumans() }}
                            </span>
                        </td>
                        <td class="px-8 py-6">
                            <p class="text-xs text-[#4A2810] leading-relaxed max-w-xs italic">
                                "{{ $mensaje->mensaje }}"
                            </p>
                        </td>
                        <td class="px-8 py-6 text-right">
                            <div class="flex justify-end gap-2">
                                @if(!$mensaje->leido)
                                <form action="{{ route('admin.mensajes.read', $mensaje) }}" method="POST">
                                    @csrf @method('PATCH')
                                    <button class="bg-white border border-[#F0DEC4] hover:border-blue-500 hover:text-blue-500 p-2 rounded-xl transition-all shadow-sm group" title="Marcar como leída">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    </button>
                                </form>
                                @endif
                                
                                <form action="{{ route('admin.mensajes.destroy', $mensaje) }}" method="POST" onsubmit="return confirm('¿Borrar este mensaje?')">
                                    @csrf @method('DELETE')
                                    <button class="bg-white border border-[#F0DEC4] hover:bg-red-50 hover:text-red-600 p-2 rounded-xl transition-all shadow-sm">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-8 py-20 text-center">
                            <p class="text-[#7A4F2D] font-serif italic text-lg opacity-50">No hay mensajes generales en el buzón.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection