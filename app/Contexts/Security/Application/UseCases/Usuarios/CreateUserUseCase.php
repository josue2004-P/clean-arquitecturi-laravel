<?php

namespace App\Contexts\Security\Application\UseCases\Usuarios;

use App\Contexts\Security\Domain\Repositories\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class CreateUserUseCase
{
    public function __construct(private UserRepositoryInterface $repository) {}

    public function execute(array $data): void
    {
        $this->repository->save([
            'usuario'          => $data['usuario'],
            'name'             => $data['name'],
            'apellido_paterno' => $data['apellido_paterno'],
            'apellido_materno' => $data['apellido_materno'],
            'email'            => $data['email'],
            'password'         => Hash::make($data['password']),
            'is_activo'        => (bool)($data['is_activo'] ?? true),
            'foto'             => $data['foto'] ?? null,
            'firma'            => $data['firma'] ?? null,
        ]);
    }
}