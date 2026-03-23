<x-layouts::app :title="__('Configuración')">
<div class="flex flex-col gap-6 p-6">

    <div>
        <h1 class="text-2xl font-bold text-white">Configuración</h1>
        <p class="text-sm text-gray-400 mt-1">Administra los ajustes generales del sistema escolar.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Sidebar de secciones --}}
        <div class="flex flex-col gap-2 lg:col-span-1">
            <button onclick="showSection('escuela')" id="btn-escuela" class="config-btn flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium text-white bg-white/10 transition text-left w-full">
                <span class="shrink-0 w-4 h-4 text-purple-400">
                    <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-2 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </span>
                Datos de la Escuela
            </button>
            <button onclick="showSection('ciclo')" id="btn-ciclo" class="config-btn flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium text-gray-400 hover:bg-white/5 hover:text-white transition text-left w-full">
                <span class="shrink-0 w-4 h-4 text-blue-400">
                    <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </span>
                Ciclo Escolar
            </button>
            <button onclick="showSection('calificaciones')" id="btn-calificaciones" class="config-btn flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium text-gray-400 hover:bg-white/5 hover:text-white transition text-left w-full">
                <span class="shrink-0 w-4 h-4 text-emerald-400">
                    <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                </span>
                Calificaciones
            </button>
            <button onclick="showSection('sistema')" id="btn-sistema" class="config-btn flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium text-gray-400 hover:bg-white/5 hover:text-white transition text-left w-full">
                <span class="shrink-0 w-4 h-4 text-orange-400">
                    <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </span>
                Sistema
            </button>
        </div>

        {{-- Contenido --}}
        <div class="lg:col-span-2 flex flex-col gap-4">

            {{-- Datos de la Escuela --}}
            <div id="section-escuela" class="config-section">
                <div class="bg-[#1e1e2e] border border-white/10 rounded-xl p-6 flex flex-col gap-4">
                    <p class="text-white font-semibold text-sm border-b border-white/10 pb-3">Datos de la Escuela</p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="flex flex-col gap-1">
                            <label class="text-xs text-gray-400">Nombre de la Escuela</label>
                            <input type="text" placeholder="Ej. Instituto Tecnológico..." class="bg-[#12121f] border border-white/10 text-white text-sm rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500 placeholder-gray-600"/>
                        </div>
                        <div class="flex flex-col gap-1">
                            <label class="text-xs text-gray-400">Clave del Centro de Trabajo (CCT)</label>
                            <input type="text" placeholder="Ej. 09DPR1234X" class="bg-[#12121f] border border-white/10 text-white text-sm rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500 placeholder-gray-600"/>
                        </div>
                        <div class="flex flex-col gap-1">
                            <label class="text-xs text-gray-400">Director(a)</label>
                            <input type="text" placeholder="Nombre completo" class="bg-[#12121f] border border-white/10 text-white text-sm rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500 placeholder-gray-600"/>
                        </div>
                        <div class="flex flex-col gap-1">
                            <label class="text-xs text-gray-400">Teléfono</label>
                            <input type="text" placeholder="55 0000 0000" class="bg-[#12121f] border border-white/10 text-white text-sm rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500 placeholder-gray-600"/>
                        </div>
                        <div class="sm:col-span-2 flex flex-col gap-1">
                            <label class="text-xs text-gray-400">Dirección</label>
                            <input type="text" placeholder="Calle, Colonia, Ciudad" class="bg-[#12121f] border border-white/10 text-white text-sm rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500 placeholder-gray-600"/>
                        </div>
                    </div>
                    <div class="flex justify-end pt-2">
                        <button class="bg-purple-600 hover:bg-purple-500 transition text-white text-sm font-medium px-5 py-2 rounded-lg">Guardar Cambios</button>
                    </div>
                </div>
            </div>

            {{-- Ciclo Escolar --}}
            <div id="section-ciclo" class="config-section hidden">
                <div class="bg-[#1e1e2e] border border-white/10 rounded-xl p-6 flex flex-col gap-4">
                    <p class="text-white font-semibold text-sm border-b border-white/10 pb-3">Ciclo Escolar</p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="flex flex-col gap-1">
                            <label class="text-xs text-gray-400">Ciclo Actual</label>
                            <input type="text" placeholder="Ej. 2024-2025" class="bg-[#12121f] border border-white/10 text-white text-sm rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 placeholder-gray-600"/>
                        </div>
                        <div class="flex flex-col gap-1">
                            <label class="text-xs text-gray-400">Número de Parciales</label>
                            <select class="bg-[#12121f] border border-white/10 text-gray-600 text-sm rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option>1</option>
                                <option>2</option>
                                <option selected>3</option>
                                <option>4</option>
                                <option>5</option>
                                <option>6</option>
                                <option>7</option>
                                <option>8</option>
                                <option>9</option>
                                <option>10</option>
                            </select>
                        </div>
                        <div class="flex flex-col gap-1">
                            <label class="text-xs text-gray-400">Fecha de Inicio</label>
                            <input type="date" class="bg-[#12121f] border border-white/10 text-gray-300 text-sm rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"/>
                        </div>
                        <div class="flex flex-col gap-1">
                            <label class="text-xs text-gray-400">Fecha de Fin</label>
                            <input type="date" class="bg-[#12121f] border border-white/10 text-gray-300 text-sm rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"/>
                        </div>
                    </div>
                    <div class="flex justify-end pt-2">
                        <button class="bg-blue-600 hover:bg-blue-500 transition text-white text-sm font-medium px-5 py-2 rounded-lg">Guardar Cambios</button>
                    </div>
                </div>
            </div>

            {{-- Calificaciones --}}
            <div id="section-calificaciones" class="config-section hidden">
                <div class="bg-[#1e1e2e] border border-white/10 rounded-xl p-6 flex flex-col gap-4">
                    <p class="text-white font-semibold text-sm border-b border-white/10 pb-3">Configuración de Calificaciones</p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="flex flex-col gap-1">
                            <label class="text-xs text-gray-400">Calificación Mínima Aprobatoria</label>
                            <input type="number" placeholder="Ej. 60" min="0" max="100" class="bg-[#12121f] border border-white/10 text-white text-sm rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-emerald-500 placeholder-gray-600"/>
                        </div>
                        <div class="flex flex-col gap-1">
                            <label class="text-xs text-gray-400">Calificación Máxima</label>
                            <input type="number" placeholder="Ej. 100" min="0" max="100" class="bg-[#12121f] border border-white/10 text-white text-sm rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-emerald-500 placeholder-gray-600"/>
                        </div>
                        <div class="flex flex-col gap-1">
                            <label class="text-xs text-gray-400">Escala de Calificación</label>
                            <select class="bg-[#12121f] border border-white/10 text-gray-600 text-sm rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-emerald-500">
                                <option>0 - 100</option>
                                <option>0 - 10</option>
                                <option>A - F</option>
                            </select>
                        </div>
                        <div class="flex flex-col gap-1">
                            <label class="text-xs text-gray-400">Decimales permitidos</label>
                            <select class="bg-[#12121f] border border-white/10 text-gray-600 text-sm rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-emerald-500">
                                <option>0</option>
                                <option selected>1</option>
                                <option>2</option>
                            </select>
                        </div>
                    </div>
                    <div class="flex justify-end pt-2">
                        <button class="bg-emerald-600 hover:bg-emerald-500 transition text-white text-sm font-medium px-5 py-2 rounded-lg">Guardar Cambios</button>
                    </div>
                </div>
            </div>

