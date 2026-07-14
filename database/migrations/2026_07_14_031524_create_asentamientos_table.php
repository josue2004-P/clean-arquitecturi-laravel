<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('asentamientos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo_postal', 10);
            $table->string('estado', 100);
            $table->string('municipio', 100);
            $table->string('ciudad', 100)->nullable();
            $table->string('tipo_asentamiento', 50);
            $table->string('nombre_asentamiento', 150);

            $table->index('codigo_postal', 'asentamientos_cp_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asentamientos');
    }
};