<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Paciente;
use App\Models\Servicio;
use Illuminate\Http\Request;

class CitaController extends Controller
{
    public function index() {
        $citas = Cita::with(['paciente', 'servicio'])->orderBy('fecha_hora_inicio', 'asc')->get();
        return view('citas.index', compact('citas'));
    }

    public function create() {
        $pacientes = Paciente::all();
        $servicios = Servicio::where('activo', true)->get();
        return view('citas.create', compact('pacientes', 'servicios'));
    }

    public function store(Request $request) {
        $request->validate([
            'paciente_id' => 'required|exists:pacientes,id',
            'servicio_id' => 'required|exists:servicios,id',
            'fecha_hora_inicio' => 'required|date|after:now',
            'fecha_hora_fin' => 'required|date|after:fecha_hora_inicio',
        ]);

        // RF-04: Validación de disponibilidad de horario
        $solapada = Cita::where('estado', '!=', 'cancelada')
            ->where(function ($query) use ($request) {
                $query->whereBetween('fecha_hora_inicio', [$request->fecha_hora_inicio, $request->fecha_hora_fin])
                      ->orWhereBetween('fecha_hora_fin', [$request->fecha_hora_inicio, $request->fecha_hora_fin])
                      ->orWhere(function ($q) use ($request) {
                          $q->where('fecha_hora_inicio', '<=', $request->fecha_hora_inicio)
                            ->where('fecha_hora_fin', '>=', $request->fecha_hora_fin);
                      });
            })->exists();

        if ($solapada) {
            return back()->withInput()->withErrors(['fecha_hora_inicio' => 'El horario seleccionado ya no está disponible.']);
        }

        Cita::create($request->all());

        return redirect()->route('citas.index')->with('success', 'Cita agendada exitosamente.');
    }
}