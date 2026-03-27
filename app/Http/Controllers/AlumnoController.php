<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumno;

class AlumnoController extends Controller
{
public function index()
{
    $alumnos = Alumno::all();
    return view('alumnos.index', compact('alumnos'));
} 

public function create()
{
    $grupos = \App\Models\Grupo::all();
    return view('alumnos.create', compact('grupos'));
}


public function store(Request $request)
{
    $request->validate([
        // Cambiamos max:100 por max:30 y agregamos mensajes personalizados
        'nombre' => 'required|string|max:30',
        'apellido' => 'required|string|max:30',
        'email' => 'required|email|unique:alumnos',
        'curp_matricula' => 'required|string|unique:alumnos',
    ], [
        // Mensajes personalizados
        'nombre.max' => 'El nombre debe ser un nombre válido menor a 30 caracteres.',
        'apellido.max' => 'El apellido debe ser un nombre válido menor a 30 caracteres.',
        'email.unique' => 'Este correo electrónico ya está registrado.',
        'curp_matricula.unique' => 'Esta matrícula o CURP ya existe en el sistema.',
    ]);

    \App\Models\Alumno::create([
        'nombre' => $request->nombre,
        'apellido' => $request->apellido,
        'email' => $request->email,
        'curp_matricula' => $request->curp_matricula,
        'estatus' => 'Activo', 
    ]);

    return redirect()->route('alumnos.index')->with('status', 'Alumno registrado con éxito.');
}
public function edit($id)
{
    $alumno = Alumno::findOrFail($id);
    $grupos = \App\Models\Grupo::all();
    return view('alumnos.edit', compact('alumno', 'grupos'));
}

public function update(Request $request, $id)
{
    $alumno = Alumno::findOrFail($id);
    
    $request->validate([
        // Aplicamos la misma restricción de 30 caracteres aquí
        'nombre' => 'required|string|max:30',
        'apellido' => 'required|string|max:30', 
        'curp_matricula' => 'required|string|unique:alumnos,curp_matricula,' . $id,
        'email' => 'required|email',
        'estatus' => 'required|in:Activo,Inactivo'
    ], [
        'nombre.max' => 'El nombre debe ser un nombre válido menor a 30 caracteres.',
        'apellido.max' => 'El apellido debe ser un nombre válido menor a 30 caracteres.',
    ]);

    $alumno->update($request->all());

    return redirect()->route('alumnos.index')->with('status', 'Alumno actualizado con éxito.');
}
/* final de update */

    public function destroy($id)
    {
        $alumno = Alumno::findOrFail($id);
        $alumno->delete();

        return redirect()->route('alumnos.index')->with('status', 'Alumno eliminado.');
    }
}