{{-- Sistema --}}
            <div id="section-sistema" class="config-section hidden">
                <div class="bg-[#1e1e2e] border border-white/10 rounded-xl p-6 flex flex-col gap-4">
                    <p class="text-white font-semibold text-sm border-b border-white/10 pb-3">Sistema</p>
                    <div class="flex flex-col gap-3">
                        <div class="flex items-center justify-between py-2 border-b border-white/5">
                            <div>
                                <p class="text-white text-sm">Modo Mantenimiento</p>
                                <p class="text-gray-500 text-xs">Desactiva el acceso al sistema temporalmente</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" class="sr-only peer" id="toggle1">
                                <div style="width:44px;height:24px;border-radius:9999px;background:#ffffff1a;position:relative;transition:background 0.2s;" class="toggle-track" data-for="toggle1">
                                    <div style="width:18px;height:18px;border-radius:9999px;background:white;position:absolute;top:3px;left:3px;transition:transform 0.2s;" class="toggle-thumb"></div>
                                </div>
                            </label>
                        </div>
                        <div class="flex items-center justify-between py-2 border-b border-white/5">
                            <div>
                                <p class="text-white text-sm">Notificaciones por Email</p>
                                <p class="text-gray-500 text-xs">Enviar alertas automáticas a docentes</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" checked class="sr-only peer" id="toggle2">
                                <div style="width:44px;height:24px;border-radius:9999px;background:#f97316;position:relative;transition:background 0.2s;" class="toggle-track" data-for="toggle2">
                                    <div style="width:18px;height:18px;border-radius:9999px;background:white;position:absolute;top:3px;left:3px;transition:transform 0.2s;transform:translateX(20px);" class="toggle-thumb"></div>
                                </div>
                            </label>
                        </div>
                        <div class="flex items-center justify-between py-2">
                            <div>
                                <p class="text-white text-sm">Registro de Actividad</p>
                                <p class="text-gray-500 text-xs">Guardar log de acciones del sistema</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" checked class="sr-only peer" id="toggle3">
                                <div style="width:44px;height:24px;border-radius:9999px;background:#f97316;position:relative;transition:background 0.2s;" class="toggle-track" data-for="toggle3">
                                    <div style="width:18px;height:18px;border-radius:9999px;background:white;position:absolute;top:3px;left:3px;transition:transform 0.2s;transform:translateX(20px);" class="toggle-thumb"></div>
                                </div>
                            </label>
                        </div>
                    </div>
                    <div class="flex justify-end pt-2">
                        <button class="bg-orange-600 hover:bg-orange-500 transition text-white text-sm font-medium px-5 py-2 rounded-lg">Guardar Cambios</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    function showSection(name) {
        document.querySelectorAll('.config-section').forEach(s => s.classList.add('hidden'));
        document.querySelectorAll('.config-btn').forEach(b => {
            b.classList.remove('bg-white/10', 'text-white');
            b.classList.add('text-gray-400');
        });
        document.getElementById('section-' + name).classList.remove('hidden');
        const btn = document.getElementById('btn-' + name);
        btn.classList.add('bg-white/10', 'text-white');
        btn.classList.remove('text-gray-400');
    }

    // Toggles
    document.querySelectorAll('.toggle-track').forEach(track => {
        const id = track.getAttribute('data-for');
        const checkbox = document.getElementById(id);
        const thumb = track.querySelector('.toggle-thumb');
        track.addEventListener('click', () => {
            checkbox.checked = !checkbox.checked;
            track.style.background = checkbox.checked ? '#f97316' : 'rgba(255,255,255,0.1)';
            thumb.style.transform = checkbox.checked ? 'translateX(20px)' : 'translateX(0)';
        });
    });
</script>

</x-layouts::app>