<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cliente_referencias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->constrained('clientes')->onDelete('cascade');
            $table->string('nombre', 255);
            $table->string('celular', 20)->nullable();
            $table->string('parentesco', 100)->nullable();
            $table->foreignId('asentamiento_id')->nullable()->constrained('asentamientos')->nullOnDelete();
            $table->string('calle_numero', 255)->nullable();
            $table->timestamps();

            $table->index('cliente_id', 'referencias_cliente_id_index');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cliente_referencias');
    }
};