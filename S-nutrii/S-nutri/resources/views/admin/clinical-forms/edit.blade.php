@extends('layouts.admin')

@section('title', 'Editar formulario clínico')

@section('content')

<div class="page-header">

    <div class="page-header-content">

        <h1 class="page-title">
            Formulario clínico
        </h1>

        <p class="page-description">
            Editando información de {{ $client->name }}.
        </p>

    </div>

</div>


<form
    action="{{ route(
        'admin.clinical-forms.update',
        $client
    ) }}"
    method="POST"
    data-prevent-double-submit
>

    @csrf
    @method('PUT')


    {{-- Datos --}}
    <div class="card" style="margin-bottom:20px;">

        <div class="card-header">

            <h2 class="card-title">
                Datos personales y antropométricos
            </h2>

        </div>


        <div class="card-body">

            <div class="form-grid">

                <div class="form-group">

                    <label
                        for="birth_date"
                        class="form-label"
                    >
                        Fecha de nacimiento
                    </label>

                    <input
                        type="date"
                        id="birth_date"
                        name="birth_date"
                        class="form-control"
                        value="{{ old(
                            'birth_date',
                            $clinicalForm?->birth_date
                        ) }}"
                    >

                </div>


                <div class="form-group">

                    <label
                        for="gender"
                        class="form-label"
                    >
                        Género
                    </label>

                    <input
                        type="text"
                        id="gender"
                        name="gender"
                        class="form-control"
                        value="{{ old(
                            'gender',
                            $clinicalForm?->gender
                        ) }}"
                    >

                </div>


                <div class="form-group">

                    <label
                        for="occupation"
                        class="form-label"
                    >
                        Ocupación
                    </label>

                    <input
                        type="text"
                        id="occupation"
                        name="occupation"
                        class="form-control"
                        value="{{ old(
                            'occupation',
                            $clinicalForm?->occupation
                        ) }}"
                    >

                </div>


                <div class="form-group">

                    <label
                        for="weight"
                        class="form-label"
                    >
                        Peso (kg)
                    </label>

                    <input
                        type="number"
                        step="0.1"
                        id="weight"
                        name="weight"
                        class="form-control"
                        value="{{ old(
                            'weight',
                            $clinicalForm?->weight
                        ) }}"
                    >

                </div>


                <div class="form-group">

                    <label
                        for="height"
                        class="form-label"
                    >
                        Estatura (m)
                    </label>

                    <input
                        type="number"
                        step="0.01"
                        id="height"
                        name="height"
                        class="form-control"
                        value="{{ old(
                            'height',
                            $clinicalForm?->height
                        ) }}"
                    >

                </div>


                <div class="form-group">

                    <label
                        for="body_fat_percentage"
                        class="form-label"
                    >
                        Grasa corporal (%)
                    </label>

                    <input
                        type="number"
                        step="0.1"
                        id="body_fat_percentage"
                        name="body_fat_percentage"
                        class="form-control"
                        value="{{ old(
                            'body_fat_percentage',
                            $clinicalForm?->body_fat_percentage
                        ) }}"
                    >

                </div>

            </div>

        </div>

    </div>


    {{-- Salud --}}
    <div class="card" style="margin-bottom:20px;">

        <div class="card-header">

            <h2 class="card-title">
                Información de salud
            </h2>

        </div>


        <div class="card-body">

            <div class="form-grid">

                @foreach([
                    'medical_history' => 'Antecedentes médicos',
                    'current_conditions' => 'Condiciones actuales',
                    'allergies' => 'Alergias',
                    'medications' => 'Medicamentos',
                    'supplements' => 'Suplementos',
                    'family_history' => 'Antecedentes familiares',
                ] as $field => $label)

                    <div class="form-group">

                        <label
                            for="{{ $field }}"
                            class="form-label"
                        >
                            {{ $label }}
                        </label>

                        <textarea
                            id="{{ $field }}"
                            name="{{ $field }}"
                            class="form-control"
                        >{{ old(
                            $field,
                            $clinicalForm?->{$field}
                        ) }}</textarea>

                    </div>

                @endforeach

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

            <div class="form-grid">

                <div class="form-group full">

                    <label
                        for="eating_habits"
                        class="form-label"
                    >
                        Hábitos alimenticios
                    </label>

                    <textarea
                        id="eating_habits"
                        name="eating_habits"
                        class="form-control"
                    >{{ old(
                        'eating_habits',
                        $clinicalForm?->eating_habits
                    ) }}</textarea>

                </div>


                <div class="form-group">

                    <label
                        for="physical_activity"
                        class="form-label"
                    >
                        Actividad física
                    </label>

                    <textarea
                        id="physical_activity"
                        name="physical_activity"
                        class="form-control"
                    >{{ old(
                        'physical_activity',
                        $clinicalForm?->physical_activity
                    ) }}</textarea>

                </div>


                <div class="form-group">

                    <label
                        for="sleep_hours"
                        class="form-label"
                    >
                        Horas de sueño
                    </label>

                    <input
                        type="text"
                        id="sleep_hours"
                        name="sleep_hours"
                        class="form-control"
                        value="{{ old(
                            'sleep_hours',
                            $clinicalForm?->sleep_hours
                        ) }}"
                    >

                </div>


                <div class="form-group">

                    <label
                        for="water_consumption"
                        class="form-label"
                    >
                        Consumo de agua
                    </label>

                    <input
                        type="text"
                        id="water_consumption"
                        name="water_consumption"
                        class="form-control"
                        value="{{ old(
                            'water_consumption',
                            $clinicalForm?->water_consumption
                        ) }}"
                    >

                </div>


                <div class="form-group">

                    <label
                        for="nutritional_goal"
                        class="form-label"
                    >
                        Objetivo nutricional
                    </label>

                    <textarea
                        id="nutritional_goal"
                        name="nutritional_goal"
                        class="form-control"
                    >{{ old(
                        'nutritional_goal',
                        $clinicalForm?->nutritional_goal
                    ) }}</textarea>

                </div>


                <div class="form-group full">

                    <label
                        for="additional_information"
                        class="form-label"
                    >
                        Información adicional
                    </label>

                    <textarea
                        id="additional_information"
                        name="additional_information"
                        class="form-control"
                    >{{ old(
                        'additional_information',
                        $clinicalForm?->additional_information
                    ) }}</textarea>

                </div>

            </div>


            <div class="form-actions">

                <a
                    href="{{ route(
                        'admin.clinical-forms.show',
                        $client
                    ) }}"
                    class="btn btn-secondary"
                >
                    Cancelar
                </a>

                <button
                    type="submit"
                    class="btn btn-primary"
                >

                    <x-icon name="check" />

                    Guardar formulario

                </button>

            </div>

        </div>

    </div>

</form>

@endsection