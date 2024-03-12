<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Muestra los alumnos
        $alumnos = Student::all()->sortBy('id');
        return view('student.home', ['alumnos' => $alumnos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Carga formulario nuevo alumno
        // Cargamos los cursos para el select
        $cursos = Course::all()->sortBy('course');
        return view('student.create', ['cursos' => $cursos]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Recibe los datos del formulario
        // Valida los datos
        // Almacena en la tabla "student" de la base de datos

        // Validación Formulario
        // Especifico en un arrau las reglas de validación de cada campo
        $validateData = $request->validate(
            [
                'name' => ['required', 'string', 'max:35'],
                'last_name' => ['required', 'string', 'max:50'],
                'birth_date' => ['required', 'date'],
                'phone' => ['required', 'max:13'],
                'city' => ['required', 'string', 'max:40'],
                'dni' => ['required', 'string', 'max:9', 'unique:students'],
                'email' => ['required', 'string', 'max:40', 'unique:students'],
                'course_id' => ['required', 'exists:courses,id']
            ]
        );

        // Cargamos los daatos del formulario en la tabla courses
        // Creamos el objeto de la clase alumno
        $alumno = Student::create(
            [
                'name' => $request['name'],
                'last_name' => $request['last_name'],
                'birth_date' => $request['birth_date'],
                'phone' => $request['phone'],
                'city' => $request['city'],
                'dni' => $request['dni'],
                'email' => $request['email'],
                'course_id' => $request['course_id']
            ]
        );

        // Guardamos
        $alumno->save();

        // Redireccionamos a la vez que creamos la variable de sesión
        return redirect()->route('alumnos.index')->with('success', 'Alumno creado correctamente');


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
