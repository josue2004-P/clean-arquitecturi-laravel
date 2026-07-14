<?php

namespace App\Contexts\Shared\Domain\Entities;

class Asentamiento
{
    public function __construct(
        private ?int $id,
        private string $codigoPostal,
        private string $estado,
        private string $municipio,
        private string $tipoAsentamiento,
        private string $nombreAsentamiento,
        private ?string $ciudad = null
    ) {}

    // Getters
    public function getId(): ?int { return $this->id; }
    public function getCodigoPostal(): string { return $this->codigoPostal; }
    public function getEstado(): string { return $this->estado; }
    public function getMunicipio(): string { return $this->municipio; }
    public function getTipoAsentamiento(): string { return $this->tipoAsentamiento; }
    public function getNombreAsentamiento(): string { return $this->nombreAsentamiento; }
    public function getCiudad(): ?string { return $this->ciudad; }

    public function toArray(): array
    {
        return [
            'id'                  => $this->id,
            'codigo_postal'       => $this->codigoPostal,
            'estado'              => $this->estado,
            'municipio'           => $this->municipio,
            'ciudad'              => $this->ciudad,
            'tipo_asentamiento'   => $this->tipoAsentamiento,
            'nombre_asentamiento' => $this->nombreAsentamiento,
        ];
    }
}