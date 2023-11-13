<?php
/*
    class.arrayAlumnos.php

    tabla de alumnos

    Es un array donde cada elemento es un objeto de la clase Alumno
*/

class ArrayAlumnos
{
    private $tabla;

    public function __construct()
    {
        $this->tabla = [];
    }


    /**
     * @return mixed
     */
    public function getTabla()
    {
        return $this->tabla;
    }

    /**
     * @param mixed $tabla 
     * @return self
     */
    public function setTabla($tabla): self
    {
        $this->tabla = $tabla;
        return $this;
    }


    static public function getCursos()
    {
        $cursos = [
            '1SMR',
            '2SMR',
            '1DAW',
            '2DAW',
            '1ADI',
            '2ADI',
        ];

        asort($cursos);

        return $cursos;
    }

    static public function getAsignaturas()
    {
        $asignaturas = [
            '1DAW Base de Datos',
            '1DAW Entornos de Desarrollo',
            '1DAW Formación y Orientación Laboral',
            '1DAW Lenguaje de Marcas y Sistemas de gestión de la Información',
            '1DAW Programación',
            '1DAW Sistemas Informáticos',
            '2DAW Desarrollo Web Entorno Cliente',
            '2DAW Desarrollo web Entorno Servidor',
            '2DAW Despliegue Aplicaciones Web'
        ];

        asort($asignaturas);

        return $asignaturas;
    }


    public function getDatos()
    {
        #Alumno 1
        $alumno = new Alumno(
            1,
            'Juan Manuel',
            'Herrera Ramírez',
            'jmherrera@gmail.com',
            '06/03/2002',
            2,
            [3, 4, 7],

        );
        #Añadir articulo a la tabla
        $this->tabla[] = $alumno;

        #Alumno 2
        $alumno = new Alumno(
            1,
            'Jorge',
            'Coronil Villalba',
            'jcorvil600@gmail.com',
            '17/04/1997',
            3,
            [6, 7, 8],

        );
        #Añadir articulo a la tabla
        $this->tabla[] = $alumno;

    }

    static public function mostrarAsignaturas($asignaturas, $asignaturasAlumno)
    {
        $array = [];

        foreach ($asignaturasAlumno as $indice) {
            $array[] = $asignaturas[$indice];
        }

        asort($array);
        return $array;

    }


    public function create(Alumno $data) {
        $this->tabla[] = $data;
    }

    public function delete ($indice) {
        unset($this->tabla[$indice]);
        array_values($this->tabla);
    }


    public function read($indice)
    {
        return $this->tabla[$indice];
    }


    public function update($indice, Alumno $data)
    {
        $this->tabla[$indice] = $data;
    }


        public function order () {
            
        }

}

?>