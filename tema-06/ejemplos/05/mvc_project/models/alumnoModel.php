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
            $pdostmt = $conexion->prepare($sql);

            # establecemos tipo fetch
            $pdostmt->setFetchMode(PDO::FETCH_OBJ);

            # ejecutamos
            $pdostmt->execute();

            # devuelvo objeto pdostatement
            return $pdostmt;

        } catch (PDOException $e) {

            include_once('template/partials/errorDB.php');

        }
    }

    public function getCursos()
    {
        try {

            #Comando sql
            $sql = "SELECT 
                        id,
                        nombreCorto AS curso
                    FROM cursos
                    ORDER BY id";

            #Conectamos con la base de datos
            //$this->db es un objeto de la clase database
            // ejecuto el método  connect de esa clase

            $conexion = $this->db->connect();

            # ejecutamos mediante prepare
            $pdostmt = $conexion->prepare($sql);

            # establecemos tipo fetch
            $pdostmt->setFetchMode(PDO::FETCH_OBJ);

            # ejecutamos
            $pdostmt->execute();

            # devuelvo objeto pdostatement
            return $pdostmt;

        } catch (PDOException $e) {
            include_once('template/partials/errorDB.php');
            exit();
        }
    }

    public function create(classAlumno $alumno)
    { {
            try {

                #Comando sql
                $sql = "INSERT INTO Alumnos (
                    nombre,
                    apellidos,
                    email,
                    telefono,
                    poblacion,
                    dni,
                    fechaNac,
                    id_curso
                ) VALUES (
                    :nombre, 
                    :apellidos, 
                    :email, 
                    :telefono, 
                    :poblacion, 
                    :dni, 
                    :fechaNac, 
                    :id_curso
                )";

                #Conectamos con la base de datos
                //$this->db es un objeto de la clase database
                // ejecuto el método  connect de esa clase

                $conexion = $this->db->connect();

                # ejecutamos mediante prepare
                $pdostmt = $conexion->prepare($sql);

                # establecemos tipo fetch
                $pdostmt->bindParam(":nombre", $alumno->nombre, PDO::PARAM_STR, 50);
                $pdostmt->bindParam(':apellidos', $alumno->apellidos, PDO::PARAM_STR, 50);
                $pdostmt->bindParam(':email', $alumno->email, PDO::PARAM_STR, 50);
                $pdostmt->bindParam(':telefono', $alumno->telefono, PDO::PARAM_STR, 13);
                $pdostmt->bindParam(':poblacion', $alumno->poblacion, PDO::PARAM_STR, 50);
                $pdostmt->bindParam(':dni', $alumno->dni, PDO::PARAM_STR, 9);
                $pdostmt->bindParam(':fechaNac', $alumno->fechaNac);
                $pdostmt->bindParam(':id_curso', $alumno->id_curso, PDO::PARAM_INT);

                # ejecutamos
                $pdostmt->execute();

                # devuelvo objeto pdostatement
                return $pdostmt;

            } catch (PDOException $e) {
                include_once('template/partials/errorDB.php');
                exit();
            }
        }
    }

    public function read($id)
    {
        try {

            $sql = "SELECT * FROM alumnos WHERE id = :id LIMIT 1";

            $stmt = $this->pdo->prepare($sql);

            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            $data = $stmt->fetch(PDO::FETCH_OBJ);

            $stmt->execute();

            if (!$data) {
                throw new Exception('Alumno No Encontrado');
            }

            return $data;

        } catch (Exception $e) {
            include('views/partials/errorDB.php');
            exit();
        }
    }
}

?>