@extends('layouts.admin')

@section('title', 'Citas')

@section('content')

<div class="page-header">

    <div class="page-header-content">

        <h1 class="page-title">
            Citas
        </h1>

        <p class="page-description">
            Administra y revisa todas las citas.
        </p>

    </div>


    <div class="page-actions">

        <a
            href="{{ route('admin.appointments.calendar') }}"
            class="btn btn-secondary"
        >

            <x-icon name="calendar-days" />

            Calendario

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


<div class="card table-card">


    <div class="card-header">

        <div>

            <h2 class="card-title">
                Agenda
            </h2>

            <p class="card-description">
                Filtra las citas por cliente o estado.
            </p>

        </div>

    </div>


    <div class="card-body">

        <form
            method="GET"
            action="{{ route('admin.appointments.index') }}"
            class="filter-bar"
        >

            <div class="search-box">

                <x-icon
                    name="search"
                    size="sm"
                />

                <input
                    type="search"
                    name="search"
                    class="form-control"
                    value="{{ $search }}"
                    placeholder="Buscar cliente..."
                >

            </div>


            <select
                name="status"
                class="form-control"
                style="max-width:180px;"
                data-auto-submit
            >

                <option value="">
                    Todos los estados
                </option>

                <option
                    value="pending"
                    @selected($status === 'pending')
                >
                    Pendientes
                </option>

                <option
                    value="confirmed"
                    @selected($status === 'confirmed')
                >
                    Confirmadas
                </option>

                <option
                    value="suspended"
                    @selected($status === 'suspended')
                >
                    Suspendidas
                </option>

                <option
                    value="cancelled"
                    @selected($status === 'cancelled')
                >
                    Canceladas
                </option>

            </select>


            <button
                type="submit"
                class="btn btn-primary"
            >

                <x-icon
                    name="search"
                    size="sm"
                />

                Buscar

            </button>


            @if($search || $status)

                <a
                    href="{{ route('admin.appointments.index') }}"
                    class="btn btn-secondary"
                >
                    Limpiar
                </a>

            @endif

        </form>

    </div>


    @if($appointments->count())

        <div class="table-wrapper">

            <table class="table">

                <thead>

                    <tr>

                        <th>
                            Cliente
                        </th>

                        <th>
                            Fecha
                        </th>

                        <th>
                            Hora
                        </th>

                        <th>
                            Motivo
                        </th>

                        <th>
                            Estado
                        </th>

                        <th>
                            Acciones
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @foreach($appointments as $appointment)

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

                                {{ \Carbon\Carbon::parse(
                                    $appointment->appointment_date
                                )->format('d/m/Y') }}

                            </td>


                            <td>

                                <strong>

                                    {{ \Carbon\Carbon::parse(
                                        $appointment->appointment_time
                                    )->format('H:i') }}

                                </strong>

                            </td>


                            <td>

                                {{ $appointment->reason ?: '—' }}

                            </td>


                            <td>

                                <x-badge
                                    :status="$appointment->status"
                                />

                            </td>


                            <td>

                                <div class="table-actions">

                                    <a
                                        href="{{ route('admin.appointments.show', $appointment) }}"
                                        class="icon-button"
                                        title="Ver"
                                    >

                                        <x-icon
                                            name="eye"
                                            size="sm"
                                        />

                                    </a>


                                    <a
                                        href="{{ route('admin.appointments.edit', $appointment) }}"
                                        class="icon-button"
                                        title="Editar"
                                    >

                                        <x-icon
                                            name="edit"
                                            size="sm"
                                        />

                                    </a>


                                    @if($appointment->status !== 'confirmed')

                                        <form
                                            action="{{ route('admin.appointments.confirm', $appointment) }}"
                                            method="POST"
                                        >

                                            @csrf
                                            @method('PATCH')

                                            <button
                                                type="submit"
                                                class="icon-button"
                                                title="Confirmar"
                                                data-confirm="¿Confirmar esta cita?"
                                            >

                                                <x-icon
                                                    name="check"
                                                    size="sm"
                                                />

                                            </button>

                                        </form>

                                    @endif

                                </div>

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>


        {{ $appointments->links('components.pagination') }}

    @else

        <div class="empty-state">

            <div class="empty-state-icon">

                <x-icon name="calendar" />

            </div>

            <h3 class="empty-state-title">
                No hay citas
            </h3>

            <p class="empty-state-text">
                No se encontraron citas con los filtros seleccionados.
            </p>

        </div>

    @endif

</div>

@endsection