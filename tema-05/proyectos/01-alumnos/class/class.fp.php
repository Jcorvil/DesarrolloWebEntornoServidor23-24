<?php

/*
    class.fp.php 

    Métodos necesarios para la gestión de la BBDD fp

    En este caso sólo los  métodos pertenecientes a la tabla
    Alumnos
*/

class Fp extends Conexion
{

    /*

        getAlumnos()

        Devuelve un objeto conjunto resultados (mysqli_result) 
        con los detalles de  todos los alumnos

        

    */

    public function getAlumnos()
    {

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

        # Ejecutamos directamente SQL
        // Objeto de la clase mysqli_result
        // $result = $this->db->query($sql);

        # Mediante Plantilla SQL o Prepare
        // Objeto clase prepare statement
        $stmt = $this->db->prepare($sql);
        // ejecuto
        $stmt->execute();
        // objeto clase mysqli_result
        $result = $stmt->get_result();

        return $result;
    }

    /*

        getCursos()

        Devuelve un objeto conjunto resultados (mysqli_result) con los 
        detalles de todos los cursos

    */

    public function getCursos()
    {

        $sql = "SELECT 
                    id,
                    nombreCorto curso
                FROM
                    cursos
                ORDER BY id";

        # Mediante Plantilla SQL o Prepare
        // Objeto clase prepare statement
        $stmt = $this->db->prepare($sql);
        // ejecuto
        $stmt->execute();
        // objeto clase mysqli_result
        $result = $stmt->get_result();

        return $result;
    }

    public function insertAlumno(Alumno $alumno)
    {

        # Prepare
        $sql = "Insert into Alumnos values(null,?,?,?,?,?,?,?,?,?,?,?)";

        # Objeto clase mysqli_stmt
        $stmt = $this->db->prepare($sql);

        # Vinculo parámetros con variables
        $stmt->bind_param(
            "ssssssssssi",
            $alumno->nombre,
            $alumno->apellidos,
            $alumno->email,
            $alumno->telefono,
            $alumno->direccion,
            $alumno->poblacion,
            $alumno->provincia,
            $alumno->nacionalidad,
            $alumno->dni,
            $alumno->fechaNac,
            $alumno->id_curso
        );
        # Ejecuto mysqli_stmt e inserto registro
        $stmt->execute();

        # Libero memoria
        $stmt->close();
    }

    /*
        Obtener un objeto de la clase Alumno a partir del id de alumno
    */
    public function readAlumno($id)
    {

        try {

            // prepare sql
            $sql = "SELECT * FROM alumnos WHERE id = $id LIMIT 1";

            // objeto clase mysqli_stmt
            $stmt = $this->db->prepare($sql);

            // vinculamos parámetros prepare en WHERE pero no funciona
            // $stmt->bind_param("i", $i);

            // ejecutamos sql
            $stmt->execute();

            // obtenemos resultado en objeto clase mysqli_result
            $result = $stmt->get_result();

            // devolvemos el resultado mediante objeto de la clase alumno
            if (!($data = $result->fetch_object())) {
                throw new Exception('Alumno No Encontrado');
            }

            return $data;
        } catch (Exception $e) {

            include('views/partials/errorDB.php');
            exit();
        }
    }

    /*
        updateAlumno()
        Actualizar los detalles de un alumno

        Parámetros:
        - objeto clase alumno
        - id del alumno
    */
    public function updateAlumno(Alumno $data, $id)
    {

        try {
            $sql = "
            
                UPDATE alumnos
                SET
                    nombre      = ?,
                    apellidos   = ?,
                    email       = ?,
                    telefono    = ?,
                    direccion   = ?,
                    poblacion   = ?,
                    provincia   = ?,
                    nacionalidad= ?,
                    dni         = ?,
                    fechaNac    = ?,
                    id_curso    = ?
                WHERE
                        id = ?
                LIMIT 1
            ";

            $stmt = $this->db->prepare($sql);

            $stmt->bind_param(
                'ssssssssssii',
                $data->nombre,
                $data->apellidos,
                $data->email,
                $data->telefono,
                $data->direccion,
                $data->poblacion,
                $data->provincia,
                $data->nacionalidad,
                $data->dni,
                $data->fechaNac,
                $data->id_curso,
                $id
            );

            if (!$stmt->execute()) {
                throw new Exception('Alumno no Actualizado');
            };
        } catch (PDOException $error) {
            include_once('views/partials/errorDB.php');
            exit(0);
        }
    }
}
?>
