<?php

namespace App\Contexts\Shared\Application\UseCases\Asentamientos;

use App\Contexts\Shared\Domain\Repositories\AsentamientoRepositoryInterface;

class GetAsentamientosByCodigoPostalUseCase
{
    public function __construct(private AsentamientoRepositoryInterface $repository) {}

    public function execute(string $codigoPostal): array
    {
        if (empty($codigoPostal)) {
            return [];
        }
        
        return $this->repository->findByCodigoPostal($codigoPostal);
    }
}