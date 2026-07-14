<?php

namespace App\Contexts\Shared\Domain\Entities;

class TipoVivienda
{
    public function __construct(
        private ?int $id,
        private string $nombre,
        private ?string $descripcion,
        private ?string $createdAt = null,
        private ?string $updatedAt = null
    ) {}

    public function getId(): ?int { return $this->id; }
    public function getNombre(): string { return $this->nombre; }
    public function getDescripcion(): ?string { return $this->descripcion; }

    public function toArray(): array
    {
        return [
            'id'          => $this->id,
            'nombre'      => $this->nombre,
            'descripcion' => $this->descripcion,
        ];
    }
}