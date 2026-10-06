@props([
    'name',
    'size' => 'md',
])

@php

    $sizeClass = match ($size) {
        'sm' => 'icon-sm',
        'lg' => 'icon-lg',
        'xl' => 'icon-xl',
        default => '',
    };

@endphp

<svg
    {{ $attributes->merge([
        'class' => 'icon ' . $sizeClass,
        'aria-hidden' => 'true',
        'viewBox' => '0 0 24 24',
    ]) }}
>

    @switch($name)

        @case('activity')

            <path d="M3 12h4l3-8 4 16 3-8h4" />

            @break


        @case('dashboard')

            <rect x="3" y="3" width="7" height="7" rx="1" />
            <rect x="14" y="3" width="7" height="7" rx="1" />
            <rect x="3" y="14" width="7" height="7" rx="1" />
            <rect x="14" y="14" width="7" height="7" rx="1" />

            @break


        @case('calendar')

            <rect
                x="3"
                y="4"
                width="18"
                height="17"
                rx="2"
            />

            <line x1="16" y1="2" x2="16" y2="6" />
            <line x1="8" y1="2" x2="8" y2="6" />
            <line x1="3" y1="10" x2="21" y2="10" />

            @break


        @case('calendar-days')

            <rect
                x="3"
                y="4"
                width="18"
                height="17"
                rx="2"
            />

            <line x1="16" y1="2" x2="16" y2="6" />
            <line x1="8" y1="2" x2="8" y2="6" />
            <line x1="3" y1="10" x2="21" y2="10" />

            <line x1="8" y1="14" x2="8" y2="14" />
            <line x1="12" y1="14" x2="12" y2="14" />
            <line x1="16" y1="14" x2="16" y2="14" />

            <line x1="8" y1="18" x2="8" y2="18" />
            <line x1="12" y1="18" x2="12" y2="18" />
            <line x1="16" y1="18" x2="16" y2="18" />

            @break


        @case('users')

            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
            <circle cx="9" cy="7" r="4" />
            <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
            <path d="M16 3.13a4 4 0 0 1 0 7.75" />

            @break


        @case('user')

            <circle cx="12" cy="7" r="4" />
            <path d="M5 21a7 7 0 0 1 14 0" />

            @break


        @case('user-plus')

            <circle cx="9" cy="7" r="4" />
            <path d="M2 21a7 7 0 0 1 14 0" />
            <line x1="19" y1="8" x2="19" y2="14" />
            <line x1="16" y1="11" x2="22" y2="11" />

            @break


        @case('menu')

            <line x1="4" y1="6" x2="20" y2="6" />
            <line x1="4" y1="12" x2="20" y2="12" />
            <line x1="4" y1="18" x2="20" y2="18" />

            @break


        @case('sun')

            <circle cx="12" cy="12" r="4" />
            <line x1="12" y1="2" x2="12" y2="4" />
            <line x1="12" y1="20" x2="12" y2="22" />
            <line x1="4.93" y1="4.93" x2="6.34" y2="6.34" />
            <line x1="17.66" y1="17.66" x2="19.07" y2="19.07" />
            <line x1="2" y1="12" x2="4" y2="12" />
            <line x1="20" y1="12" x2="22" y2="12" />
            <line x1="4.93" y1="19.07" x2="6.34" y2="17.66" />
            <line x1="17.66" y1="6.34" x2="19.07" y2="4.93" />

            @break


        @case('moon')

            <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z" />

            @break


        @case('log-out')

            <path d="M10 17l5-5-5-5" />
            <line x1="15" y1="12" x2="3" y2="12" />
            <path d="M21 19V5a2 2 0 0 0-2-2h-6" />

            @break


        @case('search')

            <circle cx="11" cy="11" r="7" />
            <line x1="20" y1="20" x2="16" y2="16" />

            @break


        @case('plus')

            <line x1="12" y1="5" x2="12" y2="19" />
            <line x1="5" y1="12" x2="19" y2="12" />

            @break


        @case('edit')

            <path d="M12 20h9" />
            <path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4Z" />

            @break


        @case('eye')

            <path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12z" />
            <circle cx="12" cy="12" r="3" />

            @break


        @case('eye-off')

            <path d="M3 3l18 18" />
            <path d="M10.6 10.6a2 2 0 0 0 2.8 2.8" />
            <path d="M9.9 5.1A10.8 10.8 0 0 1 12 5c6.5 0 10 7 10 7a18.6 18.6 0 0 1-3 3.9" />
            <path d="M6.6 6.6C3.7 8.4 2 12 2 12s3.5 7 10 7a10 10 0 0 0 3-.5" />

            @break


        @case('x')

            <line x1="18" y1="6" x2="6" y2="18" />
            <line x1="6" y1="6" x2="18" y2="18" />

            @break


        @case('check')

            <polyline points="20 6 9 17 4 12" />

            @break


        @case('alert-circle')

            <circle cx="12" cy="12" r="9" />
            <line x1="12" y1="8" x2="12" y2="12" />
            <line x1="12" y1="16" x2="12" y2="16" />

            @break


        @case('clock')

            <circle cx="12" cy="12" r="9" />
            <polyline points="12 7 12 12 15 14" />

            @break


        @case('phone')

            <path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.1 4.2 2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1 1 .4 2 .7 2.8a2 2 0 0 1-.4 2.1L8.1 9.9a16 16 0 0 0 6 6l1.3-1.3a2 2 0 0 1 2.1-.4c.9.3 1.8.6 2.8.7A2 2 0 0 1 22 16.9z" />

            @break


        @case('mail')

            <rect
                x="3"
                y="5"
                width="18"
                height="14"
                rx="2"
            />

            <polyline points="3 7 12 13 21 7" />

            @break


        @case('arrow-left')

            <line x1="19" y1="12" x2="5" y2="12" />
            <polyline points="12 19 5 12 12 5" />

            @break


        @case('arrow-right')

            <line x1="5" y1="12" x2="19" y2="12" />
            <polyline points="12 5 19 12 12 19" />

            @break


        @case('chevron-left')

            <polyline points="15 18 9 12 15 6" />

            @break


        @case('chevron-right')

            <polyline points="9 18 15 12 9 6" />

            @break


        @case('filter')

            <polygon points="3 4 21 4 14 12 14 20 10 18 10 12 3 4" />

            @break


        @case('file-text')

            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
            <polyline points="14 2 14 8 20 8" />
            <line x1="8" y1="13" x2="16" y2="13" />
            <line x1="8" y1="17" x2="16" y2="17" />
            <line x1="8" y1="9" x2="10" y2="9" />

            @break


        @case('activity')

            <polyline points="3 12 7 12 10 4 14 20 17 12 21 12" />

            @break


        @case('lock')

            <rect
                x="5"
                y="10"
                width="14"
                height="11"
                rx="2"
            />

            <path d="M8 10V7a4 4 0 0 1 8 0v3" />

            @break


        @case('heart')

            <path d="M20.8 8.8c0 5.5-8.8 10.2-8.8 10.2S3.2 14.3 3.2 8.8A4.8 4.8 0 0 1 12 6.1a4.8 4.8 0 0 1 8.8 2.7z" />

            @break


        @default

            <circle cx="12" cy="12" r="9" />

            @break

    @endswitch

</svg>