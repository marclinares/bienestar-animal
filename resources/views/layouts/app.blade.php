<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienestar Animal | Excmo. Ayuntamiento</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Lora:ital,wght@0,600;1,400&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        crema: '#F5E6D3',
                        marron: '#7A4F2D',
                        chocolate: '#4A2810',
                        coral: '#D94F3D',
                        cremaClaro: '#F0DEC4',
                        salmon: '#E8937A'
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        serif: ['Lora', 'serif'],
                    }
                }
            }
        }
    </script>

    <style>
        /* Suavizado de scroll */
        html { scroll-behavior: smooth; }
        
        /* Efecto de subrayado elegante para el menú */
        .nav-link {
            position: relative;
        }
        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -4px;
            left: 0;
            background-color: #D94F3D;
            transition: width 0.3s ease;
        }
        .nav-link:hover::after {
            width: 100%;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in { animation: fadeIn 0.5s ease-out forwards; }
    </style>
</head>

<body class="bg-crema text-chocolate font-sans selection:bg-marron/30 selection:text-chocolate">

    <div class="bg-chocolate text-cremaClaro/80 py-2 px-6 text-[10px] uppercase tracking-[3px] font-bold border-b border-white/5">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <span class="flex items-center gap-2">
                <span class="w-1.5 h-1.5 bg-coral rounded-full"></span>
                Área de Salud y Medio Ambiente
            </span>
            <span class="hidden md:block opacity-60">Sede Electrónica Oficial</span>
        </div>
    </div>

    <nav class="bg-white/90 backdrop-blur-xl sticky top-0 z-50 border-b border-marron/5 shadow-sm">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

            <a href="/" class="flex items-center gap-4 group">
                <div class="p-1 bg-cremaClaro/30 rounded-lg group-hover:bg-cremaClaro/50 transition-colors">
                    <img src="{{ asset('images/logo-ayuntamiento.png') }}" alt="Escudo Ayuntamiento" class="h-11 w-auto">
                </div>
                <div class="flex flex-col">
                    <h1 class="font-serif font-bold text-xl leading-none text-chocolate tracking-tight">
                        Bienestar Animal
                    </h1>
                    <span class="text-[10px] uppercase tracking-[2px] text-coral font-bold mt-1">Portal Municipal</span>
                </div>
            </a>

            <div class="hidden md:flex items-center gap-8">
                <div class="flex space-x-8 items-center font-bold text-[11px] text-marron/70 uppercase tracking-widest">
                    <a href="/" class="nav-link hover:text-chocolate transition-colors">Inicio</a>
                    <a href="/adopcion/perros" class="nav-link hover:text-chocolate transition-colors">Perros</a>
                    <a href="/adopcion/gatos" class="nav-link hover:text-chocolate transition-colors">Gatos</a>
                    <a href="/contacto" class="nav-link hover:text-chocolate transition-colors border-r border-marron/10 pr-8">Contacto</a>
                </div>

                <div class="flex items-center gap-3">
                    @auth
                        <a href="/dashboard" class="bg-marron hover:bg-chocolate text-cremaClaro px-5 py-2.5 rounded-xl text-[11px] font-bold uppercase tracking-widest transition-all shadow-md flex items-center gap-2">
                            <span class="relative flex h-2 w-2">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-coral opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-coral"></span>
                            </span>
                            Gestión
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="border-2 border-coral/20 hover:border-coral text-coral px-4 py-2 rounded-xl text-[11px] font-bold uppercase tracking-widest transition-all">
                                Salir
                            </button>
                        </form>
                    @endauth

                    @guest
                        <a href="/login" class="bg-cremaClaro/50 hover:bg-cremaClaro text-marron px-6 py-2.5 rounded-xl text-[11px] font-bold uppercase tracking-widest transition-all">
                            Acceso Interno
                        </a>
                    @endguest
                </div>
            </div>

            <button id="menu-btn" class="md:hidden text-marron hover:bg-marron/5 p-2 rounded-lg transition-colors">
                <svg id="menu-icon" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
            </button>
        </div>

        <div id="mobile-menu" class="hidden md:hidden bg-white border-t border-marron/5 shadow-inner">
            <div class="px-6 py-8 space-y-6">
                <div class="grid grid-cols-1 gap-4 font-bold text-marron uppercase tracking-widest text-sm">
                    <a href="/" class="p-4 bg-crema/20 rounded-xl">Inicio</a>
                    <a href="/adopcion/perros" class="p-4 bg-crema/20 rounded-xl">Perros</a>
                    <a href="/adopcion/gatos" class="p-4 bg-crema/20 rounded-xl">Gatos</a>
                    <a href="/contacto" class="p-4 bg-crema/20 rounded-xl">Contacto</a>
                </div>
                @guest
                    <a href="/login" class="block text-center bg-marron text-cremaClaro py-4 rounded-xl font-bold uppercase tracking-widest text-xs shadow-lg">Identificarse</a>
                @endguest
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto p-6 md:p-12 min-h-[80vh]">
        <nav class="flex mb-12" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-3 text-[10px] font-bold uppercase tracking-[2px]">
                <li>
                    <a href="#" class="text-marron/40 hover:text-marron transition-colors">Ayuntamiento</a>
                </li>
                <li class="text-marron/20">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                </li>
                <li class="text-coral bg-coral/5 px-3 py-1 rounded-full">Bienestar Animal</li>
            </ol>
        </nav>

        <section class="animate-fade-in">
            @yield('content')
        </section>
    </main>

    <footer class="bg-chocolate text-cremaClaro/90 border-t-4 border-coral">
        <div class="max-w-7xl mx-auto px-6 py-16">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-16 border-b border-white/5 pb-16">
                
                <div class="md:col-span-2">
                    <div class="flex items-center gap-3 mb-6">
                        <span class="text-2xl">🐾</span>
                        <h3 class="text-2xl font-serif font-bold text-white">Bienestar Animal</h3>
                    </div>
                    <p class="text-sm leading-relaxed opacity-70 max-w-sm mb-8">
                        Comprometidos con la protección animal y la convivencia responsable en nuestro municipio. Gestión ética bajo la normativa estatal vigente.
                    </p>
                    <div class="flex gap-3">
                        <a href="#" class="w-10 h-10 rounded-xl bg-white/5 flex items-center justify-center hover:bg-coral hover:text-white transition-all">FB</a>
                        <a href="#" class="w-10 h-10 rounded-xl bg-white/5 flex items-center justify-center hover:bg-coral hover:text-white transition-all">IG</a>
                        <a href="#" class="w-10 h-10 rounded-xl bg-white/5 flex items-center justify-center hover:bg-coral hover:text-white transition-all">TW</a>
                    </div>
                </div>

                <div>
                    <h4 class="text-[11px] uppercase tracking-[3px] font-bold text-salmon mb-6">Servicios</h4>
                    <ul class="text-sm space-y-4 font-medium">
                        <li><a href="#" class="opacity-60 hover:opacity-100 hover:text-salmon transition-all flex items-center gap-2"><span>→</span> Censo de ADN</a></li>
                        <li><a href="#" class="opacity-60 hover:opacity-100 hover:text-salmon transition-all flex items-center gap-2"><span>→</span> Gestión CER Gatos</a></li>
                        <li><a href="#" class="opacity-60 hover:opacity-100 hover:text-salmon transition-all flex items-center gap-2"><span>→</span> Portal Adopción</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-[11px] uppercase tracking-[3px] font-bold text-salmon mb-6">Ubicación</h4>
                    <div class="space-y-4 text-sm">
                        <div class="flex gap-3">
                            <span class="opacity-40 italic">📍</span>
                            <p class="opacity-70">Plaza Mayor, 1<br>2ª Planta (Medio Ambiente)</p>
                        </div>
                        <div class="flex gap-3">
                            <span class="opacity-40 italic">📞</span>
                            <p class="opacity-70">900 000 000</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="mt-12 flex flex-col md:flex-row justify-between items-center text-[10px] font-bold uppercase tracking-widest opacity-40">
                <p>&copy; 2026 Excmo. Ayuntamiento de la Ciudad.</p>
                <div class="flex gap-8 mt-6 md:mt-0">
                    <a href="#" class="hover:text-salmon transition-colors">Privacidad</a>
                    <a href="#" class="hover:text-salmon transition-colors">Cookies</a>
                    <a href="#" class="hover:text-salmon transition-colors">Accesibilidad</a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        const btn = document.getElementById('menu-btn');
        const menu = document.getElementById('mobile-menu');
        const icon = document.getElementById('menu-icon');

        btn.addEventListener('click', () => {
            menu.classList.toggle('hidden');
            if(menu.classList.contains('hidden')) {
                icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />';
            } else {
                icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />';
            }
        });
    </script>
</body>
</html>