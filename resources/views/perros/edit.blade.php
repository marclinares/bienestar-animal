@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-8 px-4">
    <div class="mb-8 flex items-center justify-between">
        <div>
            <a href="{{ route('perros.index') }}" class="text-[#7A4F2D] text-sm font-bold flex items-center gap-1 hover:text-[#D94F3D] mb-2 transition-colors">
                ← Volver al listado
            </a>
            <h1 class="text-3xl font-serif font-bold text-[#4A2810]">Actualizar Registro Canino</h1>
            <p class="text-[#7A4F2D]/60 text-xs font-bold uppercase tracking-widest">ID Can: #PE-{{ $perro->id }}</p>
        </div>
    </div>

    {{-- Errores de validación --}}
    @if ($errors->any())
        <div class="mb-6 bg-red-50 border border-red-200 rounded-2xl p-4">
            <p class="text-xs font-bold uppercase tracking-widest text-red-600 mb-2">Corrige los siguientes errores:</p>
            <ul class="list-disc list-inside space-y-1">
                @foreach ($errors->all() as $error)
                    <li class="text-sm text-red-500">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white rounded-[2.5rem] shadow-xl border border-[#F0DEC4] overflow-hidden">
        <form action="{{ route('perros.update', $perro) }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-10">
            @csrf
            @method('PUT')

            {{-- SECCIÓN 01: Datos --}}
            <div class="space-y-6">
                <div class="flex items-center gap-2 border-b border-[#F0DEC4] pb-2">
                    <span class="text-[#D94F3D] font-serif italic text-xl">01.</span>
                    <h3 class="text-sm font-bold uppercase tracking-widest text-[#4A2810]">Información del Perro</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-2">
                        <label class="block text-xs font-bold uppercase tracking-widest text-[#7A4F2D] ml-1">Nombre</label>
                        <input type="text" name="nombre" value="{{ old('nombre', $perro->nombre) }}" required
                            class="w-full rounded-2xl border-[#F0DEC4] bg-[#F5E6D3]/10 px-4 py-3 text-[#4A2810] focus:ring-[#D94F3D] focus:border-[#D94F3D]">
                    </div>

                    <div class="space-y-2">
                        <label class="block text-xs font-bold uppercase tracking-widest text-[#7A4F2D] ml-1">Raza / Capa</label>
                        <input type="text" name="raza" value="{{ old('raza', $perro->raza) }}"
                            class="w-full rounded-2xl border-[#F0DEC4] bg-[#F5E6D3]/10 px-4 py-3 text-[#4A2810] focus:ring-[#D94F3D]">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label class="block text-xs font-bold uppercase tracking-widest text-[#7A4F2D] ml-1">Edad aprox.</label>
                            <input type="number" name="edad" value="{{ old('edad', $perro->edad) }}"
                                class="w-full rounded-2xl border-[#F0DEC4] bg-[#F5E6D3]/10 px-4 py-3 text-[#4A2810] focus:ring-[#D94F3D]">
                        </div>
                        <div class="space-y-2">
                            <label class="block text-xs font-bold uppercase tracking-widest text-[#7A4F2D] ml-1">Estado</label>
                            <select name="estado" class="w-full rounded-2xl border-[#F0DEC4] bg-[#F5E6D3]/10 px-4 py-3 text-[#4A2810]">
                                <option value="disponible" {{ old('estado', $perro->estado) == 'disponible' ? 'selected' : '' }}>Disponible</option>
                                <option value="adoptado"   {{ old('estado', $perro->estado) == 'adoptado'   ? 'selected' : '' }}>Adoptado</option>
                            </select>
                        </div>
                    </div>

                    <div class="md:col-span-2 space-y-2">
                        <label class="block text-xs font-bold uppercase tracking-widest text-[#7A4F2D] ml-1">Descripción / Notas</label>
                        <textarea name="descripcion" rows="3"
                            class="w-full rounded-2xl border-[#F0DEC4] bg-[#F5E6D3]/10 px-4 py-3 text-[#4A2810] focus:ring-[#D94F3D]">{{ old('descripcion', $perro->descripcion) }}</textarea>
                    </div>
                </div>
            </div>

            {{-- SECCIÓN 02: Galería --}}
            <div class="pt-8 border-t border-[#F0DEC4] space-y-6">
                <div class="flex items-center justify-between border-b border-[#F0DEC4] pb-2">
                    <div class="flex items-center gap-2">
                        <span class="text-[#D94F3D] font-serif italic text-xl">02.</span>
                        <h3 class="text-sm font-bold uppercase tracking-widest text-[#4A2810]">Galería Multimedia</h3>
                    </div>
                    {{-- Contador dinámico --}}
                    <span id="contador-fotos" class="text-xs font-bold text-[#7A4F2D] bg-[#F5E6D3] px-3 py-1 rounded-full">
                        {{ $perro->fotos->count() }}/3 fotos
                    </span>
                </div>

                <p class="text-[10px] text-[#7A4F2D]/60 uppercase font-bold tracking-tighter">
                    Marca el icono 🗑 para eliminar una foto al guardar. Puedes subir hasta {{ 3 - $perro->fotos->count() }} foto(s) nueva(s).
                </p>

                {{-- Grid de fotos actuales --}}
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4" id="grid-fotos">

                    @foreach($perro->fotos as $foto)
                    <div class="relative group aspect-square" id="foto-actual-{{ $foto->id }}">
                        <img src="{{ asset('storage/' . $foto->ruta) }}"
                            class="w-full h-full object-cover rounded-2xl border border-[#F0DEC4] transition-all group-hover:brightness-75 shadow-sm">

                        {{-- Checkbox eliminar --}}
                        <label class="absolute top-2 right-2 cursor-pointer z-10">
                            <input type="checkbox" name="eliminar_fotos[]" value="{{ $foto->id }}"
                                class="hidden peer" onchange="toggleEliminar(this, {{ $foto->id }})">
                            <div class="bg-white/90 text-[#D94F3D] p-1.5 rounded-lg shadow-md border border-[#F0DEC4]
                                peer-checked:bg-[#D94F3D] peer-checked:text-white transition-all hover:scale-110"
                                title="Marcar para eliminar">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                        </label>

                        {{-- Overlay "Será eliminada" --}}
                        <div id="overlay-{{ $foto->id }}"
                            class="absolute inset-0 rounded-2xl bg-[#D94F3D]/60 hidden items-center justify-center pointer-events-none">
                            <span class="text-white text-[10px] font-bold uppercase tracking-widest bg-[#D94F3D] px-3 py-1 rounded-full">
                                Se eliminará
                            </span>
                        </div>

                        <div class="absolute bottom-2 left-2 pointer-events-none">
                            <span class="text-[8px] font-bold text-white uppercase bg-black/40 px-2 py-0.5 rounded-md backdrop-blur-sm">Actual</span>
                        </div>
                    </div>
                    @endforeach

                    {{-- Slots para nuevas fotos (se insertan con JS) --}}
                    <div id="new-previews" class="contents"></div>
                </div>

                {{-- Uploader: solo si hay huecos --}}
                @if($perro->fotos->count() < 3)
                <div id="uploader-wrap" class="mt-4">
                    <label id="uploader-label" class="relative flex flex-col items-center justify-center w-full py-8 rounded-2xl border-2 border-dashed border-[#F0DEC4] bg-[#F5E6D3]/5 hover:bg-[#F5E6D3]/20 transition-all cursor-pointer group">
                        <input type="file" name="fotos[]" id="input-fotos" multiple accept="image/*"
                            class="hidden" onchange="handleFiles(this.files)">
                        <div class="flex flex-col items-center gap-2">
                            <div class="bg-[#7A4F2D] text-white p-2 rounded-full group-hover:scale-110 transition-transform shadow-md">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 4v16m8-8H4" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                            <span class="text-[11px] font-bold uppercase tracking-widest text-[#7A4F2D]">Añadir nuevas imágenes</span>
                            <p class="text-[9px] text-[#7A4F2D]/50 italic" id="huecos-label">
                                {{ 3 - $perro->fotos->count() }} hueco(s) disponible(s) · Máximo 3 fotos totales
                            </p>
                        </div>
                    </label>
                </div>
                @else
                <div id="uploader-wrap">
                    <p id="limite-msg" class="text-center text-xs text-[#7A4F2D]/60 font-bold uppercase tracking-widest py-4 bg-[#F5E6D3]/30 rounded-2xl">
                        Límite de 3 fotos alcanzado · Elimina alguna para poder subir nuevas
                    </p>
                </div>
                @endif
            </div>

            {{-- Acciones --}}
            <div class="flex items-center justify-end gap-6 pt-10 border-t border-[#F0DEC4]">
                <a href="{{ route('perros.index') }}"
                    class="text-xs font-bold uppercase tracking-widest text-[#7A4F2D] hover:text-[#D94F3D] transition-colors">
                    Descartar cambios
                </a>
                <button type="submit"
                    class="bg-[#D94F3D] text-white px-12 py-4 rounded-2xl font-bold shadow-lg hover:bg-[#4A2810] hover:-translate-y-1 transition-all active:scale-95 flex items-center gap-2 group">
                    <span>Guardar Cambios</span>
                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M14 5l7 7m0 0l-7 7m7-7H3" stroke-width="2.5" stroke-linecap="round"/>
                    </svg>
                </button>
            </div>
        </form>
    </div>
</div>

<script>
const totalActuales = {{ $perro->fotos->count() }};
let marcadasParaEliminar = 0;
let nuevasSeleccionadas  = 0;

// Calcular huecos libres en tiempo real
function huecosLibres() {
    return 3 - (totalActuales - marcadasParaEliminar) - nuevasSeleccionadas;
}

// Actualizar el contador visible y el estado del uploader
function actualizarUI() {
    const ocupadas = (totalActuales - marcadasParaEliminar) + nuevasSeleccionadas;
    const huecos   = 3 - ocupadas;

    // Contador badge
    document.getElementById('contador-fotos').textContent = ocupadas + '/3 fotos';

    const wrap      = document.getElementById('uploader-wrap');
    const labelEl   = document.getElementById('uploader-label');
    const limiteMsg = document.getElementById('limite-msg');
    const huecosLbl = document.getElementById('huecos-label');

    if (huecos <= 0) {
        // Ocultar uploader, mostrar mensaje límite
        if (labelEl)   labelEl.classList.add('hidden');
        if (limiteMsg) limiteMsg.classList.remove('hidden');
        else {
            wrap.innerHTML = `<p id="limite-msg" class="text-center text-xs text-[#7A4F2D]/60 font-bold uppercase tracking-widest py-4 bg-[#F5E6D3]/30 rounded-2xl">
                Límite de 3 fotos alcanzado · Elimina alguna para poder subir nuevas
            </p>`;
        }
    } else {
        // Mostrar uploader
        if (labelEl)   labelEl.classList.remove('hidden');
        if (limiteMsg) limiteMsg.classList.add('hidden');
        if (huecosLbl) huecosLbl.textContent = huecos + ' hueco(s) disponible(s) · Máximo 3 fotos totales';
    }
}

// Toggle overlay al marcar/desmarcar eliminar
function toggleEliminar(checkbox, fotoId) {
    const overlay = document.getElementById('overlay-' + fotoId);
    if (checkbox.checked) {
        marcadasParaEliminar++;
        overlay.classList.remove('hidden');
        overlay.classList.add('flex');
    } else {
        marcadasParaEliminar--;
        overlay.classList.add('hidden');
        overlay.classList.remove('flex');
    }
    actualizarUI();
}

// Preview de nuevas fotos
function handleFiles(files) {
    const container = document.getElementById('new-previews');
    container.innerHTML = '';
    nuevasSeleccionadas = 0;

    const limite = Math.max(0, huecosLibres() + nuevasSeleccionadas); // recalcular antes de añadir
    const archivos = Array.from(files).slice(0, Math.max(0, 3 - (totalActuales - marcadasParaEliminar)));

    archivos.forEach(file => {
        const reader = new FileReader();
        reader.onload = (e) => {
            const div = document.createElement('div');
            div.className = 'relative aspect-square';
            div.innerHTML = `
                <img src="${e.target.result}"
                    class="w-full h-full object-cover rounded-2xl border-2 border-[#D94F3D]/40 ring-4 ring-[#D94F3D]/10 shadow-md">
                <div class="absolute bottom-2 left-2">
                    <span class="text-[8px] font-bold text-white uppercase bg-[#D94F3D] px-2 py-0.5 rounded-md shadow-sm">Nueva</span>
                </div>
            `;
            container.appendChild(div);
        };
        reader.readAsDataURL(file);
        nuevasSeleccionadas++;
    });

    actualizarUI();
}
</script>
@endsection