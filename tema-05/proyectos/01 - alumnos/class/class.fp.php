<?php

/*
    class.fp.php
    Métodos necesarios para la gestión de la BBDD fp
    En este caso sólo los métodos pertenecientes a la tabla Alumnos
*/

class Fp extends Conexion
{


    //Devuelve un objeto conjunto resultados (mysql_result) con los detalles de todos los alumnos

    public function getAlumnos()
    {

        $sql = "SELECT 
        alumnos.id,
        concat_ws(', ', alumnos.apellidos, alumnos.nombre) as alumno,
        alumnos.email,
        alumnos.telefono,
        alumnos.poblacion,
        timestampdiff(YEAR, alumnos.fechaNac, now()) as edad,
        alumnos.id_curso
    FROM
        alumnos
            INNER JOIN
        cursos ON alumnos.id_curso = cursos.id
    ORDER BY id";

        //$result = $this->db->query($sql);

        //return $result;

        $stmt = $this->db->prepare($sql);

        $stmt->execute();

        $result = $stmt->get_result();

        return $result;


    }


    public function getCursos()
    {
        $sql = "SELECT
        id, nombreCorto curso 
        FROM 
        cursos 
        ORDER BY 
        id ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        
        return $result;
    }


}


?>