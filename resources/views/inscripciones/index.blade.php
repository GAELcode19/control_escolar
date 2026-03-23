<x-layouts::app :title="__('Inscripciones')">
<div class="flex flex-col gap-6 p-6">

    {{-- Header --}}
    <div>
        <h1 class="text-2xl font-bold text-white">Inscripciones</h1>
        <p class="text-sm text-gray-400 mt-1">Gestiona la inscripción de alumnos a grupos y materias.</p>
    </div>

    {{-- Stats --}}
    <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
        <div class="bg-[#1e1e2e] border border-white/10 rounded-xl p-4 flex items-center gap-4">
            <div class="bg-cyan-500/20 text-cyan-400 rounded-lg p-3">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
            </div>
            <div>
                <p class="text-xs text-gray-400">Total</p>
                <p class="text-2xl font-bold text-white">0</p>
            </div>
        </div>
        <div class="bg-[#1e1e2e] border border-white/10 rounded-xl p-4 flex items-center gap-4">
            <div class="bg-green-500/20 text-green-400 rounded-lg p-3">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div>
                <p class="text-xs text-gray-400">Activas</p>
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
        <div class="bg-[#1e1e2e] border border-white/10 rounded-xl p-4 flex items-center gap-4">
            <div class="bg-red-500/20 text-red-400 rounded-lg p-3">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div>
                <p class="text-xs text-gray-400">Canceladas</p>
                <p class="text-2xl font-bold text-white">0</p>
            </div>
        </div>
    </div>

    {{-- Toolbar --}}
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3">
        <div class="relative w-full sm:w-72">
            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 11A6 6 0 105 11a6 6 0 0012 0z"/>
            </svg>
            <input type="text" placeholder="Buscar alumno o grupo..." class="w-full bg-[#1e1e2e] border border-white/10 text-white text-sm rounded-lg pl-9 pr-4 py-2 focus:outline-none focus:ring-2 focus:ring-cyan-500 placeholder-gray-500"/>
        </div>
        <a href="#" class="flex items-center gap-2 bg-cyan-600 hover:bg-cyan-500 transition text-white text-sm font-medium px-4 py-2 rounded-lg">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Nueva Inscripción
        </a>
    </div>

    {{-- Tabla --}}
    <div class="bg-[#1e1e2e] border border-white/10 rounded-xl overflow-hidden">
        <table class="w-full text-sm text-left">
            <thead>
                <tr class="border-b border-white/10 text-gray-400 text-xs uppercase tracking-wider">
                    <th class="px-6 py-3">Alumno</th>
                    <th class="px-6 py-3">Grupo</th>
                    <th class="px-6 py-3">Materia</th>
                    <th class="px-6 py-3">Fecha</th>
                    <th class="px-6 py-3">Estatus</th>
                    <th class="px-6 py-3 text-right">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
                <tr>
                    <td colspan="6" class="px-6 py-16 text-center">
                        <div class="flex flex-col items-center gap-3 text-gray-500">
                            <svg class="w-12 h-12 opacity-30" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                            <p class="text-sm">No hay inscripciones registradas aún.</p>
                            <a href="#" class="text-cyan-400 hover:underline text-xs">+ Registrar la primera</a>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

</div>
</x-layouts::app>