@extends('layouts.app')

@section('content')
<div class="min-h-[75vh] flex flex-col justify-center py-12 px-6">
    
    <div class="sm:mx-auto sm:w-full sm:max-w-md text-center">
        <div class="inline-flex items-center justify-center p-4 rounded-2xl bg-white shadow-sm border border-[#F0DEC4] mb-6">
            <img src="{{ asset('images/logo-ayuntamiento.png') }}" alt="Escudo" class="h-16 w-auto opacity-90">
        </div>
        
        <h2 class="text-2xl font-serif font-bold text-[#4A2810] tracking-tight">
            Portal de Gestión Interna
        </h2>
        <p class="mt-2 text-sm font-semibold text-[#7A4F2D] uppercase tracking-[2px]">
            Bienestar Animal
        </p>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-white py-10 px-8 shadow-2xl border border-[#F0DEC4] rounded-3xl relative">
            
            <div class="mb-8 flex items-center gap-3 p-3 rounded-lg bg-[#D94F3D]/5 border border-[#D94F3D]/20">
                <svg class="w-5 h-5 text-[#D94F3D]" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                </svg>
                <span class="text-[11px] font-bold text-[#D94F3D] uppercase tracking-wider">
                    Acceso exclusivo para personal autorizado
                </span>
            </div>

            <form class="space-y-6" action="{{ route('login') }}" method="POST">
                @csrf

                <div>
                    <label for="email" class="block text-[10px] font-bold uppercase tracking-widest text-[#7A4F2D] mb-2 ml-1">
                        Usuario Corporativo / Email
                    </label>
                    <input id="email" name="email" type="email" required 
                        class="block w-full rounded-xl border border-[#F0DEC4] px-4 py-3 text-[#4A2810] focus:border-[#7A4F2D] focus:ring-2 focus:ring-[#7A4F2D]/10 outline-none transition-all bg-[#F5E6D3]/10 placeholder-[#7A4F2D]/30"
                        placeholder="usuario@ayuntamiento.es">
                    @error('email')
                        <p class="mt-2 text-xs text-[#D94F3D] font-bold">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <div class="flex justify-between items-center mb-2">
                        <label for="password" class="block text-[10px] font-bold uppercase tracking-widest text-[#7A4F2D] ml-1">
                            Contraseña
                        </label>
                        <a href="{{ route('password.request') }}" class="text-[10px] font-bold text-[#D94F3D] hover:underline uppercase tracking-tighter">
                            ¿Problemas de acceso?
                        </a>
                    </div>
                    <input id="password" name="password" type="password" required 
                        class="block w-full rounded-xl border border-[#F0DEC4] px-4 py-3 text-[#4A2810] focus:border-[#7A4F2D] focus:ring-2 focus:ring-[#7A4F2D]/10 outline-none transition-all bg-[#F5E6D3]/10 placeholder-[#7A4F2D]/30"
                        placeholder="••••••••">
                </div>

                <div class="flex items-center">
                    <input id="remember_me" name="remember" type="checkbox" 
                        class="h-4 w-4 rounded border-[#F0DEC4] text-[#7A4F2D] focus:ring-[#D94F3D]">
                    <label for="remember_me" class="ml-2 block text-xs font-medium text-[#7A4F2D]">
                        Mantener sesión iniciada en este equipo corporativo
                    </label>
                </div>

                <button type="submit" 
                    class="group relative flex w-full justify-center rounded-xl bg-[#7A4F2D] py-4 px-4 text-sm font-bold text-[#F5E6D3] shadow-lg hover:bg-[#4A2810] transition-all active:scale-[0.98]">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <svg class="h-5 w-5 text-[#E8937A] group-hover:text-white transition-colors" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3 3a1 1 0 011 1v12a1 1 0 11-2 0V4a1 1 0 011-1zm7.707 3.293a1 1 0 010 1.414L9.414 9H17a1 1 0 110 2H9.414l1.293 1.293a1 1 0 01-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                    </span>
                    Entrar al Sistema
                </button>
            </form>

            <div class="mt-10 pt-6 border-t border-[#F0DEC4] text-center">
                <p class="text-[9px] text-[#7A4F2D]/60 uppercase tracking-widest leading-relaxed">
                    Sistema de Gestión Municipal <br>
                    <span class="font-bold">Uso estrictamente profesional</span>
                </p>
                <p class="mt-4 text-[9px] text-[#7A4F2D]/40 leading-tight">
                    El acceso no autorizado o el uso indebido de este portal será reportado al departamento de seguridad informática de la entidad.
                </p>
            </div>
        </div>
        
        <div class="text-center mt-8">
            <a href="/" class="text-xs font-bold text-[#7A4F2D]/60 hover:text-[#7A4F2D] transition-colors flex items-center justify-center gap-2">
                ← Volver al portal público
            </a>
        </div>
    </div>
</div>
@endsection