<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;

    protected $table = 'citas';

    protected $fillable = ['paciente_id', 'servicio_id', 'fecha_hora_inicio', 'fecha_hora_fin', 'estado', 'observaciones'];

    public function paciente() {
        return $this->belongsTo(Paciente::class);
    }

    public function servicio() {
        return $this->belongsTo(Servicio::class);
    }
}