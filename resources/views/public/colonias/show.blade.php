@extends('layouts.app')

@section('content')

    <style>
        /* Oculta la barra de desplazamiento */
        .hide-scrollbar::-webkit-scrollbar { display: none; }
        .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        
        /* Estilos para la expansión de texto */
        .description-container {
            transition: all 0.5s ease-in-out;
            max-height: 4.5rem; /* Altura de unas 3 líneas */
            position: relative;
            overflow: hidden;
        }
        
        .description-container.expanded {
            max-height: 1000px; /* Suficiente para cualquier descripción */
        }

        .fade-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 2rem;
            background: linear-gradient(transparent, white);
            transition: opacity 0.3s;
        }

        .expanded .fade-overlay {
            opacity: 0;
            pointer-events: none;
        }
    </style>

    @if(session('success'))
        <div class="mb-8 bg-green-50 border-2 border-green-200 text-green-700 px-6 py-4 rounded-2xl font-bold flex items-center gap-3 animate-fade-in">
            <span class="text-xl">✨</span>
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-12">
        <a href="{{ route('public.colonias') }}" class="text-marron text-xs font-bold uppercase tracking-widest hover:text-coral transition-colors">← Volver a colonias</a>
        <h2 class="text-4xl font-serif font-bold text-chocolate mt-4">Gatos en {{ $colonia->nombre }}</h2>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        @foreach($colonia->gatos as $gato)
        <div class="bg-white rounded-[2rem] border border-cremaClaro overflow-hidden shadow-sm hover:shadow-md transition-shadow flex flex-col group">
            
            <div class="h-64 bg-cremaClaro/20 relative">
                @if($gato->fotos->isNotEmpty())
                    <div id="carousel-gato-{{ $gato->id }}" class="flex w-full h-full overflow-x-auto snap-x snap-mandatory scroll-smooth hide-scrollbar relative">
                        @foreach($gato->fotos as $foto)
                            <img src="{{ asset('storage/' . $foto->ruta) }}" class="w-full h-full flex-shrink-0 snap-center object-cover" alt="Foto de {{ $gato->nombre }}">
                        @endforeach
                    </div>
                    
                    @if($gato->fotos->count() > 1)
                        <div class="absolute inset-y-0 left-0 flex items-center pl-2 opacity-0 group-hover:opacity-100 transition-opacity z-20">
                            <button onclick="moveCarousel('gato-{{ $gato->id }}', -1)" class="bg-black/40 backdrop-blur-sm text-white p-2 rounded-full hover:bg-black/60 shadow-md focus:outline-none transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"/></svg>
                            </button>
                        </div>

                        <div class="absolute inset-y-0 right-0 flex items-center pr-2 opacity-0 group-hover:opacity-100 transition-opacity z-20">
                            <button onclick="moveCarousel('gato-{{ $gato->id }}', 1)" class="bg-black/40 backdrop-blur-sm text-white p-2 rounded-full hover:bg-black/60 shadow-md focus:outline-none transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"/></svg>
                            </button>
                        </div>
                        
                        <div class="absolute top-4 right-4 z-10 pointer-events-none">
                            <span class="bg-black/50 backdrop-blur-md text-white px-2 py-1.5 rounded-full text-[10px] font-bold flex items-center gap-1.5 shadow-sm">
                                <span>{{ $gato->fotos->count() }}</span>
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            </span>
                        </div>
                    @endif
                @else
                    <div class="w-full h-full flex items-center justify-center text-4xl opacity-20">😺</div>
                @endif
                
                <div class="absolute top-4 left-4 z-10 pointer-events-none">
                    <span class="bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-tighter text-chocolate shadow-sm">
                        {{ $gato->edad }} años
                    </span>
                </div>
            </div>
            
            <div class="p-6 flex flex-col flex-grow">
                <h4 class="text-xl font-serif font-bold text-chocolate mb-1">{{ $gato->nombre }}</h4>
                <p class="text-marron/60 text-[10px] mb-3 uppercase tracking-wider font-bold">{{ $gato->raza ?? 'Común Europeo' }}</p>
                
                <div id="desc-container-gato-{{ $gato->id }}" class="description-container mb-2">
                    <p class="text-marron/80 text-sm leading-relaxed italic">
                        {{ $gato->descripcion ?? 'Sin descripción disponible.' }}
                    </p>
                    <div class="fade-overlay"></div>
                </div>
                
                @if(strlen($gato->descripcion) > 100)
                    <button onclick="toggleDescription('gato-{{ $gato->id }}')" id="btn-desc-gato-{{ $gato->id }}" class="text-[10px] font-bold uppercase tracking-widest text-coral hover:text-chocolate mb-6 text-left flex items-center gap-1 focus:outline-none">
                        <span>Leer más</span>
                        <svg class="w-3 h-3 transition-transform" id="icon-desc-gato-{{ $gato->id }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                @else
                    <div class="mb-6"></div>
                @endif
                
                <div class="mt-auto">
                    <button onclick="openModal('{{ $gato->nombre }}')" class="w-full bg-coral hover:bg-chocolate text-white py-3 rounded-xl text-[10px] font-bold uppercase tracking-widest transition-all shadow-lg shadow-coral/20 focus:outline-none focus:ring-2 focus:ring-coral/50">
                        Solicitar Información
                    </button>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div id="contactModal" class="fixed inset-0 bg-chocolate/60 backdrop-blur-sm z-[100] hidden flex items-center justify-center p-4">
        <div class="bg-crema rounded-[2.5rem] w-full max-w-lg p-10 relative animate-fade-in shadow-2xl border-4 border-white">
            <button onclick="closeModal()" class="absolute top-6 right-6 text-marron hover:rotate-90 transition-transform text-xl focus:outline-none">✕</button>
            
            <h3 class="text-2xl font-serif font-bold text-chocolate mb-2">Interés en <span id="gatoNombre" class="text-coral"></span></h3>
            <p class="text-marron/70 text-sm mb-8 italic">Déjanos tus datos y el equipo del Ayuntamiento se pondrá en contacto contigo.</p>
            
            <form action="{{ route('contacto.store') }}" method="POST" class="space-y-4">
                @csrf
                <input type="hidden" name="interesado_en" id="hiddenGatoNombre">
                <input type="hidden" name="especie" value="gato">
                
                <input type="text" name="nombre" placeholder="Tu nombre" class="w-full bg-white border-0 rounded-xl p-4 focus:ring-2 focus:ring-coral outline-none text-sm shadow-sm" required>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <input type="email" name="email" placeholder="Tu email" class="w-full bg-white border-0 rounded-xl p-4 focus:ring-2 focus:ring-coral outline-none text-sm shadow-sm" required>
                    <input type="text" name="telefono" placeholder="Teléfono (opcional)" class="w-full bg-white border-0 rounded-xl p-4 focus:ring-2 focus:ring-coral outline-none text-sm shadow-sm">
                </div>

                <textarea name="mensaje" placeholder="¿Por qué quieres adoptar o qué información necesitas?" rows="3" class="w-full bg-white border-0 rounded-xl p-4 focus:ring-2 focus:ring-coral outline-none text-sm mt-2 shadow-sm" required></textarea>
                
                <div class="pt-4">
                    <button type="submit" class="w-full bg-marron text-cremaClaro py-4 rounded-xl font-bold uppercase tracking-widest text-xs hover:bg-chocolate transition-all shadow-xl hover:shadow-marron/20 focus:outline-none focus:ring-2 focus:ring-marron/50">
                        Enviar solicitud
                    </button>
                </div>
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

        // Función para el carrusel (usando el prefijo 'gato-')
        function moveCarousel(id, direction) {
            const carousel = document.getElementById('carousel-' + id);
            if(!carousel) return;
            const img = carousel.querySelector('img');
            if(!img) return;
            const itemWidth = img.offsetWidth;
            carousel.scrollBy({ left: direction * itemWidth, behavior: 'smooth' });
        }

        // Función para la descripción (usando el prefijo 'gato-')
        function toggleDescription(id) {
            const container = document.getElementById('desc-container-' + id);
            const btnSpan = document.getElementById('btn-desc-' + id)?.querySelector('span');
            const icon = document.getElementById('icon-desc-' + id);
            
            if(!container || !btnSpan || !icon) return;

            container.classList.toggle('expanded');
            
            if (container.classList.contains('expanded')) {
                btnSpan.innerText = 'Leer menos';
                icon.classList.add('rotate-180');
            } else {
                btnSpan.innerText = 'Leer más';
                icon.classList.remove('rotate-180');
            }
        }
    </script>
    
@endsection