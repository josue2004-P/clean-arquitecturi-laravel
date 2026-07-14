<?php
namespace App\Contexts\Shared\Application\UseCases\TiposVivienda;

use App\Contexts\Shared\Domain\Repositories\TipoViviendaRepositoryInterface;

class UpdateTipoViviendaUseCase {
    public function __construct(private TipoViviendaRepositoryInterface $rep) {}
    public function execute(int $id, array $d) { $this->rep->update($id, ['nombre' => $d['nombre'], 'descripcion' => $d['descripcion'] ?? null]); }
}