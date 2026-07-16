<?php

namespace App\Contexts\Clientes\Infrastructure\LaravelModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClienteDocumentoEloquentModel extends Model
{
    protected $table = 'cliente_documentos';

    protected $fillable = ['cliente_id', 'url', 'nombre_original', 'tipo_documento', 'peso_bytes', 'verificado'];

    protected $casts = [
        'verificado' => 'boolean',
    ];

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(ClienteEloquentModel::class, 'cliente_id');
    }
}