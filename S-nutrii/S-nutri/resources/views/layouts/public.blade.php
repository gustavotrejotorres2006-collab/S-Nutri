@extends('layouts.app')

@section('body')

<div class="public-layout">

    <header class="public-header">

        <a
            href="{{ route('home') }}"
            class="public-brand"
        >

            <div class="public-brand-mark">

                <x-icon name="activity" />

            </div>

            <p class="public-brand-name">
                S-NUTRI
            </p>

        </a>


        <nav class="public-nav">

            <a
                href="{{ route('home') }}"
                class="public-nav-link {{ request()->routeIs('home') ? 'active' : '' }}"
            >
                Inicio
            </a>

            <a
                href="{{ route('public.appointment') }}"
                class="public-nav-link {{ request()->routeIs('public.appointment') ? 'active' : '' }}"
            >
                Agendar cita
            </a>

            <a
                href="{{ route('public.clinical-form') }}"
                class="public-nav-link {{ request()->routeIs('public.clinical-form') ? 'active' : '' }}"
            >
                Formulario clínico
            </a>

            <a
                href="{{ route('login') }}"
                class="btn btn-primary btn-sm"
            >
                Inicio de sesión
            </a>

        </nav>


        <button
            type="button"
            class="theme-toggle"
            data-theme-toggle
            aria-label="Activar modo oscuro"
        >

            <span class="theme-icon-light">
                <x-icon name="sun" />
            </span>

            <span class="theme-icon-dark">
                <x-icon name="moon" />
            </span>

        </button>

    </header>


    @if(session('success'))

        <div class="public-main" style="padding-top: 20px;">

            <x-alert
                type="success"
                :message="session('success')"
            />

        </div>

    @endif


    @if(session('error'))

        <div class="public-main" style="padding-top: 20px;">

            <x-alert
                type="error"
                :message="session('error')"
            />

        </div>

    @endif


    @yield('content')

</div>

@endsection