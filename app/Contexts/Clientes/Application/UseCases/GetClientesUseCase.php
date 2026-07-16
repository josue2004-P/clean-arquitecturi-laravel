<?php

namespace App\Contexts\Clientes\Application\UseCases;

use App\Contexts\Clientes\Domain\Repositories\ClienteRepositoryInterface;

class GetClientesUseCase
{
    public function __construct(
        private ClienteRepositoryInterface $repository
    ) {}

    public function execute(): array
    {
        return $this->repository->getAll();
    }
}