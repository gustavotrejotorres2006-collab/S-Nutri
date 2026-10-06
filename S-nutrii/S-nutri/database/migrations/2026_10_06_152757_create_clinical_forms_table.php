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
        Schema::create('clinical_forms', function (Blueprint $table) {
            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Cliente
            |--------------------------------------------------------------------------
            |
            | Un cliente solamente tendrá un formulario clínico principal.
            |
            */

            $table->foreignId('user_id')
                ->unique()
                ->constrained('users')
                ->cascadeOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Datos personales
            |--------------------------------------------------------------------------
            */

            $table->date('birth_date')
                ->nullable();

            $table->string('gender', 30)
                ->nullable();

            $table->string('occupation')
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | Datos antropométricos
            |--------------------------------------------------------------------------
            */

            $table->decimal('weight', 5, 2)
                ->nullable();

            $table->decimal('height', 5, 2)
                ->nullable();

            $table->decimal('body_fat_percentage', 5, 2)
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | Información médica
            |--------------------------------------------------------------------------
            */

            $table->text('medical_history')
                ->nullable();

            $table->text('current_conditions')
                ->nullable();

            $table->text('allergies')
                ->nullable();

            $table->text('medications')
                ->nullable();

            $table->text('supplements')
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | Antecedentes familiares
            |--------------------------------------------------------------------------
            */

            $table->text('family_history')
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | Hábitos
            |--------------------------------------------------------------------------
            */

            $table->text('eating_habits')
                ->nullable();

            $table->text('physical_activity')
                ->nullable();

            $table->string('sleep_hours', 50)
                ->nullable();

            $table->string('water_consumption', 100)
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | Objetivos
            |--------------------------------------------------------------------------
            */

            $table->text('nutritional_goal')
                ->nullable();

            $table->text('additional_information')
                ->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clinical_forms');
    }
};