@extends('layouts.admin')

@section('title', 'Nuevo cliente')

@section('content')

<div class="page-header">

    <div class="page-header-content">

        <h1 class="page-title">
            Nuevo cliente
        </h1>

        <p class="page-description">
            Registra un nuevo cliente en S-Nutri.
        </p>

    </div>

</div>


<div class="card">

    <div class="card-body">

        <form
            action="{{ route('admin.clients.store') }}"
            method="POST"
            data-prevent-double-submit
        >

            @csrf


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
                        value="{{ old('name') }}"
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
                        value="{{ old('email') }}"
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
                        value="{{ old('phone') }}"
                    >

                </div>

            </div>


            <div class="form-actions">

                <a
                    href="{{ route('admin.clients.index') }}"
                    class="btn btn-secondary"
                >
                    Cancelar
                </a>

                <button
                    type="submit"
                    class="btn btn-primary"
                >

                    <x-icon name="check" />

                    Crear cliente

                </button>

            </div>

        </form>

    </div>

</div>

@endsection