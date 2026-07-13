<?php

namespace App\Contexts\Security\Domain\Repositories;

interface UserRepositoryInterface
{
    public function paginateWithSearch(string $search, int $perPage);
    public function findById(int $id): ?array;
    public function findWithPerfiles(int $id);
    public function save(array $data): void;
    public function update(int $id, array $data, array $perfiles = []): void;
    public function delete(int $id): void;
}