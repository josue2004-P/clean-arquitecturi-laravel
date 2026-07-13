<?php
namespace App\Contexts\Security\Application\UseCases\Permisos;

use App\Contexts\Security\Domain\Repositories\PermisoRepositoryInterface;
use Exception;

class CreatePermisoUseCase
{
    public function __construct(
        private PermisoRepositoryInterface $repository
    ) {}

    public function execute(array $data): void
    {
        $nombreFormateado = strtolower(trim($data['nombre']));

        if ($this->repository->existsWithNombre($nombreFormateado)) {
            throw new Exception("El permiso '{$nombreFormateado}' ya existe.");
        }

        $this->repository->save([
            'nombre' => $nombreFormateado,
            'descripcion' => $data['descripcion'] ?? null,
        ]);
    }
}