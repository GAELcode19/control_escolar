<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inscripcion extends Model
{
    protected $table = 'inscripciones'; 

    // Aquí es donde le damos permiso a Laravel para tocar estas columnas
    protected $fillable = [
        'alumno_id',
        'docente_id',
        'materia_id',
        'periodo',
        'calificacion',
        'estatus',
        'p1', 
        'p2', 
        'p3'  
    ];

    public function alumno() { 
        return $this->belongsTo(Alumno::class); 
    }
    
    public function materia() { 
        return $this->belongsTo(Materia::class); 
    }
    
    public function docente() { 
        return $this->belongsTo(Docente::class); 
    }
}