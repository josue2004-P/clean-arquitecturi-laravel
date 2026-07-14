<?php

namespace App\Contexts\Security\Application\UseCases\Usuarios;

use App\Contexts\Security\Domain\Repositories\UserRepositoryInterface;

class UpdateUserUseCase
{
    public function __construct(private UserRepositoryInterface $repository) {}

    public function execute(int $id, array $data, array $perfiles = []): void
    {
        $this->repository->update($id, [
            'name'             => $data['name'],
            'apellido_paterno' => $data['apellido_paterno'],
            'apellido_materno' => $data['apellido_materno'],
            'email'            => $data['email'],
            'is_activo'        => (bool)($data['is_activo'] ?? false),
            'foto'             => $data['foto'] ?? null,
            'firma'            => $data['firma'] ?? null,
        ], $perfiles);
    }
}