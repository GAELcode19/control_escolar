<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AlumnoController,
    DocenteController,
    MateriaController,
    InscripcionController,
    GrupoController,
    CalificacionController,
    AsistenciaController,
    ReporteController
};

Route::get('/', function () {
    return auth()->check() ? redirect()->route('dashboard') : redirect()->route('login');
})->name('home');

Route::get('dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    
    
    Route::resource('inscripciones', InscripcionController::class);
    Route::resource('grupos', GrupoController::class);
    Route::resource('alumnos', AlumnoController::class);
    Route::resource('docentes', DocenteController::class);
    Route::resource('materias', MateriaController::class);

    
    Route::prefix('calificaciones')->name('calificaciones.')->group(function () {
        Route::get('/', [CalificacionController::class, 'index'])->name('index');
        Route::get('/create', [CalificacionController::class, 'create'])->name('create');
        Route::post('/', [CalificacionController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [CalificacionController::class, 'edit'])->name('edit');
        Route::put('/{id}', [CalificacionController::class, 'update'])->name('update');
        Route::delete('/{id}', [CalificacionController::class, 'destroy'])->name('destroy');
    });

  
        Route::resource('asistencia', AsistenciaController::class)->parameters([
            'asistencia' => 'asistencia'
        ]);

        Route::get('/reportes', [ReporteController::class, 'index'])->name('reportes.index');

        // --- OTROS MÓDULOS (VISTAS) ---
    Route::view('configuracion', 'configuracion.index')->name('configuracion.index');
});

require __DIR__.'/settings.php';