@extends('layouts.app')

@section('content')
<div class="text-center mb-16">
    <h1 class="text-5xl font-serif font-bold text-chocolate mb-4">Colonias Felinas</h1>
    <p class="text-marron/70 max-w-2xl mx-auto italic">Selecciona una zona para conocer a los pequeños que buscan un hogar responsable.</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-8">
    @foreach($colonias as $colonia)
    <a href="{{ route('public.colonias.show', $colonia) }}" class="group bg-white rounded-[2.5rem] border border-cremaClaro p-8 hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
        <div class="w-16 h-16 bg-cremaClaro/30 rounded-2xl flex items-center justify-center text-3xl mb-6 group-hover:scale-110 transition-transform">
            📍
        </div>
        <h3 class="text-2xl font-serif font-bold text-chocolate mb-2">{{ $colonia->nombre }}</h3>
        <p class="text-marron/60 text-sm mb-6">{{ $colonia->ubicacion }}</p>
        
        <div class="flex items-center justify-between border-t border-cremaClaro pt-6">
            <span class="text-[10px] uppercase tracking-widest font-bold text-coral">
                {{ $colonia->gatos_count }} Gatos censados
            </span>
            <span class="text-chocolate font-bold text-sm group-hover:translate-x-2 transition-transform">Ver gatos →</span>
        </div>
    </a>
    @endforeach
</div>
@endsection