<x-layouts::app :title="__('Asistencia')">
<div class="flex flex-col gap-6 p-6">

    <div>
        <h1 class="text-2xl font-bold text-white">Asistencia</h1>
        <p class="text-sm text-gray-400 mt-1">Registra y consulta la asistencia diaria por grupo.</p>
    </div>

    {{-- Stats --}}
    <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
        <div class="bg-[#1e1e2e] border border-white/10 rounded-xl p-4 flex items-center gap-4">
            <div class="bg-blue-500/20 text-blue-400 rounded-lg p-3">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            </div>
            <div>
                <p class="text-xs text-gray-400">Hoy</p>
                <p class="text-2xl font-bold text-white">{{ now()->format('d/m/Y') }}</p>
            </div>
        </div>
        <div class="bg-[#1e1e2e] border border-white/10 rounded-xl p-4 flex items-center gap-4">
            <div class="bg-green-500/20 text-green-400 rounded-lg p-3">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div>
                <p class="text-xs text-gray-400">Presentes</p>
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
                <p class="text-xs text-gray-400">Ausentes</p>
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
                <p class="text-xs text-gray-400">Tardanzas</p>
                <p class="text-2xl font-bold text-white">0</p>
            </div>
        </div>
    </div>

    {{-- Toolbar --}}
    <div class="flex flex-wrap gap-3 items-center justify-between">
        <div class="flex flex-wrap gap-3">
            <input type="date" value="{{ now()->format('Y-m-d') }}" class="bg-[#1e1e2e] border border-white/10 text-gray-300 text-sm rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"/>
            <select class="bg-[#1e1e2e] border border-white/10 text-gray-300 text-sm rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">Todos los grupos</option>
            </select>
            <select class="bg-[#1e1e2e] border border-white/10 text-gray-300 text-sm rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">Todas las materias</option>
            </select>
        </div>
        <a href="#" class="flex items-center gap-2 bg-blue-600 hover:bg-blue-500 transition text-white text-sm font-medium px-4 py-2 rounded-lg">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Pasar Lista
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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <p class="text-sm">No hay registros de asistencia aún.</p>
                            <a href="#" class="text-blue-400 hover:underline text-xs">+ Pasar lista ahora</a>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

</div>
</x-layouts::app>