<?php

/*
    Clase FP
    Métodos específicos para BBDD fp con las tablas
        -Alumnos
        -Cursos
*/

class Fp extends Conexion
{

    public function insert_cursos(Curso $curso)
    {

        try {
            $sql = "INSERT INTO Cursos (
                    nombre,
                    ciclo,
                    nombreCorto,
                    nivel
                ) VALUES (
                    :nombre,
                    :ciclo,
                    :nombreCorto,
                    :nivel
                )";

            # Objeto de clase PDOStatement
            $pdostmt = $this->pdo->prepare($sql);

            #Vincular los parámetros con valores
            $pdostmt->bindParam(':nombre', $curso->nombre, PDO::PARAM_STR, 50);
            $pdostmt->bindParam(':ciclo', $curso->ciclo, PDO::PARAM_STR, 50);
            $pdostmt->bindParam(':nombreCorto', $curso->nombreCorto, PDO::PARAM_STR, 4);
            $pdostmt->bindParam(':nivel', $curso->nivel, PDO::PARAM_INT, 1);

            # Ejecutamos sql
            $pdostmt->execute();

            # Liberamos el objet
            $pdostmt = null;

            # Cerramos la conexión
            $this->pdo = null;

        } catch (PDOException $e) {
            include('views/partials/errorDB.php');
            exit();
        }
    }

}

?>