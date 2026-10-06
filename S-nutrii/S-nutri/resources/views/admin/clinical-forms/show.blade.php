@extends('layouts.admin')

@section('title', 'Formulario clínico')

@section('content')

<div class="page-header">

    <div class="page-header-content">

        <h1 class="page-title">
            Formulario clínico
        </h1>

        <p class="page-description">
            Información clínica de {{ $client->name }}.
        </p>

    </div>


    <div class="page-actions">

        <a
            href="{{ route(
                'admin.clinical-forms.edit',
                $client
            ) }}"
            class="btn btn-primary"
        >

            <x-icon name="edit" />

            Editar formulario

        </a>

    </div>

</div>


@if(!$clinicalForm)

    <div class="card">

        <div class="empty-state">

            <div class="empty-state-icon">

                <x-icon name="file-text" />

            </div>

            <h3 class="empty-state-title">
                Formulario no disponible
            </h3>

            <p class="empty-state-text">
                Este cliente todavía no ha completado su formulario clínico.
            </p>

            <a
                href="{{ route(
                    'admin.clinical-forms.edit',
                    $client
                ) }}"
                class="btn btn-primary"
                style="margin-top:18px;"
            >
                Crear formulario
            </a>

        </div>

    </div>

@else


    {{-- Datos antropométricos --}}
    <div class="card" style="margin-bottom:20px;">

        <div class="card-header">

            <h2 class="card-title">
                Datos antropométricos
            </h2>

        </div>


        <div class="card-body">

            <div class="detail-grid">

                <div class="detail-item">

                    <span class="detail-label">
                        Peso
                    </span>

                    <p class="detail-value">
                        {{ $clinicalForm->weight ?: '—' }} kg
                    </p>

                </div>


                <div class="detail-item">

                    <span class="detail-label">
                        Estatura
                    </span>

                    <p class="detail-value">
                        {{ $clinicalForm->height ?: '—' }} m
                    </p>

                </div>


                <div class="detail-item">

                    <span class="detail-label">
                        Grasa corporal
                    </span>

                    <p class="detail-value">
                        {{ $clinicalForm->body_fat_percentage ?: '—' }} %
                    </p>

                </div>


                <div class="detail-item">

                    <span class="detail-label">
                        Fecha de nacimiento
                    </span>

                    <p class="detail-value">
                        {{ $clinicalForm->birth_date ?: '—' }}
                    </p>

                </div>


                <div class="detail-item">

                    <span class="detail-label">
                        Género
                    </span>

                    <p class="detail-value">
                        {{ $clinicalForm->gender ?: '—' }}
                    </p>

                </div>


                <div class="detail-item">

                    <span class="detail-label">
                        Ocupación
                    </span>

                    <p class="detail-value">
                        {{ $clinicalForm->occupation ?: '—' }}
                    </p>

                </div>

            </div>

        </div>

    </div>


    {{-- Salud --}}
    <div class="card" style="margin-bottom:20px;">

        <div class="card-header">

            <h2 class="card-title">
                Antecedentes de salud
            </h2>

        </div>


        <div class="card-body">

            <div class="detail-grid">

                <div class="detail-item">

                    <span class="detail-label">
                        Antecedentes médicos
                    </span>

                    <p class="detail-value multiline">
                        {{ $clinicalForm->medical_history ?: 'Sin información' }}
                    </p>

                </div>


                <div class="detail-item">

                    <span class="detail-label">
                        Condiciones actuales
                    </span>

                    <p class="detail-value multiline">
                        {{ $clinicalForm->current_conditions ?: 'Sin información' }}
                    </p>

                </div>


                <div class="detail-item">

                    <span class="detail-label">
                        Alergias
                    </span>

                    <p class="detail-value multiline">
                        {{ $clinicalForm->allergies ?: 'Sin información' }}
                    </p>

                </div>


                <div class="detail-item">

                    <span class="detail-label">
                        Medicamentos
                    </span>

                    <p class="detail-value multiline">
                        {{ $clinicalForm->medications ?: 'Sin información' }}
                    </p>

                </div>


                <div class="detail-item">

                    <span class="detail-label">
                        Suplementos
                    </span>

                    <p class="detail-value multiline">
                        {{ $clinicalForm->supplements ?: 'Sin información' }}
                    </p>

                </div>


                <div class="detail-item">

                    <span class="detail-label">
                        Antecedentes familiares
                    </span>

                    <p class="detail-value multiline">
                        {{ $clinicalForm->family_history ?: 'Sin información' }}
                    </p>

                </div>

            </div>

        </div>

    </div>


    {{-- Hábitos --}}
    <div class="card">

        <div class="card-header">

            <h2 class="card-title">
                Hábitos y objetivos
            </h2>

        </div>


        <div class="card-body">

            <div class="detail-grid">

                <div class="detail-item">

                    <span class="detail-label">
                        Hábitos alimenticios
                    </span>

                    <p class="detail-value multiline">
                        {{ $clinicalForm->eating_habits ?: 'Sin información' }}
                    </p>

                </div>


                <div class="detail-item">

                    <span class="detail-label">
                        Actividad física
                    </span>

                    <p class="detail-value multiline">
                        {{ $clinicalForm->physical_activity ?: 'Sin información' }}
                    </p>

                </div>


                <div class="detail-item">

                    <span class="detail-label">
                        Horas de sueño
                    </span>

                    <p class="detail-value">
                        {{ $clinicalForm->sleep_hours ?: '—' }}
                    </p>

                </div>


                <div class="detail-item">

                    <span class="detail-label">
                        Consumo de agua
                    </span>

                    <p class="detail-value">
                        {{ $clinicalForm->water_consumption ?: '—' }}
                    </p>

                </div>


                <div class="detail-item">

                    <span class="detail-label">
                        Objetivo nutricional
                    </span>

                    <p class="detail-value multiline">
                        {{ $clinicalForm->nutritional_goal ?: 'Sin información' }}
                    </p>

                </div>


                <div class="detail-item">

                    <span class="detail-label">
                        Información adicional
                    </span>

                    <p class="detail-value multiline">
                        {{ $clinicalForm->additional_information ?: 'Sin información' }}
                    </p>

                </div>

            </div>

        </div>

    </div>

@endif

@endsection