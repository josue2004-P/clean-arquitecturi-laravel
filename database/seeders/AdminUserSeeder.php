<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Contexts\Security\Infrastructure\LaravelModels\UserEloquentModel;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        UserEloquentModel::firstOrCreate(
            ['email' => 'admin@altamardev.com'],
            [
                'usuario' => 'admin', 
                'name' => 'Administrador',
                'apellido_paterno' => 'Sistema', 
                'apellido_materno' => 'Inmobiliaria',
                'password' => Hash::make('admin123'), 
                'is_activo' => true,
                'foto' => null,
                'firma' => null,
            ]
        );
    }
}