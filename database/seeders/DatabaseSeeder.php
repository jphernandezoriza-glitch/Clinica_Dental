<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Servicio;
use App\Models\Promocion;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Dra. Celia Pérez Díaz',
            'email' => 'admin@clinicadental.com',
            'password' => Hash::make('password123'),
        ]);

        Servicio::create([
            'nombre' => 'Limpieza Dental Ultrasonido',
            'descripcion' => 'Eliminación de sarro y pulido dental completo.',
            'precio' => 600.00,
            'activo' => true,
        ]);

        Servicio::create([
            'nombre' => 'Resina Fotocurable',
            'descripcion' => 'Restauración estética de piezas con caries.',
            'precio' => 500.00,
            'activo' => true,
        ]);

        Promocion::create([
            'titulo' => 'Descuento de Inicio de Mes',
            'descripcion' => '20% de descuento en blanqueamiento dental.',
            'precio_promocional' => 1200.00,
            'fecha_inicio' => now()->startOfMonth(),
            'fecha_fin' => now()->endOfMonth(),
            'activa' => true,
        ]);
    }
}