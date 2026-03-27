<x-layouts::app :title="__('Nueva Inscripción')">
    <div class="p-6 max-w-2xl mx-auto space-y-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-zinc-900 dark:text-white">Registrar Inscripción</h1>
                <p class="text-sm text-zinc-500 dark:text-zinc-400">Asigna un alumno a una materia con su respectivo docente.</p>
            </div>
            <a href="{{ route('inscripciones.index') }}" class="text-sm font-medium text-zinc-500 hover:text-zinc-700">Cancelar</a>
        </div>

        <div class="rounded-xl border border-zinc-200 bg-white p-6 shadow-sm dark:border-zinc-700 dark:bg-zinc-800">
            <form action="{{ route('inscripciones.store') }}" method="POST" class="space-y-4">
                @csrf
                
                        <input type="hidden" name="estatus" value="Cursando">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    {{-- Selección de Alumno --}}
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-zinc-700 dark:text-zinc-300">Seleccionar Alumno</label>
                        <select name="alumno_id" required 
                            class="w-full rounded-lg border @error('alumno_id') border-red-500 @else border-zinc-300 @enderror bg-white px-3 py-2 text-sm dark:bg-zinc-900 dark:text-white focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none">
                            <option value="">-- Selecciona un Alumno --</option>
                            @foreach($alumnos as $alumno)
                                <option value="{{ $alumno->id }}" {{ old('alumno_id') == $alumno->id ? 'selected' : '' }}>
                                    {{ $alumno->matricula ?? $alumno->curp_matricula }} - {{ $alumno->nombre }} {{ $alumno->apellido }}
                                </option>
                            @endforeach
                        </select>
                        @error('alumno_id')
                            <p class="text-red-500 text-[10px] mt-1 font-medium italic">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Selección de Materia --}}
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-zinc-700 dark:text-zinc-300">Seleccionar Materia</label>
                        <select name="materia_id" required 
                            class="w-full rounded-lg border @error('materia_id') border-red-500 @else border-zinc-300 @enderror bg-white px-3 py-2 text-sm dark:bg-zinc-900 dark:text-white focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none">
                            <option value="">-- Selecciona una Materia --</option>
                            @foreach($materias as $materia)
                                <option value="{{ $materia->id }}" {{ old('materia_id') == $materia->id ? 'selected' : '' }}>
                                    {{ $materia->codigo_materia ?? $materia->codigo }} - {{ $materia->nombre_materia }}
                                </option>
                            @endforeach
                        </select>
                        @error('materia_id')
                            <p class="text-red-500 text-[10px] mt-1 font-medium italic">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    {{-- Selección de Docente --}}
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-zinc-700 dark:text-zinc-300">Asignar Docente</label>
                        <select name="docente_id" required 
                            class="w-full rounded-lg border @error('docente_id') border-red-500 @else border-zinc-300 @enderror bg-white px-3 py-2 text-sm dark:bg-zinc-900 dark:text-white focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none">
                            <option value="">-- Selecciona un Docente --</option>
                            @foreach($docentes as $docente)
                                <option value="{{ $docente->id }}" {{ old('docente_id') == $docente->id ? 'selected' : '' }}>
                                    {{ $docente->nombre }} {{ $docente->apellido }}
                                </option>
                            @endforeach
                        </select>
                        @error('docente_id')
                            <p class="text-red-500 text-[10px] mt-1 font-medium italic">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Periodo --}}
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-zinc-700 dark:text-zinc-300">Periodo</label>
                        <input type="text" name="periodo" value="{{ old('periodo', '2025-2026') }}" maxlength="20" required
                            placeholder="Ej: Ene-Jun 2026"
                            class="w-full rounded-lg border @error('periodo') border-red-500 @else border-zinc-300 @enderror bg-white px-3 py-2 text-sm dark:bg-zinc-900 dark:text-white focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none">
                        @error('periodo')
                            <p class="text-red-500 text-[10px] mt-1 font-medium italic">El periodo debe ser menor a 20 caracteres.</p>
                        @enderror
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg transition-all hover:scale-[1.02] shadow-md">
                        <flux:icon.plus class="w-4 h-4 mr-2" />
                        Guardar Inscripción
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layouts::app>