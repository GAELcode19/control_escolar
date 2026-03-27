<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use App\Models\Grupo;
use App\Models\Materia;
use App\Models\Alumno; // No olvides importar el modelo Alumno
use Illuminate\Http\Request;

class AsistenciaController extends Controller
{
    public function index(Request $request)
{
    $fecha = $request->fecha ?? now()->format('Y-m-d');
    
    $query = Asistencia::with(['alumno', 'materia'])
        ->whereDate('fecha', $fecha);

    if ($request->filled('materia_id')) {
        $query->where('materia_id', $request->materia_id);
    }

    if ($request->filled('grupo_id')) {
        $query->whereHas('alumno', function($q) use ($request) {
            $q->where('alumnos.grupo_id', $request->grupo_id);
        });
    }

    $asistencias = $query->get();

    $presentes = $asistencias->where('estatus', 'Presente')->count();
    $ausentes = $asistencias->where('estatus', 'Ausente')->count();
    $tardanzas = $asistencias->where('estatus', 'Retardo')->count();

    $grupos = Grupo::all();
    $materias = Materia::all();

    return view('asistencia.index', compact(
        'asistencias', 'presentes', 'ausentes', 'tardanzas', 'grupos', 'materias', 'fecha'
    ));
}

    public function create()
    {
        $grupos = Grupo::all();
        $materias = Materia::all();
        $alumnos = Alumno::where('estatus', 'Activo')->get(); 

        return view('asistencia.create', compact('grupos', 'materias', 'alumnos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'fecha' => 'required|date',
            'materia_id' => 'required',
            'asistencias' => 'required|array',
        ]);

        foreach ($request->asistencias as $data) {
            Asistencia::updateOrCreate(
                [
                    'alumno_id' => $data['alumno_id'],
                    'materia_id' => $request->materia_id,
                    'fecha' => $request->fecha,
                ],
                [
                    'estatus' => $data['estatus'],
                ]
            );
        }

        return redirect()->route('asistencia.index')->with('success', 'Asistencia registrada correctamente');
    }
    // Editar una asistencia individual
public function edit(Asistencia $asistencia) 
{
    // Cargamos la relación explícitamente para evitar el error de "null" en la vista
    $asistencia->load('alumno'); 

    $grupos = Grupo::all();
    $materias = Materia::all();
    
    return view('asistencia.edit', compact('asistencia', 'grupos', 'materias'));
}

// Actualizar la asistencia
public function update(Request $request, Asistencia $asistencia)
{
    $request->validate([
        'estatus' => 'required|in:Presente,Ausente,Retardo,Justificado',
    ]);

    $asistencia->update($request->only('estatus', 'observaciones'));

    return redirect()->route('asistencia.index')->with('success', 'Registro actualizado correctamente');
}

// Eliminar un registro de asistencia
public function destroy(Asistencia $asistencia)
{
    // El método delete() debe ejecutarse sobre la instancia recibida
    $asistencia->delete(); 
    
    return redirect()->route('asistencia.index')->with('success', 'Registro eliminado correctamente');
}
}