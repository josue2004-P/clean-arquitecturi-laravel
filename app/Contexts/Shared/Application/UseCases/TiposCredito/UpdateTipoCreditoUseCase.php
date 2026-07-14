<?php

namespace App\Contexts\Shared\Application\UseCases\TiposCredito;

use App\Contexts\Shared\Domain\Repositories\TipoCreditoRepositoryInterface;

class UpdateTipoCreditoUseCase
{
    public function __construct(
        private TipoCreditoRepositoryInterface $repository
    ) {}

    public function execute(int $id, array $data): void
    {
        $payload = [
            'nombre'          => $data['nombre'],
            'descripcion'     => $data['descripcion'] ?? null,
            'aplica_vivienda' => (bool)$data['aplica_vivienda'],
            'aplica_cliente'  => (bool)$data['aplica_cliente'],
        ];

        $this->repository->update($id, $payload);
    }
}