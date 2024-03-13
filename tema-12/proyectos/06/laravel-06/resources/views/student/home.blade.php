{{-- 
    Creamos una vista a partir del layout.
    Vista principal de Alumnos
--}}


@extends('layout.layout')

@section('titulo', 'Home Alumnos')
@section('subtitulo', 'Panel de Control de Alumnos')

@section('contenido')
    @include('partials.alerts')
    {{-- Menú alumnos --}}
    @include('student.partials.menu')

    {{-- Lista de Alumnos --}}
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Apellidos</th>
                <th>Nombre</th>
                <th>Teléfono</th>
                <th>Ciudad</th>
                <th>Email</th>
                <th>Curso</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($alumnos as $alumno)
                <tr>
                    <td scope="row">{{ $alumno->id }}</td>
                    <td>{{ $alumno->last_name }}</td>
                    <td>{{ $alumno->name }}</td>
                    <td>{{ $alumno->phone }}</td>
                    <td>{{ $alumno->city }}</td>
                    <td>{{ $alumno->email }}</td>
                    <td>{{ $alumno->course->course }}</td>
                    {{-- Botones de acción --}}
                    <td>
                        <div class="d-grip gap-2 d-md-block">
                            <a href="{{ route('alumnos.edit', $alumno->id) }}" title="Editar" class="btn btn-primary"><i
                                    class="bi bi-pencil-fill"></i></a>
                            <a href="{{ route('alumnos.show', $alumno->id) }}" title="Mostrar" class="btn btn-warning"><i
                                    class="bi bi-eye-fill"></i></a>
                            <form action="{{ route('alumnos.destroy', $alumno->id) }}" method="POST"
                                style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" title="Eliminar" class="btn btn-danger"
                                    onclick="return confirm('Confirmar eliminación del Alumno')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <p>No hay alumnos registrados</p>
            @endforelse
        </tbody>
    </table>

    <br>
    <br>
    <br>
    <br>

@endsection
