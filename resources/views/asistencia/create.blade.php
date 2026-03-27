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

        {{-- Configuración de la Sesión --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6 bg-[#1e1e2e] border border-white/10 p-4 rounded-2xl">
            <div>
                <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Fecha</label>
                <input type="date" name="fecha" value="{{ now()->format('Y-m-d') }}" class="w-full bg-black/20 border border-white/10 rounded-xl px-4 py-2 text-white outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Grupo</label>
                <select name="grupo_id" required class="w-full bg-black/20 border border-white/10 rounded-xl px-4 py-2 text-white outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Seleccionar Grupo</option>
                    @foreach($grupos as $g)
                        <option value="{{ $g->id }}">{{ $g->grado }}°{{ $g->nombre_grupo }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Materia</label>
                <select name="materia_id" required class="w-full bg-black/20 border border-white/10 rounded-xl px-4 py-2 text-white outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Seleccionar Materia</option>
                    @foreach($materias as $m)
                        <option value="{{ $m->id }}">{{ $m->nombre_materia }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        {{-- Lista de Alumnos --}}
        <div class="bg-[#1e1e2e] border border-white/10 rounded-2xl overflow-hidden shadow-xl">
            <table class="w-full text-sm text-left">
                <thead>
                    <tr class="border-b border-white/5 text-gray-400 text-xs uppercase tracking-widest">
                        <th class="px-6 py-4">Alumno</th>
                        <th class="px-6 py-4 text-center">Estatus de Asistencia</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/[0.03]">
                    @foreach($alumnos as $alumno)
                    <tr class="hover:bg-white/[0.01] transition-colors" id="row-{{ $alumno->id }}">
                        <td class="px-6 py-4">
                            <input type="hidden" name="asistencias[{{ $loop->index }}][alumno_id]" value="{{ $alumno->id }}">
                            <div class="flex flex-col">
                                <span class="text-white font-medium">{{ $alumno->nombre }} {{ $alumno->apellido }}</span>
                                <span class="text-[10px] text-gray-500">MATRÍCULA: {{ $alumno->matricula ?? 'S/N' }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex justify-center items-center gap-2">
                                {{-- Presente --}}
                                <label class="cursor-pointer group">
                                    <input type="radio" name="asistencias[{{ $loop->index }}][estatus]" value="Presente" checked class="hidden peer">
                                    <div class="px-3 py-1.5 rounded-lg border border-white/5 bg-white/5 text-gray-500 peer-checked:bg-emerald-500/20 peer-checked:text-emerald-400 peer-checked:border-emerald-500/30 transition-all text-[10px] font-bold uppercase">
                                        Presente
                                    </div>
                                </label>

                                {{-- Ausente --}}
                                <label class="cursor-pointer group">
                                    <input type="radio" name="asistencias[{{ $loop->index }}][estatus]" value="Ausente" class="hidden peer">
                                    <div class="px-3 py-1.5 rounded-lg border border-white/5 bg-white/5 text-gray-500 peer-checked:bg-red-500/20 peer-checked:text-red-400 peer-checked:border-red-500/30 transition-all text-[10px] font-bold uppercase">
                                        Ausente
                                    </div>
                                </label>

                                {{-- Retardo --}}
                                <label class="cursor-pointer group">
                                    <input type="radio" name="asistencias[{{ $loop->index }}][estatus]" value="Retardo" class="hidden peer">
                                    <div class="px-3 py-1.5 rounded-lg border border-white/5 bg-white/5 text-gray-500 peer-checked:bg-amber-500/20 peer-checked:text-amber-400 peer-checked:border-amber-500/30 transition-all text-[10px] font-bold uppercase">
                                        Retardo
                                    </div>
                                </label>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-6 flex justify-end">
            <button type="submit" class="bg-blue-600 hover:bg-blue-500 text-white font-bold py-3 px-8 rounded-xl transition shadow-lg shadow-blue-900/20">
                Guardar Asistencia
            </button>
        </div>
    </form>
</div>
</x-layouts::app>