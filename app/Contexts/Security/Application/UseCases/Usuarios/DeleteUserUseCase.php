<?php

namespace App\Contexts\Security\Application\UseCases\Usuarios;

use App\Contexts\Security\Domain\Repositories\UserRepositoryInterface;

class DeleteUserUseCase
{
    public function __construct(private UserRepositoryInterface $repository) {}

    public function execute(int $id): void
    {
        $this->repository->delete($id);
    }
}