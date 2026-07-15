<?php

namespace App\Contexts\Viviendas\Application\UseCases;

use App\Contexts\Viviendas\Domain\Repositories\ViviendaRepositoryInterface;

class SaveViviendaFotosUseCase
{
    private ViviendaRepositoryInterface $repository;

    public function __construct(ViviendaRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute(int $viviendaId, array $fotos): void
    {
        $this->repository->saveFotos($viviendaId, $fotos);
    }
}