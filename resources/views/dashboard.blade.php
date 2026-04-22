@extends('layouts.app')

@section('content')
<div class="py-2">
    <div class="mb-10 flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-serif font-bold text-[#4A2810]">Panel de Control</h1>
            <p class="text-[#7A4F2D]/70 font-medium">Gestión de Bienestar Animal • Ayuntamiento</p>
        </div>
        <div class="hidden md:block text-right">
            <span class="block text-xs font-bold uppercase tracking-widest text-[#7A4F2D]/40">Usuario actual</span>
            <span class="text-[#4A2810] font-bold">{{ Auth::user()->name }}</span>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
        
        <div class="bg-white p-6 rounded-3xl border border-[#F0DEC4] shadow-sm flex items-center gap-5 hover:shadow-md transition-shadow">
            <div class="p-4 bg-[#F5E6D3] rounded-2xl text-[#7A4F2D]">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" stroke-width="2"/></svg>
            </div>
            <div>
                <span class="block text-3xl font-bold text-[#4A2810] leading-none">{{ $totalColonias }}</span>
                <span class="text-[10px] font-bold uppercase tracking-[2px] text-[#7A4F2D]/60 mt-1 block">Colonias Felinas</span>
            </div>
        </div>

        <div class="bg-white p-6 rounded-3xl border border-[#F0DEC4] shadow-sm flex items-center gap-5 hover:shadow-md transition-shadow">
            <div class="p-4 bg-[#E8937A]/20 rounded-2xl text-[#D94F3D]">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" stroke-width="2"/></svg>
            </div>
            <div>
                <span class="block text-3xl font-bold text-[#4A2810] leading-none">{{ $totalGatos }}</span>
                <span class="text-[10px] font-bold uppercase tracking-[2px] text-[#7A4F2D]/60 mt-1 block">Gatos Registrados</span>
            </div>
        </div>

        <div class="bg-white p-6 rounded-3xl border border-[#F0DEC4] shadow-sm flex items-center gap-5 hover:shadow-md transition-shadow">
            <div class="p-4 bg-[#7A4F2D] rounded-2xl text-[#F5E6D3]">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" stroke-width="2"/></svg>
            </div>
            <div>
                <span class="block text-3xl font-bold text-[#4A2810] leading-none">{{ $totalPerros }}</span>
                <span class="text-[10px] font-bold uppercase tracking-[2px] text-[#7A4F2D]/60 mt-1 block">Perros en Adopción</span>
            </div>
        </div>
    </div>

    <div class="mb-6">
        <h2 class="text-xs font-bold uppercase tracking-[3px] text-[#7A4F2D]/50 mb-6">Módulos de Gestión</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            
            <a href="{{ route('colonias.index') }}" class="group relative overflow-hidden bg-[#7A4F2D] p-10 rounded-[2.5rem] shadow-xl hover:scale-[1.01] transition-all">
                <div class="relative z-10">
                    <h3 class="text-3xl font-serif font-bold text-[#F5E6D3] mb-3">Colonias</h3>
                    <p class="text-[#F5E6D3]/70 text-sm mb-8 max-w-xs leading-relaxed">
                        Censo de colonias, control de responsables y seguimiento de la población felina municipal.
                    </p>
                    <div class="inline-flex items-center gap-3 bg-white/10 px-6 py-3 rounded-xl backdrop-blur-md text-[#F5E6D3] font-bold text-xs uppercase tracking-widest group-hover:bg-[#D94F3D] transition-colors">
                        Acceder al Censo
                        <span>→</span>
                    </div>
                </div>
                <div class="absolute right-[-20px] bottom-[-20px] opacity-10 group-hover:rotate-12 transition-transform duration-500">
                    <svg class="w-48 h-48 fill-current text-white" viewBox="0 0 24 24"><path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                </div>
            </a>

            <a href="{{ route('perros.index') }}" class="group relative overflow-hidden bg-white p-10 rounded-[2.5rem] border border-[#F0DEC4] shadow-sm hover:border-[#D94F3D] transition-all">
                <div class="relative z-10">
                    <h3 class="text-3xl font-serif font-bold text-[#4A2810] mb-3">Perros en Adopción</h3>
                    <p class="text-[#7A4F2D]/70 text-sm mb-8 max-w-xs leading-relaxed">
                        Administración del censo de perros, gestión de fichas para el portal público y seguimiento de adopciones.
                    </p>
                    <div class="inline-flex items-center gap-3 bg-[#D94F3D] px-6 py-3 rounded-xl text-white font-bold text-xs uppercase tracking-widest group-hover:bg-[#4A2810] transition-colors shadow-lg shadow-[#D94F3D]/20">
                        Gestionar Perros
                        <span>→</span>
                    </div>
                </div>
                <div class="absolute right-[-20px] bottom-[-20px] text-[#D94F3D] opacity-5 group-hover:-rotate-12 transition-transform duration-500">
                    <svg class="w-48 h-48 fill-current" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                </div>
            </a>

            @if(Auth::user()->isAdmin())
                <a href="{{ route('users.create') }}" class="group relative overflow-hidden bg-white p-10 rounded-[2.5rem] border border-[#F0DEC4] shadow-sm hover:border-[#7A4F2D] transition-all">
                    <div class="relative z-10">
                        <h3 class="text-3xl font-serif font-bold text-[#4A2810] mb-3">Usuarios</h3>
                        <p class="text-[#7A4F2D]/70 text-sm mb-8 max-w-xs leading-relaxed">
                            Administración de accesos. Crea nuevas cuentas para el personal del ayuntamiento o gestores.
                        </p>
                        <div class="inline-flex items-center gap-3 bg-[#4A2810] px-6 py-3 rounded-xl text-white font-bold text-xs uppercase tracking-widest group-hover:bg-[#D94F3D] transition-colors shadow-lg">
                            Añadir Usuario
                            <span>+</span>
                        </div>
                    </div>
                    <div class="absolute right-[-20px] bottom-[-20px] text-[#4A2810] opacity-5 group-hover:rotate-12 transition-transform duration-500">
                        <svg class="w-48 h-48 fill-current" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                    </div>
                </a>
            @endif

        </div>
    </div>

</div>
@endsection