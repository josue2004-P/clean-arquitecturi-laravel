<?php
namespace App\Contexts\Security\Application\UseCases\Permisos;

use App\Contexts\Security\Domain\Repositories\PermisoRepositoryInterface;
use Exception;

class UpdatePermisoUseCase
{
    public function __construct(
        private PermisoRepositoryInterface $repository
    ) {}

    public function execute(int $id, array $data): void
    {
        $nombreFormateado = strtolower(trim($data['nombre']));

        if ($this->repository->existsWithNombre($nombreFormateado, $id)) {
            throw new Exception("El permiso '{$nombreFormateado}' ya está en uso por otro registro.");
        }

        $this->repository->update($id, [
            'nombre' => $nombreFormateado,
            'descripcion' => $data['descripcion'] ?? null,
        ]);
    }
}