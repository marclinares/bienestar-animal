@extends('layouts.app')

@section('content')

<div class="relative overflow-hidden rounded-3xl bg-[#F0DEC4] mb-12 shadow-sm border border-[#7A4F2D]/10">
    <div class="absolute top-0 right-0 -mt-20 -mr-20 w-96 h-96 bg-[#E8937A]/20 rounded-full blur-3xl"></div>
    
    <div class="max-w-5xl mx-auto px-8 py-16 md:py-24 relative z-10">
        <div class="text-center">
            <span class="inline-block bg-[#D94F3D]/10 text-[#D94F3D] font-bold text-xs uppercase tracking-[3px] px-4 py-1.5 rounded-full mb-6 border border-[#D94F3D]/20">
                Área de Salud y Medio Ambiente
            </span>
            <h1 class="text-4xl md:text-6xl font-serif font-bold text-[#4A2810] leading-tight mb-6">
                Comprometidos con el <br>
                <span class="text-[#7A4F2D] italic font-normal">Bienestar Animal</span>
            </h1>
            <p class="text-lg text-[#7A4F2D] mb-10 leading-relaxed max-w-2xl mx-auto">
                Portal oficial para el fomento de la adopción responsable, la gestión de colonias felinas y la protección de los derechos de los animales en nuestro municipio.
            </p>
            
            <div class="flex flex-wrap justify-center gap-4">
                <a href="/adopcion/perros" class="bg-[#7A4F2D] hover:bg-[#4A2810] text-[#F0DEC4] px-8 py-4 rounded-xl font-bold transition-all shadow-lg flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    Conoce a nuestros perros
                </a>
                <a href="/adopcion/gatos" class="bg-white hover:bg-[#F0DEC4] text-[#4A2810] px-8 py-4 rounded-xl font-bold transition-all border border-[#7A4F2D]/20 shadow-sm flex items-center gap-2">
                    Gatos que buscan familia
                </a>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-2 md:grid-cols-4 gap-8 mb-20 px-4">
    <div class="text-center">
        <div class="text-3xl font-bold text-[#D94F3D] mb-1">Cero</div>
        <div class="text-[10px] uppercase tracking-widest font-bold text-[#7A4F2D]/60">Sacrificio Animal</div>
    </div>
    <div class="text-center border-l border-[#7A4F2D]/10">
        <div class="text-3xl font-bold text-[#4A2810] mb-1">100%</div>
        <div class="text-[10px] uppercase tracking-widest font-bold text-[#7A4F2D]/60">Identificados</div>
    </div>
    <div class="text-center border-l border-[#7A4F2D]/10">
        <div class="text-3xl font-bold text-[#D94F3D] mb-1">+300</div>
        <div class="text-[10px] uppercase tracking-widest font-bold text-[#7A4F2D]/60">Adopciones/Año</div>
    </div>
    <div class="text-center border-l border-[#7A4F2D]/10">
        <div class="text-3xl font-bold text-[#4A2810] mb-1">24h</div>
        <div class="text-[10px] uppercase tracking-widest font-bold text-[#7A4F2D]/60">Servicio de Recogida</div>
    </div>
</div>

<div class="mb-20">
    <div class="flex items-center gap-4 mb-10">
        <div class="h-[2px] flex-grow bg-[#E8937A]/30"></div>
        <h2 class="text-2xl font-serif font-bold text-[#4A2810] px-4 text-center">Trámites y Servicios</h2>
        <div class="h-[2px] flex-grow bg-[#E8937A]/30"></div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="bg-white p-8 rounded-2xl border border-[#7A4F2D]/10 hover:border-[#D94F3D]/40 transition-all shadow-sm">
            <div class="w-12 h-12 bg-[#F5E6D3] rounded-full flex items-center justify-center mb-6 text-[#7A4F2D]">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            </div>
            <h3 class="text-xl font-bold text-[#4A2810] mb-3">Censo Municipal</h3>
            <p class="text-[#7A4F2D]/80 text-sm leading-relaxed mb-6">Información sobre la obligatoriedad del registro de animales de compañía y el chip de identificación.</p>
            <a href="#" class="text-[#D94F3D] font-bold text-xs uppercase tracking-widest flex items-center gap-2">
                Saber más <span class="text-lg">→</span>
            </a>
        </div>

        <div class="bg-white p-8 rounded-2xl border border-[#7A4F2D]/10 hover:border-[#D94F3D]/40 transition-all shadow-sm">
            <div class="w-12 h-12 bg-[#F5E6D3] rounded-full flex items-center justify-center mb-6 text-[#7A4F2D]">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
            </div>
            <h3 class="text-xl font-bold text-[#4A2810] mb-3">Colonias Felinas</h3>
            <p class="text-[#7A4F2D]/80 text-sm leading-relaxed mb-6">Gestión ética de poblaciones de gatos comunitarios mediante el método CER (Captura, Esterilización y Retorno).</p>
            <a href="#" class="text-[#D94F3D] font-bold text-xs uppercase tracking-widest flex items-center gap-2">
                Ver protocolo <span class="text-lg">→</span>
            </a>
        </div>

        <div class="bg-white p-8 rounded-2xl border border-[#7A4F2D]/10 hover:border-[#D94F3D]/40 transition-all shadow-sm">
            <div class="w-12 h-12 bg-[#F5E6D3] rounded-full flex items-center justify-center mb-6 text-[#7A4F2D]">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
            </div>
            <h3 class="text-xl font-bold text-[#4A2810] mb-3">Denuncia de Maltrato</h3>
            <p class="text-[#7A4F2D]/80 text-sm leading-relaxed mb-6">Canal oficial para informar sobre situaciones de abandono o maltrato animal de forma confidencial.</p>
            <a href="#" class="text-[#D94F3D] font-bold text-xs uppercase tracking-widest flex items-center gap-2">
                Informar ahora <span class="text-lg">→</span>
            </a>
        </div>
    </div>
