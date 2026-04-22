@extends('layouts.app')

@section('content')

    @if(session('success'))
        <div class="mb-8 bg-green-50 border-2 border-green-200 text-green-700 px-6 py-4 rounded-2xl font-bold flex items-center gap-3 animate-fade-in">
            <span class="text-xl">✨</span>
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-12">
        <a href="{{ route('home') }}" class="text-marron text-xs font-bold uppercase tracking-widest hover:text-orange-600 transition-colors">← Volver al inicio</a>
        <h2 class="text-4xl font-serif font-bold text-chocolate mt-4">Perros en adopción</h2>
        <p class="text-marron/60 mt-2 italic">Buscan un hogar donde les den todo el cariño que merecen.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        @foreach($perros as $perro)
        <div class="bg-white rounded-[2rem] border border-cremaClaro overflow-hidden shadow-sm hover:shadow-md transition-shadow flex flex-col">
            <div class="h-64 bg-orange-50/30 relative">
                @if($perro->fotos->isNotEmpty())
                    <img src="{{ asset('storage/' . $perro->fotos->first()->ruta) }}" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full flex items-center justify-center text-4xl opacity-20">🐶</div>
                @endif
                <div class="absolute top-4 left-4">
                    <span class="bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-tighter text-chocolate">
                        {{ $perro->edad }} años
                    </span>
                </div>
            </div>
            
            <div class="p-6 flex flex-col flex-grow">
                <h4 class="text-xl font-serif font-bold text-chocolate mb-1">{{ $perro->nombre }}</h4>
                <p class="text-marron/60 text-[10px] mb-3 uppercase tracking-wider font-bold">{{ $perro->raza ?? 'Mestizo' }}</p>
                
                <p class="text-marron/80 text-sm leading-relaxed mb-6 italic line-clamp-3">
                    {{ $perro->descripcion ?? 'Sin descripción disponible por el momento.' }}
                </p>
                
                <div class="mt-auto">
                    <button onclick="openModal('{{ $perro->nombre }}')" class="w-full bg-orange-600 hover:bg-chocolate text-white py-3 rounded-xl text-[10px] font-bold uppercase tracking-widest transition-all shadow-lg shadow-orange-200">
                        Solicitar Información
                    </button>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div id="contactModal" class="fixed inset-0 bg-chocolate/60 backdrop-blur-sm z-[100] hidden flex items-center justify-center p-4">
        <div class="bg-crema rounded-[2.5rem] w-full max-w-lg p-10 relative animate-fade-in shadow-2xl border-4 border-white">
            <button onclick="closeModal()" class="absolute top-6 right-6 text-marron hover:rotate-90 transition-transform">✕</button>
            
            <h3 class="text-2xl font-serif font-bold text-chocolate mb-2">Interés en <span id="animalNombre" class="text-orange-600"></span></h3>
            <p class="text-marron/70 text-sm mb-8 italic">Déjanos tus datos y el equipo del Ayuntamiento se pondrá en contacto contigo.</p>
            
            <form action="{{ route('contacto.store') }}" method="POST" class="space-y-4">
                @csrf
                <input type="hidden" name="interesado_en" id="hiddenAnimalNombre">
                
                <input type="hidden" name="especie" value="perro">
                
                <input type="text" name="nombre" placeholder="Tu nombre" class="w-full bg-white border-0 rounded-xl p-4 focus:ring-2 focus:ring-orange-500 outline-none text-sm" required>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <input type="email" name="email" placeholder="Tu email" class="w-full bg-white border-0 rounded-xl p-4 focus:ring-2 focus:ring-orange-500 outline-none text-sm" required>
                    
                    <div class="relative group">
                        <input type="text" name="telefono" placeholder="Teléfono (opcional)" class="w-full bg-white border-0 rounded-xl p-4 focus:ring-2 focus:ring-orange-500 outline-none text-sm">
                        <span class="absolute -bottom-5 left-2 text-[9px] text-marron/50 font-bold uppercase tracking-tighter opacity-0 group-focus-within:opacity-100 transition-opacity">
                            ✨ Recomendado para mayor rapidez
                        </span>
                    </div>
                </div>

                <textarea name="mensaje" placeholder="¿Por qué quieres adoptar?" rows="3" class="w-full bg-white border-0 rounded-xl p-4 focus:ring-2 focus:ring-orange-500 outline-none text-sm mt-2" required></textarea>
                
                <div class="pt-4">
                    <button type="submit" class="w-full bg-chocolate text-cremaClaro py-4 rounded-xl font-bold uppercase tracking-widest text-xs hover:bg-orange-600 transition-all shadow-xl">
                        Enviar solicitud
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openModal(nombre) {
            document.getElementById('animalNombre').innerText = nombre;
            document.getElementById('hiddenAnimalNombre').value = nombre;
            document.getElementById('contactModal').classList.remove('hidden');
        }
        function closeModal() {
            document.getElementById('contactModal').classList.add('hidden');
        }
    </script>
    
@endsection