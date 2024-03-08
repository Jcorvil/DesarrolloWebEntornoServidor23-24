@extends('layout.layout')

@section('titulo', 'Home')
@section('subtitulo', 'Página Principal')

@section('contenido')

    <div class="h-100 p-5 bg-light border rounded-3">
        <h2>Add borders</h2>
        <p>Or keep it light and add a border for some added definition</p>
        <a href="alumnos" class="btn btn-outline-secondary" type="button">Alumno</a>
        <a href="cuentas" class="btn btn-outline-secondary" type="button">Cuentas</a>

    </div>

@endsection
