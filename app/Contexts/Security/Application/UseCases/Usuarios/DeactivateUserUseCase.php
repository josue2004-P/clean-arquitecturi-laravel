<?php

namespace App\Contexts\Security\Application\UseCases\Usuarios;

use App\Contexts\Security\Domain\Repositories\UserRepositoryInterface;

class DeactivateUserUseCase
{
    public function __construct(private UserRepositoryInterface $repository) {}

    public function execute(int $id): void
    {
        $this->repository->update($id, [
            'is_activo' => false
        ]);
    }
}