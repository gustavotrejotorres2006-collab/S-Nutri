@extends('layouts.admin')

@section('title', 'Detalle de cita')

@section('content')

<div class="page-header">

    <div class="page-header-content">

        <h1 class="page-title">
            Detalle de cita
        </h1>

        <p class="page-description">
            Información de la consulta y del cliente.
        </p>

    </div>


    <div class="page-actions">

        <a
            href="{{ route('admin.appointments.edit', $appointment) }}"
            class="btn btn-secondary"
        >

            <x-icon name="edit" />

            Editar cita

        </a>

        <a
            href="{{ route('admin.clients.show', $appointment->user) }}"
            class="btn btn-primary"
        >

            <x-icon name="user" />

            Ver cliente

        </a>

    </div>

</div>


<div class="dashboard-grid">


    {{-- Información de cita --}}
    <div class="card">

        <div class="card-header">

            <div>

                <h2 class="card-title">
                    Información de la cita
                </h2>

            </div>

            <x-badge
                :status="$appointment->status"
            />

        </div>


        <div class="card-body">

            <div class="detail-grid">

                <div class="detail-item">

                    <span class="detail-label">
                        Fecha
                    </span>

                    <p class="detail-value">

                        {{ \Carbon\Carbon::parse(
                            $appointment->appointment_date
                        )->format('d/m/Y') }}

                    </p>

                </div>


                <div class="detail-item">

                    <span class="detail-label">
                        Hora
                    </span>

                    <p class="detail-value">

                        {{ \Carbon\Carbon::parse(
                            $appointment->appointment_time
                        )->format('H:i') }}

                    </p>

                </div>


                <div class="detail-item">

                    <span class="detail-label">
                        Motivo
                    </span>

                    <p class="detail-value">
                        {{ $appointment->reason ?: 'No especificado' }}
                    </p>

                </div>


                <div class="detail-item">

                    <span class="detail-label">
                        Observaciones
                    </span>

                    <p class="detail-value multiline">
                        {{ $appointment->notes ?: 'Sin observaciones' }}
                    </p>

                </div>


                <div class="detail-item">

                    <span class="detail-label">
                        Notas del estado
                    </span>

                    <p class="detail-value multiline">
                        {{ $appointment->status_notes ?: 'Sin notas' }}
                    </p>

                </div>

            </div>

        </div>


        <div class="card-footer">

            <div class="page-actions">


                @if($appointment->status !== 'confirmed')

                    <form
                        action="{{ route('admin.appointments.confirm', $appointment) }}"
                        method="POST"
                    >

                        @csrf
                        @method('PATCH')

                        <button
                            type="submit"
                            class="btn btn-success"
                            data-confirm="¿Confirmar esta cita?"
                        >

                            <x-icon name="check" />

                            Confirmar cita

                        </button>

                    </form>

                @endif


                @if(
                    $appointment->status !== 'suspended' &&
                    $appointment->status !== 'cancelled'
                )

                    <button
                        type="button"
                        class="btn btn-danger"
                        data-modal-open="suspendAppointmentModal"
                    >

                        <x-icon name="x" />

                        Suspender

                    </button>

                @endif

            </div>

        </div>

    </div>


    {{-- Cliente --}}
    <div class="card">

        <div class="card-header">

            <div>

                <h2 class="card-title">
                    Cliente
                </h2>

                <p class="card-description">
                    Datos del paciente.
                </p>

            </div>

        </div>


        <div class="card-body">

            <div class="detail-grid">

                <div class="detail-item">

                    <span class="detail-label">
                        Nombre
                    </span>

                    <p class="detail-value">
                        {{ $appointment->user->name }}
                    </p>

                </div>


                <div class="detail-item">

                    <span class="detail-label">
                        Teléfono
                    </span>

                    <p class="detail-value">
                        {{ $appointment->user->phone ?: '—' }}
                    </p>

                </div>


                <div class="detail-item">

                    <span class="detail-label">
                        Correo
                    </span>

                    <p class="detail-value">
                        {{ $appointment->user->email ?: '—' }}
                    </p>

                </div>


                <div class="detail-item">

                    <span class="detail-label">
                        Formulario
                    </span>

                    <p class="detail-value">

                        @if($appointment->user->clinicalForm)

                            <a
                                href="{{ route(
                                    'admin.clinical-forms.show',
                                    $appointment->user
                                ) }}"
                                class="btn btn-secondary btn-sm"
                            >

                                <x-icon
                                    name="file-text"
                                    size="sm"
                                />

                                Ver formulario

                            </a>

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

</div>


{{-- Modal suspensión --}}
<div
    id="suspendAppointmentModal"
    class="modal-backdrop"
>

    <div class="modal">

        <div class="modal-header">

            <h2 class="modal-title">
                Suspender cita
            </h2>

            <button
                type="button"
                class="icon-button"
                data-modal-close
            >

                <x-icon
                    name="x"
                    size="sm"
                />

            </button>

        </div>


        <form
            action="{{ route(
                'admin.appointments.suspend',
                $appointment
            ) }}"
            method="POST"
        >

            @csrf
            @method('PATCH')


            <div class="modal-body">

                <div class="form-group">

                    <label
                        for="status_notes"
                        class="form-label"
                    >
                        Motivo de suspensión
                    </label>

                    <textarea
                        id="status_notes"
                        name="status_notes"
                        class="form-control"
                        placeholder="Indica el motivo..."
                    ></textarea>

                </div>

            </div>


            <div class="modal-footer">

                <button
                    type="button"
                    class="btn btn-secondary"
                    data-modal-close
                >
                    Cancelar
                </button>

                <button
                    type="submit"
                    class="btn btn-danger"
                >

                    <x-icon
                        name="x"
                        size="sm"
                    />

                    Suspender cita

                </button>

            </div>

        </form>

    </div>

</div>

@endsection