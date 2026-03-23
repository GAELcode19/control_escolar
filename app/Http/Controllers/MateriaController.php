<?php

namespace App\Http\Controllers;

use App\Models\Materia;

class MateriaController extends Controller
{
    public function index()
    {
        $materias = Materia::all();
        $totalMaterias = $materias->count();
        $activas = $materias->where('estatus', 'Activa')->count();
        $horasTotales = $materias->sum('horas_semana');

        return view('materias.index', compact('materias', 'totalMaterias', 'activas', 'horasTotales'));
    }
}