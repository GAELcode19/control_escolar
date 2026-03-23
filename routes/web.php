<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\DocenteController;
use App\Http\Controllers\MateriaController;
// redirect visitors to dashboard if they are logged in, otherwise show login page
Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    return redirect()->route('login');
})->name('home');

Route::get('dashboard', function () {
    // Aquí podrías cargar datos desde la base de datos, por ejemplo:
    // $totalAlumnos = \App\Models\Alumno::count();
    // $totalDocentes = \App\Models\Docente::count();
    // y pasarlos a la vista: return view('dashboard', compact('totalAlumnos', 'totalDocentes'));
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/alumnos', [AlumnoController::class, 'index'])->name('alumnos.index');
    Route::get('/docentes', [DocenteController::class, 'index'])->name('docentes.index');
    Route::get('/materias', [MateriaController::class, 'index'])->name('materias.index');
    Route::view('grupos', 'grupos.index')->name('grupos.index');
    Route::view('inscripciones', 'inscripciones.index')->name('inscripciones.index');
    Route::view('calificaciones', 'calificaciones.index')->name('calificaciones.index');
    Route::view('asistencia', 'asistencia.index')->name('asistencia.index');
    Route::view('reportes', 'reportes.index')->name('reportes.index');
    Route::view('configuracion', 'configuracion.index')->name('configuracion.index');
});

require __DIR__.'/settings.php';
