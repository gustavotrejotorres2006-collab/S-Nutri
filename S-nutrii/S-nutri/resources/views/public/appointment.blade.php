@extends('layouts.public')

@section('title', 'Agendar cita')

@section('content')

<main class="public-main">

    <div class="public-form-wrapper">

        <div class="public-form-header">

            <p class="section-eyebrow">
                S-Nutri
            </p>

            <h1>
                Agendar cita
            </h1>

            <p>
                Completa tus datos para solicitar una consulta.
            </p>

        </div>


        <form
            action="{{ route('public.appointment.store') }}"
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


                        <div class="form-group full">

                            <label
                                for="email"
                                class="form-label form-label-required"
                            >
                                Correo electrónico
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

                    </div>

                </div>

            </section>


            {{-- Cita --}}
            <section class="form-section">

                <div class="form-section-header">

                    <div class="form-section-number">
                        2
                    </div>

                    <h2 class="form-section-title">
                        Datos de la cita
                    </h2>

                </div>


                <div class="form-section-body">

                    <div class="form-grid">

                        <div class="form-group">

                            <label
                                for="appointment_date"
                                class="form-label form-label-required"
                            >
                                Fecha
                            </label>

                            <input
                                type="date"
                                id="appointment_date"
                                name="appointment_date"
                                class="form-control"
                                value="{{ old('appointment_date') }}"
                                min="{{ now()->format('Y-m-d') }}"
                                required
                            >

                        </div>


                        <div class="form-group">

                            <label
                                for="appointment_time"
                                class="form-label form-label-required"
                            >
                                Hora
                            </label>

                            <input
                                type="time"
                                id="appointment_time"
                                name="appointment_time"
                                class="form-control"
                                value="{{ old('appointment_time') }}"
                                required
                            >

                        </div>


                        <div class="form-group full">

                            <label
                                for="reason"
                                class="form-label"
                            >
                                Motivo de consulta
                            </label>

                            <input
                                type="text"
                                id="reason"
                                name="reason"
                                class="form-control"
                                value="{{ old('reason') }}"
                                placeholder="Ej. Primera consulta, seguimiento..."
                            >

                        </div>


                        <div class="form-group full">

                            <label
                                for="notes"
                                class="form-label"
                            >
                                Comentarios adicionales
                            </label>

                            <textarea
                                id="notes"
                                name="notes"
                                class="form-control"
                                placeholder="Información que consideres importante..."
                            >{{ old('notes') }}</textarea>

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

                    <x-icon name="calendar" />

                    Solicitar cita

                </button>

            </div>

        </form>

    </div>

</main>

@endsection