</div>

<div class="bg-[#7A4F2D] rounded-[2rem] p-10 md:p-16 mb-20 text-[#F5E6D3] flex flex-col md:flex-row items-center gap-12 relative overflow-hidden">
    <div class="absolute right-0 bottom-0 opacity-5 -mb-20 -mr-20">
        <svg class="w-80 h-80 fill-current" viewBox="0 0 24 24"><path d="M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10 10-4.477 10-10S17.523 2 12 2zm0 18c-4.411 0-8-3.589-8-8s3.589-8 8-8 8 3.589 8 8-3.589 8-8 8z"/></svg>
    </div>

    <div class="md:w-1/2">
        <h2 class="text-3xl font-serif font-bold mb-6">Bienestar Animal</h2>
        <div class="space-y-4">
            <div class="flex gap-4">
                <div class="mt-1 text-[#E8937A]">✓</div>
                <p class="text-sm leading-relaxed italic opacity-90 text-balance">"Un animal no es un juguete, es un compromiso para toda su vida."</p>
            </div>
            <p class="text-sm opacity-80 leading-relaxed">
                Adoptar conlleva la responsabilidad de garantizar cuidados veterinarios, alimentación adecuada y, sobre todo, el tiempo y cariño que cada especie requiere. Conoce las pautas de convivencia municipal.
            </p>
        </div>
    </div>
    
    <div class="md:w-1/2 grid grid-cols-2 gap-4">
        <div class="bg-[#4A2810]/30 p-6 rounded-2xl border border-white/10">
            <div class="text-xl font-bold mb-1">Salud</div>
            <p class="text-xs opacity-60 italic">Vacunación y desparasitación.</p>
        </div>
        <div class="bg-[#4A2810]/30 p-6 rounded-2xl border border-white/10 text-balance">
            <div class="text-xl font-bold mb-1">Cuidado</div>
            <p class="text-xs opacity-60 italic">Respeto y protección animal.</p>
        </div>
    </div>
</div>

<div class="text-center py-20 relative">
    <div class="max-w-2xl mx-auto">
        <h2 class="text-3xl font-serif font-bold text-[#4A2810] mb-4">¿Estás listo para ampliar la familia?</h2>
        <p class="text-[#7A4F2D]/70 mb-10">Muchos compañeros esperan en nuestro centro una segunda oportunidad. El proceso de adopción está supervisado por profesionales para asegurar la mejor compatibilidad.</p>
        
        <div class="inline-flex p-1 bg-[#F0DEC4] rounded-2xl gap-2">
            <a href="/adopcion/perros" class="bg-[#D94F3D] text-white px-8 py-4 rounded-xl font-bold shadow-xl hover:scale-105 transition-transform text-sm">
                Adoptar un perro
            </a>
            <a href="/adopcion/gatos" class="bg-[#4A2810] text-white px-8 py-4 rounded-xl font-bold shadow-xl hover:scale-105 transition-transform text-sm">
                Adoptar un gato
            </a>
        </div>
        
        <p class="mt-6 text-[10px] text-[#7A4F2D]/50 uppercase tracking-[2px] font-bold">Sin ánimo de lucro · Por un municipio animal friendly</p>
    </div>
</div>

@endsection