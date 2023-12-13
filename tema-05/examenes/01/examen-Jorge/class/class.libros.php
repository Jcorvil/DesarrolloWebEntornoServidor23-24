<?php

/*
    Clase libros 

    Aquí se definirán los métodos necesarios para completar el examen
    
*/

class Libros extends Conexion
{

    public function getLibros()
    {
        try {
            $sql = "SELECT
                    libros.id,
                    libros.titulo,
                    autores.nombre AS autor,
                    editoriales.nombre AS editorial,
                    libros.stock AS unidades,
                    libros.precio_coste AS coste,
                    libros.precio_venta AS pvp
                FROM libros
                INNER JOIN autores ON autores.id = libros.autor_id
                INNER JOIN editoriales ON editoriales.id = libros.editorial_id
                ORDER BY libros.id";


            $pdostmt = $this->pdo->prepare($sql);

            $pdostmt->setFetchMode(PDO::FETCH_OBJ);

            $pdostmt->execute();

            return $pdostmt;

        } catch (PDOException $e) {
            include('views/partials/partial.errorDB.php');
            exit();
        }
    }


    public function getAutores()
    {
        try {
            $sql = "SELECT
                        autores.id,
                        autores.nombre
                    FROM geslibros.autores
                    ORDER BY id";

            $pdostmt = $this->pdo->prepare($sql);
            $pdostmt->setFetchMode(PDO::FETCH_OBJ);
            $pdostmt->execute();
            return $pdostmt;

        } catch (PDOException $e) {
            include('views/partials/partial.errorDB.php');
            exit();
        }
    }


    public function getEditoriales()
    {
        try {

            $sql = "SELECT
                        editoriales.id,
                        editoriales.nombre
                    FROM geslibros.editoriales
                    ORDER BY id";

            $pdostmt = $this->pdo->prepare($sql);
            $pdostmt->setFetchMode(PDO::FETCH_OBJ);
            $pdostmt->execute();
            return $pdostmt;

        } catch (PDOException $e) {
            include('views/partials/partial.errorDB.php');
            exit();
        }
    }


    public function insertarLibro(Libro $libro)
    {
        try {

            $sql = "INSERT INTO libros
                            (titulo,
                            isbn,
                            fecha_edicion,
                            autor_id,
                            editorial_id,
                            stock,
                            precio_coste,
                            precio_venta)
                    VALUES
                            (:titulo,
                            :isbn,
                            :fecha_edicion,
                            :autores,
                            :editoriales,
                            :stock,
                            :precio_coste,
                            :precio_venta)";

            $pdostmt = $this->pdo->prepare($sql);

            $pdostmt->bindParam(':titulo', $libro->titulo, PDO::PARAM_STR);
            $pdostmt->bindParam(':isbn', $libro->isbn, PDO::PARAM_INT);
            $pdostmt->bindParam(':fecha_edicion', $libro->fecha_edicion, PDO::PARAM_STR);
            $pdostmt->bindParam(':autores', $libro->autor_id, PDO::PARAM_INT);
            $pdostmt->bindParam(':editoriales', $libro->editorial_id, PDO::PARAM_INT);
            $pdostmt->bindParam(':stock', $libro->stock, PDO::PARAM_INT);
            $pdostmt->bindParam(':precio_coste', $libro->precio_coste, PDO::PARAM_INT);
            $pdostmt->bindParam(':precio_venta', $libro->precio_venta, PDO::PARAM_INT);

            $pdostmt->setFetchMode(PDO::FETCH_OBJ);
            $pdostmt->execute();
            $pdostmt = null;
            $this->pdo = null;

        } catch (PDOException $e) {
            include('views/partials/partial.errorDB.php');
            exit();
        }
    }


    public function order(int $expresion)
    {
        try {

            $sql = "SELECT 
                        libros.id,
                        libros.titulo,
                        autores.nombre AS autor,
                        editoriales.nombre AS editorial,
                        libros.stock AS unidades,
                        libros.precio_coste AS coste,
                        libros.precio_venta AS pvp
                    FROM
                        geslibros.libros
                    INNER JOIN
                        geslibros.autores ON autores.id = libros.autor_id
                    INNER JOIN
                        geslibros.editoriales ON editoriales.id = libros.editorial_id
                    ORDER BY :orden";

            $pdostmt = $this->pdo->prepare($sql);
            
            $pdostmt->bindParam(':orden', $expresion, PDO::PARAM_INT);
            $pdostmt->execute();

            return $pdostmt->fetchAll(PDO::FETCH_OBJ);
           


        } catch (PDOException $e) {
            include('views/partials/partial.errorDB.php');
            exit();
        }
    }


}

?>