<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'telefono', 'email', 'notas'];

    public function citas() {
        return $this->hasMany(Cita::class);
    }
}