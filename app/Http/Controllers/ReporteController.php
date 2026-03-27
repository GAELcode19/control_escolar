<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Docente;
use App\Models\Asistencia;
use App\Models\Inscripcion; // Usamos tu modelo real
use Illuminate\Http\Request;

class ReporteController extends Controller
{
    public function index()
    {
        // 1. Datos de Alumnos y Docentes
        $totalAlumnos = Alumno::count();
        $totalDocentes = Docente::count();
        
        // 2. Cálculo de Asistencia (Real de tu tabla asistencias)
        $totalAsistencias = Asistencia::count();
        $presentes = Asistencia::where('estatus', 'Presente')->count();
        $porcentajeAsistencia = $totalAsistencias > 0 ? round(($presentes / $totalAsistencias) * 100) : 0;

        // 3. Promedio General (Desde tu tabla inscripciones)
        $promedioGeneral = Inscripcion::where('calificacion', '>', 0)->avg('calificacion') ?? 0;

        // 4. Datos para Gráfica de Asistencia (4 semanas)
        $asistenciaData = [
            'presentes' => [
                Asistencia::where('estatus', 'Presente')->whereBetween('created_at', [now()->subDays(28), now()->subDays(21)])->count(),
                Asistencia::where('estatus', 'Presente')->whereBetween('created_at', [now()->subDays(21), now()->subDays(14)])->count(),
                Asistencia::where('estatus', 'Presente')->whereBetween('created_at', [now()->subDays(14), now()->subDays(7)])->count(),
                Asistencia::where('estatus', 'Presente')->whereBetween('created_at', [now()->subDays(7), now()])->count(),
            ],
            'ausentes' => [
                Asistencia::where('estatus', 'Ausente')->whereBetween('created_at', [now()->subDays(28), now()->subDays(21)])->count(),
                Asistencia::where('estatus', 'Ausente')->whereBetween('created_at', [now()->subDays(21), now()->subDays(14)])->count(),
                Asistencia::where('estatus', 'Ausente')->whereBetween('created_at', [now()->subDays(14), now()->subDays(7)])->count(),
                Asistencia::where('estatus', 'Ausente')->whereBetween('created_at', [now()->subDays(7), now()])->count(),
            ]
        ];

        // 5. Distribución de Calificaciones (Basado en tus rangos de 0-100)
        $distribucionCalificaciones = [
            Inscripcion::where('calificacion', '>=', 90)->count(),
            Inscripcion::whereBetween('calificacion', [80, 89.9])->count(),
            Inscripcion::whereBetween('calificacion', [70, 79.9])->count(),
            Inscripcion::whereBetween('calificacion', [60, 69.9])->count(),
            Inscripcion::where('calificacion', '<', 60)->where('calificacion', '>', 0)->count(),
        ];

        // Enviamos todas las variables requeridas por la vista
        return view('reportes.index', compact(
            'totalAlumnos', 
            'totalDocentes', 
            'promedioGeneral', 
            'porcentajeAsistencia',
            'asistenciaData',
            'distribucionCalificaciones'
        ));
    }
}