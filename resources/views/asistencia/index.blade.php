<x-layouts::app :title="__('Asistencia')">
<div class="flex flex-col gap-6 p-6">

    <div>
        <h1 class="text-2xl font-bold text-white">Control de Asistencia</h1>
        <p class="text-sm text-gray-400 mt-1">Registra y consulta la asistencia diaria por grupo y materia.</p>
    </div>

    {{-- Alertas de éxito --}}
    @if(session('success'))
        <div class="p-4 text-sm text-emerald-400 bg-emerald-500/10 border border-emerald-500/20 rounded-xl">
            {{ session('success') }}
        </div>
    @endif

    {{-- Stats Dinámicos --}}
    <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
        <div class="bg-[#1e1e2e] border border-white/10 rounded-xl p-4 flex items-center gap-4">
            <div class="bg-blue-500/20 text-blue-400 rounded-lg p-3">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            </div>
            <div>
                <p class="text-xs text-gray-400 font-medium">Fecha de Registro</p>
                <p class="text-lg font-bold text-white">{{ \Carbon\Carbon::parse($fecha)->format('d/m/Y') }}</p>
            </div>
        </div>

        <div class="bg-[#1e1e2e] border border-white/10 rounded-xl p-4 flex items-center gap-4">
            <div class="bg-emerald-500/20 text-emerald-400 rounded-lg p-3">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div>
                <p class="text-xs text-gray-400 font-medium">Presentes</p>
                <p class="text-2xl font-bold text-white">{{ $presentes }}</p>
            </div>
        </div>

        <div class="bg-[#1e1e2e] border border-white/10 rounded-xl p-4 flex items-center gap-4">
            <div class="bg-red-500/20 text-red-400 rounded-lg p-3">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div>
                <p class="text-xs text-gray-400 font-medium">Ausentes</p>
                <p class="text-2xl font-bold text-white">{{ $ausentes }}</p>
            </div>
        </div>

        <div class="bg-[#1e1e2e] border border-white/10 rounded-xl p-4 flex items-center gap-4">
            <div class="bg-amber-500/20 text-amber-400 rounded-lg p-3">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div>
                <p class="text-xs text-gray-400 font-medium">Tardanzas</p>
                <p class="text-2xl font-bold text-white">{{ $tardanzas }}</p>
            </div>
        </div>
    </div>

    {{-- Toolbar con Filtros --}}
    <form action="{{ route('asistencia.index') }}" method="GET" class="flex flex-wrap gap-3 items-center justify-between">
        <div class="flex flex-wrap gap-3">
            <input type="date" name="fecha" value="{{ $fecha }}" 
                class="bg-[#1e1e2e] border border-white/10 text-gray-300 text-sm rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                onchange="this.form.submit()">
            
            <select name="grupo_id" onchange="this.form.submit()" class="bg-[#1e1e2e] border border-white/10 text-gray-300 text-sm rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                <option value="">Todos los grupos</option>
                @foreach($grupos as $g)
                    <option value="{{ $g->id }}" {{ request('grupo_id') == $g->id ? 'selected' : '' }}>
                        {{ $g->grado }}°{{ $g->nombre_grupo }}
                    </option>
                @endforeach
            </select>

            <select name="materia_id" onchange="this.form.submit()" class="bg-[#1e1e2e] border border-white/10 text-gray-300 text-sm rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                <option value="">Todas las materias</option>
                @foreach($materias as $m)
                    <option value="{{ $m->id }}" {{ request('materia_id') == $m->id ? 'selected' : '' }}>
                        {{ $m->nombre_materia }}
                    </option>
                @endforeach
            </select>
        </div>

        <a href="{{ route('asistencia.create') }}" class="flex items-center gap-2 bg-blue-600 hover:bg-blue-500 transition text-white text-sm font-medium px-4 py-2.5 rounded-xl shadow-lg shadow-blue-900/20">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Pasar Lista
        </a>
    </form>

    {{-- Tabla de Asistencias --}}
    <div class="bg-[#1e1e2e] border border-white/10 rounded-xl overflow-hidden shadow-2xl">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead>
                    <tr class="border-b border-white/5 text-gray-400 text-xs uppercase tracking-widest">
                        <th class="px-6 py-4 font-black">Alumno</th>
                        <th class="px-6 py-4 font-black text-center">Materia</th>
                        <th class="px-6 py-4 font-black text-center">Fecha</th>
                        <th class="px-6 py-4 font-black text-center">Estatus</th>
                        <th class="px-6 py-4 font-black text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/[0.03]">
                    @forelse($asistencias as $asistencia)
                    <tr class="text-gray-300 hover:bg-white/[0.02] transition">
                        <td class="px-6 py-4">
                            <div class="flex flex-col">
                                <span class="text-white font-semibold">{{ $asistencia->alumno->nombre }} {{ $asistencia->alumno->apellido }}</span>
                                <span class="text-[10px] text-gray-500 uppercase tracking-tighter">Grupo: {{ $asistencia->alumno->grupo->grado ?? 'N/A' }}°{{ $asistencia->alumno->grupo->nombre_grupo ?? '' }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center text-zinc-400">
                            {{ $asistencia->materia->nombre_materia }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            {{ \Carbon\Carbon::parse($asistencia->fecha)->format('d/m/Y') }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            @php
                                $color = match($asistencia->estatus) {
                                    'Presente' => 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20',
                                    'Ausente' => 'bg-red-500/10 text-red-400 border-red-500/20',
                                    'Retardo' => 'bg-amber-500/10 text-amber-400 border-amber-500/20',
                                    'Justificado' => 'bg-blue-500/10 text-blue-400 border-blue-500/20',
                                    default => 'bg-zinc-500/10 text-zinc-400 border-zinc-500/20',
                                };
                            @endphp
                            <span class="px-2.5 py-1 rounded-lg text-[10px] font-black uppercase border {{ $color }}">
                                {{ $asistencia->estatus }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end items-center gap-2">
                                {{-- Editar --}}
                                <a href="{{ route('asistencia.edit', $asistencia->id) }}" class="p-2 text-zinc-500 hover:text-white hover:bg-white/5 rounded-lg transition-all">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                    </svg>
                                </a>

                                {{-- Eliminar --}}
                                <form action="{{ route('asistencia.destroy', $asistencia->id) }}" method="POST" onsubmit="return confirm('¿Eliminar este registro?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-zinc-500 hover:text-red-500 hover:bg-red-500/10 rounded-lg transition-all">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-20 text-center">
                            <div class="flex flex-col items-center gap-3 text-gray-500">
                                <svg class="w-16 h-16 opacity-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <p class="text-lg">No hay registros de asistencia para esta fecha.</p>
                                <a href="{{ route('asistencia.create') }}" class="text-blue-400 hover:text-blue-300 font-medium text-sm underline decoration-blue-500/30 underline-offset-4">
                                    + Registrar asistencia ahora
                                </a>
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