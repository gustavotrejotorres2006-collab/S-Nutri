@props([
    'type' => 'info',
    'message' => '',
])

@php

    $icon = match ($type) {
        'success' => 'check',
        'error', 'danger' => 'alert-circle',
        'warning' => 'alert-circle',
        default => 'activity',
    };

@endphp

<div
    class="alert alert-{{ $type }}"
    data-alert
    data-auto-dismiss="6"
>

    <x-icon :name="$icon" />

    <div class="alert-content">

        <p class="alert-message">
            {{ $message }}
        </p>

    </div>

    <button
        type="button"
        class="icon-button"
        data-alert-close
        aria-label="Cerrar"
    >

        <x-icon
            name="x"
            size="sm"
        />

    </button>

</div>