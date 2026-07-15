<?php

namespace App\Contexts\Viviendas\Application\UseCases;

use App\Contexts\Viviendas\Domain\Repositories\ViviendaRepositoryInterface;

class SaveViviendaDocumentosUseCase
{
    private ViviendaRepositoryInterface $repository;

    public function __construct(ViviendaRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute(int $viviendaId, array $documentos): void
    {
        $this->repository->saveDocumentos($viviendaId, $documentos);
    }
}