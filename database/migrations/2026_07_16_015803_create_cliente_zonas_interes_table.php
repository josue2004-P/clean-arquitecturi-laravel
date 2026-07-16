<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cliente_zonas_interes', function (Blueprint $table) {
            $table->foreignId('cliente_id')->constrained('clientes')->onDelete('cascade');
            $table->foreignId('asentamiento_id')->constrained('asentamientos')->onDelete('cascade');
            
            $table->primary(['cliente_id', 'asentamiento_id'], 'pk_cliente_zonas_interes');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cliente_zonas_interes');
    }
};