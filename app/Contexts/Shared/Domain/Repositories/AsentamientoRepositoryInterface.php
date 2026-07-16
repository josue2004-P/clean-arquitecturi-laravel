<?php

namespace App\Contexts\Shared\Domain\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Contexts\Shared\Domain\Entities\Asentamiento;

interface AsentamientoRepositoryInterface
{
    public function all(): array; 
    public function findByCodigoPostal(string $codigoPostal): array;
    public function create(\App\Contexts\Shared\Domain\Entities\Asentamiento $asentamiento): void;
    public function bulkInsert(array $asentamientos): void;
    public function paginateWithSearch(?string $search, int $perPage): LengthAwarePaginator;
    public function findDuplicate(string $codigoPostal, string $nombreAsentamiento, string $tipoAsentamiento): ?Asentamiento;
}