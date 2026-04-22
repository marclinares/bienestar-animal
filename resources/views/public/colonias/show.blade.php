@extends('layouts.app')

@section('content')
<div class="mb-12">
    <a href="{{ route('public.colonias') }}" class="text-marron text-xs font-bold uppercase tracking-widest hover:text-coral transition-colors">← Volver a colonias</a>
    <h2 class="text-4xl font-serif font-bold text-chocolate mt-4">Gatos en {{ $colonia->nombre }}</h2>
</div>

<div class="grid grid-cols-1 md:grid-cols-4 gap-6">
    @foreach($colonia->gatos as $gato)
    <div class="bg-white rounded-[2rem] border border-cremaClaro overflow-hidden shadow-sm hover:shadow-md transition-shadow">
        <div class="h-64 bg-cremaClaro/20 relative">
            @if($gato->fotos->isNotEmpty())
                <img src="{{ asset('storage/' . $gato->fotos->first()->ruta) }}" class="w-full h-full object-cover">
            @else
                <div class="w-full h-full flex items-center justify-center text-4xl opacity-20">😺</div>
            @endif
            <div class="absolute top-4 left-4">
                <span class="bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-tighter text-chocolate">
                    {{ $gato->edad }} años
                </span>
            </div>
        </div>
        
        <div class="p-6">
            <h4 class="text-xl font-serif font-bold text-chocolate mb-1">{{ $gato->nombre }}</h4>
            <p class="text-marron/60 text-xs mb-4 uppercase tracking-wider">{{ $gato->raza ?? 'Común Europeo' }}</p>
            
            <button onclick="openModal('{{ $gato->nombre }}')" class="w-full bg-coral hover:bg-chocolate text-white py-3 rounded-xl text-[10px] font-bold uppercase tracking-widest transition-all shadow-lg shadow-coral/20">
                Solicitar Información
            </button>
        </div>
    </div>
    @endforeach
</div>

<div id="contactModal" class="fixed inset-0 bg-chocolate/60 backdrop-blur-sm z-[100] hidden flex items-center justify-center p-4">
    <div class="bg-crema rounded-[2.5rem] w-full max-w-lg p-10 relative animate-fade-in shadow-2xl border-4 border-white">
        <button onclick="closeModal()" class="absolute top-6 right-6 text-marron hover:rotate-90 transition-transform">✕</button>
        
        <h3 class="text-2xl font-serif font-bold text-chocolate mb-2">Interés en <span id="gatoNombre" class="text-coral"></span></h3>
        <p class="text-marron/70 text-sm mb-8 italic">Déjanos tus datos y el equipo del Ayuntamiento se pondrá en contacto contigo.</p>
        
        <form action="{{ route('contacto.store') }}" method="POST" class="space-y-4">
            @csrf
            <input type="hidden" name="interesado_en" id="hiddenGatoNombre">
            
            <input type="text" name="nombre" placeholder="Tu nombre" class="w-full bg-white border-0 rounded-xl p-4 focus:ring-2 focus:ring-coral outline-none text-sm" required>
            <input type="email" name="email" placeholder="Tu email" class="w-full bg-white border-0 rounded-xl p-4 focus:ring-2 focus:ring-coral outline-none text-sm" required>
            <textarea name="mensaje" placeholder="¿Por qué quieres adoptar?" rows="3" class="w-full bg-white border-0 rounded-xl p-4 focus:ring-2 focus:ring-coral outline-none text-sm" required></textarea>
            
            <button type="submit" class="w-full bg-marron text-cremaClaro py-4 rounded-xl font-bold uppercase tracking-widest text-xs hover:bg-chocolate transition-all shadow-xl mt-4">
                Enviar solicitud
            </button>
        </form>
    </div>
</div>

<script>
    function openModal(nombre) {
        document.getElementById('gatoNombre').innerText = nombre;
        document.getElementById('hiddenGatoNombre').value = nombre;
        document.getElementById('contactModal').classList.remove('hidden');
    }
    function closeModal() {
        document.getElementById('contactModal').classList.add('hidden');
    }
</script>
@endsection