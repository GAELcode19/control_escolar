<x-layouts::app :title="__('Nueva Materia')">
    <div class="p-6 max-w-2xl mx-auto space-y-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-zinc-900 dark:text-white">Crear Nueva Materia</h1>
                <p class="text-sm text-zinc-500 dark:text-zinc-400">Registra una nueva asignatura en el sistema.</p>
            </div>
            <a href="{{ route('materias.index') }}" class="text-sm font-medium text-zinc-500 hover:text-zinc-700">Cancelar</a>
        </div>

        <div class="rounded-xl border border-zinc-200 bg-white p-6 shadow-sm dark:border-zinc-700 dark:bg-zinc-800">
            <form action="{{ route('materias.store') }}" method="POST" class="space-y-4">
                @csrf
                
                {{-- Estatus por defecto (Oculto para que no truene la DB) --}}
                <input type="hidden" name="estatus" value="Activo">

                {{-- Nombre de la Materia --}}
                <div class="space-y-2">
                    <label class="text-sm font-medium text-zinc-700 dark:text-zinc-300">Nombre de la Materia</label>
                    <input type="text" name="nombre_materia" value="{{ old('nombre_materia') }}" 
                        maxlength="20" required 
                        class="w-full rounded-lg border @error('nombre_materia') border-red-500 @else border-zinc-300 @enderror bg-white px-3 py-2 text-sm dark:bg-zinc-900 dark:text-white focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none">
                    @error('nombre_materia')
                        <p class="text-red-500 text-[10px] mt-1 font-medium italic">El nombre debe ser un nombre válido menor a 30 caracteres.</p>
                    @enderror
                </div>

                {{-- Código / Clave de la Materia --}}
                <div class="space-y-2">
                    <label class="text-sm font-medium text-zinc-700 dark:text-zinc-300">Código / Clave</label>
                    <input type="text" name="codigo" value="{{ old('codigo') }}" 
                        maxlength="20" required 
                        class="w-full rounded-lg border @error('codigo') border-red-500 @else border-zinc-300 @enderror bg-white px-3 py-2 text-sm dark:bg-zinc-900 dark:text-white focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none">
                    @error('codigo')
                        <p class="text-red-500 text-[10px] mt-1 font-medium italic">La clave debe ser válida y menor a 30 caracteres.</p>
                    @enderror
                </div>

                {{-- Campo de Créditos --}}
                <div class="space-y-2">
                    <label class="text-sm font-medium text-zinc-700 dark:text-zinc-300">Créditos</label>
                    <input type="number" name="creditos" value="{{ old('creditos', 0) }}" min="0" required 
                        class="w-full rounded-lg border @error('creditos') border-red-500 @else border-zinc-300 @enderror bg-white px-3 py-2 text-sm dark:bg-zinc-900 dark:text-white focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none">
                    @error('creditos')
                        <p class="text-red-500 text-[10px] mt-1 font-medium italic">{{ $message }}</p>
                    @enderror
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg transition-all hover:scale-[1.02] shadow-md">
                        <flux:icon.plus class="w-4 h-4 mr-2" />
                        Guardar Materia
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layouts::app>