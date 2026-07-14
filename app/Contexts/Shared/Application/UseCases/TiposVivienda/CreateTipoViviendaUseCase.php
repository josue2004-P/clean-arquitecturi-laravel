<?php
namespace App\Contexts\Shared\Application\UseCases\TiposVivienda;

use App\Contexts\Shared\Domain\Entities\TipoVivienda;
use App\Contexts\Shared\Domain\Repositories\TipoViviendaRepositoryInterface;

class CreateTipoViviendaUseCase {
    public function __construct(private TipoViviendaRepositoryInterface $rep) {}
    public function execute(array $d) { $this->rep->create(new TipoVivienda(null, $d['nombre'], $d['descripcion'] ?? null)); }
}