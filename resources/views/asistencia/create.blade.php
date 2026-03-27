<x-layouts::app :title="__('Pasar Lista')">
<div class="p-6 max-w-5xl mx-auto">
    
    <div class="mb-6">
        <a href="{{ route('asistencia.index') }}" class="text-zinc-500 hover:text-white text-sm flex items-center gap-2 mb-2 transition">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Volver al listado
        </a>
        <h1 class="text-2xl font-bold text-white">Registrar Asistencia</h1>
    </div>

    <form action="{{ route('asistencia.store') }}" method="POST">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6 bg-[#1e1e2e] border border-white/10 p-4 rounded-2xl">
            <div>
                <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Fecha</label>
                <input type="date" name="fecha" value="{{ now()->format('Y-m-d') }}" class="w-full bg-black/20 border border-white/5 rounded-xl px-4 py-2.5 text-white focus:outline-none">
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Grupo</label>
                <select name="grupo_id" id="grupo_select" required class="w-full bg-black/20 border border-white/5 rounded-xl px-4 py-2.5 text-white focus:outline-none">
                    <option value="">Seleccionar Grupo</option>
                    @foreach($grupos as $grupo)
                        <option value="{{ $grupo->id }}">{{ $grupo->grado }}° {{ $grupo->nombre_grupo }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Materia</label>
                <select name="materia_id" id="materia_select" required class="w-full bg-black/20 border border-white/5 rounded-xl px-4 py-2.5 text-white focus:outline-none">
                    <option value="">Seleccionar Materia</option>
                    @foreach($materias as $materia)
                        {{-- Filtro de materia por grupo --}}
                        <option value="{{ $materia->id }}" class="materia-option" data-grupo="{{ $materia->grupo_id }}">
                            {{ $materia->nombre_materia }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="bg-[#1e1e2e] border border-white/10 rounded-2xl overflow-hidden shadow-2xl">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-white/5 border-b border-white/5">
                        <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase">Alumno</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase text-right">Asistencia</th>
                    </tr>
                </thead>
                <tbody id="alumnos_body">
                    @foreach($alumnos as $alumno)
                    <tr class="alumno-row border-b border-white/5" data-grupo="{{ $alumno->grupo_id }}">
                        <td class="px-6 py-4">
                            <input type="hidden" name="asistencias[{{ $loop->index }}][alumno_id]" value="{{ $alumno->id }}">
                            <div class="flex items-center gap-3">
                                <div class="text-sm font-semibold text-white">{{ $alumno->nombre }} {{ $alumno->apellido }}</div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-2">
                                <label class="cursor-pointer">
                                    <input type="radio" name="asistencias[{{ $loop->index }}][estatus]" value="Presente" checked class="hidden peer">
                                    <div class="px-3 py-1 rounded-lg border border-white/5 peer-checked:bg-emerald-500/20 peer-checked:text-emerald-400 text-[10px] font-bold">PRESENTE</div>
                                </label>
                                <label class="cursor-pointer">
                                    <input type="radio" name="asistencias[{{ $loop->index }}][estatus]" value="Ausente" class="hidden peer">
                                    <div class="px-3 py-1 rounded-lg border border-white/5 peer-checked:bg-red-500/20 peer-checked:text-red-400 text-[10px] font-bold">AUSENTE</div>
                                </label>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-6 flex justify-end">
            <button type="submit" class="bg-blue-600 hover:bg-blue-500 text-white font-bold py-3 px-8 rounded-xl transition">
                Guardar Asistencia
            </button>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const grupoSelect = document.getElementById('grupo_select');
        const materiaSelect = document.getElementById('materia_select');
        const alumnoRows = document.querySelectorAll('.alumno-row');
        const materiaOptions = document.querySelectorAll('.materia-option');

        function filtrar() {
            const grupoId = grupoSelect.value;

            // Filtrar Alumnos
            alumnoRows.forEach(row => {
                row.style.display = (grupoId === "" || row.dataset.grupo === grupoId) ? "" : "none";
            });

            // Filtrar Materias
            materiaOptions.forEach(opt => {
                opt.style.display = (grupoId === "" || opt.dataset.grupo === grupoId) ? "" : "none";
            });

            // Resetear materia al cambiar grupo para evitar errores
            materiaSelect.value = "";
        }

        grupoSelect.addEventListener('change', filtrar);
        filtrar();
    });
</script>
</x-layouts::app>