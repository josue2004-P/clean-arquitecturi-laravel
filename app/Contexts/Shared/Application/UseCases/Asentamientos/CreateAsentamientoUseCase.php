<?php

namespace App\Contexts\Shared\Application\UseCases\Asentamientos;

use App\Contexts\Shared\Domain\Entities\Asentamiento;
use App\Contexts\Shared\Domain\Repositories\AsentamientoRepositoryInterface;

class CreateAsentamientoUseCase
{
    public function __construct(private AsentamientoRepositoryInterface $repository) {}

    public function execute(array $data): void
    {
        $existe = $this->repository->findDuplicate(
            $data['codigo_postal'],
            $data['nombre_asentamiento'],
            $data['tipo_asentamiento']
        );

        if ($existe) {
            return; 
        }

        $asentamiento = new Asentamiento(
            null,
            $data['codigo_postal'],
            $data['estado'],
            $data['municipio'],
            $data['tipo_asentamiento'],
            $data['nombre_asentamiento'],
            $data['ciudad'] ?? null
        );

        $this->repository->create($asentamiento);
    }
}