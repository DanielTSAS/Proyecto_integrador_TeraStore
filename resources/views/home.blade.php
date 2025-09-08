{{-- 1. Le decimos a Blade que queremos usar la plantilla 'app.blade.php' --}}
@extends('layouts.app')

{{-- 2. Definimos el título específico para esta página --}}
@section('title', 'Bienvenido a TeraStore')

{{-- 3. Aquí va todo el contenido que se insertará en el @yield('content') --}}
@section('content')
    <div class="container">
        <h1>¡Página de Inicio de TeraStore!</h1>
        <p>Aquí mostraremos los productos destacados.</p>

        {{-- Aquí podrías recorrer los productos que pasaste desde el HomeController --}}
        {{-- @foreach ($productosRecientes as $producto)
            <p>{{ $producto->Nombre }}</p>
        @endforeach --}}
    </div>
@endsection
