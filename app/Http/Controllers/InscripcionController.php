<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inscripcion;
use App\Models\Alumno;
use App\Models\Docente; 
use App\Models\Materia; 
use Illuminate\Support\Facades\Validator;

class InscripcionController extends Controller
{
    public function index()
    {
        // Traemos las inscripciones con sus relaciones
        $inscripciones = Inscripcion::with(['alumno', 'docente', 'materia'])->get();
        return view('inscripciones.index', compact('inscripciones'));
    }

    public function create()
    {
        // Traemos todos los datos necesarios para los selects
        $alumnos = Alumno::where('estatus', 'Activo')->get();
        $docentes = Docente::all();
        $materias = Materia::where('estatus', 'Activo')->get();
        
        return view('inscripciones.create', compact('alumnos', 'docentes', 'materias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'alumno_id' => 'required|exists:alumnos,id',
            'docente_id' => 'required|exists:docentes,id',
            'materia_id' => 'required|exists:materias,id',
            'periodo' => 'required|string|max:20', 
            'estatus' => 'required|string'
        ], [
            'alumno_id.required' => 'Debes seleccionar un alumno.',
            'docente_id.required' => 'Debes seleccionar un docente.',
            'materia_id.required' => 'Debes seleccionar una materia.',
            'periodo.max' => 'El periodo no puede tener más de 20 caracteres.',
        ]);

        // Evitar duplicados: Verificar si el alumno ya está en esta materia
        $existe = Inscripcion::where('alumno_id', $request->alumno_id)
                             ->where('materia_id', $request->materia_id)
                             ->where('periodo', $request->periodo)
                             ->first();

        if ($existe) {
            return redirect()->back()
                ->withErrors(['alumno_id' => 'Este alumno ya está inscrito en esta materia para este periodo.'])
                ->withInput();
        }

        // Guardamos todo mapeado exactamente a las columnas de tu DBeaver/PgAdmin
        Inscripcion::create([
            'alumno_id' => $request->alumno_id,
            'docente_id' => $request->docente_id,
            'materia_id' => $request->materia_id,
            'periodo' => $request->periodo,
            'p1' => 0, 
            'p2' => 0,
            'p3' => 0,
            'calificacion' => 0,
            'estatus' => $request->estatus, // Aquí viaja el 'Cursando'
        ]);

        return redirect()->route('inscripciones.index')->with('status', 'Inscripción realizada con éxito.');
    }

    // === PANTALLA PARA EDITAR ===
    public function edit($id)
    {
        $inscripcion = Inscripcion::findOrFail($id);
        
        // Traemos las listas para los selects para poder cambiarlos
        $alumnos = Alumno::where('estatus', 'Activo')->get();
        $docentes = Docente::all();
        $materias = Materia::where('estatus', 'Activo')->get();

        return view('inscripciones.edit', compact('inscripcion', 'alumnos', 'docentes', 'materias'));
    }

    // === LÓGICA PARA ACTUALIZAR EN LA BD ===
    public function update(Request $request, $id)
    {
        $inscripcion = Inscripcion::findOrFail($id);

        $request->validate([
            'alumno_id' => 'required|exists:alumnos,id',
            'docente_id' => 'required|exists:docentes,id',
            'materia_id' => 'required|exists:materias,id',
            'periodo' => 'required|string|max:20',
            // Validamos contra las opciones exactas de tu migración
            'estatus' => 'required|in:Cursando,Aprobado,Reprobado,Baja' 
        ], [
            'alumno_id.required' => 'Debes seleccionar un alumno.',
            'docente_id.required' => 'Debes seleccionar un docente.',
            'materia_id.required' => 'Debes seleccionar una materia.',
            'periodo.max' => 'El periodo no puede tener más de 20 caracteres.',
        ]);

        // Evitar duplicados (pero ignoramos la inscripción que estamos editando actualmente)
        $existe = Inscripcion::where('alumno_id', $request->alumno_id)
                             ->where('materia_id', $request->materia_id)
                             ->where('periodo', $request->periodo)
                             ->where('id', '!=', $id) // <-- Ignora a sí mismo para que deje guardar si no cambiaste el alumno
                             ->first();

        if ($existe) {
            return redirect()->back()
                ->withErrors(['alumno_id' => 'Este alumno ya está inscrito en esta materia para este periodo.'])
                ->withInput();
        }

        $inscripcion->update([
            'alumno_id' => $request->alumno_id,
            'docente_id' => $request->docente_id,
            'materia_id' => $request->materia_id,
            'periodo' => $request->periodo,
            'estatus' => $request->estatus,
        ]);

        return redirect()->route('inscripciones.index')->with('status', 'Inscripción actualizada con éxito.');
    }

    // === LÓGICA PARA ELIMINAR ===
    public function destroy($id)
    {
        $inscripcion = Inscripcion::findOrFail($id);
        $inscripcion->delete();

        return redirect()->route('inscripciones.index')->with('status', 'Inscripción eliminada del sistema.');
    }
}