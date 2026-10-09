<?php

namespace App\Http\Controllers;

use App\Models\Servicio;
use App\Models\Promocion;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index() {
        $servicios = Servicio::where('activo', true)->get();
        $promociones = Promocion::where('activa', true)
            ->where('fecha_inicio', '<=', now())
            ->where('fecha_fin', '>=', now())
            ->get();

        return view('welcome', compact('servicios', 'promociones'));
    }
}