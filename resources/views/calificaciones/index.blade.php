<x-layouts::app :title="__('Calificaciones')">
<div class="flex flex-col gap-6 p-6">

    {{-- Encabezado --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-2xl font-bold text-white">Gestión de Calificaciones</h1>
            <p class="text-sm text-gray-400 mt-1">Administra los puntajes parciales y promedios finales.</p>
        </div>
        <a href="{{ route('calificaciones.create') }}" class="flex items-center gap-2 bg-emerald-600 hover:bg-emerald-500 transition text-white text-sm font-medium px-5 py-2.5 rounded-xl shadow-lg shadow-emerald-900/20">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Registrar Calificación
        </a>
    </div>

    {{-- Mensajes de Confirmación --}}
    @if (session('success'))
        <div class="p-4 bg-emerald-500/10 border border-emerald-500/20 rounded-xl text-emerald-400 text-sm flex items-center gap-3">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            {{ session('success') }}
        </div>
    @endif

    {{-- Estadísticas Dinámicas --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        {{-- Promedio --}}
        <div class="bg-[#1e1e2e] border border-white/10 rounded-2xl p-4 flex items-center gap-4">
            <div class="bg-blue-500/20 text-blue-400 rounded-xl p-3">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
            </div>
            <div>
                <p class="text-xs text-gray-400 uppercase font-bold tracking-wider">Promedio Gral</p>
                <p class="text-2xl font-bold text-white">{{ number_format($promedioGeneral, 1) }}</p>
            </div>
        </div>

        {{-- Aprobados --}}
        <div class="bg-[#1e1e2e] border border-white/10 rounded-2xl p-4 flex items-center gap-4">
            <div class="bg-emerald-500/20 text-emerald-400 rounded-xl p-3">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            </div>
            <div>
                <p class="text-xs text-gray-400 uppercase font-bold tracking-wider">Aprobados</p>
                <p class="text-2xl font-bold text-white">{{ $aprobados }}</p>
            </div>
        </div>

        {{-- Reprobados --}}
        <div class="bg-[#1e1e2e] border border-white/10 rounded-2xl p-4 flex items-center gap-4">
            <div class="bg-red-500/20 text-red-400 rounded-xl p-3">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </div>
            <div>
                <p class="text-xs text-gray-400 uppercase font-bold tracking-wider">Reprobados</p>
                <p class="text-2xl font-bold text-white">{{ $reprobados }}</p>
            </div>
        </div>

        {{-- Pendientes --}}
        <div class="bg-[#1e1e2e] border border-white/10 rounded-2xl p-4 flex items-center gap-4">
            <div class="bg-amber-500/20 text-amber-400 rounded-xl p-3">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <div>
                <p class="text-xs text-gray-400 uppercase font-bold tracking-wider">Pendientes</p>
                <p class="text-2xl font-bold text-white">{{ $pendientes }}</p>
            </div>
        </div>
    </div>

    {{-- Filtros --}}
    <div class="flex flex-wrap gap-3 items-center">
        <select class="bg-[#1e1e2e] border border-white/10 text-gray-300 text-sm rounded-xl px-4 py-2 outline-none focus:ring-2 focus:ring-emerald-500 transition">
            <option value="">Todos los Grupos</option>
            @foreach($grupos as $g)
                <option value="{{ $g->id }}">{{ $g->grado }}°{{ $g->nombre_grupo }}</option>
            @endforeach
        </select>
        
        <select class="bg-[#1e1e2e] border border-white/10 text-gray-300 text-sm rounded-xl px-4 py-2 outline-none focus:ring-2 focus:ring-emerald-500 transition">
            <option value="">Todas las Materias</option>
            @foreach($materias as $m)
                <option value="{{ $m->id }}">{{ $m->nombre_materia }}</option>
            @endforeach
        </select>
    </div>

    {{-- Tabla de Resultados --}}
    <div class="bg-[#1e1e2e] border border-white/10 rounded-2xl overflow-hidden shadow-xl">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead>
                    <tr class="border-b border-white/5 text-gray-400 text-xs uppercase tracking-widest font-black">
                        <th class="px-6 py-4">Alumno</th>
                        <th class="px-6 py-4">Materia</th>
                        <th class="px-6 py-4 text-center">P1</th>
                        <th class="px-6 py-4 text-center">P2</th>
                        <th class="px-6 py-4 text-center">P3</th>
                        <th class="px-6 py-4 text-center">Final</th>
                        <th class="px-6 py-4">Estatus</th>
                        <th class="px-6 py-4 text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/[0.03]">
                    @forelse($inscripciones as $inscripcion)
                    <tr class="text-gray-300 hover:bg-white/[0.02] transition-colors group">
                        <td class="px-6 py-4">
                            <div class="flex flex-col">
                                <span class="text-white font-semibold">{{ $inscripcion->alumno->nombre }} {{ $inscripcion->alumno->apellido }}</span>
                                <span class="text-[10px] text-gray-500">ID: #{{ $inscripcion->id }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-gray-400">
                            {{ $inscripcion->materia->nombre_materia }}
                        </td>
                        <td class="px-6 py-4 text-center font-mono text-xs">{{ $inscripcion->p1 ?? '0' }}</td>
                        <td class="px-6 py-4 text-center font-mono text-xs">{{ $inscripcion->p2 ?? '0' }}</td>
                        <td class="px-6 py-4 text-center font-mono text-xs">{{ $inscripcion->p3 ?? '0' }}</td>
                        <td class="px-6 py-4 text-center">
                            <span class="font-bold text-white bg-black/30 px-2 py-1 rounded">
                                {{ number_format($inscripcion->calificacion, 1) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-2.5 py-1 rounded-lg text-[10px] font-black uppercase tracking-tighter {{ $inscripcion->estatus == 'Aprobado' ? 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/20' : 'bg-red-500/10 text-red-400 border border-red-500/20' }}">
                                {{ $inscripcion->estatus }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex justify-end items-center gap-4">
                                <a href="{{ route('calificaciones.edit', $inscripcion->id) }}" class="text-zinc-400 hover:text-emerald-400 transition transform hover:scale-110">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                </a>
                                
                                <form action="{{ route('calificaciones.destroy', $inscripcion->id) }}" method="POST" onsubmit="return confirm('¿Deseas resetear las calificaciones de este alumno?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-zinc-400 hover:text-red-400 transition transform hover:scale-110">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="px-6 py-20 text-center">
                            <div class="flex flex-col items-center gap-3 text-gray-500">
                                <svg class="w-16 h-16 opacity-10" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                <p class="text-lg">No hay registros de calificaciones encontrados.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
</x-layouts::app>