<?php
namespace App\Contexts\Security\Application\UseCases\Permisos;

use App\Contexts\Security\Domain\Repositories\PermisoRepositoryInterface;

class GetPermisosUseCase
{
    public function __construct(
        private PermisoRepositoryInterface $repository
    ) {}

    public function execute(): array
    {
        return $this->repository->all();
    }
}