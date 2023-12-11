<?php

/*
    Clase Corredores

    Métodos específicos para BBDD
    - Corredores

*/

class Corredores extends Conexion
{

    public function getCorredores()
    {
        $sql = "SELECT 
                    corredores.id,
                    corredores.nombre,
                    corredores.apellidos,
                    corredores.ciudad,
                    corredores.email,
                    TIMESTAMPDIFF(YEAR, corredores.fechaNacimiento, NOW()) AS edad,
                    categorias.nombrecorto AS categoria,
                    clubs.nombrecorto AS club
                FROM
                    corredores
                LEFT JOIN
                    categorias ON corredores.id_categoria = categorias.id
                LEFT JOIN
                    clubs ON corredores.id_club = clubs.id
                ORDER BY
                    corredores.id";


        # Preparar objeto
        $pdostmt = $this->pdo->prepare($sql);

        # Establecer fetch
        $pdostmt->setFetchMode(PDO::FETCH_OBJ);

        # Ejecución
        $pdostmt->execute();

        return $pdostmt;
    }



    public function getCategorias()
    {
        try {

            $sql = "SELECT id, nombrecorto FROM categorias;";

            # Preparar objeto
            $pdostmt = $this->pdo->prepare($sql);

            # Establecer fetch
            $pdostmt->setFetchMode(PDO::FETCH_OBJ);

            # Ejecución
            $pdostmt->execute();

            return $pdostmt;

        } catch (Exception $e) {
            include('views/partials/errorDB.php');
            exit();
        }

    }

    public function getClubs()
    {
        try {

            $sql = "SELECT id, nombrecorto FROM clubs;";

            # Preparar objeto
            $pdostmt = $this->pdo->prepare($sql);

            # Establecer fetch
            $pdostmt->setFetchMode(PDO::FETCH_OBJ);

            # Ejecución
            $pdostmt->execute();

            return $pdostmt;

        } catch (Exception $e) {
            include('views/partials/errorDB.php');
            exit();
        }

    }

