<x-layouts::app :title="__('Reportes')">
<div class="flex flex-col gap-6 p-6">

    <div>
        <h1 class="text-2xl font-bold text-white">Reportes</h1>
        <p class="text-sm text-gray-400 mt-1">Visualiza estadísticas y métricas del sistema escolar.</p>
    </div>

    {{-- Stats principales --}}
    <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
        <div class="bg-[#1e1e2e] border border-white/10 rounded-xl p-4 flex items-center gap-4">
            <div class="bg-indigo-500/20 text-indigo-400 rounded-lg p-3">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197"/>
                </svg>
            </div>
            <div>
                <p class="text-xs text-gray-400">Total Alumnos</p>
                <p class="text-2xl font-bold text-white">{{ $totalAlumnos }}</p>
            </div>
        </div>
        <div class="bg-[#1e1e2e] border border-white/10 rounded-xl p-4 flex items-center gap-4">
            <div class="bg-violet-500/20 text-violet-400 rounded-lg p-3">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-5-5M9 20H4v-2a4 4 0 015-5m6-4a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
            </div>
            <div>
                <p class="text-xs text-gray-400">Total Docentes</p>
                <p class="text-2xl font-bold text-white">{{ $totalDocentes }}</p>
            </div>
        </div>
        <div class="bg-[#1e1e2e] border border-white/10 rounded-xl p-4 flex items-center gap-4">
            <div class="bg-emerald-500/20 text-emerald-400 rounded-lg p-3">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                </svg>
            </div>
            <div>
                <p class="text-xs text-gray-400">Promedio General</p>
                <p class="text-2xl font-bold text-white">{{ number_format($promedioGeneral, 1) }}</p>
            </div>
        </div>
        <div class="bg-[#1e1e2e] border border-white/10 rounded-xl p-4 flex items-center gap-4">
            <div class="bg-green-500/20 text-green-400 rounded-lg p-3">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
            </div>
            <div>
                <p class="text-xs text-gray-400">% Asistencia</p>
                <p class="text-2xl font-bold text-white">{{ $porcentajeAsistencia }}%</p>
            </div>
        </div>
    </div>

    {{-- Gráficas row --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
        <div class="bg-[#1e1e2e] border border-white/10 rounded-xl p-5">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <p class="text-white font-semibold text-sm">Asistencia Mensual</p>
                    <p class="text-gray-400 text-xs">Presentes vs Ausentes (4 Semanas)</p>
                </div>
                <span class="text-xs text-gray-500 bg-white/5 px-2 py-1 rounded-lg">{{ now()->format('M Y') }}</span>
            </div>
            <canvas id="asistenciaChart" height="200"></canvas>
        </div>

        <div class="bg-[#1e1e2e] border border-white/10 rounded-xl p-5">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <p class="text-white font-semibold text-sm">Distribución de Calificaciones</p>
                    <p class="text-gray-400 text-xs">Por rango académico</p>
                </div>
                <span class="text-xs text-gray-500 bg-white/5 px-2 py-1 rounded-lg">Actual</span>
            </div>
            <canvas id="calificacionesChart" height="200"></canvas>
        </div>
    </div>

    {{-- Reportes rápidos --}}
    <div>
        <p class="text-white font-semibold text-sm mb-3">Exportar Reportes</p>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
            {{-- Los enlaces están vacíos (#) a la espera de crear las funciones de PDF --}}
            <a href="#" class="bg-[#1e1e2e] border border-white/10 hover:border-indigo-500/40 rounded-xl p-4 flex items-center gap-3 transition group">
                <div class="bg-indigo-500/20 text-indigo-400 rounded-lg p-2.5 group-hover:bg-indigo-500/30 transition shrink-0">
                    <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197"/>
                    </svg>
                </div>
                <div class="min-w-0">
                    <p class="text-white text-sm font-medium">Reporte de Alumnos</p>
                    <p class="text-gray-400 text-xs">Listado completo en PDF</p>
                </div>
            </a>

            <a href="#" class="bg-[#1e1e2e] border border-white/10 hover:border-emerald-500/40 rounded-xl p-4 flex items-center gap-3 transition group">
                <div class="bg-emerald-500/20 text-emerald-400 rounded-lg p-2.5 group-hover:bg-emerald-500/30 transition shrink-0">
                    <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                    </svg>
                </div>
                <div class="min-w-0">
                    <p class="text-white text-sm font-medium">Reporte de Calificaciones</p>
                    <p class="text-gray-400 text-xs">Por grupo y materia</p>
                </div>
            </a>

            <a href="#" class="bg-[#1e1e2e] border border-white/10 hover:border-blue-500/40 rounded-xl p-4 flex items-center gap-3 transition group">
                <div class="bg-blue-500/20 text-blue-400 rounded-lg p-2.5 group-hover:bg-blue-500/30 transition shrink-0">
                    <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <div class="min-w-0">
                    <p class="text-white text-sm font-medium">Reporte de Asistencia</p>
                    <p class="text-gray-400 text-xs">Mensual por grupo</p>
                </div>
            </a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Configuración global para que Chart.js se vea bien en tema oscuro
    Chart.defaults.color = '#9ca3af';
    Chart.defaults.borderColor = 'rgba(255,255,255,0.05)';

    // Gráfica de Asistencia (Barras)
    new Chart(document.getElementById('asistenciaChart'), {
        type: 'bar',
        data: {
            labels: ['Semana 4', 'Semana 3', 'Semana 2', 'Semana Actual'],
            datasets: [
                {
                    label: 'Presentes',
                    data: @json($asistenciaData['presentes']),
                    backgroundColor: 'rgba(34,197,94,0.7)',
                    borderRadius: 6,
                },
                {
                    label: 'Ausentes',
                    data: @json($asistenciaData['ausentes']),
                    backgroundColor: 'rgba(239,68,68,0.7)',
                    borderRadius: 6,
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'top', labels: { boxWidth: 12, usePointStyle: true } }
            },
            scales: {
                y: { beginAtZero: true, grid: { color: 'rgba(255,255,255,0.05)' } },
                x: { grid: { display: false } }
            }
        }
    });

    // Gráfica de Calificaciones (Dona)
    new Chart(document.getElementById('calificacionesChart'), {
        type: 'doughnut',
        data: {
            labels: ['90-100', '80-89', '70-79', '60-69', 'Reprobado'],
            datasets: [{
                data: @json($distribucionCalificaciones),
                backgroundColor: [
                    'rgba(99,102,241,0.8)', // Indigo
                    'rgba(34,197,94,0.8)',  // Verde
                    'rgba(234,179,8,0.8)',  // Amarillo
                    'rgba(249,115,22,0.8)', // Naranja
                    'rgba(239,68,68,0.8)',  // Rojo
                ],
                borderWidth: 0,
                hoverOffset: 15
            }]
        },
        options: {
            responsive: true,
            cutout: '70%',
            plugins: {
                legend: { position: 'bottom', labels: { padding: 20, usePointStyle: true } }
            }
        }
    });
</script>
</x-layouts::app>