<?php

namespace App\Http\Controllers;

use App\Models\Inscripcion;
use App\Models\Grupo;
use App\Models\Materia;
use Illuminate\Http\Request;

class CalificacionController extends Controller
{
    public function index()
    {
        $inscripciones = Inscripcion::with(['alumno', 'materia'])->get();
        
        $promedioGeneral = $inscripciones->avg('calificacion') ?? 0;
        $aprobados = $inscripciones->where('calificacion', '>=', 70)->count();
        $reprobados = $inscripciones->where('calificacion', '<', 70)->where('calificacion', '>', 0)->count();
        $pendientes = $inscripciones->where('calificacion', 0)->count();

        $grupos = Grupo::all();
        $materias = Materia::all();

        return view('calificaciones.index', compact(
            'inscripciones', 
            'promedioGeneral', 
            'aprobados', 
            'reprobados', 
            'pendientes', 
            'grupos', 
            'materias'
        ));
    }
    public function create()
{
   
    $alumnos = \App\Models\Alumno::where('estatus', 'Activo')->get();
    $materias = \App\Models\Materia::all();
    $grupos = \App\Models\Grupo::all();

    return view('calificaciones.create', compact('alumnos', 'materias', 'grupos'));
}

public function store(Request $request)
{
    $request->validate([
        'alumno_id' => 'required|exists:alumnos,id',
        'materia_id' => 'required|exists:materias,id',
        'p1' => 'nullable|numeric|min:0|max:100',
        'p2' => 'nullable|numeric|min:0|max:100',
        'p3' => 'nullable|numeric|min:0|max:100',
    ]);

    // Buscamos si el alumno está inscrito en esa materia
    $inscripcion = \App\Models\Inscripcion::where('alumno_id', $request->alumno_id)
        ->where('materia_id', $request->materia_id)
        ->first();

    if (!$inscripcion) {
        return back()->withErrors(['materia_id' => 'Error: Este alumno no está inscrito en esta materia. Primero debes inscribirlo en el módulo de Inscripciones.'])->withInput();
    }

    $p1 = $request->p1 ?? 0;
    $p2 = $request->p2 ?? 0;
    $p3 = $request->p3 ?? 0;
    $promedio = ($p1 + $p2 + $p3) / 3;

    $inscripcion->update([
        'p1' => $p1,
        'p2' => $p2,
        'p3' => $p3,
        'calificacion' => $promedio,
        'estatus' => $promedio >= 70 ? 'Aprobado' : 'Reprobado'
    ]);

    return redirect()->route('calificaciones.index')->with('success', 'Calificación actualizada correctamente.');
}
public function edit($id)
{
    // Buscamos la inscripción por su ID
    $inscripcion = Inscripcion::with(['alumno', 'materia'])->findOrFail($id);
    
    return view('calificaciones.edit', compact('inscripcion'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'p1' => 'nullable|numeric|min:0|max:100',
        'p2' => 'nullable|numeric|min:0|max:100',
        'p3' => 'nullable|numeric|min:0|max:100',
    ]);

    $inscripcion = Inscripcion::findOrFail($id);
    
    $p1 = $request->p1 ?? 0;
    $p2 = $request->p2 ?? 0;
    $p3 = $request->p3 ?? 0;
    $promedio = ($p1 + $p2 + $p3) / 3;

    $inscripcion->update([
        'p1' => $p1,
        'p2' => $p2,
        'p3' => $p3,
        'calificacion' => $promedio,
        'estatus' => $promedio >= 70 ? 'Aprobado' : 'Reprobado'
    ]);

    return redirect()->route('calificaciones.index')->with('success', 'Calificación actualizada correctamente');
}
// === LÓGICA PARA "BORRAR" (RESETEAR) UNA CALIFICACIÓN ===
    public function destroy($id)
    {

        $inscripcion = Inscripcion::findOrFail($id);

        $inscripcion->update([
            'p1' => 0,
            'p2' => 0,
            'p3' => 0,
            'calificacion' => 0,
            'estatus' => 'Cursando' // Regresa a cursando porque ya no tiene calificación final
        ]);

        return redirect()->route('calificaciones.index')->with('status', 'Calificación eliminada (reseteada a 0) correctamente.');
    }
}