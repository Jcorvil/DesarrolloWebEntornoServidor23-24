<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>@yield('titulo') - ONLINE Marroquinería</title>
</head>

<body>
    <header>
        <hgroup>
            <!-- Titulos y subtitulos -->

            <div class="container">
                <h1 class="display-7">@yield('titulo')</h1>
                <p class="lead">@yield('subtitulo')</p>
            </div>
        </hgroup>
    </header>

    <div class="container">
        @yield('contenido')
    </div>

    @extends('layout')

    @section('titulo', 'Artículos')
    @section('subtitulo', 'Listado de artículos')

    @section('contenido')
        <!-- Menú -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand" href="#">Home</a>
                <a class="navbar-brand" href="#">Artículos</a>
            </div>
        </nav>

        <!-- Cabecera de la tabla -->
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Categoría</th>
                    <th scope="col">stock</th>
                    <th scope="col">Precio Coste</th>
                    <th scope="col">Precio Venta</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($articulos as $articulo)
                    <tr>
                        <th scope="row">{{ $articulo->id }}</th>
                        <td>{{ $articulo->descripcion }}</td>
                        <td>{{ $articulo->categoria }}</td>
                        <td>{{ $articulo->stock }}</td>
                        <td>{{ $articulo->precio_coste }}</td>
                        <td>{{ $articulo->precio_venta }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <p>Registros: {{ count($articulos) }}</p>
    @endsection


    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>

    <!-- Pié de página -->
    <footer class="footer mt-auto py-3 fixed-bottom bg-light">
        <div class="container">
            <span class="text-muted">© 2024
                Jorge Coronil Villalba - DWES - 2º DAW - Curso 23/24</span>
        </div>
    </footer>

</body>

</html>
