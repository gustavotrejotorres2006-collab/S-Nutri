@extends('layouts.admin')

@section('title', 'Clientes')

@section('content')

<div class="page-header">

    <div class="page-header-content">

        <h1 class="page-title">
            Clientes
        </h1>

        <p class="page-description">
            Administra la información de tus clientes.
        </p>

    </div>


    <div class="page-actions">

        <a
            href="{{ route('admin.clients.create') }}"
            class="btn btn-primary"
        >

            <x-icon name="user-plus" />

            Nuevo cliente

        </a>

    </div>

</div>


<div class="card table-card">


    <div class="card-header">

        <div>

            <h2 class="card-title">
                Lista de clientes
            </h2>

            <p class="card-description">
                Consulta sus datos e historial.
            </p>

        </div>

    </div>


    <div class="card-body">

        <form
            method="GET"
            action="{{ route('admin.clients.index') }}"
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
                    placeholder="Buscar por nombre, teléfono o correo..."
                >

            </div>


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


            @if($search)

                <a
                    href="{{ route('admin.clients.index') }}"
                    class="btn btn-secondary"
                >
                    Limpiar
                </a>

            @endif

        </form>

    </div>


    @if($clients->count())

        <div class="table-wrapper">

            <table class="table">

                <thead>

                    <tr>

                        <th>
                            Cliente
                        </th>

                        <th>
                            Teléfono
                        </th>

                        <th>
                            Correo
                        </th>

                        <th>
                            Formulario
                        </th>

                        <th>
                            Estado
                        </th>

                        <th>
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @foreach($clients as $client)

                        <tr>

                            <td>

                                <div class="user-cell">

                                    <div class="user-avatar">

                                        {{ strtoupper(
                                            substr(
                                                $client->name,
                                                0,
                                                1
                                            )
                                        ) }}

                                    </div>

                                    <div class="user-cell-info">

                                        <p class="user-cell-name">
                                            {{ $client->name }}
                                        </p>

                                        <p class="user-cell-meta">
                                            Cliente
                                        </p>

                                    </div>

                                </div>

                            </td>


                            <td>
                                {{ $client->phone ?: '—' }}
                            </td>


                            <td>
                                {{ $client->email ?: '—' }}
                            </td>


                            <td>

                                @if($client->clinicalForm)

                                    <span class="badge badge-confirmed">
                                        <span class="badge-dot"></span>
                                        Completo
                                    </span>

                                @else

                                    <span class="badge badge-pending">
                                        <span class="badge-dot"></span>
                                        Pendiente
                                    </span>

                                @endif

                            </td>


                            <td>

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

                            </td>


                            <td>

                                <div class="table-actions">

                                    <a
                                        href="{{ route('admin.clients.show', $client) }}"
                                        class="icon-button"
                                        title="Ver cliente"
                                    >

                                        <x-icon
                                            name="eye"
                                            size="sm"
                                        />

                                    </a>


                                    <a
                                        href="{{ route('admin.clients.edit', $client) }}"
                                        class="icon-button"
                                        title="Editar cliente"
                                    >

                                        <x-icon
                                            name="edit"
                                            size="sm"
                                        />

                                    </a>

                                </div>

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>


        {{ $clients->links('components.pagination') }}

    @else

        <div class="empty-state">

            <div class="empty-state-icon">

                <x-icon name="users" />

            </div>

            <h3 class="empty-state-title">
                No hay clientes
            </h3>

            <p class="empty-state-text">
                No se encontraron clientes con los criterios seleccionados.
            </p>

        </div>

    @endif

</div>

@endsection