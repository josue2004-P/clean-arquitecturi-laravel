<?php

namespace App\Contexts\Shared\Infrastructure\LaravelModels;

use Illuminate\Database\Eloquent\Model;

class TipoViviendaEloquentModel extends Model
{
    protected $table = 'tipos_vivienda';

    protected $fillable = [
        'nombre',
        'descripcion',
    ];
}