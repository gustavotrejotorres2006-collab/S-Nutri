@extends('layouts.admin')

@section('title', $client->name)

@section('content')

<div class="page-header">

    <div class="page-header-content">

        <h1 class="page-title">
            {{ $client->name }}
        </h1>

        <p class="page-description">
            Información general e historial del cliente.
        </p>

    </div>


    <div class="page-actions">

        <a
            href="{{ route('admin.clients.edit', $client) }}"
            class="btn btn-secondary"
        >

            <x-icon name="edit" />

            Editar

        </a>

        <a
            href="{{ route('admin.clinical-forms.show', $client) }}"
            class="btn btn-primary"
        >

            <x-icon name="file-text" />

            Formulario clínico

        </a>

    </div>

</div>


<div class="dashboard-grid">


    {{-- Datos --}}
    <div class="card">

        <div class="card-header">

            <div>

                <h2 class="card-title">
                    Información del cliente
                </h2>

            </div>

        </div>


        <div class="card-body">

            <div class="detail-grid">

                <div class="detail-item">

                    <span class="detail-label">
                        Nombre
                    </span>

                    <p class="detail-value">
                        {{ $client->name }}
                    </p>

                </div>


                <div class="detail-item">

                    <span class="detail-label">
                        Estado
                    </span>

                    <p class="detail-value">

                        @if($client->active)

                            <span class="badge badge-confirmed">
                                <span class="badge-dot"></span>
                                Activo
                            </span>

                        @else

                            <span class="badge badge-cancelled">
                                <span class="badge-dot"></span>
                                Inactivo
                            </span>

                        @endif

                    </p>

                </div>


                <div class="detail-item">

                    <span class="detail-label">
                        Teléfono
                    </span>

                    <p class="detail-value">
                        {{ $client->phone ?: 'No registrado' }}
                    </p>

                </div>


                <div class="detail-item">

                    <span class="detail-label">
                        Correo
                    </span>

                    <p class="detail-value">
                        {{ $client->email ?: 'No registrado' }}
                    </p>

                </div>


                <div class="detail-item">

                    <span class="detail-label">
                        Formulario clínico
                    </span>

                    <p class="detail-value">

                        @if($client->clinicalForm)

                            <span class="badge badge-confirmed">
                                <span class="badge-dot"></span>
                                Disponible
                            </span>

                        @else

                            <span class="badge badge-pending">
                                <span class="badge-dot"></span>
                                Pendiente
                            </span>

                        @endif

                    </p>

                </div>

            </div>

        </div>

    </div>


    {{-- Citas --}}
    <div class="card table-card">

        <div class="card-header">

            <div>

                <h2 class="card-title">
                    Historial de citas
                </h2>

                <p class="card-description">
                    Citas registradas del cliente.
                </p>

            </div>

        </div>


        @if($client->appointments->count())

            <div class="table-wrapper">

                <table class="table">

                    <thead>

                        <tr>

                            <th>
                                Fecha
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

                        @foreach($client->appointments as $appointment)

                            <tr>

                                <td>

                                    {{ \Carbon\Carbon::parse(
                                        $appointment->appointment_date
                                    )->format('d/m/Y') }}

                                </td>

                                <td>

                                    {{ \Carbon\Carbon::parse(
                                        $appointment->appointment_time
                                    )->format('H:i') }}

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

                <p class="empty-state-text">
                    Este cliente todavía no tiene citas.
                </p>

            </div>

        @endif

    </div>

</div>

@endsection