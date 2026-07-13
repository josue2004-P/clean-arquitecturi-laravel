<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Contexts\Security\Infrastructure\LaravelModels\PerfilEloquentModel;

class PerfilDefaultSeeder extends Seeder
{
    public function run(): void
    {
        if (!PerfilEloquentModel::where('nombre', 'administrador')->exists()) {
            PerfilEloquentModel::create([
                'nombre' => 'administrador',
                'descripcion' => 'Perfil con todos los permisos del sistema',
            ]);
        }
    }
}
