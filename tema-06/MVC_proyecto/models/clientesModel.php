<?php

/*
    clientesModel.php

    Modelo del controlador clientes

    Definir los métodos de acceso a la base de datos
    
    - insert
    - update
    - select
    - delete
    - etc..
*/

class clientesModel extends Model
{

    /*
        Extrae los detalles  de los clientes
    */
    public function get()
    {

        try {

            # comando sql
            $sql = "SELECT 
                        clientes.id,
                        clientes.nombre,
                        clientes.apellidos,
                        clientes.email,
                        clientes.telefono,
                        clientes.ciudad,
                        clientes.dni
                    FROM
                        clientes
                    ORDER BY 
                        id
                    ";

            # conectamos con la base de datos

            // $this->db es un objeto de la clase database
            // ejecuto el método connect de esa clase

            $conexion = $this->db->connect();

            # ejecutamos mediante prepare
            $pdost = $conexion->prepare($sql);

            # establecemos  tipo fetch
            $pdost->setFetchMode(PDO::FETCH_OBJ);

            #  ejecutamos 
            $pdost->execute();

            # devuelvo objeto pdostatement
            return $pdost;

        } catch (PDOException $e) {

            include_once('template/partials/errorDB.php');
            exit();

        }
    }


    public function create(classCliente $cliente)
    {

        try {
            $sql = "INSERT INTO Clientes (
                        nombre,
                        apellidos,
                        email,
                        telefono,
                        ciudad,
                        dni
                    )
                    VALUES (
                        :nombre,
                        :apellidos,
                        :email,
                        :telefono,
                        :ciudad,
                        :dni
                    )
                ";
            # Conectar con la base de datos
            $conexion = $this->db->connect();

            $pdoSt = $conexion->prepare($sql);

            $pdoSt->bindParam(':nombre', $cliente->nombre, PDO::PARAM_STR, 30);
            $pdoSt->bindParam(':apellidos', $cliente->apellidos, PDO::PARAM_STR, 50);
            $pdoSt->bindParam(':email', $cliente->email, PDO::PARAM_STR, 50);
            $pdoSt->bindParam(':telefono', $cliente->telefono, PDO::PARAM_STR, 13);
            $pdoSt->bindParam(':ciudad', $cliente->ciudad, PDO::PARAM_STR, 30);
            $pdoSt->bindParam(':dni', $cliente->dni, PDO::PARAM_STR, 9);

            $pdoSt->execute();

        } catch (PDOException $e) {
            include_once('template/partials/errorDB.php');
            exit();
        }

    }

    public function read($id)
    {

        try {
            $sql = "SELECT 
                        id,
                        nombre, 
                        apellidos,
                        email,
                        telefono,
                        ciudad,
                        dni
                    FROM 
                        clientes
                    WHERE
                        id = :id
                ";

            # Conectar con la base de datos
            $conexion = $this->db->connect();


            $pdoSt = $conexion->prepare($sql);

            $pdoSt->bindParam(':id', $id, PDO::PARAM_INT);
            $pdoSt->setFetchMode(PDO::FETCH_OBJ);
            $pdoSt->execute();

            return $pdoSt->fetch();

        } catch (PDOException $e) {
            include_once('template/partials/errorDB.php');
            exit();
        }

    }

    public function update(int $id, classCliente $cliente)
    {
        try {
            $sql = "UPDATE clientes
                    SET
                        nombre = :nombre,
                        apellidos = :apellidos,
                        email = :email,
                        telefono = :telefono,
                        ciudad = :ciudad,
                        dni = :dni
                    WHERE
                        id = :id
                    LIMIT 1
                ";

            $conexion = $this->db->connect();
            $pdoSt = $conexion->prepare($sql);

            $pdoSt->bindParam(':id', $id, PDO::PARAM_INT);
            $pdoSt->bindParam(':nombre', $cliente->nombre, PDO::PARAM_STR, 30);
            $pdoSt->bindParam(':apellidos', $cliente->apellidos, PDO::PARAM_STR, 50);
            $pdoSt->bindParam(':email', $cliente->email, PDO::PARAM_STR, 50);
            $pdoSt->bindParam(':telefono', $cliente->telefono, PDO::PARAM_STR, 9);
            $pdoSt->bindParam(':ciudad', $cliente->ciudad, PDO::PARAM_STR, 30);
            $pdoSt->bindParam(':dni', $cliente->dni, PDO::PARAM_STR, 9);

            $pdoSt->execute();
        } catch (PDOException $e) {
            include_once('template/partials/errorDB.php');
            exit();
        }
    }


    public function order(int $criterio)
    {
        try {

            # comando sql
            $sql = "SELECT 
                        clientes.id,
                        clientes.nombre,
                        clientes.apellidos,
                        clientes.email,
                        clientes.telefono,
                        clientes.ciudad,
                        clientes.dni
                    FROM
                        clientes
                    ORDER BY 
                        :criterio
            ";

            $conexion = $this->db->connect();

            # ejecutamos mediante prepare
            $pdost = $conexion->prepare($sql);

            $pdost->bindParam(':criterio', $criterio, PDO::PARAM_INT);

            # establecemos  tipo fetch
            $pdost->setFetchMode(PDO::FETCH_OBJ);

            #  ejecutamos 
            $pdost->execute();

            # devuelvo objeto pdostatement
            return $pdost;

        } catch (PDOException $e) {

            include_once('template/partials/errorDB.php');
            exit();

        }
    }

    public function filter($expresion)
    {
        try {
            $sql = "SELECT 
                        clientes.id,
                        clientes.nombre,
                        clientes.apellidos,
                        clientes.email,
                        clientes.telefono,
                        clientes.ciudad,
                        clientes.dni
                    FROM
                        clientes
                    WHERE
                        CONCAT_WS(', ', 
                                    clientes.id,
                                    clientes.nombre,
                                    clientes.apellidos,
                                    clientes.email,
                                    clientes.telefono,
                                    clientes.ciudad,
                                    clientes.dni) 
                        LIKE :expresion
                    ORDER BY 
                        clientes.id
                    ";

            # Conectar con la base de datos
            $conexion = $this->db->connect();

            $pdost = $conexion->prepare($sql);

            $pdost->bindValue(':expresion', '%' . $expresion . '%', PDO::PARAM_STR);
            $pdost->setFetchMode(PDO::FETCH_OBJ);
            $pdost->execute();

            return $pdost;
        } catch (PDOException $e) {
            include_once('template/partials/errorDB.php');
            exit();
        }
    }


    public function delete($id)
    {
        try {
            $sql = "DELETE FROM clientes
                    WHERE id = :id";

            $conexion = $this->db->connect();

            $pdoSt = $conexion->prepare($sql);
            $pdoSt->bindParam(':id', $id, PDO::PARAM_INT);
            $pdoSt->execute();
        } catch (PDOException $e) {
            include_once('template/partials/errorDB.php');
            exit();
        }
    }


}

?>