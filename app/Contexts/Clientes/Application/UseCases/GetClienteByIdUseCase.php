<?php

namespace App\Contexts\Clientes\Application\UseCases;

use App\Contexts\Clientes\Domain\Entities\Cliente;
use App\Contexts\Clientes\Domain\Repositories\ClienteRepositoryInterface;

class GetClienteByIdUseCase
{
    public function __construct(
        private ClienteRepositoryInterface $repository
    ) {}

    public function execute(int $id): ?Cliente
    {
        return $this->repository->findById($id);
    }
}