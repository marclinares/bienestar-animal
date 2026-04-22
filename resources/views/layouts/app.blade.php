<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienestar Animal | Excmo. Ayuntamiento</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&family=Lora:ital,wght@0,600;1,400&display=swap" rel="stylesheet">
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
        .header-line { background: linear-gradient(90deg, #7A4F2D 0%, #D94F3D 100%); }
        .content-card { background: rgba(255, 255, 255, 0.5); border: 1px solid #E8937A; }
    </style>
</head>

<body class="bg-crema text-chocolate font-sans selection:bg-marron selection:text-white">

    <div class="bg-chocolate text-cremaClaro py-1.5 px-6 text-[10px] uppercase tracking-[3px] font-bold">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <span>Área de Medio Ambiente y Salud</span>
            <span class="hidden md:block">Sede Oficial</span>
        </div>
    </div>

    <nav class="bg-white/80 backdrop-blur-md sticky top-0 z-50 border-b border-marron/10 shadow-sm">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

            <div class="flex items-center gap-4 border-r border-cremaClaro pr-8">
                <img src="{{ asset('images/logo-ayuntamiento.png') }}" alt="Escudo Ayuntamiento" class="h-12 w-auto">
                <div class="flex flex-col">
                    <h1 class="font-serif font-bold text-xl leading-none text-marron tracking-tight">
                        Bienestar Animal
                    </h1>
                    <span class="text-[11px] uppercase tracking-widest text-coral font-bold mt-1">Portal Municipal</span>
                </div>
            </div>

            <div class="hidden md:flex space-x-10 items-center font-semibold text-sm text-marron/80 uppercase tracking-wide">
                <a href="/" class="hover:text-coral transition-colors">Inicio</a>
                <a href="/adopcion/perros" class="hover:text-coral transition-colors">Perros</a>
                <a href="/adopcion/gatos" class="hover:text-coral transition-colors">Gatos</a>
                <a href="/contacto" class="hover:text-coral transition-colors">Contacto</a>

                @auth
                    <a href="/dashboard" class="bg-marron hover:bg-chocolate px-6 py-2 rounded text-cremaClaro transition-all shadow-md flex items-center gap-2">
                        <span class="w-2 h-2 bg-coral rounded-full animate-pulse"></span>
                        Gestión
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="bg-[#D94F3D] hover:bg-[#F5E6D3] hover:text-[#D94F3D] text-white px-4 py-2 rounded-xl text-xs font-bold uppercase tracking-widest transition-all shadow-md">
                            Cerrar Sesión
                        </button>
                    </form>
                @endauth

                @guest
                    <a href="/login" class="flex items-center gap-2 text-marron hover:text-coral border-l border-cremaClaro pl-8 transition-colors">
                        Acceso
                    </a>
                @endguest
            </div>

            <button id="menu-btn" class="md:hidden text-marron p-1">
                <svg id="menu-icon" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
            </button>
        </div>

        <div id="mobile-menu" class="hidden md:hidden bg-cremaClaro border-t border-marron/10">
            <div class="px-6 py-8 space-y-4">
                <a href="/" class="block text-lg font-bold text-marron">Inicio</a>
                <a href="/adopcion/perros" class="block text-lg font-bold text-marron">Perros</a>
                <a href="/adopcion/gatos" class="block text-lg font-bold text-marron">Gatos</a>
                <a href="/contacto" class="block text-lg font-bold text-marron">Contacto</a>
                <hr class="border-marron/10">
                @guest
                    <a href="/login" class="block text-center bg-marron text-cremaClaro py-3 rounded font-bold">Identificarse</a>
                @endguest
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto p-6 md:p-12 min-h-screen">
        <nav class="flex mb-10 text-[11px] font-bold uppercase tracking-widest text-marron/50" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-2">
                <li class="hover:text-marron cursor-pointer">Ayuntamiento</li>
                <li>/</li>
                <li class="text-coral">Bienestar Animal</li>
            </ol>
        </nav>

        <section class="animate-[fadeIn_0.5s_ease-out]">
            @yield('content')
        </section>
    </main>

    <footer class="bg-marron text-cremaClaro">
        <div class="max-w-7xl mx-auto px-6 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 border-b border-cremaClaro/10 pb-12">
                
                <div class="md:col-span-2">
                    <h3 class="text-xl font-serif font-bold mb-4">🐾 Bienestar Animal</h3>
                    <p class="text-sm opacity-80 max-w-md leading-relaxed mb-6">
                        Iniciativa municipal para el fomento de la adopción responsable y la protección del derecho animal. Cumpliendo con la Ley 7/2023 de protección de los derechos y el bienestar de los animales.
                    </p>
                    <div class="flex gap-4">
                        <div class="w-8 h-8 rounded border border-cremaClaro/20 flex items-center justify-center hover:bg-coral transition-colors cursor-pointer">f</div>
                        <div class="w-8 h-8 rounded border border-cremaClaro/20 flex items-center justify-center hover:bg-coral transition-colors cursor-pointer">t</div>
                        <div class="w-8 h-8 rounded border border-cremaClaro/20 flex items-center justify-center hover:bg-coral transition-colors cursor-pointer">i</div>
                    </div>
                </div>

                <div>
                    <h4 class="text-xs uppercase tracking-widest font-bold text-salmon mb-4">Trámites</h4>
                    <ul class="text-sm space-y-3 opacity-80 font-medium">
                        <li><a href="#" class="hover:text-salmon transition-colors">Registro de ADN</a></li>
                        <li><a href="#" class="hover:text-salmon transition-colors">Licencia PPP</a></li>
                        <li><a href="#" class="hover:text-salmon transition-colors">Cita Previa Veterinaria</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-xs uppercase tracking-widest font-bold text-salmon mb-4">Sede</h4>
                    <ul class="text-sm space-y-3 opacity-80">
                        <li class="flex items-start gap-2 italic">📍 Plaza Mayor, 1 - 2ª Planta</li>
                        <li class="flex items-start gap-2">📞 900 000 000</li>
                    </ul>
                </div>
            </div>
            
            <div class="mt-8 flex flex-col md:flex-row justify-between items-center text-[11px] font-medium opacity-60 uppercase tracking-tighter">
                <p>&copy; 2026 Ayuntamiento de la Ciudad. Todos los derechos reservados.</p>
                <div class="flex gap-6 mt-4 md:mt-0">
                    <a href="#" class="hover:text-white transition-colors">Aviso Legal</a>
                    <a href="#" class="hover:text-white transition-colors">Privacidad</a>
                    <a href="#" class="hover:text-white transition-colors">Accesibilidad</a>
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

    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</body>
</html>