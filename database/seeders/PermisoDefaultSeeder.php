<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Contexts\Security\Infrastructure\LaravelModels\PermisoEloquentModel;

class PermisoDefaultSeeder extends Seeder
{
    public function run(): void
    {
        if (!PermisoEloquentModel::where('nombre', 'administrador')->exists()) {
            PermisoEloquentModel::create([
                'nombre' => 'administrador',
                'descripcion' => 'Permiso del sistema',
            ]);
        }

        if (!PermisoEloquentModel::where('nombre', 'mod-est-anl')->exists()) {
            PermisoEloquentModel::create([
                'nombre' => 'mod-est-anl',
                'descripcion' => 'Permiso modulo de configuracion',
            ]);
        }
    }
}
