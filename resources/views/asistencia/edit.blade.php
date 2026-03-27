<x-layouts::app :title="__('Editar Asistencia')">
<div class="p-6 max-w-2xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('asistencia.index') }}" class="text-zinc-500 hover:text-white text-sm flex items-center gap-2 mb-2 transition">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Volver al listado
        </a>
        <h1 class="text-2xl font-bold text-white">Editar Asistencia</h1>
        {{-- Usamos ?? por seguridad en caso de que la relación falle --}}
        <p class="text-sm text-gray-400">
            Alumno: {{ $asistencia->alumno->nombre ?? 'N/A' }} {{ $asistencia->alumno->apellido ?? '' }}
        </p>
    </div>

    <form action="{{ route('asistencia.update', $asistencia->id) }}" method="POST" class="bg-[#1e1e2e] border border-white/10 p-6 rounded-2xl space-y-6">
        @csrf
        @method('PUT')

        <div class="space-y-2">
            <label class="text-xs font-bold text-gray-500 uppercase">Estatus de Asistencia</label>
            <select name="estatus" class="w-full bg-black/20 border border-white/10 rounded-xl px-4 py-3 text-white outline-none focus:ring-2 focus:ring-blue-500">
                <option value="Presente" {{ $asistencia->estatus == 'Presente' ? 'selected' : '' }}>Presente</option>
                <option value="Ausente" {{ $asistencia->estatus == 'Ausente' ? 'selected' : '' }}>Ausente</option>
                <option value="Retardo" {{ $asistencia->estatus == 'Retardo' ? 'selected' : '' }}>Retardo</option>
                <option value="Justificado" {{ $asistencia->estatus == 'Justificado' ? 'selected' : '' }}>Justificado</option>
            </select>
        </div>

        <div class="space-y-2">
            <label class="text-xs font-bold text-gray-500 uppercase">Observaciones / Justificación</label>
            <textarea name="observaciones" rows="3" placeholder="Opcional: motivo del retardo o falta..." 
                class="w-full bg-black/20 border border-white/10 rounded-xl px-4 py-3 text-white outline-none focus:ring-2 focus:ring-blue-500 transition-all">{{ old('observaciones', $asistencia->observaciones) }}</textarea>
        </div>

        <div class="flex gap-3 pt-2">
            <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-500 text-white font-bold py-3 rounded-xl transition shadow-lg shadow-blue-900/20 active:scale-[0.98]">
                Actualizar Registro
            </button>
            <a href="{{ route('asistencia.index') }}" class="px-6 py-3 bg-white/5 text-zinc-400 rounded-xl hover:bg-white/10 transition text-center">
                Cancelar
            </a>
        </div>
    </form>
</div>
</x-layouts::app>