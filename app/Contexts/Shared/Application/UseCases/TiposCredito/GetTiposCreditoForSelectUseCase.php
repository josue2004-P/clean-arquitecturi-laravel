<?php

namespace App\Contexts\Shared\Application\UseCases\TiposCredito;

use App\Contexts\Shared\Domain\Repositories\TipoCreditoRepositoryInterface;

class GetTiposCreditoForSelectUseCase
{
    public function __construct(
        private TipoCreditoRepositoryInterface $tipoCreditoRepository
    ) {}

    /**
     * Ejecuta el caso de uso permitiendo definir el contexto ('cliente', 'vivienda' o null).
     */
    public function execute(?string $contexto = 'cliente'): array
    {
        return $this->tipoCreditoRepository->all($contexto);
    }
}