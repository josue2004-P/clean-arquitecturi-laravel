<?php

namespace App\Contexts\Security\Application\UseCases\Perfiles;

use App\Contexts\Security\Domain\Repositories\PerfilRepositoryInterface;
use Exception;

class CreatePerfilUseCase
{
    public function __construct(private PerfilRepositoryInterface $repository) {}

    public function execute(array $data): void
    {
        $nombreFormateado = strtolower(trim($data['nombre']));

        if ($this->repository->existsWithNombre($nombreFormateado)) {
            throw new Exception("El perfil '{$nombreFormateado}' ya existe en el sistema.");
        }

        $this->repository->save([
            'nombre' => $nombreFormateado,
            'descripcion' => $data['descripcion'] ?? null,
        ]);
    }
}