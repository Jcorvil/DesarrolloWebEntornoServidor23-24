<?php


class movimientosModel extends Model
{


    public function get()
    {

        try {

            # comando sql
            $sql = "SELECT 
                        movimientos.id,
                        cuentas.num_cuenta,
                        movimientos.fecha_hora,
                        movimientos.concepto,
                        movimientos.tipo,
                        movimientos.cantidad,
                        movimientos.saldo
                    FROM
                        movimientos
                    INNER JOIN
                        cuentas
                    ON
                        movimientos.id_cuenta = cuentas.id
                    ORDER BY 
                        movimientos.id";

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

    public function read($id)
    {
        try {
            $sql = "SELECT 
                        movimientos.id,
                        cuentas.num_cuenta, 
                        movimientos.fecha_hora,
                        movimientos.concepto,
                        movimientos.tipo,
                        movimientos.cantidad,
                        movimientos.saldo
                    FROM
                        movimientos
                    INNER JOIN
                        cuentas
                    ON
                        movimientos.id_cuenta = cuentas.id
                    WHERE
                        movimientos.id = :id
                    ORDER BY 
                        movimientos.id";

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


    public function filter($expresion)
    {
        try {
            $sql = "SELECT 
                        movimientos.id,
                        cuentas.num_cuenta,
                        movimientos.fecha_hora,
                        movimientos.concepto,
                        movimientos.tipo,
                        movimientos.cantidad,
                        movimientos.saldo
                    FROM
                        movimientos
                    INNER JOIN
                        cuentas
                    ON
                        movimientos.id_cuenta = cuentas.id
                    WHERE
                        CONCAT_WS(', ', 
                                movimientos.id,
                                cuentas.num_cuenta,
                                movimientos.fecha_hora,
                                movimientos.concepto,
                                movimientos.tipo,
                                movimientos.cantidad,
                                movimientos.saldo) 
                        LIKE :expresion
                    ORDER BY 
                        movimientos.id";

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


    public function order(int $criterio)
    {
        try {

            # comando sql
            $sql = "SELECT 
                        movimientos.id,
                        cuentas.num_cuenta,
                        movimientos.fecha_hora,
                        movimientos.concepto,
                        movimientos.tipo,
                        movimientos.cantidad,
                        movimientos.saldo
                    FROM
                        movimientos
                    INNER JOIN
                        cuentas
                    ON
                        movimientos.id_cuenta = cuentas.id
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


    public function create(classMovimiento $movimiento)
    {

        try {
            $sql = "INSERT INTO Movimientos (
                        id_cuenta,
                        fecha_hora,
                        concepto,
                        tipo,
                        cantidad,
                        saldo
                    )
                    VALUES (
                        :id_cuenta,
                        :fecha_hora,
                        :concepto,
                        :tipo,
                        :cantidad,
                        :saldo
                    )
                ";
            # Conectar con la base de datos
            $conexion = $this->db->connect();

            $pdoSt = $conexion->prepare($sql);

            $pdoSt->bindParam(':id_cuenta', $movimiento->id_cuenta, PDO::PARAM_INT);
            $pdoSt->bindParam(':fecha_hora', $movimiento->fecha_hora, PDO::PARAM_STR);
            $pdoSt->bindParam(':concepto', $movimiento->concepto, PDO::PARAM_STR, 50);
            $pdoSt->bindParam(':tipo', $movimiento->tipo, PDO::PARAM_STR);
            $pdoSt->bindParam(':cantidad', $movimiento->cantidad, PDO::PARAM_STR);
            $pdoSt->bindParam(':saldo', $movimiento->saldo, PDO::PARAM_STR);

            $pdoSt->execute();

        } catch (PDOException $e) {
            include_once('template/partials/errorDB.php');
            exit();
        }

    }


    public function getSaldoCuenta($id)
    {
        try {
            $sql = "SELECT
                        saldo
                    FROM
                        cuentas
                    WHERE 
                        id = :id";

            $conexion = $this->db->connect();
            $pdoSt = $conexion->prepare($sql);

            $pdoSt->bindParam(':id', $id, PDO::PARAM_INT);

            $pdoSt->execute();
            $saldo = $pdoSt->fetchColumn();
            return $saldo;

        } catch (PDOException $e) {
            include_once('template/partials/errorDB.php');
            exit();
        }
    }


    public function updateSaldoCuenta($id, $nuevo_saldo)
    {
        try {
            $sql = "UPDATE
                        cuentas
                    SET 
                        saldo = :nuevo_saldo
                    WHERE
                        id = :id";

            $conexion = $this->db->connect();
            $pdoSt = $conexion->prepare($sql);

            $pdoSt->bindParam(':id', $id, PDO::PARAM_INT);
            $pdoSt->bindParam(':nuevo_saldo', $nuevo_saldo, PDO::PARAM_STR);

            $pdoSt->execute();

        } catch (PDOException $e) {
            include_once('template/partials/errorDB.php');
            exit();
        }
    }


    public function getCuentas()
    {

        $sql = "SELECT
                    id, num_cuenta
                FROM 
                    cuentas";

        $conexion = $this->db->connect();
        $pdoSt = $conexion->prepare($sql);
        $pdoSt->execute();
        return $pdoSt->fetchAll(PDO::FETCH_OBJ);
    }


}

?>