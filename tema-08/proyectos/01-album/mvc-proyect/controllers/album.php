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

                # Autorrellenar formulario con los detalles del  album
                $this->view->album = unserialize($_SESSION['album']);

                # Recupero array errores  específicos
                $this->view->errores = $_SESSION['errores'];

                # Elimino las variables de sesión
                unset($_SESSION['error']);
                unset($_SESSION['album']);
                unset($_SESSION['errores']);
            }

            # etiqueta title de la vista
            $this->view->title = "Añadir - Gestión albumes";

            #  obtener los cursos  para generar dinámicamente lista cursos
            $this->view->cursos = $this->model->getCursos();

            # cargo la vista con el formulario nuevo album
            $this->view->render('album/new/index');
        }
    }

    function create($param = [])
    {

        # Iniciar sesión
        session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";

            header("location:" . URL . "login");

        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['album']['new']))) {
            $_SESSION['mensaje'] = "Operación sin privilegios";
            header('location:' . URL . 'album');
        } else {

            # 1. Seguridad. Saneamos los  datos del formulario
            $nombre = filter_var($_POST['nombre'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $apellidos = filter_var($_POST['apellidos'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $email = filter_var($_POST['email'] ??= '', FILTER_SANITIZE_EMAIL);
            $telefono = filter_var($_POST['telefono'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $poblacion = filter_var($_POST['poblacion'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $dni = filter_var($_POST['dni'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $fechaNac = filter_var($_POST['fechaNac'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $id_curso = filter_var($_POST['id_curso'] ??= '', FILTER_SANITIZE_NUMBER_INT);

            # 2. Creamos album con los datos saneados
            $album = new classalbum(
                null,
                $nombre,
                $apellidos,
                $email,
                $telefono,
                null,
                $poblacion,
                null,
                null,
                $dni,
                $fechaNac,
                $id_curso
            );

            # 3. Validación
            $errores = [];

            // Nombre: obligatorio
            if (empty($nombre)) {
                $errores['nombre'] = 'El campo nombre es  obligatorio';
            }

            // Apellidos: obligatorio
            if (empty($apellidos)) {
                $errores['apellidos'] = 'El campo apellidos es  obligatorio';
            }

            // FechaNac: obligatorio y valor fecha válido
            // $valores = explode('/', $fechaNac);
            // if (empty($fechaNac)) {
            //     $errores['fechaNac'] = 'Campo obligatorio';
            // } else if (!checkdate($valores[1], $valores[0], $valores[2])) {
            //     $errores['fechaNac'] = 'Fecha no válida';
            // }

            // Email: obligatorio, formáto válido y clave secundaria
            if (empty($email)) {
                $errores['email'] = 'El campo email es  obligatorio';
            } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errores['email'] = 'Formato email incorrecto';
            } else if (!$this->model->validateUniqueEmail($email)) {
                $errores['email'] = 'Email existente';
            }

            // Dni: obligatorio, formáto válido y clave secundaria
            // Expresión regular
            $options = [
                'options' => [
                    'regexp' => '/^(\d{8})([A-Za-z])$/'
                ]
            ];

            if (empty($dni)) {
                $errores['dni'] = 'El campo dni es  obligatorio';
            } else if (!filter_var($dni, FILTER_VALIDATE_REGEXP, $options)) {
                $errores['dni'] = 'Formato DNI incorrecto';
            } else if (!$this->model->validateUniqueDNI($dni)) {
                $errores['dni'] = 'DNI existente';
            }

            // id_curso: obligatorio, entero, existente
            if (empty($id_curso)) {
                $errores['id_curso'] = 'Debe seleccionar un curso';
            } else if (!filter_var($id_curso, FILTER_VALIDATE_INT)) {
                $errores['id_curso'] = 'Curso no válido';
            } else if (!$this->model->validateCurso($id_curso)) {
                $errores['id_curso'] = 'Curso no existente';
            }

            # 4. Comprobar  validación

            if (!empty($errores)) {
                # errores de validación
                // variables sesión no admiten objetos
                $_SESSION['album'] = serialize($album);
                $_SESSION['error'] = 'Formulario no ha sido validado';
                $_SESSION['errores'] = $errores;

                # redireccionamos a new
                header('location:' . URL . 'album/new');


            } else {

                # Añadir registro a la tabla
                $this->model->create($album);

                # Mensaje
                $_SESSION['mensaje'] = "album creado correctamente";

                # Redirigimos al main de albumes
                header('location:' . URL . 'album');

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

            # obtener los cursos
            $this->view->cursos = $this->model->getCursos();

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

    public function update($param = [])
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

            # 1. Saneamos datos del formulario FILTER_SANITIZE
            $nombre = filter_var($_POST['nombre'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $apellidos = filter_var($_POST['apellidos'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $email = filter_var($_POST['email'] ??= '', FILTER_SANITIZE_EMAIL);
            $telefono = filter_var($_POST['telefono'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $poblacion = filter_var($_POST['poblacion'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $dni = filter_var($_POST['dni'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $fechaNac = filter_var($_POST['fechaNac'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $id_curso = filter_var($_POST['id_curso'] ??= '', FILTER_SANITIZE_NUMBER_INT);

            # 2. Creamos el objeto album a partir de  los datos saneados del  formuario
            $album = new classalbum(
                null,
                $nombre,
                $apellidos,
                $email,
                $telefono,
                null,
                $poblacion,
                null,
                null,
                $dni,
                $fechaNac,
                $id_curso
            );

            # Cargo id del album que voya a actualizar
            $id = $param[0];

            # Obtengo el  objeto album original
            $album_orig = $this->model->read($id);

            # 3. Validación
            // Sólo si es necesario
            // Sólo en caso de modificación del campo

            $errores = [];

            //Validar nombre
            if (strcmp($nombre, $album_orig->nombre) !== 0) {
                if (empty($nombre)) {
                    $errores['nombre'] = 'El campo nombre es  obligatorio';
                }
            }

            //Validar apellidos
            if (strcmp($apellidos, $album_orig->apellidos) !== 0) {
                if (empty($apellidos)) {
                    $errores['apellidos'] = 'El campo nombre es  obligatorio';
                }
            }

            // Email: obligatorio, formáto válido y clave secundaria
            if (strcmp($email, $album_orig->email) !== 0) {
                if (empty($email)) {
                    $errores['email'] = 'El campo email es  obligatorio';
                } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $errores['email'] = 'Formato email incorrecto';
                } else if (!$this->model->validateUniqueEmail($email)) {
                    $errores['email'] = 'Email existente';
                }
            }

            // Dni: obligatorio, formáto válido y clave secundaria
            // Expresión regular
            if (strcmp($dni, $album_orig->dni) !== 0) {
                $options = [
                    'options' => [
                        'regexp' => '/^(\d{8})([A-Za-z])$/'
                    ]
                ];

                if (empty($dni)) {
                    $errores['dni'] = 'El campo dni es  obligatorio';
                } else if (!filter_var($dni, FILTER_VALIDATE_REGEXP, $options)) {
                    $errores['dni'] = 'Formato DNI incorrecto';
                } else if (!$this->model->validateUniqueDNI($dni)) {
                    $errores['dni'] = 'DNI existente';
                }
            }

            // id_curso: obligatorio, entero, existente
            if (strcmp($id_curso, $album_orig->id_curso) !== 0) {
                if (empty($id_curso)) {
                    $errores['id_curso'] = 'Debe seleccionar un curso';
                } else if (!filter_var($id_curso, FILTER_VALIDATE_INT)) {
                    $errores['id_curso'] = 'Curso no válido';
                } else if (!$this->model->validateCurso($id_curso)) {
                    $errores['id_curso'] = 'Curso no existente';
                }
            }

            # 4. Comprobar  validación

            if (!empty($errores)) {
                # errores de validación
                // variables sesión no admiten objetos
                $_SESSION['album'] = serialize($album);
                $_SESSION['error'] = 'Formulario no ha sido validado';
                $_SESSION['errores'] = $errores;

                # redireccionamos a new
                header('location:' . URL . 'album/edit/' . $id);


            } else {

                # Actualizo registro
                $this->model->update($album, $id);

                # Mensaje
                $_SESSION['mensaje'] = "album actualizado correctamente";

                # Redirigimos al main de albumes
                header('location:' . URL . 'album');

            }

        }
    }

    public function order($param = [])
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

    public function filter($param = [])
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

    public function delete($param = [])
    {

        # inicar sesión
        session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";

            header("location:" . URL . "login");

        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['album']['delete']))) {
            $_SESSION['mensaje'] = "Operación sin privilegios";
            header('location:' . URL . 'album');
        } else {

            # obtenemos id del  album
            $id = $param[0];

            # eliminar album
            $this->model->delete($id);

            # generar mensaje
            $_SESSION['mensaje'] = 'album eliminado correctamente';

            # redirecciono al main de albumes
            header('location:' . URL . 'album');
        }
    }
}

