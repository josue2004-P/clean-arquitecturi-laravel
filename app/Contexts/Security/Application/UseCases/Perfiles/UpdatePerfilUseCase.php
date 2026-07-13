<?php

namespace App\Contexts\Security\Application\UseCases\Perfiles;

use App\Contexts\Security\Domain\Repositories\PerfilRepositoryInterface;
use Exception;

class UpdatePerfilUseCase
{
    public function __construct(private PerfilRepositoryInterface $repository) {}

    public function execute(int $id, array $data, array $permisosMatrix): void
    {
        $nombreFormateado = strtolower(trim($data['nombre']));

        if ($this->repository->existsWithNombre($nombreFormateado, $id)) {
            throw new Exception("El perfil '{$nombreFormateado}' ya está asignado a otro rol.");
        }

        $this->repository->update($id, [
            'nombre' => $nombreFormateado,
            'descripcion' => $data['descripcion'] ?? null,
        ], $permisosMatrix);
    }
}