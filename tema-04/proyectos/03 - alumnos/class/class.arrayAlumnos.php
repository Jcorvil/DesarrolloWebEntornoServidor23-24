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


        $alumno = new Alumno(
            1,
            'David',
            'Herrera Ramírez',
            'jmherrera@gmail.com',
            '06/03/2002',
            2,
            [3, 4, 7]
        );
        $this->tabla[] = $alumno;

        $alumno = new Alumno(
            2,
            'Pablo',
            'Mateos Palas',
            'pmatpal0105@g.educaand.es',
            '01/05/2004',
            3,
            [3, 7, 8]
        );
        $this->tabla[] = $alumno;

        $alumno = new Alumno(
            3,
            'Antonio Jesús',
            'Téllez Perdigones',
            'atelper@gmail.com',
            '10/05/1999',
            2,
            [6, 7, 8]
        );
        $this->tabla[] = $alumno;

        $alumno = new Alumno(
            4,
            'Juan Maria',
            'Mateos Ponce',
            'jmherrera@gmail.com',
            '20/10/2004',
            4,
            [6, 7, 8]
        );
        $this->tabla[] = $alumno;

        $alumno = new Alumno(
            5,
            'Jorge',
            'Coronil Villalba',
            'jcorvil600@gmail.com',
            '17/04/1997',
            3,
            [6, 7, 8],
        );
        $this->tabla[] = $alumno;

        $alumno = new Alumno(
            6,
            "Juan Manuel",
            "Herrera Ramírez",
            'jmherrera@gmail.com',
            '06/03/2002',
            2,
            [3, 1, 4, 2]
        );
        $this->tabla[] = $alumno;

        $alumno = new Alumno(
            7,
            'Diego',
            'González Romero',
            'diegogonzalezromero@gmail.com',
            '28/03/2001',
            3,
            [6, 7, 8]
        );
        $this->tabla[] = $alumno;

        $alumno = new Alumno(
            8,
            'Adrián',
            'Merino Gamaza',
            'aamergam@g.educand.es',
            '10/12/2002',
            2,
            [6, 7, 8]
        );
        $this->tabla[] = $alumno;

        $alumno1 = new Alumno(
            9,
            'Daniel Alfonso',
            'Rodríguez Santos',
            'darancuga@gmail.com',
            '27/08/1999',
            2,
            [0, 1, 5]
        );
        $this->tabla[] = $alumno1;

        $alumno = new Alumno(
            10,
            'Ricardo',
            'Moreno Cantea',
            'rmorcan@g.educaand.es',
            '13/05/2004',
            3,
            [6, 7, 8]
        );
        $this->tabla[] = $alumno;

        $alumno = new Alumno(
            11,
            'Jonathan',
            'León Canto',
            'jleocan773@g.educaand.es',
            '19/06/2000',
            3,
            [6, 7, 8]
        );
        $this->tabla[] = $alumno;

        $alumno = new Articulo(
            12,
            'Juan Jesus',
            'Muñoz Perez',
            'jjmunper@gmail.com',
            '06/03/2000',
            2,
            [3, 2, 4]
        );
        $this->tabla[] = $alumno;

        $alumno = new Alumno(
            13,
            'Julian',
            'Garcia Velazquez',
            'jgarvel076@g.educaand.es',
            '01/12/2004',
            2,
            [3, 7, 8]
        );
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


    public function create(Alumno $data)
    {
        $this->tabla[] = $data;
    }

    public function delete($indice)
    {
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


    public function order()
    {

    }

}

?>