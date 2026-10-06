@extends('layouts.app')

@section('title', 'Inicio de sesión')

@section('body')

<div class="auth-page">

    <div class="auth-container">

        <div class="auth-brand">

            <div class="auth-brand-mark">

                <x-icon
                    name="activity"
                    size="xl"
                />

            </div>

            <h1 class="auth-brand-name">
                S-NUTRI
            </h1>

            <p class="auth-brand-description">
                Sistema de gestión nutricional
            </p>

        </div>


        <div class="auth-card">

            <h2 class="auth-title">
                Inicio de sesión
            </h2>

            <p class="auth-description">
                Accede al panel administrativo del nutriólogo.
            </p>


            @if(session('error'))

                <x-alert
                    type="error"
                    :message="session('error')"
                />

            @endif


            @if(session('success'))

                <x-alert
                    type="success"
                    :message="session('success')"
                />

            @endif


            <form
                action="{{ route('login.store') }}"
                method="POST"
                class="auth-form"
                data-prevent-double-submit
            >

                @csrf


                {{-- Correo --}}
                <div class="form-group">

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
                        placeholder="nutriologo@s-nutri.test"
                        autocomplete="email"
                        required
                        autofocus
                    >

                    @error('email')

                        <p class="form-error">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                {{-- Contraseña --}}
                <div class="form-group">

                    <label
                        for="password"
                        class="form-label form-label-required"
                    >
                        Contraseña
                    </label>

                    <div style="position: relative;">

                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="form-control"
                            placeholder="Ingresa tu contraseña"
                            autocomplete="current-password"
                            required
                            style="padding-right: 48px;"
                        >

                        <button
                            type="button"
                            class="icon-button"
                            data-password-toggle="password"
                            aria-label="Mostrar contraseña"
                            style="
                                position:absolute;
                                right:4px;
                                top:50%;
                                transform:translateY(-50%);
                                border:0;
                                background:transparent;
                            "
                        >

                            <x-icon
                                name="eye"
                                size="sm"
                            />

                        </button>

                    </div>

                    @error('password')

                        <p class="form-error">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                {{-- Recordar --}}
                <label
                    style="
                        display:flex;
                        align-items:center;
                        gap:8px;
                        color:var(--text-secondary);
                        font-size:12px;
                        cursor:pointer;
                    "
                >

                    <input
                        type="checkbox"
                        name="remember"
                        value="1"
                        style="accent-color:var(--cerulean);"
                    >

                    Mantener la sesión iniciada

                </label>


                <button
                    type="submit"
                    class="btn btn-primary btn-lg auth-submit"
                >

                    <x-icon
                        name="lock"
                        size="sm"
                    />

                    Iniciar sesión

                </button>

            </form>


            <div class="auth-footer">

                <a
                    href="{{ route('home') }}"
                    style="color:var(--cerulean);"
                >
                    Volver al sitio público
                </a>

            </div>

        </div>

    </div>

</div>

@endsection