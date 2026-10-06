@extends('layouts.admin')

@section('title', 'Editar cliente')

@section('content')

<div class="page-header">

    <div class="page-header-content">

        <h1 class="page-title">
            Editar cliente
        </h1>

        <p class="page-description">
            Actualiza la información de {{ $client->name }}.
        </p>

    </div>

</div>


<div class="card">

    <div class="card-body">

        <form
            action="{{ route('admin.clients.update', $client) }}"
            method="POST"
            data-prevent-double-submit
        >

            @csrf
            @method('PUT')


            <div class="form-grid">

                <div class="form-group full">

                    <label
                        for="name"
                        class="form-label form-label-required"
                    >
                        Nombre completo
                    </label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        class="form-control"
                        value="{{ old('name', $client->name) }}"
                        required
                    >

                </div>


                <div class="form-group">

                    <label
                        for="email"
                        class="form-label"
                    >
                        Correo electrónico
                    </label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="form-control"
                        value="{{ old('email', $client->email) }}"
                    >

                </div>


                <div class="form-group">

                    <label
                        for="phone"
                        class="form-label"
                    >
                        Teléfono
                    </label>

                    <input
                        type="tel"
                        id="phone"
                        name="phone"
                        class="form-control"
                        value="{{ old('phone', $client->phone) }}"
                    >

                </div>


                <div class="form-group">

                    <label
                        for="active"
                        class="form-label"
                    >
                        Estado
                    </label>

                    <select
                        id="active"
                        name="active"
                        class="form-control"
                    >

                        <option
                            value="1"
                            @selected(old('active', $client->active))
                        >
                            Activo
                        </option>

                        <option
                            value="0"
                            @selected(!old('active', $client->active))
                        >
                            Inactivo
                        </option>

                    </select>

                </div>

            </div>


            <div class="form-actions">

                <a
                    href="{{ route('admin.clients.show', $client) }}"
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