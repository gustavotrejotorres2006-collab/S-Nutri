@props([
    'status',
])

@php

    $config = match ($status) {

        'pending' => [
            'class' => 'badge-pending',
            'label' => 'Pendiente',
        ],

        'confirmed' => [
            'class' => 'badge-confirmed',
            'label' => 'Confirmada',
        ],

        'suspended' => [
            'class' => 'badge-suspended',
            'label' => 'Suspendida',
        ],

        'cancelled' => [
            'class' => 'badge-cancelled',
            'label' => 'Cancelada',
        ],

        default => [
            'class' => 'badge-info',
            'label' => ucfirst($status),
        ],

    };

@endphp

<span class="badge {{ $config['class'] }}">

    <span class="badge-dot"></span>

    {{ $config['label'] }}

</span>