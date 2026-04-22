@extends('layouts.app')

@section('content')
<style>
    /* Añadimos la animación por si no la tienes en tu CSS */
    @keyframes fadeInDown {
        0% { opacity: 0; transform: translateY(-20px); }
        100% { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in {
        animation: fadeInDown 0.6s ease-out forwards;
    }
</style>

<div class="max-w-6xl mx-auto py-12 px-4">
    <div class="text-center mb-16 animate-fade-in">
        <h2 class="text-4xl font-serif font-bold text-chocolate mb-4">Contacto y Ubicación</h2>
        <p class="text-marron/60 italic font-medium">Estamos aquí para resolver tus dudas sobre el centro de protección animal.</p>
        <div class="w-24 h-1 bg-coral mx-auto mt-6 rounded-full opacity-20"></div>
    </div>

    @if(session('success'))
        <div class="max-w-3xl mx-auto mb-10 bg-green-50 border-2 border-green-200 p-6 rounded-[2rem] shadow-lg shadow-green-900/5 animate-fade-in flex items-center gap-4">
            <div class="bg-green-500 text-white w-10 h-10 rounded-full flex items-center justify-center text-xl shadow-sm">
                ✓
            </div>
            <div>
                <p class="text-green-800 font-bold uppercase tracking-widest text-xs">¡Mensaje enviado!</p>
                <p class="text-green-700 text-sm mt-0.5">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
        <div class="space-y-6">
            <div class="bg-white p-8 rounded-[2.5rem] border border-cremaClaro shadow-sm">
                <h4 class="text-[10px] font-bold uppercase tracking-[2px] text-coral mb-8">Información de interés</h4>
                <div class="space-y-8">
                    <div class="flex items-start gap-4">
                        <div class="bg-crema p-3 rounded-xl text-xl">📍</div>
                        <div>
                            <p class="font-bold text-chocolate text-sm uppercase tracking-tighter">Dirección</p>
                            <p class="text-marron/70 text-xs mt-1">Calle de la Protección, 12<br>CP 28000</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4 border-t border-cremaClaro pt-6">
                        <div class="bg-coral/10 p-3 rounded-xl text-xl">📞</div>
                        <div>
                            <p class="font-bold text-chocolate text-sm uppercase tracking-tighter">Urgencias</p>
                            <p class="text-coral font-extrabold text-lg tracking-tighter">900 123 456</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="md:col-span-2">
            <div class="bg-crema p-10 rounded-[2.5rem] border-4 border-white shadow-xl">
                <h3 class="text-2xl font-serif font-bold text-chocolate mb-2 text-center md:text-left">Envíanos un mensaje</h3>
                <p class="text-marron/60 text-[10px] mb-8 uppercase tracking-widest font-bold text-center md:text-left">Buzón de atención ciudadana</p>
                
                <form action="{{ route('contacto.general.store') }}" method="POST" class="space-y-5">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div class="space-y-1">
                            <label class="text-[10px] font-bold text-marron/40 uppercase ml-4">Nombre</label>
                            <input type="text" name="nombre" placeholder="Tu nombre" class="w-full bg-white border-0 rounded-2xl p-4 focus:ring-2 focus:ring-coral outline-none text-sm shadow-sm" required>
                        </div>
                        <div class="space-y-1">
                            <label class="text-[10px] font-bold text-marron/40 uppercase ml-4">Email</label>
                            <input type="email" name="email" placeholder="tu@email.com" class="w-full bg-white border-0 rounded-2xl p-4 focus:ring-2 focus:ring-coral outline-none text-sm shadow-sm" required>
                        </div>
                    </div>
                    
                    <div class="space-y-1">
                        <label class="text-[10px] font-bold text-marron/40 uppercase ml-4">Teléfono (Opcional)</label>
                        <input type="text" name="telefono" placeholder="600 000 000" class="w-full bg-white border-0 rounded-2xl p-4 focus:ring-2 focus:ring-coral outline-none text-sm shadow-sm">
                    </div>

                    <div class="space-y-1">
                        <label class="text-[10px] font-bold text-marron/40 uppercase ml-4">Asunto</label>
                        <select name="asunto" class="w-full bg-white border-0 rounded-2xl p-4 focus:ring-2 focus:ring-coral outline-none text-sm text-marron/70 shadow-sm" required>
                            <option value="" disabled selected>Selecciona un motivo</option>
                            <option value="Voluntariado">Quiero ser voluntario</option>
                            <option value="Donaciones">Donaciones</option>
                            <option value="Aviso">Animal perdido/encontrado</option>
                            <option value="Otros">Otros</option>
                        </select>
                    </div>

                    <div class="space-y-1">
                        <label class="text-[10px] font-bold text-marron/40 uppercase ml-4">Mensaje</label>
                        <textarea name="mensaje" placeholder="¿En qué podemos ayudarte?" rows="4" class="w-full bg-white border-0 rounded-2xl p-4 focus:ring-2 focus:ring-coral outline-none text-sm shadow-sm" required></textarea>
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="w-full bg-marron text-cremaClaro py-5 rounded-2xl font-bold uppercase tracking-[2px] text-xs hover:bg-chocolate transition-all shadow-xl">
                            Enviar mensaje
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection