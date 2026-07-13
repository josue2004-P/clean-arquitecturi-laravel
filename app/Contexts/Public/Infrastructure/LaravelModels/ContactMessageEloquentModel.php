<?php

namespace App\Contexts\Public\Infrastructure\LaravelModels;

use Illuminate\Database\Eloquent\Model;

class ContactMessageEloquentModel extends Model
{
    protected $table = 'contact_messages'; 
    protected $fillable = ['nombre', 'email', 'mensaje'];
}