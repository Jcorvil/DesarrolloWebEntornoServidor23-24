<?php

class Album extends Controller
{

    function __construct()
    {

        parent::__construct();


    }

    function render()
    {

        # inicio o continuo sesión
        session_start();

        # compruebo usuario autentificado
        if (!isset($_SESSION['id'])) {
            $_SESSION['notify'] = "Usuario sin autentificar";
            header("location:" . URL . "login");
        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['album']['main']))) {
            $_SESSION['mensaje'] = "Ha intentado realizar operación sin privilegios";
            header('location:' . URL . 'index');
        } else {

            if (isset($_SESSION['mensaje'])) {
                $this->view->mensaje = $_SESSION['mensaje'];
                unset($_SESSION['mensaje']);
            }


            # Creo la propiedad title de la vista
            $this->view->title = "Home - Panel Control albumes";

            # Creo la propiedad albumes dentro de la vista
            # Del modelo asignado al controlador ejecuto el método get();
            $this->view->albumes = $this->model->get();

            $this->view->render('album/main/index');
        }

    }

    function new()
    {

        # iniciar o continuar  sesión
        session_start();

        # compruebo usuario autentificado
        if (!isset($_SESSION['id'])) {
            $_SESSION['notify'] = "Usuario debe autentificarse";

            header("location:" . URL . "login");

        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['album']['new']))) {
            $_SESSION['mensaje'] = "Operación sin privilegios";
            header('location:' . URL . 'album');
        } else {

            # Crear un objeto album vacio
            $this->view->album = new classalbum();

            # Comprobar si vuelvo de  un registro no validado
            if (isset($_SESSION['error'])) {
                # Mensaje de error
                $this->view->error = $_SESSION['error'];

                # Autorrellenar formulario con los detalles del album
                if (isset($_SESSION['album'])) {
                    $this->view->album = unserialize($_SESSION['album']);
                } else {
                    $this->view->album = new classalbum();
                }

                # Recupero array errores específicos
                $this->view->errores = $_SESSION['errores'];

                # Elimino las variables de sesión
                unset($_SESSION['error']);
                unset($_SESSION['album']);
                unset($_SESSION['errores']);
            } else {
                $this->view->album = new classalbum();
            }
            # etiqueta title de la vista
            $this->view->title = "Añadir - Gestión albumes";

            # cargo la vista con el formulario nuevo album
            $this->view->render('album/new/index');
        }
    }

    function create($param = [])
    {
        session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";
            header("location:" . URL . "login");
        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['album']['new']))) {
            $_SESSION['mensaje'] = "Operación sin privilegios";
            header('location:' . URL . 'album');
        } else {
            $titulo = filter_var($_POST['titulo'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $descripcion = filter_var($_POST['descripcion'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $autor = filter_var($_POST['autor'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $fecha = filter_var($_POST['fecha'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $lugar = filter_var($_POST['lugar'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $categoria = filter_var($_POST['categoria'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $etiquetas = filter_var($_POST['etiquetas'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $carpeta = filter_var($_POST['carpeta'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);

            $album = new classalbum(
                null,
                $titulo,
                $descripcion,
                $autor,
                $fecha,
                $lugar,
                $categoria,
                $etiquetas,
                $carpeta
            );

            $errores = [];

            if (empty($titulo)) {
                $errores['titulo'] = 'El campo titulo es obligatorio';
            } elseif (strlen($titulo) > 100) {
                $errores['titulo'] = 'El titulo no puede tener más de 100 caracteres';
            }

            if (empty($descripcion)) {
                $errores['descripcion'] = 'El campo descripcion es obligatorio';
            }

            if (empty($autor)) {
                $errores['autor'] = 'El campo autor es obligatorio';
            }

            if (empty($fecha)) {
                $errores['fecha'] = 'El campo fecha es obligatorio';
            }

            if (empty($lugar)) {
                $errores['lugar'] = 'El campo lugar es obligatorio';
            }

            if (empty($categoria)) {
                $errores['categoria'] = 'El campo categoria es obligatorio';
            }

            if (empty($carpeta)) {
                $errores['carpeta'] = 'El campo carpeta es obligatorio';
            } else if (preg_match('/\s/', $carpeta)) {
                $errores['carpeta'] = 'El campo carpeta no puede contener espacios';
            }

            if (!empty($errores)) {
                $_SESSION['album'] = serialize($album);
                $_SESSION['error'] = 'Formulario no ha sido validado';
                $_SESSION['errores'] = $errores;
                header('location:' . URL . 'album/new');
            } else {
                $rutaCarpeta = 'images/' . $carpeta;
                if (!file_exists($rutaCarpeta)) {
                    if (mkdir($rutaCarpeta, 0777, true)) {
                        $album->carpeta = $carpeta;
                        $this->model->create($album);
                        $_SESSION['mensaje'] = "Álbum creado correctamente";
                        header('location:' . URL . 'album');
                    } else {
                        $_SESSION['error'] = "Error al crear la carpeta para el álbum";
                        header('location:' . URL . 'album/new');
                    }
                } else {
                    $_SESSION['error'] = "La carpeta para el álbum ya existe";
                    header('location:' . URL . 'album/new');
                }
            }
        }
    }

    function edit($param = [])
    {

        # iniciamos sesión
        session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";

            header("location:" . URL . "login");

        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['album']['edit']))) {
            $_SESSION['mensaje'] = "Operación sin privilegios";
            header('location:' . URL . 'album');
        } else {

            # obtengo el id del album que voy a editar
            // album/edit/4

            $id = $param[0];

            # asigno id a una propiedad de la vista
            $this->view->id = $id;

            # title
            $this->view->title = "Editar - Panel de control albumes";

            # obtener objeto de la clase album
            $this->view->album = $this->model->read($id);

            # Comprobar si el formulario viene de una no validación
            if (isset($_SESSION['error'])) {

                # Mensaje de error
                $this->view->error = $_SESSION['error'];

                # Autorrellenar formulario con los detalles del  album
                $this->view->album = unserialize($_SESSION['album']);

                # Recupero array errores  específicos
                $this->view->errores = $_SESSION['errores'];

                # Elimino las variables de sesión
                unset($_SESSION['error']);
                unset($_SESSION['album']);
                unset($_SESSION['errores']);
            }

            # cargo la vista
            $this->view->render('album/edit/index');

        }
    }

    function update($param = [])
    {
        # iniciar sesión
        session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";
            header("location:" . URL . "login");
        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['album']['edit']))) {
            $_SESSION['mensaje'] = "Operación sin privilegios";
            header('location:' . URL . 'album');
        } else {
            # obtenemos el id del álbum a actualizar
            $id = $param[0];

            # obtenemos el álbum original desde la base de datos
            $album_orig = $this->model->read($id);

            # saneamos los datos del formulario
            $titulo = filter_var($_POST['titulo'] ?? $album_orig->titulo, FILTER_SANITIZE_SPECIAL_CHARS);
            $descripcion = filter_var($_POST['descripcion'] ?? $album_orig->descripcion, FILTER_SANITIZE_SPECIAL_CHARS);
            $autor = filter_var($_POST['autor'] ?? $album_orig->autor, FILTER_SANITIZE_SPECIAL_CHARS);
            $fecha = filter_var($_POST['fecha'] ?? $album_orig->fecha, FILTER_SANITIZE_SPECIAL_CHARS);
            $lugar = filter_var($_POST['lugar'] ?? $album_orig->lugar, FILTER_SANITIZE_SPECIAL_CHARS);
            $categoria = filter_var($_POST['categoria'] ?? $album_orig->categoria, FILTER_SANITIZE_SPECIAL_CHARS);
            $etiquetas = filter_var($_POST['etiquetas'] ?? $album_orig->etiquetas, FILTER_SANITIZE_SPECIAL_CHARS);
            $carpeta = filter_var($_POST['carpeta'] ?? $album_orig->carpeta, FILTER_SANITIZE_SPECIAL_CHARS);

            # creamos un nuevo objeto album con los datos actualizados
            $album = new classalbum(
                null,
                $titulo,
                $descripcion,
                $autor,
                $fecha,
                $lugar,
                $categoria,
                $etiquetas,
                null,
                null,
                $carpeta
            );

            # validamos los campos que han cambiado
            $errores = [];

            // Validación de los campos, igual que antes...

            if (empty($titulo)) {
                $errores['titulo'] = 'El campo titulo es obligatorio';
            } elseif (strlen($titulo) > 100) {
                $errores['titulo'] = 'El titulo no puede tener más de 100 caracteres';
            }

            if (empty($descripcion)) {
                $errores['descripcion'] = 'El campo descripcion es obligatorio';
            }

            if (empty($autor)) {
                $errores['autor'] = 'El campo autor es obligatorio';
            }

            if (empty($fecha)) {
                $errores['fecha'] = 'El campo fecha es obligatorio';
            }

            if (empty($lugar)) {
                $errores['lugar'] = 'El campo lugar es obligatorio';
            }

            if (empty($categoria)) {
                $errores['categoria'] = 'El campo categoria es obligatorio';
            }

            if (empty($carpeta)) {
                $errores['carpeta'] = 'El campo carpeta es obligatorio';
            } else if (preg_match('/\s/', $carpeta)) {
                $errores['carpeta'] = 'El campo carpeta no puede contener espacios';
            }

            # comprobamos la validación
            if (!empty($errores)) {
                # errores de validación
                $_SESSION['error'] = 'Formulario no ha sido validado';
                $_SESSION['errores'] = $errores;
                $_SESSION['album'] = serialize($album);

                # redireccionamos a edit con el id del álbum
                header('location:' . URL . 'album/edit/' . $id);
            } else {
                # renombrar la carpeta en el sistema de archivos
                $rutaCarpetaOriginal = 'images/' . $album_orig->carpeta;
                $rutaCarpetaNueva = 'images/' . $carpeta;
                if (rename($rutaCarpetaOriginal, $rutaCarpetaNueva)) {
                    # actualizamos el álbum en la base de datos con el nuevo nombre de la carpeta
                    $carpetaOrig = $album_orig->carpeta;

                    # Actualizo registro
                    $this->model->update($album, $id, $carpetaOrig);

                    # mensaje de éxito
                    $_SESSION['mensaje'] = "Álbum actualizado correctamente";

                    # redirigimos al main de álbumes
                    header('location:' . URL . 'album');
                } else {
                    # Error al renombrar la carpeta
                    $errores['carpeta'] = "El nombre de la carpeta ya existe";
                    $_SESSION['error'] = "Formulario no ha sido validado";
                    $_SESSION['errores'] = $errores;
                    $_SESSION['album'] = serialize($album);
                    header('location:' . URL . 'album/edit/' . $id);
                }

            }
        }
    }

    function show($param = [])
    {

        session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";
            header("location:" . URL . "login");
        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['album']['show']))) {
            $_SESSION['mensaje'] = "Operación sin privilegios";
            header('location:' . URL . 'album');
        } else {
            // Obtengo la id del album que quiero mostrar
            $id = $param[0];

            // Obtengo los datos del album mediante el modelo
            $album = $this->model->read($id);

            // Configuro las propiedades de la vista
            $this->view->title = "Detalles del Album";
            $this->view->album = $album;

            // Cargo la vista de detalles del album
            $this->view->render('album/show/index');
        }
    }

    function order($param = [])
    {

        # inicio o continúo sesión
        session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";

            header("location:" . URL . "login");

        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['album']['order']))) {
            $_SESSION['mensaje'] = "Operación sin privilegios";
            header('location:' . URL . 'album');
        } else {

            # Obtengo criterio de ordenación
            $criterio = $param[0];

            # Creo la propiedad title de la vista
            $this->view->title = "Ordenar - Panel Control albumes";

            # Creo la propiedad albumes dentro de la vista
            # Del modelo asignado al controlador ejecuto el método get();
            $this->view->albumes = $this->model->order($criterio);

            # Cargo la vista principal de album
            $this->view->render('album/main/index');
        }
    }

    function filter($param = [])
    {

        # inicio o continúo sesión
        session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";
            header("location:" . URL . "login");
        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['album']['filter']))) {
            $_SESSION['mensaje'] = "Operación sin privilegios";
            header('location:' . URL . 'album');
        } else {

            # Obtengo expresión de búsqueda
            $expresion = $_GET['expresion'];

            # Creo la propiedad title de la vista
            $this->view->title = "Buscar - Panel Control albumes";

            # Filtro a partir de la  expresión
            $this->view->albumes = $this->model->filter($expresion);

            # Cargo la vista principal de album
            $this->view->render('album/main/index');
        }
    }

    function delete($param = [])
    {
        session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";
            header("location:" . URL . "login");
        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['album']['delete']))) {
            $_SESSION['mensaje'] = "Operación sin privilegios";
            header('location:' . URL . 'album');
        } else {

            $id = $param[0];

            $album = $this->model->read($id);
            $carpeta = $album->carpeta;

            $rutaCarpeta = 'images/' . $carpeta;

            // Si encuentra un archivo dentro de la carpeta, llama a 
            // la función recursiva "eliminarDirectorio".
            if (file_exists($rutaCarpeta)) {
                $this->eliminarDirectorio($rutaCarpeta);
            }

            $this->model->delete($id);
            $_SESSION['mensaje'] = 'Álbum eliminado correctamente';
            header('location:' . URL . 'album');
        }
    }

    // Funcion para eliminar un directorio, eliminando antes los archivos que contenga.
    function eliminarDirectorio($directorio)
    {
        $ficheros = array_diff(scandir($directorio), array('.', '..'));
        // Es una función recursiva.
        // Recorre el directorio y si encuentra un archivo, lo elimina y se vuelve a llamar a si misma.
        // Se llama tantas veces como archivos contenga la carpeta. Una vez la carpeta está vacía va al
        //  "return", que elimina la carpeta definitivamente. 
        foreach ($ficheros as $fichero) {
            (is_dir("$directorio/$fichero")) ? $this->eliminarDirectorio("$directorio/$fichero") : unlink("$directorio/$fichero");
        }
        return rmdir($directorio);
    }


    function add($param = [])
    {
        // Usamod el método del repositorio "02-subida"
        session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";
            header("location:" . URL . "login");
        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['album']['add']))) {
            $_SESSION['mensaje'] = "Operación sin privilegios";
            header('location:' . URL . 'album');
        } else {
            // Obtengo objeto de la clase álbum
            $album = $this->model->read($param[0]);

            $this->model->upload($_FILES['archivos'], $album->carpeta);

            // $numFotos = count(glob("images/" . $album->carpeta . "/*"));

            // $this->model->contadorFotos($album->id, $numFotos);

            header("Location:" . URL . "album");

        }
        
    }



}

