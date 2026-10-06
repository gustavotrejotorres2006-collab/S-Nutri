<!DOCTYPE html>
<html lang="es" data-theme="light">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <meta
        name="csrf-token"
        content="{{ csrf_token() }}"
    >

    <meta
        name="description"
        content="S-Nutri - Sistema de gestión nutricional"
    >

    <title>
        @hasSection('title')
            @yield('title') | S-Nutri
        @else
            S-Nutri
        @endif
    </title>

    {{-- Fuentes --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link
        rel="preconnect"
        href="https://fonts.gstatic.com"
        crossorigin
    >

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Quantico:ital,wght@0,400;0,700;1,400;1,700&family=Silkscreen:wght@400;700&display=swap"
        rel="stylesheet"
    >

    {{-- Evita el parpadeo al cargar el tema --}}
    <script>
        (() => {
            const savedTheme =
                localStorage.getItem('s-nutri-theme');

            const systemDark =
                window.matchMedia(
                    '(prefers-color-scheme: dark)'
                ).matches;

            const theme =
                savedTheme ||
                (systemDark ? 'dark' : 'light');

            document.documentElement.dataset.theme =
                theme;
        })();
    </script>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

    @stack('head')
</head>

<body>

    @yield('body')

    @stack('scripts')

</body>

</html>