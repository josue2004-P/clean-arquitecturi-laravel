<?php

namespace App\Contexts\Clientes\Domain\Repositories;

use App\Contexts\Clientes\Domain\Entities\Cliente;

interface ClienteRepositoryInterface
{
    public function getAll(): array;
    public function findById(int $id): ?Cliente;
    public function save(Cliente $cliente): Cliente;
    public function update(int $id, Cliente $cliente): Cliente;
    public function delete(int $id): bool;
}