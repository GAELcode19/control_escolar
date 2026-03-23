<?php

namespace App\Http\Controllers;

use App\Models\Docente;
use Illuminate\Http\Request;

class DocenteController extends Controller
{
    public function index()
    {
        $docentes = Docente::all();
        $totalDocentes = $docentes->count();
        $activos = $docentes->where('estatus', 'Activo')->count();
        $inactivos = $docentes->where('estatus', 'Inactivo')->count();

        return view('docentes.index', compact('docentes', 'totalDocentes', 'activos', 'inactivos'));
    }
}