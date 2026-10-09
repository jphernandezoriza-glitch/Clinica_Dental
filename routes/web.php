<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\CitaController;
use App\Models\Servicio;
use App\Models\Promocion;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $servicios = Servicio::where('activo', true)->get();
    $promociones = Promocion::where('activa', true)
        ->where('fecha_inicio', '<=', now())
        ->where('fecha_fin', '>=', now())
        ->get();

    return view('welcome', compact('servicios', 'promociones'));
})->name('home');

Route::get('/agendar', [CitaController::class, 'create'])->name('citas.create');
Route::post('/citas', [CitaController::class, 'store'])->name('citas.store');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('citas', CitaController::class)->except(['create', 'store']);
});

require __DIR__.'/auth.php';