<?php
namespace App\Contexts\Security\Domain\Repositories;

interface PermisoRepositoryInterface
{
    public function all(): array;
    public function findById(int $id): ?array;
    public function existsWithNombre(string $nombre, ?int $exceptId = null): bool;
    public function save(array $data): void;
    public function update(int $id, array $data): void;
    public function delete(int $id): void;
}