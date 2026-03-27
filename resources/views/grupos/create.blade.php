<x-layouts::app :title="__('Nuevo Grupo')">
    <div class="p-6 max-w-2xl mx-auto space-y-6">
        {{-- Encabezado --}}
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-zinc-900 dark:text-white">Crear Nuevo Grupo</h1>
                <p class="text-sm text-zinc-500 dark:text-zinc-400">Configura un nuevo grupo para el ciclo escolar.</p>
            </div>
            <a href="{{ route('grupos.index') }}" class="text-sm font-medium text-zinc-500 hover:text-zinc-700 dark:hover:text-zinc-300">
                Cancelar
            </a>
        </div>

        {{-- Formulario --}}
        <div class="rounded-xl border border-zinc-200 bg-white p-6 shadow-sm dark:border-zinc-700 dark:bg-zinc-800">
            <form action="{{ route('grupos.store') }}" method="POST" class="space-y-4">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    {{-- Grado --}}
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-zinc-700 dark:text-zinc-300">Grado</label>
                        <select name="grado" required 
                            class="w-full rounded-lg border border-zinc-300 bg-white px-3 py-2 text-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 dark:border-zinc-600 dark:bg-zinc-900 dark:text-white outline-none">
                            @for ($i = 1; $i <= 6; $i++)
                                <option value="{{ $i }}" {{ old('grado') == $i ? 'selected' : '' }}>{{ $i }}° Grado</option>
                            @endfor
                        </select>
                    </div>

                    {{-- Nombre del Grupo (Letra/Identificador) --}}
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-zinc-700 dark:text-zinc-300">Nombre del Grupo / Sección</label>
                        {{-- Aplicamos límite de 20 caracteres por seguridad --}}
                        <input type="text" name="nombre_grupo" value="{{ old('nombre_grupo') }}" maxlength="20" required 
                            placeholder="Ej: A, B o 'Ingeniería'"
                            class="w-full rounded-lg border @error('nombre_grupo') border-red-500 @else border-zinc-300 @enderror bg-white px-3 py-2 text-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 dark:border-zinc-600 dark:bg-zinc-900 dark:text-white outline-none">
                        @error('nombre_grupo')
                            <p class="text-red-500 text-[10px] mt-1 font-medium italic">El nombre debe ser menor a 20 caracteres.</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    {{-- Turno --}}
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-zinc-700 dark:text-zinc-300">Turno</label>
                        <div class="grid grid-cols-2 gap-4">
                            <label class="flex items-center justify-center p-3 border rounded-lg cursor-pointer hover:bg-zinc-50 dark:hover:bg-zinc-700 border-zinc-200 dark:border-zinc-700 has-[:checked]:border-indigo-500 has-[:checked]:bg-indigo-50 dark:has-[:checked]:bg-indigo-900/20">
                                <input type="radio" name="turno" value="Matutino" class="hidden" {{ old('turno', 'Matutino') == 'Matutino' ? 'checked' : '' }}>
                                <span class="text-sm font-medium text-zinc-700 dark:text-zinc-300">Matutino</span>
                            </label>
                            <label class="flex items-center justify-center p-3 border rounded-lg cursor-pointer hover:bg-zinc-50 dark:hover:bg-zinc-700 border-zinc-200 dark:border-zinc-700 has-[:checked]:border-indigo-500 has-[:checked]:bg-indigo-50 dark:has-[:checked]:bg-indigo-900/20">
                                <input type="radio" name="turno" value="Vespertino" class="hidden" {{ old('turno') == 'Vespertino' ? 'checked' : '' }}>
                                <span class="text-sm font-medium text-zinc-700 dark:text-zinc-300">Vespertino</span>
                            </label>
                        </div>
                    </div>

                    {{-- NUEVO: Campo de Aula --}}
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-zinc-700 dark:text-zinc-300">Aula Asignada</label>
                        <input type="text" name="aula" value="{{ old('aula') }}" maxlength="20" required 
                            placeholder="Ej: D05, Edificio A"
                            class="w-full rounded-lg border @error('aula') border-red-500 @else border-zinc-300 @enderror bg-white px-3 py-2 text-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 dark:border-zinc-600 dark:bg-zinc-900 dark:text-white outline-none">
                        @error('aula')
                            <p class="text-red-500 text-[10px] mt-1 font-medium italic">El aula debe ser válida y menor a 20 caracteres.</p>
                        @enderror
                    </div>
                </div>

                {{-- Botón de Acción --}}
                <div class="pt-4">
                    <button type="submit" 
                        class="w-full inline-flex items-center justify-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg transition-all hover:scale-[1.02] shadow-md">
                        <flux:icon.plus class="w-4 h-4 mr-2" />
                        Crear Grupo
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layouts::app>