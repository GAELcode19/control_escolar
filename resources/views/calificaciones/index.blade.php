<x-layouts::app :title="__('Calificaciones')">
<div class="flex flex-col gap-6 p-6">

    <div>
        <h1 class="text-2xl font-bold text-white">Calificaciones</h1>
        <p class="text-sm text-gray-400 mt-1">Consulta y registra las calificaciones por materia y grupo.</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
        <div class="bg-[#1e1e2e] border border-white/10 rounded-xl p-4 flex items-center gap-4">
            <div class="bg-emerald-500/20 text-emerald-400 rounded-lg p-3">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                </svg>
            </div>
            <div>
                <p class="text-xs text-gray-400">Promedio General</p>
                <p class="text-2xl font-bold text-white">0.0</p>
            </div>
        </div>
        <div class="bg-[#1e1e2e] border border-white/10 rounded-xl p-4 flex items-center gap-4">
            <div class="bg-green-500/20 text-green-400 rounded-lg p-3">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div>
                <p class="text-xs text-gray-400">Aprobados</p>
                <p class="text-2xl font-bold text-white">0</p>
            </div>
        </div>
        <div class="bg-[#1e1e2e] border border-white/10 rounded-xl p-4 flex items-center gap-4">
            <div class="bg-red-500/20 text-red-400 rounded-lg p-3">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div>
                <p class="text-xs text-gray-400">Reprobados</p>
                <p class="text-2xl font-bold text-white">0</p>
            </div>
        </div>
        <div class="bg-[#1e1e2e] border border-white/10 rounded-xl p-4 flex items-center gap-4">
            <div class="bg-yellow-500/20 text-yellow-400 rounded-lg p-3">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div>
                <p class="text-xs text-gray-400">Pendientes</p>
                <p class="text-2xl font-bold text-white">0</p>
            </div>
        </div>
    </div>

    <div class="flex flex-wrap gap-3">
        <select class="bg-[#1e1e2e] border border-white/10 text-gray-300 text-sm rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-emerald-500">
            <option value="">Todos los grupos</option>
        </select>
        <select class="bg-[#1e1e2e] border border-white/10 text-gray-300 text-sm rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-emerald-500">
            <option value="">Todas las materias</option>
        </select>
        <select class="bg-[#1e1e2e] border border-white/10 text-gray-300 text-sm rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-emerald-500">
            <option value="">Todos los periodos</option>
        </select>
        <a href="#" class="flex items-center gap-2 bg-emerald-600 hover:bg-emerald-500 transition text-white text-sm font-medium px-4 py-2 rounded-lg ml-auto">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Registrar Calificación
        </a>
    </div>

    <div class="bg-[#1e1e2e] border border-white/10 rounded-xl overflow-hidden">
        <table class="w-full text-sm text-left">
            <thead>
                <tr class="border-b border-white/10 text-gray-400 text-xs uppercase tracking-wider">
                    <th class="px-6 py-3">Alumno</th>
                    <th class="px-6 py-3">Materia</th>
                    <th class="px-6 py-3">Grupo</th>
                    <th class="px-6 py-3">Parcial 1</th>
                    <th class="px-6 py-3">Parcial 2</th>
                    <th class="px-6 py-3">Parcial 3</th>
                    <th class="px-6 py-3">Promedio</th>
                    <th class="px-6 py-3 text-right">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
                <tr>
                    <td colspan="8" class="px-6 py-16 text-center">
                        <div class="flex flex-col items-center gap-3 text-gray-500">
                            <svg class="w-12 h-12 opacity-30" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                            </svg>
                            <p class="text-sm">No hay calificaciones registradas aún.</p>
                            <a href="#" class="text-emerald-400 hover:underline text-xs">+ Registrar la primera</a>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

</div>
</x-layouts::app>