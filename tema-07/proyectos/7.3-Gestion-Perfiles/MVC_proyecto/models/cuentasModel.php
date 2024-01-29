<?php

/*
    cuentasModel.php

    Modelo del controlador cuentas

    Definir los métodos de acceso a la base de datos
    
    - insert
    - update
    - select
    - delete
    - etc..
*/

class cuentasModel extends Model
{

    /*
        Extrae los detalles  de los cuentas
    */
    public function get()
    {

        try {

            # comando sql
            $sql = "SELECT 
                        cuentas.id,
                        cuentas.num_cuenta,
                        concat_ws(', ', clientes.apellidos, clientes.nombre) as cliente,
                        cuentas.fecha_alta,
                        cuentas.fecha_ul_mov,
                        cuentas.num_movtos,
                        cuentas.saldo
                    FROM
                        cuentas
                    JOIN clientes ON cuentas.id_cliente = clientes.id
                    ORDER BY 
                        cuentas.id";


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


    public function create(classCuenta $cuenta)
    {

        try {
            $sql = "INSERT INTO cuentas (
                        num_cuenta,
                        id_cliente,
                        fecha_alta,
                        fecha_ul_mov,
                        num_movtos,
                        saldo
                    )
                    VALUES (
                        :num_cuenta,
                        :id_cliente,
                        :fecha_alta,
                        :fecha_ul_mov,
                        :num_movtos,
                        :saldo
                    )
                ";
            # Conectar con la base de datos
            $conexion = $this->db->connect();

            $pdoSt = $conexion->prepare($sql);

            $pdoSt->bindParam(':num_cuenta', $cuenta->num_cuenta, PDO::PARAM_INT);
            $pdoSt->bindParam(':id_cliente', $cuenta->id_cliente, PDO::PARAM_INT);
            $pdoSt->bindParam(':fecha_alta', $cuenta->fecha_alta, PDO::PARAM_STR);
            $pdoSt->bindParam(':fecha_ul_mov', $cuenta->fecha_ul_mov, PDO::PARAM_STR);
            $pdoSt->bindParam(':num_movtos', $cuenta->num_movtos, PDO::PARAM_INT);
            $pdoSt->bindParam(':saldo', $cuenta->saldo, PDO::PARAM_STR);

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
                        num_cuenta,
                        id_cliente,
                        fecha_alta,
                        fecha_ul_mov,
                        num_movtos,
                        saldo
                    FROM 
                        cuentas
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

    public function update(int $id, classCuenta $cuenta)
    {
        try {

            $sql = " UPDATE cuentas SET
                        num_cuenta = :num_cuenta,
                        id_cliente = :id_cliente,
                        fecha_alta = :fecha_alta,
                        fecha_ul_mov = :fecha_ul_mov,
                        num_movtos = :num_movtos,
                        saldo=:saldo,
                        update_at = now()
                    WHERE
                        id=:id";

            $conexion = $this->db->connect();
            $pdoSt = $conexion->prepare($sql);

            $pdoSt->bindParam(":num_cuenta", $cuenta->num_cuenta, PDO::PARAM_STR, 20);
            $pdoSt->bindParam(":id_cliente", $cuenta->id_cliente, PDO::PARAM_INT);
            $pdoSt->bindParam(":fecha_alta", $cuenta->fecha_alta, PDO::PARAM_STR);
            $pdoSt->bindParam(":fecha_ul_mov", $cuenta->fecha_ul_mov, PDO::PARAM_STR);
            $pdoSt->bindParam(":num_movtos", $cuenta->num_movtos, PDO::PARAM_INT);
            $pdoSt->bindParam(":saldo", $cuenta->saldo, PDO::PARAM_INT);
            $pdoSt->bindParam(":id", $id, PDO::PARAM_INT);

            $pdoSt->execute();
        } catch (PDOException $e) {
            require_once("template/partials/errorDB.php");
            exit();
        }
    }


    public function order(int $criterio)
    {
        try {

            # comando sql
            $sql = "SELECT 
                        cuentas.id,
                        cuentas.num_cuenta,
                        clientes.nombre,
                        clientes.apellidos,
                        cuentas.fecha_alta,
                        cuentas.fecha_ul_mov,
                        cuentas.num_movtos,
                        cuentas.saldo
                    FROM
                        cuentas
                    JOIN clientes ON cuentas.id_cliente = clientes.id
                    ORDER BY 
                        :criterio";

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
                        cuentas.id,
                        cuentas.num_cuenta,
                        cuentas.id_cliente,
                        cuentas.fecha_alta,
                        cuentas.fecha_ul_mov,
                        cuentas.num_movtos,
                        cuentas.saldo,
                        clientes.nombre,
                        clientes.apellidos
                    FROM
                        cuentas
                    INNER JOIN clientes 
                    ON cuentas.id_cliente = clientes.id
                    WHERE
                        CONCAT_WS(' ', 
                                    cuentas.id,
                                    cuentas.num_cuenta,
                                    clientes.nombre,
                                    clientes.apellidos,
                                    cuentas.fecha_alta,
                                    cuentas.fecha_ul_mov,
                                    cuentas.num_movtos,
                                    cuentas.saldo) 
                        LIKE :expresion
                    ORDER BY 
                        cuentas.id";


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
            $sql = "DELETE FROM cuentas
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


    public function getClienteCuenta()
    {
        try {
            $sql = "SELECT 
                        id,
                        CONCAT_WS(' ',
                        clientes.nombre,
                        clientes.apellidos) AS clienteCuenta
                    FROM
                        clientes
                    ORDER BY 
                        apellidos, nombre";

            $conexion = $this->db->connect();

            $result = $conexion->prepare($sql);

            $result->setFetchMode(PDO::FETCH_OBJ);

            $result->execute();

            return $result;

        } catch (PDOException $e) {
            include_once('template/partials/errorDB.php');
            exit();
        }
    }

    public function existeCuenta($num_cuenta)
    {
        try {
            $sql = "SELECT * FROM cuentas 
                     WHERE num_cuenta = :num_cuenta";


            //Conectar con la base de datos
            $conexion = $this->db->connect();

            $pdost = $conexion->prepare($sql);
            $pdost->bindParam(':num_cuenta', $num_cuenta, PDO::PARAM_INT);

            $pdost->execute();

            if ($pdost->rowCount() != 0) {
                return false;
            }

            return true;
        } catch (PDOException $e) {

            include_once('template/partials/errorDB.php');
            exit();
        }
    }

    public function validateFechaAlta($fecha_alta)
    {
        $formatoFecha = DateTime::createFromFormat('Y-m-d\TH:i', $fecha_alta);
        if ($formatoFecha !== false) {
            return true;
        } else {
            return false;
        }
    }

    public function getClienteById($id)
    {
        try {
            $sql = " SELECT     
                        id,
                        apellidos,
                        nombre,
                        telefono,
                        ciudad,
                        dni,
                        email
                    FROM  
                        clientes  
                    WHERE
                        id = :id";

            $conexion = $this->db->connect();
            $pdoSt = $conexion->prepare($sql);
            $pdoSt->bindParam(":id", $id, PDO::PARAM_INT);
            $pdoSt->setFetchMode(PDO::FETCH_OBJ);
            $pdoSt->execute();
            return $pdoSt->fetch();
        } catch (PDOException $e) {
            require_once("template/partials/errorDB.php");
            exit();
        }
    }


}

?>