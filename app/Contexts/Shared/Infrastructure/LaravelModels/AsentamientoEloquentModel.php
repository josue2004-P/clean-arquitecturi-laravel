<?php

namespace App\Contexts\Shared\Infrastructure\LaravelModels;

use Illuminate\Database\Eloquent\Model;

class AsentamientoEloquentModel extends Model
{
    protected $table = 'asentamientos';

    protected $fillable = [
        'codigo_postal',
        'estado',
        'municipio',
        'ciudad',
        'tipo_asentamiento',
        'nombre_asentamiento',
    ];

    public $timestamps = false; 
}