@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-8 px-4 sm:px-6">
    <div class="mb-8 flex flex-col md:flex-row md:items-end justify-between gap-4">
        <div>
            <a href="javascript:history.back()" class="text-[#7A4F2D] text-sm font-bold flex items-center gap-1 hover:text-[#D94F3D] transition-colors mb-4">
                ← Cancelar y volver
            </a>
            <h1 class="text-3xl font-serif font-bold text-[#4A2810]">Nuevo Registro Canino</h1>
            <p class="text-[#7A4F2D]/70 font-medium italic">Expediente oficial de identificación canina</p>
        </div>
        <div class="bg-[#E8937A]/20 px-4 py-2 rounded-xl border border-[#E8937A]/30">
            <span class="text-[10px] font-bold text-[#7A4F2D] uppercase tracking-widest">Estado: Borrador Nuevo</span>
        </div>
    </div>

    <div class="bg-white rounded-[2.5rem] shadow-xl border border-[#F0DEC4] overflow-hidden">
        <div class="bg-[#7A4F2D] px-8 py-4 flex items-center gap-3">
            <svg class="w-5 h-5 text-[#F5E6D3]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" stroke-width="2"/></svg>
            <span class="text-xs font-bold uppercase tracking-widest text-[#F5E6D3]">Complete todos los campos requeridos para el registro</span>
        </div>

        <form action="{{ route('perros.store') }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-10">
            @csrf

            <div class="space-y-6">
                <div class="flex items-center gap-2 border-b border-[#F0DEC4] pb-2">
                    <span class="text-[#D94F3D] font-serif italic text-xl">01.</span>
                    <h3 class="text-sm font-bold uppercase tracking-widest text-[#4A2810]">Identificación</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-2">
                        <label class="block text-xs font-bold uppercase tracking-widest text-[#7A4F2D] ml-1">Nombre del Perro <span class="text-[#D94F3D]">*</span></label>
                        <input type="text" name="nombre" value="{{ old('nombre') }}" required
                            class="block w-full rounded-2xl border-[#F0DEC4] bg-[#F5E6D3]/10 px-4 py-3 text-[#4A2810] focus:border-[#D94F3D] focus:ring-[#D94F3D] transition-all" placeholder="Nombre identificativo">
                    </div>

                    <div class="space-y-2">
                        <label class="block text-xs font-bold uppercase tracking-widest text-[#7A4F2D] ml-1">Raza / Tipo</label>
                        <input type="text" name="raza" value="{{ old('raza') }}"
                            class="block w-full rounded-2xl border-[#F0DEC4] bg-[#F5E6D3]/10 px-4 py-3 text-[#4A2810] focus:border-[#D94F3D] focus:ring-[#D94F3D] transition-all" placeholder="Ej: Pastor Alemán Mix">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label class="block text-xs font-bold uppercase tracking-widest text-[#7A4F2D] ml-1">Edad estimada</label>
                            <input type="number" name="edad" value="{{ old('edad') }}"
                                class="block w-full rounded-2xl border-[#F0DEC4] bg-[#F5E6D3]/10 px-4 py-3 text-[#4A2810] focus:ring-[#D94F3D]" placeholder="Años">
                        </div>
                        <div class="space-y-2">
                            <label class="block text-xs font-bold uppercase tracking-widest text-[#7A4F2D] ml-1">Estado <span class="text-[#D94F3D]">*</span></label>
                            <select name="estado" class="block w-full rounded-2xl border-[#F0DEC4] bg-[#F5E6D3]/10 px-4 py-3 text-[#4A2810] focus:ring-[#D94F3D]">
                                <option value="disponible" {{ old('estado') == 'disponible' ? 'selected' : '' }}>Disponible</option>
                                <option value="adoptado"   {{ old('estado') == 'adoptado'   ? 'selected' : '' }}>Adoptado</option>
                            </select>
                        </div>
                    </div>

                    <div class="md:col-span-2 space-y-2">
                        <label class="block text-xs font-bold uppercase tracking-widest text-[#7A4F2D] ml-1">Descripción / Notas médicas</label>
                        <textarea name="descripcion" rows="3"
                            class="block w-full rounded-2xl border-[#F0DEC4] bg-[#F5E6D3]/10 px-4 py-3 text-[#4A2810] focus:ring-[#D94F3D]"
                            placeholder="Indique marcas distintivas, carácter o tratamientos en curso...">{{ old('descripcion') }}</textarea>
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <div class="flex items-center gap-2 border-b border-[#F0DEC4] pb-2">
                    <span class="text-[#D94F3D] font-serif italic text-xl">02.</span>
                    <h3 class="text-sm font-bold uppercase tracking-widest text-[#4A2810]">Registro Fotográfico <span class="text-[10px] text-[#7A4F2D]/50 font-normal normal-case italic">(Máx. 3)</span></h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @for ($i = 1; $i <= 3; $i++)
                    <div class="space-y-2">
                        <div class="relative group h-40 rounded-3xl border-2 border-dashed {{ $i == 1 ? 'border-[#D94F3D]/30 bg-[#D94F3D]/5' : 'border-[#F0DEC4] bg-[#F5E6D3]/5' }} hover:border-[#D94F3D] transition-all overflow-hidden">
                            <input type="file" name="fotos[]" id="foto-{{ $i }}" {{ $i == 1 ? 'required' : '' }} accept="image/*"
                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-20" onchange="previewImage(this, {{ $i }})">

                            <div id="preview-container-{{ $i }}" class="absolute inset-0 z-10 hidden">
                                <img id="img-preview-{{ $i }}" src="#" class="w-full h-full object-cover">
                                <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                    <span class="text-white text-[10px] font-bold uppercase tracking-widest">Cambiar foto</span>
                                </div>
                            </div>

                            <div id="placeholder-{{ $i }}" class="flex flex-col items-center justify-center h-full space-y-2 p-4 text-center">
                                <svg class="w-8 h-8 {{ $i == 1 ? 'text-[#D94F3D]/40' : 'text-[#7A4F2D]/20' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" stroke-width="1.5"/></svg>
                                <div>
                                    <span class="text-[10px] font-bold {{ $i == 1 ? 'text-[#D94F3D]' : 'text-[#7A4F2D]/60' }} uppercase block">Foto {{ $i }}</span>
                                    <span class="text-[9px] text-[#7A4F2D]/40">{{ $i == 1 ? 'Obligatoria' : 'Opcional' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endfor
                </div>
                @error('fotos') <p class="text-[#D94F3D] text-xs font-bold mt-2 italic">{{ $message }}</p> @enderror
            </div>

            <div class="flex items-center justify-end gap-6 pt-8 border-t border-[#F0DEC4]">
                <a href="javascript:history.back()" class="text-xs font-bold uppercase tracking-widest text-[#7A4F2D] hover:text-[#D94F3D] transition-colors">
                    Descartar Registro
                </a>
                <button type="submit" class="bg-[#7A4F2D] text-[#F5E6D3] px-12 py-4 rounded-2xl font-bold shadow-lg hover:bg-[#4A2810] hover:-translate-y-1 transition-all active:scale-95 flex items-center gap-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" stroke-width="2"/></svg>
                    Finalizar y Guardar
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function previewImage(input, index) {
    const preview = document.getElementById(`img-preview-${index}`);
    const container = document.getElementById(`preview-container-${index}`);
    const placeholder = document.getElementById(`placeholder-${index}`);

    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            container.classList.remove('hidden');
            placeholder.classList.add('hidden');
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection