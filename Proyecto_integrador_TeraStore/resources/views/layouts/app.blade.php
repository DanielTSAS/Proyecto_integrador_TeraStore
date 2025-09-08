<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- El título de la página será dinámico --}}
    <title>@yield('title', 'TeraStore')</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    {{-- Aquí es donde Laravel Vite incluirá tus archivos CSS y JS --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    
    <header>
        {{-- Aquí irá tu barra de navegación --}}
        <nav>
            <a href="{{ route('home') }}">Inicio</a>
            <a href="{{ route('tienda.index') }}">Tienda</a>
            {{-- Más enlaces aquí --}}
        </nav>
    </header>

    <main>
        {{-- ESTA ES LA PARTE MÁGICA --}}
        {{-- Aquí se insertará el contenido específico de cada página --}}
        @yield('content')
    </main>

    <footer>
        {{-- Aquí irá tu pie de página --}}
        <p>&copy; {{ date('Y') }} TeraStore. Todos los derechos reservados.</p>
    </footer>

</body>
</html>