    public function create(Corredor $corredor)
    {
        try {
            # Prepare
            $sql = "INSERT INTO maratoon.corredores (
                        nombre,
                        apellidos,
                        ciudad,
                        fechaNacimiento,
                        sexo,
                        email,
                        dni,
                        id_categoria,
                        id_club
                    ) VALUES(
                        :nombre,
                        :apellidos,
                        :ciudad,
                        :fechaNacimiento,
                        :sexo,
                        :email,
                        :dni,
                        :id_categoria,
                        :id_club)";

            # Objeto clase mysqli_stmt
            $pdostmt = $this->pdo->prepare($sql);

            # Vinculo parámetros con variables
            $pdostmt->bindParam(':nombre', $corredor->nombre, PDO::PARAM_STR, 30);
            $pdostmt->bindParam(':apellidos', $corredor->apellidos, PDO::PARAM_STR, 50);
            $pdostmt->bindParam(':ciudad', $corredor->ciudad, PDO::PARAM_STR, 30);
            $pdostmt->bindParam(':fechaNacimiento', $corredor->fechaNacimiento);
            $pdostmt->bindParam(':sexo', $corredor->sexo);
            $pdostmt->bindParam(':email', $corredor->email, PDO::PARAM_STR, 128);
            $pdostmt->bindParam(':dni', $corredor->dni, PDO::PARAM_STR, 9);
            $pdostmt->bindParam(':id_categoria', $corredor->id_categoria, PDO::PARAM_INT);
            $pdostmt->bindParam(':id_club', $corredor->id_club, PDO::PARAM_INT);

            // ejecuto
            $pdostmt->execute();

            // libero memoria
            $pdostmt = null;

            // Cerrar conexión
            $this->pdo = null;

        } catch (PDOException $e) {

            include('views/partials/errorDB.php');
            exit();

        }

    }



    public function delete($id)
    {
        try {

            $registroDelete = "DELETE FROM 
                                    maratoon.registros 
                                WHERE 
                                    registros.id_corredor=:id";


            $pdostmtRegistros = $this->pdo->prepare($registroDelete);

            $pdostmtRegistros->bindParam(":id", $id, PDO::PARAM_INT);

            $pdostmtRegistros->execute();


            $sql = "DELETE FROM
                        maratoon.corredores
                    WHERE
                        corredores.id = :id";

            $pdostmt = $this->pdo->prepare($sql);

            $pdostmt->bindParam(":id", $id, PDO::PARAM_INT);

            $pdostmt->execute();

            // libero memoria
            $pdostmtRegistros = null;
            $pdostmt = null;

            // Cerrar conexión
            $this->pdo = null;

        } catch (PDOException $e) {

            include('views/partials/errorDB.php');
            exit();

        }
    }


    public function read($id)
    {
        try {
            $sql = "SELECT *
                    FROM
                        corredores
                    WHERE id = :id
                    LIMIT 1";

            $pdostmt = $this->pdo->prepare($sql);
            $pdostmt->bindParam(":id", $id, PDO::PARAM_INT);
            $pdostmt->setFetchMode(PDO::FETCH_OBJ);
            $pdostmt->execute();

            return $pdostmt->fetch();
        } catch (PDOException $e) {
            include('views/partials/errorDB.php');
            exit();

        }
    }

    public function update(Corredor $corredor, $id)
    {

        try {
            $sql = "UPDATE corredores SET 
                        nombre=:nombre, 
                        apellidos=:apellidos, 
                        ciudad=:ciudad,
                        fechaNacimiento=:fechaNacimiento,
                        sexo=:sexo,
                        email=:email,
                        dni=:dni,
                        id_categoria=:id_categoria,
                        id_club=:id_club 
                    WHERE id= :id";


            $pdostmt = $this->pdo->prepare($sql);


            $pdostmt->bindParam(':id', $id, PDO::PARAM_INT);
            $pdostmt->bindParam(':nombre', $corredor->nombre, PDO::PARAM_STR, 30);
            $pdostmt->bindParam(':apellidos', $corredor->apellidos, PDO::PARAM_STR, 50);
            $pdostmt->bindParam(':ciudad', $corredor->ciudad, PDO::PARAM_STR, 30);
            $pdostmt->bindParam(':fechaNacimiento', $corredor->fechaNacimiento);
            $pdostmt->bindParam(':sexo', $corredor->sexo);
            $pdostmt->bindParam(':email', $corredor->email, PDO::PARAM_STR, 128);
            $pdostmt->bindParam(':dni', $corredor->dni, PDO::PARAM_STR, 9);
            $pdostmt->bindParam(':id_categoria', $corredor->id_categoria, PDO::PARAM_INT);
            $pdostmt->bindParam(':id_club', $corredor->id_club, PDO::PARAM_INT);

            $pdostmt->setFetchMode(PDO::FETCH_OBJ);

            $pdostmt->execute();

            return $pdostmt->fetch();

        } catch (PDOException $e) {
            include('views/partials/errorDB.php');
            exit();
        }
    }

    public function insertarCorredor(Corredor $corredor)
    {
        try {
            // Creamos la consulta
            $sql = "INSERT INTO corredores (
                    nombre,
                    apellidos,
                    ciudad,
                    fechaNacimiento,
                    sexo,
                    email,
                    dni,
                    id_categoria,
                    id_club
                ) VALUES(
                    :nombre,
                    :apellidos,
                    :ciudad,
                    :fechaNacimiento,
                    :sexo,
                    :email,
                    :dni,
                    :id_categoria,
                    :id_club)";

            // Preparamos la consulta
            $pdostmt = $this->pdo->prepare($sql);

            // Vinculamos los parametros
            $pdostmt->bindParam(':nombre', $corredor->nombre, PDO::PARAM_STR, 30);
            $pdostmt->bindParam(':apellidos', $corredor->apellidos, PDO::PARAM_STR, 50);
            $pdostmt->bindParam(':ciudad', $corredor->ciudad, PDO::PARAM_STR, 30);
            $pdostmt->bindParam(':fechaNacimiento', $corredor->fechaNacimiento);
            $pdostmt->bindParam(':sexo', $corredor->sexo);
            $pdostmt->bindParam(':email', $corredor->email, PDO::PARAM_STR, 128);
            $pdostmt->bindParam(':dni', $corredor->dni, PDO::PARAM_STR, 9);
            $pdostmt->bindParam(':id_categoria', $corredor->id_categoria, PDO::PARAM_INT);
            $pdostmt->bindParam(':id_club', $corredor->id_club, PDO::PARAM_INT);

            // Ejecutar la sentencia preparada
            $pdostmt->execute();

            // Libero Memoria
            $pdostmt = null;

            // Cerramos la conexion
            $this->pdo = null;

        } catch (PDOException $e) {
            include 'views/partials/errorDB.php';
            exit();
        }
    }



    public function getCategoria($id)
    {
        try {

            $sql = "SELECT 
                categorias.nombrecorto as nombre
                FROM 
                maratoon.corredores
                INNER JOIN
                categorias ON 
                categorias.id = corredores.id_categoria
                WHERE 
                corredores.id = :id";

            # Preparar objeto
            $pdostmt = $this->pdo->prepare($sql);

            $pdostmt->bindParam(':id', $id, PDo::PARAM_INT);

            # Establecer fetch
            $pdostmt->setFetchMode(PDO::FETCH_OBJ);

            # Ejecución
            $pdostmt->execute();

            $resultado = $pdostmt->fetch();

            if ($resultado) {
                return $resultado;
            } else {
                // En caso de que no haya categoría, devuelve un valor predeterminado
                return (object) ['nombre' => 'Sin categoría'];
            }

        } catch (Exception $e) {
            include('views/partials/errorDB.php');
            exit();
        }

    }

    public function getClub($id)
    {
        try {

            $sql = "SELECT 
                clubs.nombrecorto as nombre
                FROM 
                maratoon.corredores
                INNER JOIN
                clubs ON 
                clubs.id = corredores.id_club
                WHERE 
                corredores.id = :id";

            # Preparar objeto
            $pdostmt = $this->pdo->prepare($sql);

            $pdostmt->bindParam(':id', $id, PDo::PARAM_INT);

            # Establecer fetch
            $pdostmt->setFetchMode(PDO::FETCH_OBJ);

            # Ejecución
            $pdostmt->execute();

            return $pdostmt->fetch();

        } catch (Exception $e) {
            include('views/partials/errorDB.php');
            exit();
        }

    }

    public function order(int $criterio)
    {
        try {
            $sql = "SELECT 
                        corredores.id,
                        corredores.nombre,
                        corredores.apellidos,
                        corredores.ciudad,
                        corredores.email,
                        TIMESTAMPDIFF(YEAR,
                            corredores.fechaNacimiento,
                            NOW()) AS edad,
                        categorias.nombrecorto AS categoria,
                        clubs.nombrecorto AS club
                    FROM
                        maratoon.corredores
                    LEFT JOIN
                        maratoon.categorias ON categorias.id = corredores.id_categoria
                    LEFT JOIN
                        maratoon.clubs ON clubs.id = corredores.id_club
                    ORDER BY :order";



            $pdostmt = $this->pdo->prepare($sql);
            
            $pdostmt->bindParam(':order', $criterio, PDO::PARAM_INT);
            $pdostmt->execute();

            return $pdostmt->fetchAll(PDO::FETCH_OBJ);

        } catch (Exception $e) {
            include('views/partials/errorDB.php');
            exit();
        }
    }


    public function filter($expresion)
    {
        try {
            $sql = "SELECT 
                        corredores.id,
                        corredores.nombre,
                        corredores.apellidos,
                        corredores.ciudad,
                        corredores.email,
                        TIMESTAMPDIFF(YEAR, corredores.fechaNacimiento, NOW()) AS edad,
                        categorias.nombrecorto AS categoria,
                        clubs.nombrecorto AS club
                    FROM
                        maratoon.corredores
                    LEFT JOIN
                        maratoon.categorias ON categorias.id = corredores.id_categoria
                    LEFT JOIN
                        maratoon.clubs ON clubs.id = corredores.id_club
                    WHERE
                        CONCAT_WS('',corredores.apellidos, corredores.nombre,corredores.ciudad,
                        corredores.email,TIMESTAMPDIFF(YEAR,corredores.fechaNacimiento,NOW()),
                        categorias.nombrecorto,clubs.nombreCorto)
                    LIKE :expresion";

            $pdostmt = $this->pdo->prepare($sql);
            $expresion = '%' . $expresion . '%';
            $pdostmt->bindParam(':expresion', $expresion, PDO::PARAM_STR);
            $pdostmt->execute();

            return $pdostmt->fetchAll(PDO::FETCH_OBJ);

        } catch (Exception $e) {
            include('views/partials/errorDB.php');
            exit();
        }
    }




}

?>