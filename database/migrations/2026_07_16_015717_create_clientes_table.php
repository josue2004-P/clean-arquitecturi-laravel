<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 255);
            $table->string('apellido_paterno', 255);
            $table->string('apellido_materno', 255);
            $table->date('fecha_nacimiento')->nullable();
            $table->string('rfc', 13)->unique()->nullable();
            $table->string('curp', 18)->unique()->nullable();
            $table->foreignId('asentamiento_id')->nullable()->constrained('asentamientos')->nullOnDelete();
            $table->string('calle_numero', 255)->nullable();
            $table->string('nss', 15)->nullable();
            $table->string('correo_infonavit', 255)->nullable();
            $table->string('contrasena_infonavit', 255)->nullable();
            $table->foreignId('tipo_redito_id')->nullable()->constrained('tipos_credito')->nullOnDelete();
            $table->decimal('precalificacion', 15, 2)->default(0);
            $table->string('avaluo_solicitado', 5)->default('No');
            $table->enum('estado_civil', ['Soltero', 'Casado', 'Divorciado', 'Viudo', 'Union_Libre'])->nullable();
            $table->string('regimen_casamiento', 100)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};