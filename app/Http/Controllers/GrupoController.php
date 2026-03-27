<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use App\Models\Alumno; 
use Illuminate\Http\Request;

class GrupoController extends Controller
{
    public function index()
    {
        $grupos = Grupo::all();
        
        $totalGrupos = $grupos->count();
        $activos = $grupos->count(); 
        $totalAlumnos = Alumno::count(); 

        return view('grupos.index', compact('grupos', 'totalGrupos', 'activos', 'totalAlumnos'));
    }

    public function create()
    {
        return view('grupos.create');
    }

public function store(Request $request)
{
    $request->validate([
        'nombre_grupo' => 'required|string|max:20',
        'grado' => 'required|integer|min:1|max:12',
        'turno' => 'required|in:Matutino,Vespertino',
        'aula' => 'required|string|max:20', // <--- AGREGADO AQUÍ
    ], [
        'nombre_grupo.max' => 'El nombre debe ser menor a 20 caracteres.',
        'aula.max' => 'El nombre del aula debe ser menor a 20 caracteres.', // <--- MENSAJE DE ERROR
    ]);

    // Asegúrate de que tu modelo reciba el campo aula
    \App\Models\Grupo::create([
        'nombre_grupo' => $request->nombre_grupo,
        'grado' => $request->grado,
        'turno' => $request->turno,
        'aula' => $request->aula, // <--- AGREGADO AQUÍ
    ]);

    return redirect()->route('grupos.index')->with('status', 'Grupo creado con éxito.');
}
// Método para mostrar el formulario de edición
    public function edit($id)
    {
        $grupo = Grupo::findOrFail($id);
        return view('grupos.edit', compact('grupo'));
    }

    // Método para guardar los cambios en la base de datos
    public function update(Request $request, $id)
    {
        $grupo = Grupo::findOrFail($id);

        $request->validate([
            'nombre_grupo' => 'required|string|max:10',
            'grado' => 'required|integer',
            'turno' => 'required|in:Matutino,Vespertino',
            'aula' => 'nullable|string|max:50',
        ]);

        $grupo->update($request->all());

        return redirect()->route('grupos.index')->with('success', 'Grupo actualizado correctamente');
    }
    public function destroy($id)
{
    $grupo = Grupo::findOrFail($id);
    $grupo->delete();

    return redirect()->route('grupos.index')->with('success', 'Grupo eliminado correctamente');
}
}