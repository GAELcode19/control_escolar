<x-layouts::app :title="__('Registrar Nota')">
    <div class="p-6 max-w-2xl mx-auto">
        {{-- Encabezado --}}
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-white">Registrar Calificación</h1>
            <p class="text-sm text-gray-400 mt-1">Asigna los puntajes de los parciales para el alumno seleccionado.</p>
        </div>

        {{-- Alertas de Errores de Validación o de Inscripción --}}
        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-500/20 border border-red-500/50 rounded-xl text-red-400 text-sm">
                <div class="flex items-center gap-2 mb-2">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span class="font-bold">Atención:</span>
                </div>
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('calificaciones.store') }}" method="POST" class="space-y-6">
            @csrf
            
            <div class="bg-[#1e1e2e] border border-white/10 rounded-2xl p-6 shadow-xl">
                <div class="grid grid-cols-1 gap-6">
                    
                    {{-- Selección de Alumno --}}
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-zinc-300">Alumno</label>
                        <select name="alumno_id" required class="w-full bg-black/20 border border-white/10 rounded-xl px-4 py-2.5 text-white outline-none focus:ring-2 focus:ring-emerald-500 transition">
                            <option value="">Selecciona un alumno</option>
                            @foreach($alumnos as $a)
                                <option value="{{ $a->id }}" {{ old('alumno_id') == $a->id ? 'selected' : '' }}>
                                    {{ $a->nombre }} {{ $a->apellido }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Selección de Materia --}}
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-zinc-300">Materia</label>
                        <select name="materia_id" required class="w-full bg-black/20 border border-white/10 rounded-xl px-4 py-2.5 text-white outline-none focus:ring-2 focus:ring-emerald-500 transition">
                            <option value="">Selecciona la materia</option>
                            @foreach($materias as $m)
                                <option value="{{ $m->id }}" {{ old('materia_id') == $m->id ? 'selected' : '' }}>
                                    {{ $m->nombre_materia }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Parciales --}}
                    <div class="pt-4">
                        <label class="text-sm font-medium text-zinc-300 mb-3 block">Calificaciones por Parcial (0 - 100)</label>
                        <div class="grid grid-cols-3 gap-4">
                            <div class="space-y-1">
                                <span class="text-[10px] text-gray-500 uppercase font-bold px-1">Parcial 1</span>
                                <input type="number" name="p1" value="{{ old('p1', 0) }}" min="0" max="100" step="0.1"
                                    class="w-full bg-black/20 border border-white/10 rounded-xl px-4 py-2.5 text-white text-center outline-none focus:ring-2 focus:ring-emerald-500 transition">
                            </div>
                            <div class="space-y-1">
                                <span class="text-[10px] text-gray-500 uppercase font-bold px-1">Parcial 2</span>
                                <input type="number" name="p2" value="{{ old('p2', 0) }}" min="0" max="100" step="0.1"
                                    class="w-full bg-black/20 border border-white/10 rounded-xl px-4 py-2.5 text-white text-center outline-none focus:ring-2 focus:ring-emerald-500 transition">
                            </div>
                            <div class="space-y-1">
                                <span class="text-[10px] text-gray-500 uppercase font-bold px-1">Parcial 3</span>
                                <input type="number" name="p3" value="{{ old('p3', 0) }}" min="0" max="100" step="0.1"
                                    class="w-full bg-black/20 border border-white/10 rounded-xl px-4 py-2.5 text-white text-center outline-none focus:ring-2 focus:ring-emerald-500 transition">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Botones de Acción --}}
                <div class="mt-8 pt-6 border-t border-white/5 flex flex-col sm:flex-row gap-3">
                    <button type="submit" class="flex-1 bg-emerald-600 hover:bg-emerald-500 text-white font-bold py-3 rounded-xl transition shadow-lg shadow-emerald-900/20">
                        Guardar Calificaciones
                    </button>
                    <a href="{{ route('calificaciones.index') }}" class="flex-1 bg-zinc-800 hover:bg-zinc-700 text-white text-center font-bold py-3 rounded-xl transition flex items-center justify-center">
                        Cancelar
                    </a>
                </div>
            </div>
        </form>
    </div>
</x-layouts::app>