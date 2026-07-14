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
        // 1. TABLAS MAESTRAS BASE
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('usuario')->unique(); 
            $table->string('name');
            $table->string('apellido_paterno');
            $table->string('apellido_materno'); 
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('is_activo')->default(true);
            $table->string('foto')->nullable();
            $table->string('firma')->nullable(); 
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('perfiles', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->unique();
            $table->string('descripcion')->nullable();
            $table->timestamps();
        });

        Schema::create('permisos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->unique();
            $table->string('descripcion')->nullable();
            $table->timestamps();
        });

        // 2. TABLAS PIVOTE Y MATRICES (Dependen de las maestras)
        Schema::create('perfil_permiso', function (Blueprint $table) {
            $table->foreignId('perfil_id')->constrained('perfiles')->onDelete('cascade');
            $table->foreignId('permiso_id')->constrained('permisos')->onDelete('cascade');
            $table->boolean('is_read')->default(false);
            $table->boolean('is_create')->default(false);
            $table->boolean('is_update')->default(false);
            $table->boolean('is_delete')->default(false);
            $table->timestamps();

            // Llave primaria compuesta
            $table->primary(['perfil_id', 'permiso_id'], 'pk_perfil_permiso_matriz');
        });

        Schema::create('perfil_user', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('perfil_id')->constrained('perfiles')->onDelete('cascade');
            $table->timestamps();

            // Llave primaria compuesta
            $table->primary(['user_id', 'perfil_id'], 'pk_usuario_perfil_matriz');
        });

        // 3. TABLAS DE SOPORTE DE SISTEMA
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // El orden de eliminación va a la inversa para evitar conflictos de llaves foráneas
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('perfil_user');
        Schema::dropIfExists('perfil_permiso');
        Schema::dropIfExists('permisos');
        Schema::dropIfExists('perfiles');
        Schema::dropIfExists('users');
    }
};