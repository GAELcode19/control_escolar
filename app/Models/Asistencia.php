<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    protected $fillable = ['alumno_id', 'materia_id', 'fecha', 'estatus', 'observaciones'];

public function alumno()
{
    return $this->belongsTo(Alumno::class, 'alumno_id');
}

public function materia()
{
    return $this->belongsTo(Materia::class, 'materia_id');
}
}
