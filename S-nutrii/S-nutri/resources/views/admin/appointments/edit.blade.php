@extends('layouts.admin')

@section('title', 'Editar cita')

@section('content')

<div class="page-header">

    <div class="page-header-content">

        <h1 class="page-title">
            Editar cita
        </h1>

        <p class="page-description">
            Modifica la fecha, hora, cliente o estado de la cita.
        </p>

    </div>

</div>


<div class="card">

    <div class="card-body">

        <form
            action="{{ route('admin.appointments.update', $appointment) }}"
            method="POST"
            data-prevent-double-submit
        >

            @csrf
            @method('PUT')


            <div class="form-grid">

                {{-- Cliente --}}
                <div class="form-group full">

                    <label
                        for="user_id"
                        class="form-label form-label-required"
                    >
                        Cliente
                    </label>

                    <select
                        id="user_id"
                        name="user_id"
                        class="form-control"
                        required
                    >

                        @foreach($clients as $client)

                            <option
                                value="{{ $client->id }}"
                                @selected(
                                    old(
                                        'user_id',
                                        $appointment->user_id
                                    ) == $client->id
                                )
                            >

                                {{ $client->name }}

                                @if($client->phone)
                                    — {{ $client->phone }}
                                @endif

                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- Fecha --}}
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
                        value="{{ old(
                            'appointment_date',
                            \Carbon\Carbon::parse(
                                $appointment->appointment_date
                            )->format('Y-m-d')
                        ) }}"
                        required
                    >

                </div>


                {{-- Hora --}}
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
                        value="{{ old(
                            'appointment_time',
                            \Carbon\Carbon::parse(
                                $appointment->appointment_time
                            )->format('H:i')
                        ) }}"
                        required
                    >

                </div>


                {{-- Estado --}}
                <div class="form-group">

                    <label
                        for="status"
                        class="form-label form-label-required"
                    >
                        Estado
                    </label>

                    <select
                        id="status"
                        name="status"
                        class="form-control"
                        required
                    >

                        <option
                            value="pending"
                            @selected(
                                old(
                                    'status',
                                    $appointment->status
                                ) === 'pending'
                            )
                        >
                            Pendiente
                        </option>

                        <option
                            value="confirmed"
                            @selected(
                                old(
                                    'status',
                                    $appointment->status
                                ) === 'confirmed'
                            )
                        >
                            Confirmada
                        </option>

                        <option
                            value="suspended"
                            @selected(
                                old(
                                    'status',
                                    $appointment->status
                                ) === 'suspended'
                            )
                        >
                            Suspendida
                        </option>

                        <option
                            value="cancelled"
                            @selected(
                                old(
                                    'status',
                                    $appointment->status
                                ) === 'cancelled'
                            )
                        >
                            Cancelada
                        </option>

                    </select>

                </div>


                {{-- Motivo --}}
                <div class="form-group">

                    <label
                        for="reason"
                        class="form-label"
                    >
                        Motivo
                    </label>

                    <input
                        type="text"
                        id="reason"
                        name="reason"
                        class="form-control"
                        value="{{ old(
                            'reason',
                            $appointment->reason
                        ) }}"
                    >

                </div>


                {{-- Notas --}}
                <div class="form-group full">

                    <label
                        for="notes"
                        class="form-label"
                    >
                        Observaciones
                    </label>

                    <textarea
                        id="notes"
                        name="notes"
                        class="form-control"
                    >{{ old(
                        'notes',
                        $appointment->notes
                    ) }}</textarea>

                </div>


                {{-- Notas de estado --}}
                <div class="form-group full">

                    <label
                        for="status_notes"
                        class="form-label"
                    >
                        Notas del estado
                    </label>

                    <textarea
                        id="status_notes"
                        name="status_notes"
                        class="form-control"
                    >{{ old(
                        'status_notes',
                        $appointment->status_notes
                    ) }}</textarea>

                </div>

            </div>


            <div class="form-actions">

                <a
                    href="{{ route(
                        'admin.appointments.show',
                        $appointment
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

                    Guardar cambios

                </button>

            </div>

        </form>

    </div>

</div>

@endsection