<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cliente_telefonos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->constrained('clientes')->onDelete('cascade');
            $table->string('telefono', 20);
            $table->string('tipo_telefono', 50)->default('Celular');
            $table->timestamps();

            $table->index('cliente_id', 'telefonos_cliente_id_index');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cliente_telefonos');
    }
};