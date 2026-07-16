<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cliente_documentos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->constrained('clientes')->onDelete('cascade');
            $table->string('url', 255);
            $table->string('nombre_original', 255)->nullable();
            $table->string('tipo_documento', 100);
            $table->integer('peso_bytes')->nullable();
            $table->boolean('verificado')->default(false);
            $table->timestamps();

            $table->index(['cliente_id', 'tipo_documento'], 'cliente_documento_tipo_index');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cliente_documentos');
    }
};