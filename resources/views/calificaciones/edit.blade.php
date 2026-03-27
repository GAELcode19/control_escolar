<x-layouts::app :title="__('Editar Calificación')">
    <div class="p-6 max-w-2xl mx-auto">
        <h1 class="text-2xl font-bold text-white mb-2">Editar Calificación</h1>
        <p class="text-gray-400 mb-6">{{ $inscripcion->alumno->nombre }} - {{ $inscripcion->materia->nombre_materia }}</p>

        <form action="{{ route('calificaciones.update', $inscripcion->id) }}" method="POST" class="bg-[#1e1e2e] border border-white/10 rounded-2xl p-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-3 gap-4 mb-6">
                <div>
                    <label class="block text-xs text-gray-500 uppercase font-bold mb-1">Parcial 1</label>
                    <input type="number" name="p1" value="{{ old('p1', $inscripcion->p1) }}" step="0.1" class="w-full bg-black/20 border border-white/10 rounded-xl px-4 py-2 text-white text-center">
                </div>
                <div>
                    <label class="block text-xs text-gray-500 uppercase font-bold mb-1">Parcial 2</label>
                    <input type="number" name="p2" value="{{ old('p2', $inscripcion->p2) }}" step="0.1" class="w-full bg-black/20 border border-white/10 rounded-xl px-4 py-2 text-white text-center">
                </div>
                <div>
                    <label class="block text-xs text-gray-500 uppercase font-bold mb-1">Parcial 3</label>
                    <input type="number" name="p3" value="{{ old('p3', $inscripcion->p3) }}" step="0.1" class="w-full bg-black/20 border border-white/10 rounded-xl px-4 py-2 text-white text-center">
                </div>
            </div>

            <div class="flex gap-3">
                <button type="submit" class="flex-1 bg-emerald-600 hover:bg-emerald-500 text-white font-bold py-3 rounded-xl transition">Actualizar</button>
                <a href="{{ route('calificaciones.index') }}" class="flex-1 bg-zinc-800 text-center text-white font-bold py-3 rounded-xl">Cancelar</a>
            </div>
        </form>
    </div>
</x-layouts::app>