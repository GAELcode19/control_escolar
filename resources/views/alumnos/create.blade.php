<x-layouts::app :title="__('Nuevo Alumno')">
    <div class="p-6 max-w-2xl mx-auto space-y-6">
        {{-- Encabezado --}}
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-zinc-900 dark:text-white">Registrar Nuevo Alumno</h1>
                <p class="text-sm text-zinc-500 dark:text-zinc-400">Completa la información para dar de alta al estudiante.</p>
            </div>
            <a href="{{ route('alumnos.index') }}" class="text-sm font-medium text-zinc-500 hover:text-zinc-700 dark:hover:text-zinc-300">
                Cancelar
            </a>
        </div>

        {{-- Formulario --}}
        <div class="rounded-xl border border-zinc-200 bg-white p-6 shadow-sm dark:border-zinc-700 dark:bg-zinc-800">
            <form action="{{ route('alumnos.store') }}" method="POST" class="space-y-4">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    {{-- Nombre --}}
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-zinc-700 dark:text-zinc-300">Nombre(s)</label>
                        {{-- Se agregó maxlength="30" y la clase de error --}}
                        <input type="text" name="nombre" value="{{ old('nombre') }}" maxlength="30" required 
                            class="w-full rounded-lg border @error('nombre') border-red-500 @else border-zinc-300 @enderror bg-white px-3 py-2 text-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 dark:border-zinc-600 dark:bg-zinc-900 dark:text-white">
                        @error('nombre')
                            <p class="text-red-500 text-[10px] mt-1 font-medium italic">Debe ser un nombre válido menor a 30 caracteres.</p>
                        @enderror
                    </div>

                    {{-- Apellido --}}
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-zinc-700 dark:text-zinc-300">Apellidos</label>
                        {{-- Se agregó maxlength="30" y la clase de error --}}
                        <input type="text" name="apellido" value="{{ old('apellido') }}" maxlength="30" required 
                            class="w-full rounded-lg border @error('apellido') border-red-500 @else border-zinc-300 @enderror bg-white px-3 py-2 text-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 dark:border-zinc-600 dark:bg-zinc-900 dark:text-white">
                        @error('apellido')
                            <p class="text-red-500 text-[10px] mt-1 font-medium italic">Debe ser un nombre válido menor a 30 caracteres.</p>
                        @enderror
                    </div>
                </div>

                {{-- Email --}}
                <div class="space-y-2">
                    <label class="text-sm font-medium text-zinc-700 dark:text-zinc-300">Correo Electrónico</label>
                    <input type="email" name="email" value="{{ old('email') }}" required 
                        class="w-full rounded-lg border @error('email') border-red-500 @else border-zinc-300 @enderror bg-white px-3 py-2 text-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 dark:border-zinc-600 dark:bg-zinc-900 dark:text-white">
                    @error('email')
                        <p class="text-red-500 text-[10px] mt-1 font-medium italic">{{ $message }}</p>
                    @enderror
                </div>

                {{-- CURP / Matrícula --}}
                <div class="space-y-2">
                    <label class="text-sm font-medium text-zinc-700 dark:text-zinc-300">CURP / Matrícula</label>
                    <input type="text" name="curp_matricula" value="{{ old('curp_matricula') }}" required
                        class="w-full rounded-lg border @error('curp_matricula') border-red-500 @else border-zinc-300 @enderror bg-white px-3 py-2 text-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 dark:border-zinc-600 dark:bg-zinc-900 dark:text-white">
                    @error('curp_matricula')
                        <p class="text-red-500 text-[10px] mt-1 font-medium italic">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Grupo Asignado --}}
                <div class="space-y-2">
                    <label class="text-sm font-medium text-zinc-700 dark:text-zinc-300">Grupo</label>
                    <select name="grupo_id" required
                        class="w-full rounded-lg border @error('grupo_id') border-red-500 @else border-zinc-300 @enderror bg-white px-3 py-2 text-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 dark:border-zinc-600 dark:bg-zinc-900 dark:text-white">
                        <option value="">Selecciona un grupo</option>
                        @foreach($grupos as $grupo)
                            <option value="{{ $grupo->id }}" {{ old('grupo_id') == $grupo->id ? 'selected' : '' }}>
                                {{ $grupo->grado }}°{{ $grupo->nombre_grupo }} - {{ $grupo->turno }}
                            </option>
                        @endforeach
                    </select>
                    @error('grupo_id')
                        <p class="text-red-500 text-[10px] mt-1 font-medium italic">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Botón de Acción --}}
                <div class="pt-4">
                    <button type="submit" 
                        class="w-full inline-flex items-center justify-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg transition-all hover:scale-[1.02] active:scale-95 shadow-md">
                        <flux:icon.plus class="w-4 h-4 mr-2" />
                        Guardar Registro
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layouts::app>