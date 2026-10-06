@extends('layouts.app')

@section('body')

<div class="admin-layout">

    {{-- Overlay para móvil --}}
    <div
        class="sidebar-overlay"
        data-sidebar-overlay
    ></div>


    {{-- ==========================================================
         SIDEBAR
    =========================================================== --}}

    <aside class="sidebar">

        <div class="sidebar-header">

            <a
                href="{{ route('admin.dashboard') }}"
                class="sidebar-brand"
            >

                <div class="brand-mark">

                    <x-icon
                        name="activity"
                        size="lg"
                    />

                </div>

                <div class="brand-text">

                    <p class="brand-name">
                        S-NUTRI
                    </p>

                    <p class="brand-subtitle">
                        Gestión nutricional
                    </p>

                </div>

            </a>

        </div>


        {{-- Navegación --}}
        <nav class="sidebar-nav">

            <div class="nav-section">

                <p class="nav-section-title">
                    Principal
                </p>

                <ul class="nav-list">

                    <li>

                        <a
                            href="{{ route('admin.dashboard') }}"
                            class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                        >

                            <x-icon name="dashboard" />

                            <span class="nav-link-text">
                                Dashboard
                            </span>

                        </a>

                    </li>


                    <li>

                        <a
                            href="{{ route('admin.appointments.index') }}"
                            class="nav-link {{ request()->routeIs('admin.appointments.index', 'admin.appointments.show', 'admin.appointments.edit') ? 'active' : '' }}"
                        >

                            <x-icon name="calendar" />

                            <span class="nav-link-text">
                                Citas
                            </span>

                        </a>

                    </li>


                    <li>

                        <a
                            href="{{ route('admin.appointments.calendar') }}"
                            class="nav-link {{ request()->routeIs('admin.appointments.calendar') ? 'active' : '' }}"
                        >

                            <x-icon name="calendar-days" />

                            <span class="nav-link-text">
                                Calendario
                            </span>

                        </a>

                    </li>


                    <li>

                        <a
                            href="{{ route('admin.clients.index') }}"
                            class="nav-link {{ request()->routeIs('admin.clients.*') ? 'active' : '' }}"
                        >

                            <x-icon name="users" />

                            <span class="nav-link-text">
                                Clientes
                            </span>

                        </a>

                    </li>

                </ul>

            </div>


            <div class="nav-section">

                <p class="nav-section-title">
                    Administración
                </p>

                <ul class="nav-list">

                    <li>

                        <a
                            href="{{ route('admin.clients.create') }}"
                            class="nav-link"
                        >

                            <x-icon name="user-plus" />

                            <span class="nav-link-text">
                                Nuevo cliente
                            </span>

                        </a>

                    </li>

                </ul>

            </div>

        </nav>


        {{-- Usuario --}}
        <div class="sidebar-footer">

            <div class="sidebar-user">

                <div class="sidebar-user-avatar">

                    {{ strtoupper(
                        substr(auth()->user()->name ?? 'N', 0, 1)
                    ) }}

                </div>

                <div class="sidebar-user-info">

                    <p class="sidebar-user-name">

                        {{ auth()->user()->name ?? 'Nutriólogo' }}

                    </p>

                    <p class="sidebar-user-role">
                        Nutriólogo
                    </p>

                </div>

            </div>

        </div>

    </aside>


    {{-- ==========================================================
         CONTENIDO
    =========================================================== --}}

    <main class="main-content">


        {{-- Topbar --}}
        <header class="topbar">

            <div class="topbar-left">

                <button
                    type="button"
                    class="icon-button mobile-menu-button"
                    data-sidebar-toggle
                    aria-label="Abrir menú"
                >

                    <x-icon name="menu" />

                </button>

            </div>


            <div class="topbar-right">

                {{-- Tema --}}
                <button
                    type="button"
                    class="theme-toggle"
                    data-theme-toggle
                    aria-label="Activar modo oscuro"
                    title="Activar modo oscuro"
                >

                    <span class="theme-icon-light">
                        <x-icon name="sun" />
                    </span>

                    <span class="theme-icon-dark">
                        <x-icon name="moon" />
                    </span>

                </button>


                {{-- Logout --}}
                <form
                    action="{{ route('logout') }}"
                    method="POST"
                >

                    @csrf

                    <button
                        type="submit"
                        class="icon-button"
                        data-logout
                        aria-label="Cerrar sesión"
                        title="Cerrar sesión"
                    >

                        <x-icon name="log-out" />

                    </button>

                </form>

            </div>

        </header>


        {{-- Contenido --}}
        <div class="page-content">

            @if(session('success'))

                <x-alert
                    type="success"
                    :message="session('success')"
                />

            @endif


            @if(session('error'))

                <x-alert
                    type="error"
                    :message="session('error')"
                />

            @endif


            @if($errors->any())

                <div
                    class="alert alert-error"
                    data-alert
                >

                    <x-icon name="alert-circle" />

                    <div class="alert-content">

                        <p class="alert-title">
                            Revisa la información
                        </p>

                        <ul>
                            @foreach($errors->all() as $error)

                                <li>
                                    {{ $error }}
                                </li>

                            @endforeach
                        </ul>

                    </div>

                    <button
                        type="button"
                        class="icon-button"
                        data-alert-close
                    >

                        <x-icon
                            name="x"
                            size="sm"
                        />

                    </button>

                </div>

            @endif


            @yield('content')

        </div>

    </main>

</div>

@endsection