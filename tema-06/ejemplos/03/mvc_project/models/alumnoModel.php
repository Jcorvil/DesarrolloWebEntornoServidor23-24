<?php

/*
    alumnosModel.php

    Modelo del controlador de alumos
    Definir los métodos de acceso a la base de datos

    -insert
    -update-
    -select
    -delete
    -etc...
*/

class alumnoModel extends Model
{

    /* 
        Extrae los detalles de los alumnos
    */
    public function get()
    {

        try {

            #Comando sql
            $sql = "SELECT 
                alumnos.id,
                concat_ws(', ', alumnos.apellidos, alumnos.nombre) alumno,
                alumnos.email,
                alumnos.telefono,
                alumnos.poblacion,
                alumnos.dni,
                timestampdiff(YEAR,  alumnos.fechaNac, NOW() ) edad,
                cursos.nombreCorto curso
            FROM
                alumnos
            INNER JOIN
                cursos
            ON alumnos.id_curso = cursos.id
            ORDER BY id";

            #Conectamos con la base de datos
            //$this->db es un objeto de la clase database
            // ejecuto el método  connect de esa clase

            $conexion = $this->db->connect();

            # ejecutamos mediante prepare
            $pdost = $conexion->prepare($sql);

            # establecemos tipo fetch
            $pdost->setFetchMode(PDO::FETCH_OBJ);

            # ejecutamos
            $pdost->execute();

            # devuelvo objeto pdostatement
            return $pdost;

        } catch (PDOException $e) {

            include_once('template/partials/errorDB.php');

        }
    }
}

?>