<?php

namespace App\Contexts\Shared\Application\UseCases\TiposCredito;

use App\Contexts\Shared\Domain\Repositories\TipoCreditoRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class GetTiposCreditoPaginatedUseCase
{
    public function __construct(private TipoCreditoRepositoryInterface $repository) {}

    public function execute(?string $search, int $perPage): LengthAwarePaginator
    {
        return $this->repository->paginateWithSearch($search, $perPage);
    }
}