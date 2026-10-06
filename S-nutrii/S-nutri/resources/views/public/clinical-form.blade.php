@extends('layouts.public')

@section('title', 'Formulario clínico')

@section('content')

<main class="public-main">

    <div class="public-form-wrapper">

        <div class="public-form-header">

            <p class="section-eyebrow">
                Información clínica
            </p>

            <h1>
                Formulario clínico
            </h1>

            <p>
                La información proporcionada será utilizada
                para preparar tu atención nutricional.
            </p>

        </div>


        <form
            action="{{ route('public.clinical-form.store') }}"
            method="POST"
            data-prevent-double-submit
        >

            @csrf


            {{-- Datos personales --}}
            <section class="form-section">

                <div class="form-section-header">

                    <div class="form-section-number">
                        1
                    </div>

                    <h2 class="form-section-title">
                        Datos personales
                    </h2>

                </div>


                <div class="form-section-body">

                    <div class="form-grid">

                        <div class="form-group">

                            <label
                                for="name"
                                class="form-label form-label-required"
                            >
                                Nombre completo
                            </label>

                            <input
                                type="text"
                                id="name"
                                name="name"
                                class="form-control"
                                value="{{ old('name') }}"
                                required
                            >

                        </div>


                        <div class="form-group">

                            <label
                                for="phone"
                                class="form-label form-label-required"
                            >
                                Teléfono
                            </label>

                            <input
                                type="tel"
                                id="phone"
                                name="phone"
                                class="form-control"
                                value="{{ old('phone') }}"
                                required
                            >

                        </div>


                        <div class="form-group">

                            <label
                                for="email"
                                class="form-label form-label-required"
                            >
                                Correo
                            </label>

                            <input
                                type="email"
                                id="email"
                                name="email"
                                class="form-control"
                                value="{{ old('email') }}"
                                required
                            >

                        </div>


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
                                value="{{ old('birth_date') }}"
                            >

                        </div>


                        <div class="form-group">

                            <label
                                for="gender"
                                class="form-label"
                            >
                                Género
                            </label>

                            <select
                                id="gender"
                                name="gender"
                                class="form-control"
                            >

                                <option value="">
                                    Seleccionar
                                </option>

                                <option
                                    value="Femenino"
                                    @selected(old('gender') === 'Femenino')
                                >
                                    Femenino
                                </option>

                                <option
                                    value="Masculino"
                                    @selected(old('gender') === 'Masculino')
                                >
                                    Masculino
                                </option>

                                <option
                                    value="Otro"
                                    @selected(old('gender') === 'Otro')
                                >
                                    Otro
                                </option>

                                <option
                                    value="Prefiero no decirlo"
                                    @selected(old('gender') === 'Prefiero no decirlo')
                                >
                                    Prefiero no decirlo
                                </option>

                            </select>

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
                                value="{{ old('occupation') }}"
                            >

                        </div>

                    </div>

                </div>

            </section>


            {{-- Antropometría --}}
            <section class="form-section">

                <div class="form-section-header">

                    <div class="form-section-number">
                        2
                    </div>

                    <h2 class="form-section-title">
                        Datos antropométricos
                    </h2>

                </div>


                <div class="form-section-body">

                    <div class="form-grid-3 form-grid">

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
                                value="{{ old('weight') }}"
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
                                value="{{ old('height') }}"
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
                                value="{{ old('body_fat_percentage') }}"
                            >

                        </div>

                    </div>

                </div>

            </section>


            {{-- Salud --}}
            <section class="form-section">

                <div class="form-section-header">

                    <div class="form-section-number">
                        3
                    </div>

                    <h2 class="form-section-title">
                        Antecedentes de salud
                    </h2>

                </div>


                <div class="form-section-body">

                    <div class="form-grid">

                        <div class="form-group full">

                            <label
                                for="medical_history"
                                class="form-label"
                            >
                                Antecedentes médicos
                            </label>

                            <textarea
                                id="medical_history"
                                name="medical_history"
                                class="form-control"
                            >{{ old('medical_history') }}</textarea>

                        </div>


                        <div class="form-group full">

                            <label
                                for="current_conditions"
                                class="form-label"
                            >
                                Enfermedades o condiciones actuales
                            </label>

                            <textarea
                                id="current_conditions"
                                name="current_conditions"
                                class="form-control"
                            >{{ old('current_conditions') }}</textarea>

                        </div>


                        <div class="form-group">

                            <label
                                for="allergies"
                                class="form-label"
                            >
                                Alergias
                            </label>

                            <textarea
                                id="allergies"
                                name="allergies"
                                class="form-control"
                            >{{ old('allergies') }}</textarea>

                        </div>


                        <div class="form-group">

                            <label
                                for="medications"
                                class="form-label"
                            >
                                Medicamentos
                            </label>

                            <textarea
                                id="medications"
                                name="medications"
                                class="form-control"
                            >{{ old('medications') }}</textarea>

                        </div>


                        <div class="form-group">

                            <label
                                for="supplements"
                                class="form-label"
                            >
                                Suplementos
                            </label>

                            <textarea
                                id="supplements"
                                name="supplements"
                                class="form-control"
                            >{{ old('supplements') }}</textarea>

                        </div>


                        <div class="form-group">

                            <label
                                for="family_history"
                                class="form-label"
                            >
                                Antecedentes familiares
                            </label>

                            <textarea
                                id="family_history"
                                name="family_history"
                                class="form-control"
                            >{{ old('family_history') }}</textarea>

                        </div>

                    </div>

                </div>

            </section>


            {{-- Hábitos --}}
            <section class="form-section">

                <div class="form-section-header">

                    <div class="form-section-number">
                        4
                    </div>

                    <h2 class="form-section-title">
                        Hábitos y objetivos
                    </h2>

                </div>


                <div class="form-section-body">

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
                            >{{ old('eating_habits') }}</textarea>

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
                            >{{ old('physical_activity') }}</textarea>

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
                                value="{{ old('sleep_hours') }}"
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
                                value="{{ old('water_consumption') }}"
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
                            >{{ old('nutritional_goal') }}</textarea>

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
                            >{{ old('additional_information') }}</textarea>

                        </div>

                    </div>

                </div>

            </section>


            <div class="form-actions">

                <a
                    href="{{ route('home') }}"
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

        </form>

    </div>

</main>

@endsection