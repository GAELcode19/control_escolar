<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use App\Models\Materia;
use Illuminate\Support\Facades\Validator;

class MateriaController extends Controller
{
    public function index()
    {
        $materias = Materia::all();
        $totalMaterias = $materias->count();
        $activas = $materias->where('estatus', 'Activo')->count();
        $totalCreditos = $materias->sum('creditos');

        return view('materias.index', compact('materias', 'totalMaterias', 'activas', 'totalCreditos'));
    }

    public function create()
    {
        return view('materias.create');
    }

public function store(Request $request)
{
    $request->validate([
        // ¡CAMBIAMOS EL MAX A 20!
        'nombre_materia' => 'required|string|max:20',
        'codigo' => 'required|string|max:20|unique:materias,codigo_materia',
        'creditos' => 'required|integer|min:0',
        'estatus' => 'required|string'
    ], [
        'nombre_materia.max' => 'El nombre debe ser menor a 20 caracteres.',
        'codigo.max' => 'La clave debe ser menor a 20 caracteres.',
        'codigo.unique' => 'Este código de materia ya existe.',
    ]);

    \App\Models\Materia::create([
        'nombre_materia' => $request->nombre_materia,
        'codigo_materia' => $request->codigo, 
        'creditos' => $request->creditos,
        'estatus' => $request->estatus,
    ]);

    return redirect()->route('materias.index')->with('status', 'Materia creada con éxito.');
}

    public function edit($id)
    {
        $materia = Materia::findOrFail($id);
        return view('materias.edit', compact('materia'));
    }

    public function update(Request $request, $id)
    {
        $materia = Materia::findOrFail($id);
        
        $request->validate([
            'nombre_materia' => 'required|string|max:30',
            'codigo' => 'required|string|max:30|unique:materias,codigo_materia,' . $id,
            'creditos' => 'required|integer|min:1',
            'estatus' => 'required|in:Activo,Inactivo'
        ], [
            'nombre_materia.max' => 'El nombre debe ser un nombre válido menor a 30 caracteres.',
            'codigo.max' => 'La clave debe ser válida y menor a 30 caracteres.',
            'codigo.unique' => 'Este código ya está asignado a otra materia.',
        ]);

        // Actualizamos asignando el valor del input 'codigo' a la columna 'codigo_materia'
        $materia->update([
            'nombre_materia' => $request->nombre_materia,
            'codigo_materia' => $request->codigo,
            'creditos' => $request->creditos,
            'estatus' => $request->estatus,
        ]);

        return redirect()->route('materias.index')->with('status', 'Materia actualizada correctamente.');
    }

    public function destroy($id)
    {
        $materia = Materia::findOrFail($id);
        $materia->delete();

        return redirect()->route('materias.index')->with('status', 'Materia eliminada del sistema.');
    }
}