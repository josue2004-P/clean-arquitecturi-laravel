<?php

namespace App\Contexts\Security\Domain\Repositories;

interface PerfilRepositoryInterface
{
    public function paginateWithSearch(string $search, int $perPage);
    public function findById(int $id): ?array;
    public function findWithPermisos(int $id);
    public function existsWithNombre(string $nombre, ?int $exceptId = null): bool;
    public function save(array $data): void;
    public function update(int $id, array $data, array $permisosMatrix = []): void;
    public function delete(int $id): void;
}