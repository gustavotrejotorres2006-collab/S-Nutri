@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

<div class="page-header">

    <div class="page-header-content">

        <h1 class="page-title">
            Dashboard
        </h1>

        <p class="page-description">
            Resumen general de tu consulta nutricional.
        </p>

    </div>


    <div class="page-actions">

        <a
            href="{{ route('admin.appointments.calendar') }}"
            class="btn btn-secondary"
        >

            <x-icon name="calendar-days" />

            Ver calendario

        </a>

        <a
            href="{{ route('public.appointment') }}"
            class="btn btn-primary"
            target="_blank"
        >

            <x-icon name="plus" />

            Nueva cita

        </a>

    </div>

</div>


{{-- Estadísticas --}}
<div class="stats-grid">


    <div class="stat-card">

        <div class="stat-card-top">

            <div>

                <p class="stat-label">
                    Clientes activos
                </p>

                <p class="stat-value">
                    {{ $statistics['clients'] }}
                </p>

            </div>

            <div class="stat-icon">
                <x-icon name="users" />
            </div>

        </div>

        <p class="stat-meta">
            Clientes registrados
        </p>

    </div>


    <div class="stat-card">

        <div class="stat-card-top">

            <div>

                <p class="stat-label">
                    Citas de hoy
                </p>

                <p class="stat-value">
                    {{ $statistics['appointments_today'] }}
                </p>

            </div>

            <div class="stat-icon">
                <x-icon name="calendar" />
            </div>

        </div>

        <p class="stat-meta">
            Agenda del día
        </p>

    </div>


    <div class="stat-card">

        <div class="stat-card-top">

            <div>

                <p class="stat-label">
                    Pendientes
                </p>

                <p class="stat-value">
                    {{ $statistics['pending_appointments'] }}
                </p>

            </div>

            <div class="stat-icon">
                <x-icon name="clock" />
            </div>

        </div>

        <p class="stat-meta">
            Requieren revisión
        </p>

    </div>


    <div class="stat-card">

        <div class="stat-card-top">

            <div>

                <p class="stat-label">
                    Confirmadas
                </p>

                <p class="stat-value">
                    {{ $statistics['confirmed_appointments'] }}
                </p>

            </div>

            <div class="stat-icon">
                <x-icon name="check" />
            </div>

        </div>

        <p class="stat-meta">
            Citas confirmadas
        </p>

    </div>

</div>


{{-- Contenido --}}
<div class="dashboard-grid">


    {{-- Citas de hoy --}}
    <div class="card table-card">

        <div class="card-header">

            <div>

                <h2 class="card-title">
                    Citas de hoy
                </h2>

                <p class="card-description">
                    Agenda del día actual.
                </p>

            </div>

            <a
                href="{{ route('admin.appointments.index') }}"
                class="btn btn-secondary btn-sm"
            >
                Ver todas
            </a>

        </div>


        @if($todayAppointments->count())

            <div class="table-wrapper">

                <table class="table">

                    <thead>

                        <tr>

                            <th>
                                Cliente
                            </th>

                            <th>
                                Hora
                            </th>

                            <th>
                                Estado
                            </th>

                            <th>
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach($todayAppointments as $appointment)

                            <tr>

                                <td>

                                    <div class="user-cell">

                                        <div class="user-avatar">

                                            {{ strtoupper(
                                                substr(
                                                    $appointment->user->name,
                                                    0,
                                                    1
                                                )
                                            ) }}

                                        </div>

                                        <div class="user-cell-info">

                                            <p class="user-cell-name">
                                                {{ $appointment->user->name }}
                                            </p>

                                            <p class="user-cell-meta">
                                                {{ $appointment->user->phone }}
                                            </p>

                                        </div>

                                    </div>

                                </td>


                                <td>

                                    <strong>
                                        {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('H:i') }}
                                    </strong>

                                </td>


                                <td>

                                    <x-badge
                                        :status="$appointment->status"
                                    />

                                </td>


                                <td>

                                    <a
                                        href="{{ route('admin.appointments.show', $appointment) }}"
                                        class="icon-button"
                                        title="Ver cita"
                                    >

                                        <x-icon
                                            name="eye"
                                            size="sm"
                                        />

                                    </a>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        @else

            <div class="empty-state">

                <div class="empty-state-icon">

                    <x-icon name="calendar" />

                </div>

                <h3 class="empty-state-title">
                    No hay citas para hoy
                </h3>

                <p class="empty-state-text">
                    No existen citas registradas para la fecha actual.
                </p>

            </div>

        @endif

    </div>


    {{-- Próximas citas --}}
    <div class="card">

        <div class="card-header">

            <div>

                <h2 class="card-title">
                    Próximas citas
                </h2>

                <p class="card-description">
                    Próximas atenciones.
                </p>

            </div>

        </div>


        <div class="card-body">

            @forelse($upcomingAppointments as $appointment)

                <a
                    href="{{ route('admin.appointments.show', $appointment) }}"
                    class="hero-feature"
                    style="display:flex;"
                >

                    <div class="hero-feature-icon">

                        <x-icon
                            name="calendar"
                            size="sm"
                        />

                    </div>

                    <div style="min-width:0;">

                        <p class="hero-feature-title">

                            {{ $appointment->user->name }}

                        </p>

                        <p class="hero-feature-text">

                            {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d/m/Y') }}

                            ·

                            {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('H:i') }}

                        </p>

                    </div>

                </a>

            @empty

                <div class="empty-state">

                    <div class="empty-state-icon">
                        <x-icon name="calendar" />
                    </div>

                    <p class="empty-state-text">
                        No hay próximas citas.
                    </p>

                </div>

            @endforelse

        </div>

    </div>

</div>

@endsection