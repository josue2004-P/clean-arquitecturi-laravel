<?php

namespace App\Contexts\Shared\Application\UseCases\TiposCredito;

use App\Contexts\Shared\Domain\Entities\TipoCredito;
use App\Contexts\Shared\Domain\Repositories\TipoCreditoRepositoryInterface;

class CreateTipoCreditoUseCase
{
    public function __construct(private TipoCreditoRepositoryInterface $repository) {}

    public function execute(array $data): void
    {
        $tipoCredito = new TipoCredito(
            null,
            $data['nombre'],
            $data['descripcion'] ?? null,
            (bool)$data['aplica_vivienda'],
            (bool)$data['aplica_cliente']
        );

        $this->repository->create($tipoCredito);
    }
}