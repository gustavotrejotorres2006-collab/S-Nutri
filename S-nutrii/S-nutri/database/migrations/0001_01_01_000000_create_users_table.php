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
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Información básica
            |--------------------------------------------------------------------------
            */

            $table->string('name');

            $table->string('email')
                ->unique()
                ->nullable();

            $table->string('phone', 20)
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | Tipo de usuario
            |--------------------------------------------------------------------------
            |
            | nutriologo = administrador/superusuario
            | cliente    = cliente que agenda citas
            |
            */

            $table->string('role')
                ->default('cliente');

            /*
            |--------------------------------------------------------------------------
            | Autenticación
            |--------------------------------------------------------------------------
            |
            | Los clientes no necesitan contraseña.
            | Únicamente el nutriólogo utilizará este campo.
            |
            */

            $table->string('password')
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | Estado
            |--------------------------------------------------------------------------
            */

            $table->boolean('active')
                ->default(true);

            /*
            |--------------------------------------------------------------------------
            | Recordatorios / autenticación
            |--------------------------------------------------------------------------
            */

            $table->rememberToken();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
