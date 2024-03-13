@extends('layout\layout')

@section('titulo', 'Alumnos')
@section('subtitulo', 'Editar Alumno')
@section('contenido')
    @include('partials.alerts')
    <br>
    <br>
    <div class="card">
        <div class="card-header">
            Formulario Editar Alumno
        </div>
        <div class="card-body">
            <!-- Formulario  -->

            <form action={{ route('alumnos.update', $alumno->id) }} method="POST">
                @csrf
                @method('PUT')
                <!-- Nombre  -->
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre</label>
                    <input type="text" class="form-control" name="name" value="{{ $alumno->name }}" disabled>
                </div>

                <!-- Apellidos  -->
                <div class="mb-3">
                    <label for="last_name" class="form-label">Apellidos</label>
                    <input type="text" class="form-control" name="last_name" value="{{ $alumno->last_name }}" disabled>
                </div>
                <!-- Fecha nacimiento  -->
                <div class="mb-3">
                    <label for="birth_date" class="form-label">Fecha nacimiento</label>
                    <input type="text" class="form-control" name="birth_date" value="{{ $alumno->birth_date }}" disabled>
                </div>
                <!-- Teléfono  -->
                <div class="mb-3">
                    <label for="phone" class="form-label">Teléfono</label>
                    <input type="text" class="form-control" name="phone" value="{{ $alumno->phone }}" disabled>
                </div>
                <!-- Población  -->
                <div class="mb-3">
                    <label for="city" class="form-label">Población</label>
                    <input type="text" class="form-control" name="city" value="{{ $alumno->city }}" disabled>
                </div>
                <!-- Dni  -->
                <div class="mb-3">
                    <label for="dni" class="form-label">DNI</label>
                    <input type="text" class="form-control" name="dni" value="{{ $alumno->dni }}" disabled>
                </div>
                <!-- Email  -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control" name="email" value="{{ $alumno->email }}" disabled>
                </div>
                <!-- Curso -->
                <div class="mb-3">
                    <label for="course_id" class="form-label">Curso</label>
                    <input type="text" class="form-control" name="course_id" value="{{ $alumno->course->course }}" disabled>
                </div>

        </div>
        {{-- Fin Formulario --}}

        <div class="card-footer text-muted">
            <!-- Botones de acción -->
            <a class="btn btn-primary" href="{{ route('alumnos.index') }}" role="button">Volver</a>
        </div>

        </form>
    </div>
    <br>
    <br>
    <br>
    <br>


@endsection
