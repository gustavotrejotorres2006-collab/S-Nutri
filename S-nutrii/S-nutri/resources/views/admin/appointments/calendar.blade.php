@extends('layouts.admin')

@section('title', 'Calendario')

@section('content')

<div class="page-header">

    <div class="page-header-content">

        <h1 class="page-title">
            Calendario
        </h1>

        <p class="page-description">
            Consulta visualmente las citas de tus clientes.
        </p>

    </div>


    <div class="page-actions">

        <a
            href="{{ route('admin.appointments.index') }}"
            class="btn btn-secondary"
        >

            <x-icon name="calendar" />

            Lista de citas

        </a>

    </div>

</div>


<div
    class="card calendar-card"
    data-calendar
    data-calendar-endpoint="{{ route('admin.appointments.calendar.data') }}"
>

    <div class="calendar-toolbar">

        <div class="calendar-controls">

            <button
                type="button"
                class="btn btn-secondary btn-sm"
                data-calendar-prev
                aria-label="Mes anterior"
            >

                <x-icon
                    name="chevron-left"
                    size="sm"
                />

            </button>


            <button
                type="button"
                class="btn btn-secondary btn-sm"
                data-calendar-today
            >
                Hoy
            </button>


            <button
                type="button"
                class="btn btn-secondary btn-sm"
                data-calendar-next
                aria-label="Mes siguiente"
            >

                <x-icon
                    name="chevron-right"
                    size="sm"
                />

            </button>

        </div>


        <h2
            class="calendar-title"
            data-calendar-title
        >
            Calendario
        </h2>


        <div class="calendar-controls">

            <span class="badge badge-pending">
                <span class="badge-dot"></span>
                Pendiente
            </span>

            <span class="badge badge-confirmed">
                <span class="badge-dot"></span>
                Confirmada
            </span>

            <span class="badge badge-suspended">
                <span class="badge-dot"></span>
                Suspendida
            </span>

            <span class="badge badge-cancelled">
                <span class="badge-dot"></span>
                Cancelada
            </span>

        </div>

    </div>


    <div
        class="calendar-grid"
        data-calendar-grid
    ></div>

</div>

@endsection