<?php
namespace App\Contexts\Security\Application\UseCases\Permisos;

use App\Contexts\Security\Domain\Repositories\PermisoRepositoryInterface;

class GetPaginatedPermisosUseCase
{
    public function __construct(
        private PermisoRepositoryInterface $repository
    ) {}

    public function execute(string $search, int $perPage)
    {
        return $this->repository->paginateWithSearch($search, $perPage);
    }
}