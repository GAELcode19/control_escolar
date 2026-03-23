<x-layouts::app :title="__('Dashboard')">
    <div class="space-y-6 p-4">
        
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
            @foreach(['Total Alumnos'=>'156','En Riesgo'=>'12','Pagos Vencidos'=>'8','Docentes'=>'24','Grupos Activos'=>'18','Promedio General'=>'8.3'] as $label=>$value)
                {{-- Aquí agregamos: transition-all, duration-300, hover:scale-105, hover:shadow-lg y cursor-pointer --}}
                <div class="rounded-lg border border-zinc-200 bg-white p-4 shadow-sm dark:border-zinc-700 dark:bg-zinc-800 transition-all duration-300 hover:scale-105 hover:shadow-lg hover:border-zinc-400 dark:hover:border-zinc-500 cursor-pointer">
                    <div class="text-xs font-medium text-zinc-500 dark:text-zinc-400">{{ $label }}</div>
                    <div class="mt-1 text-2xl font-semibold text-zinc-900 dark:text-zinc-100">{{ $value }}</div>
                </div>
            @endforeach
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
            <div class="rounded-lg border border-zinc-200 bg-white p-4 shadow-sm dark:border-zinc-700 dark:bg-zinc-800">
                <h2 class="text-lg font-semibold">Inscripciones por Ciclo Escolar</h2>
                <p class="text-sm text-zinc-500">Histórico de inscripciones</p>
                <div class="mt-4 h-64">
                    {{-- insert chart component or canvas here --}}
                </div>
            </div>
            <div class="rounded-lg border border-zinc-200 bg-white p-4 shadow-sm dark:border-zinc-700 dark:bg-zinc-800">
                <h2 class="text-lg font-semibold">Ingresos Mensuales</h2>
                <p class="text-sm text-zinc-500">Ciclo escolar 2024-2025</p>
                <div class="mt-4 h-64">
                    {{-- insert chart component or canvas here --}}
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
            <div class="rounded-lg border border-zinc-200 bg-white p-4 shadow-sm dark:border-zinc-700 dark:bg-zinc-800">
                {{-- risk students list placeholder --}}
            </div>
            <div class="rounded-lg border border-zinc-200 bg-white p-4 shadow-sm dark:border-zinc-700 dark:bg-zinc-800">
                {{-- overdue payments placeholder --}}
            </div>
            <div class="rounded-lg border border-zinc-200 bg-white p-4 shadow-sm dark:border-zinc-700 dark:bg-zinc-800">
                {{-- grade distribution pie chart placeholder --}}
            </div>
        </div>
        
    </div>
</x-layouts::app>