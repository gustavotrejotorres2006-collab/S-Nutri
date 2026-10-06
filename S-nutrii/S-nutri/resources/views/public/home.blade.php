@extends('layouts.public')

@section('title', 'Inicio')

@section('content')

<main class="public-main">

    {{-- Hero --}}
    <section class="hero">

        <div>

            <p class="hero-eyebrow">

                <x-icon
                    name="activity"
                    size="sm"
                />

                Atención nutricional

            </p>


            <h1 class="hero-title">

                Tu salud.
                <br>

                Tu bienestar.
                <br>

                <span>Tu mejor versión.</span>

            </h1>


            <p class="hero-description">

                En S-Nutri encontrarás un espacio para llevar
                seguimiento de tus objetivos nutricionales,
                agendar consultas y proporcionar la información
                necesaria para una atención personalizada.

            </p>


            <div class="hero-actions">

                <a
                    href="{{ route('public.appointment') }}"
                    class="btn btn-primary btn-lg"
                >

                    <x-icon name="calendar" />

                    Agendar cita

                </a>


                <a
                    href="#servicios"
                    class="btn btn-secondary btn-lg"
                >

                    Conocer servicios

                </a>

            </div>

        </div>


        <div class="hero-card">

            <h2 class="hero-card-title">
                Atención personalizada
            </h2>


            <div class="hero-feature">

                <div class="hero-feature-icon">

                    <x-icon name="calendar" />

                </div>

                <div>

                    <p class="hero-feature-title">
                        Agenda tu consulta
                    </p>

                    <p class="hero-feature-text">
                        Selecciona la fecha y horario de tu preferencia.
                    </p>

                </div>

            </div>


            <div class="hero-feature">

                <div class="hero-feature-icon">

                    <x-icon name="file-text" />

                </div>

                <div>

                    <p class="hero-feature-title">
                        Formulario clínico
                    </p>

                    <p class="hero-feature-text">
                        Comparte información relevante para tu consulta.
                    </p>

                </div>

            </div>


            <div class="hero-feature">

                <div class="hero-feature-icon">

                    <x-icon name="heart" />

                </div>

                <div>

                    <p class="hero-feature-title">
                        Seguimiento
                    </p>

                    <p class="hero-feature-text">
                        Atención enfocada en tus necesidades y objetivos.
                    </p>

                </div>

            </div>

        </div>

    </section>


    {{-- Servicios --}}
    <section
        id="servicios"
        class="public-section"
    >

        <div class="section-heading">

            <p class="section-eyebrow">
                Lo que ofrecemos
            </p>

            <h2 class="section-title">
                Servicios de S-Nutri
            </h2>

            <p class="section-description">
                Herramientas para facilitar tu atención nutricional.
            </p>

        </div>


        <div class="services-grid">

            <article class="service-card">

                <div class="service-icon">

                    <x-icon name="calendar" />

                </div>

                <h3 class="service-title">
                    Consulta nutricional
                </h3>

                <p class="service-description">
                    Agenda una consulta con el nutriólogo
                    de acuerdo con la disponibilidad.
                </p>

            </article>


            <article class="service-card">

                <div class="service-icon">

                    <x-icon name="file-text" />

                </div>

                <h3 class="service-title">
                    Evaluación clínica
                </h3>

                <p class="service-description">
                    Proporciona información sobre tus
                    antecedentes, hábitos y objetivos.
                </p>

            </article>


            <article class="service-card">

                <div class="service-icon">

                    <x-icon name="activity" />

                </div>

                <h3 class="service-title">
                    Seguimiento nutricional
                </h3>

                <p class="service-description">
                    Lleva un seguimiento organizado de
                    tus consultas e información clínica.
                </p>

            </article>

        </div>

    </section>


    {{-- Contacto --}}
    <section
        id="contacto"
        class="public-section"
    >

        <div class="section-heading">

            <p class="section-eyebrow">
                Contacto
            </p>

            <h2 class="section-title">
                Estamos para ayudarte
            </h2>

        </div>


        <div class="contact-grid">

            <div class="contact-card">

                <div class="contact-icon">
                    <x-icon name="phone" />
                </div>

                <h3 class="contact-title">
                    Teléfono
                </h3>

                <p class="contact-text">
                    595 123 4567
                </p>

            </div>


            <div class="contact-card">

                <div class="contact-icon">
                    <x-icon name="mail" />
                </div>

                <h3 class="contact-title">
                    Correo
                </h3>

                <p class="contact-text">
                    contacto@s-nutri.test
                </p>

            </div>


            <div class="contact-card">

                <div class="contact-icon">
                    <x-icon name="clock" />
                </div>

                <h3 class="contact-title">
                    Atención
                </h3>

                <p class="contact-text">
                    Consulta disponibilidad al agendar.
                </p>

            </div>

        </div>

    </section>

</main>

@endsection