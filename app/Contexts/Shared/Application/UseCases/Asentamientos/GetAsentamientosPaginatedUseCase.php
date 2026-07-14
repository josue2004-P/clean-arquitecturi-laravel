<?php

namespace App\Contexts\Shared\Application\UseCases\Asentamientos;

use App\Contexts\Shared\Domain\Repositories\AsentamientoRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class GetAsentamientosPaginatedUseCase
{
    public function __construct(
        private AsentamientoRepositoryInterface $repository
    ) {}

    public function execute(?string $search, int $perPage): LengthAwarePaginator
    {
        return $this->repository->paginateWithSearch($search, $perPage);
    }
}