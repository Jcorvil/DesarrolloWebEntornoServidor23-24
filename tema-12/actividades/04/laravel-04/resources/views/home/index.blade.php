<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Controller Vista</title>
</head>

<body>
    <p>Hola mundo Blade Laravel</p>

    <table border="2">
        <thead>
            <tr>
                <td>ID</td>
                <td>Nombre</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($alumnos as $alumno)
                <tr>
                    <td>{{ $alumno['id'] }}</td>
                    <td>{{ $alumno['nombre'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Forelse. Hace un for each y si está vacío, muestra el mensaje --}}
    @forelse($usuarios as $usuario)
        print_r($usuario)
    @empty
        <p>Sin usuarios</p>
    @endforelse


    {{-- If Else --}}
    @if ($nivel == 1)
        <p>Estoy en primer curso</p>
    @else
        <p>Estoy en segundo curso</p>
    @endif

    <footer>
        <p>Autor:{{ $autor }}</p>
        <p>Curso:{{ $curso }}</p>
        <p>Módulo:{{ $modulo ?? 'Base de datos' }}</p>
        <p>Nivel: {{ $nivel }}</p>
    </footer>
    {{-- Comentario Blade --}}
    <!-- Comentario HTML -->
</body>

</html>
