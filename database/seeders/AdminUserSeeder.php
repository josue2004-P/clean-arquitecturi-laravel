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
            ['email' => 'admin@example.com'],
            [
                'name' => 'Administrador',
                'password' => Hash::make('admin123'), 
            ]
        );
    }
}
