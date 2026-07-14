<?php

namespace App\Contexts\Shared\Domain\Repositories;

use App\Contexts\Shared\Domain\Entities\TipoCredito;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface TipoCreditoRepositoryInterface
{
    public function create(TipoCredito $tipoCredito): void;
    public function update(int $id, array $data): void;
    public function delete(int $id): void;
    public function paginateWithSearch(?string $search, int $perPage): LengthAwarePaginator;
}