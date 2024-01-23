<?php

class Alumno extends Controller
{

    function __construct()
    {

        parent::__construct();


    }

    function render()
    {
        # Iniciamos o continuamos la sesión
        session_start();

        # Compruebo si el usuario está autentificado
        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";
            header('location:' . URL . 'login');
        } else if (!in_array($_SESSION['id_rol'], $GLOBALS['alumno']['main'])) {
            $_SESSION['mensaje'] = 'Operación sin privilegios';
            header('location: ' . URL . 'index');
        } else {

            # Si existe un mensaje, lo mostramos
            if (isset($_SESSION['mensaje'])) {
                $this->view->mensaje = $_SESSION['mensaje'];
                unset($_SESSION['mensaje']);
            }

            # Creo la propiedad title de la vista
            $this->view->title = "Home - Panel Control Alumnos";

            # Creo la propiedad alumnos dentro de la vista
            # Del modelo asignado al controlador ejecuto el método get();
            $this->view->alumnos = $this->model->get();

            $this->view->render('alumno/main/index');
        }
    }

    function new()
    {
        # Iniciamos o continuamos la sesión
        session_start();

        # Compruebo si el usuario está autentificado
        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";
            header('location:' . URL . 'login');
        } else if (!in_array($_SESSION['id_rol'], $GLOBALS['alumno']['new'])) {
            $_SESSION['mensaje'] = 'Operación sin privilegios';
            header('location: ' . URL . 'alumno');
        } else {

            # Creamos un objeto vacio
            $this->view->alumno = new classAlumno();

            # Comprobamos si existen errores
            if (isset($_SESSION['error'])) {
                // Añadimos el mensaje de error
                $this->view->error = $_SESSION['error'];

                // Autorellenamos el formulario
                $this->view->alumno = unserialize($_SESSION['alumno']);

                // Recuperamos array con los errores
                $this->view->errores = $_SESSION['errores'];

                // Una vez usadas las variables de sesión, las liberamos
                unset($_SESSION['error']);
                unset($_SESSION['errores']);
                unset($_SESSION['alumno']);
            }

            # etiqueta title de la vista
            $this->view->title = "Añadir - Gestión Alumnos";

            #  obtener los cursos  para generar dinámicamente lista cursos
            $this->view->cursos = $this->model->getCursos();

            # cargo la vista con el formulario nuevo alumno
            $this->view->render('alumno/new/index');
        }
    }

    function create($param = [])
    {
        // Iniciamos sesión
        session_start();

        # Compruebo si el usuario está autentificado
        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";
            header('location:' . URL . 'login');
        } else if (!in_array($_SESSION['id_rol'], $GLOBALS['alumno']['new'])) {
            $_SESSION['mensaje'] = 'Operación sin privilegios';
            header('location: ' . URL . 'alumno');
        } else {

            # 1. Seguridad. Saneamos los datos del formulario
            // el uso del método filter_var nos permite la filtración de caracteres especiales, para evitar posibles injecciones de código
            // Si usamos la expresion abreviada ??='', indicamos que si existe, filtra el contenido de la variable, si no le asigna una cadena vacía
            $nombre = filter_var($_POST['nombre'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $apellidos = filter_var($_POST['apellidos'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $email = filter_var($_POST['email'] ??= '', FILTER_SANITIZE_EMAIL);
            $telefono = filter_var($_POST['telefono'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $poblacion = filter_var($_POST['poblacion'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $dni = filter_var($_POST['dni'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $fechaNac = filter_var($_POST['fechaNac'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $id_curso = filter_var($_POST['id_curso'] ??= '', FILTER_SANITIZE_NUMBER_INT);

            # 2. Creamos el alumno con los datos saneados
            $alumno = new classAlumno(
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

            // Nombre: Obligatorio
            if (empty($nombre)) {
                $errores['nombre'] = 'El campo nombre es obligatorio';
            }

            // Apellidos: Obligatorio
            if (empty($apellidos)) {
                $errores['apellidos'] = 'El campo apellidos es obligatorio';
            }

            // // Fecha de nacimiento: Obligatorio
            // $fecha = explode('/',$fechaNac);
            // if(empty($fechaNac)){
            //     $errores['fechaNac'] = 'El campo fecha de nacimiento es obligatorio';
            // } else if(checkdate($fecha)){
            //     $errores['fechaNac'] = 'formato no valido';

            // }

            // Email: obligatorio, formato válido y clave secundario
            if (empty($email)) {
                $errores['email'] = 'El campo es obligatorio';
            } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { // VALIDAMOS EL EMAIL -> retorna booleano
                $errores['email'] = 'El formato del email no es válido';
            } else if (!$this->model->validateUniqueEmail($email)) {
                $errores['email'] = 'El email ya ha sido registrado';
            }

            // DNI: obligatorio, formato válido y único
            $options = [
                'options' => [ // ESTOS PARÁMETROS DEBEN LLAMARSE ASÍ
                    'regexp' => '/^(\d{8})([a-zA-Z])$/'
                ]
            ];

            if (empty($dni)) {
                $errores['dni'] = 'El campo es obligatorio';
            } else if (!filter_var($dni, FILTER_VALIDATE_REGEXP, $options)) { // VALIDAMOS EL EMAIL -> retorna booleano
                $errores['dni'] = 'El formato del dni no es válido';
            } else if (!$this->model->validateUniqueDni($dni)) {
                $errores['dni'] = 'El dni ya ha sido registrado';
            }

            // id_curso: campo obligatorio, valor entero y debe existir
            if (empty($id_curso)) {
                $errores['id_curso'] = 'El campo curso es obligatorio';
            } else if (!filter_var($id_curso, FILTER_VALIDATE_INT)) {
                $errores['id_curso'] = 'Curso no valido';
            } else if (!$this->model->validateCurso($id_curso)) {
                $errores['dni'] = 'El curso no existe';
            }

            # 4. Comprobar validación
            if (!empty($errores)) {
                // Errores de validación
                $_SESSION['alumno'] = serialize($alumno);
                $_SESSION['error'] = 'Formulario no validado';
                $_SESSION['errores'] = $errores;

                // Redireccionamos
                header('location:' . URL . 'alumno/new');

            } else {
                # Añadir registro a la tabla
                $this->model->create($alumno);

                // Mensaje
                $_SESSION['mensaje'] = "Alumno creaado correctamente";

                # Redirigimos al main de alumnos
                header('location:' . URL . 'alumno');
            }
        }
    }

    function edit($param = [])
    {
        # Iniciamos o continuamos sesión
        session_start();

        # Compruebo si el usuario está autentificado
        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";
            header('location:' . URL . 'login');
        } else if (!in_array($_SESSION['id_rol'], $GLOBALS['alumno']['edit'])) {
            $_SESSION['mensaje'] = 'Operación sin privilegios';
            header('location: ' . URL . 'alumno');
        } else {

            # obtengo el id del alumno que voy a editar
            // alumno/edit/4

            $id = $param[0];

            # asigno id a una propiedad de la vista
            $this->view->id = $id;

            # title
            $this->view->title = "Editar - Panel de control Alumnos";

            # obtener objeto de la clase alumno
            $this->view->alumno = $this->model->read($id);

            # obtener los cursos
            $this->view->cursos = $this->model->getCursos();

            # Comprobamos si el formulario viene de una no validación
            # Comprobamos si existen errores
            if (isset($_SESSION['error'])) {
                // Añadimos el mensaje de error
                $this->view->error = $_SESSION['error'];

                // Autorellenamos el formulario
                $this->view->alumno = unserialize($_SESSION['alumno']);

                // Recuperamos array con los errores
                $this->view->errores = $_SESSION['errores'];

                // Una vez usadas las variables de sesión, las liberamos
                unset($_SESSION['error']);
                unset($_SESSION['errores']);
                unset($_SESSION['alumno']);
            }
            # cargo la vista
            $this->view->render('alumno/edit/index');
        }
    }

    public function update($param = [])
    {
        # Iniciamos o continuamos sesión
        session_start();

        # Compruebo si el usuario está autentificado
        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";
            header('location:' . URL . 'login');
        } else if (!in_array($_SESSION['id_rol'], $GLOBALS['alumno']['edit'])) {
            $_SESSION['mensaje'] = 'Operación sin privilegios';
            header('location: ' . URL . 'alumno');
        } else {

            # 1. Saneamos datos del formulario
            $nombre = filter_var($_POST['nombre'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $apellidos = filter_var($_POST['apellidos'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $email = filter_var($_POST['email'] ??= '', FILTER_SANITIZE_EMAIL);
            $telefono = filter_var($_POST['telefono'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $poblacion = filter_var($_POST['poblacion'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $dni = filter_var($_POST['dni'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $fechaNac = filter_var($_POST['fechaNac'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $id_curso = filter_var($_POST['id_curso'] ??= '', FILTER_SANITIZE_NUMBER_INT);

            # 2. Creamos el objeto alumno a partir de los datos saneados del formulario
            $alumno = new classAlumno(
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

            # Cargo id del alumno que quiero actualizar
            $id = $param[0];

            # Obtengo el objeto alumno original
            $alumno_original = $this->model->read($id);

            # 3. Validación
            // Sólo si es necesario y en casa de modificación del campo
            $errores = [];

            // Validar nombre
            if (strcmp($nombre, $alumno_original->nombre) !== 0) {
                if (empty($nombre)) {
                    $errores['nombre'] = 'El campo nombre es obligatorio';
                }
            }

            // Validar apellidos
            if (strcmp($apellidos, $alumno_original->apellidos) !== 0) {
                if (empty($apellidos)) {
                    $errores['apellidos'] = 'El campo apellidos es obligatorio';
                }
            }

            // Validar email
            if (strcmp($email, $alumno_original->email) !== 0) {
                // Email: obligatorio, formato válido y clave secundario
                if (empty($email)) {
                    $errores['email'] = 'El campo es obligatorio';
                } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { // VALIDAMOS EL EMAIL -> retorna booleano
                    $errores['email'] = 'El formato del email no es válido';
                } else if (!$this->model->validateUniqueEmail($email)) {
                    $errores['email'] = 'El email ya ha sido registrado';
                }
            }

            // Validar DNI
            if (strcmp($dni, $alumno_original->dni) !== 0) {
                // DNI: obligatorio, formato válido y único
                $options = [
                    'options' => [ // ESTOS PARÁMETROS DEBEN LLAMARSE ASÍ
                        'regexp' => '/^(\d{8})([a-zA-Z])$/'
                    ]
                ];

                if (empty($dni)) {
                    $errores['dni'] = 'El campo es obligatorio';
                } else if (!filter_var($dni, FILTER_VALIDATE_REGEXP, $options)) { // VALIDAMOS EL EMAIL -> retorna booleano
                    $errores['dni'] = 'El formato del dni no es válido';
                } else if (!$this->model->validateUniqueDni($dni)) {
                    $errores['dni'] = 'El dni ya ha sido registrado';
                }
            }

            // Validar curso
            if (strcmp($id_curso, $alumno_original->id_curso) !== 0) {
                // id_curso: campo obligatorio, valor entero y debe existir
                if (empty($id_curso)) {
                    $errores['id_curso'] = 'El campo curso es obligatorio';
                } else if (!filter_var($id_curso, FILTER_VALIDATE_INT)) {
                    $errores['id_curso'] = 'Curso no valido';
                } else if (!$this->model->validateCurso($id_curso)) {
                    $errores['dni'] = 'El curso no existe';
                }
            }


            # 4. Comprobar validación
            if (!empty($errores)) {
                // Errores de validación
                $_SESSION['alumno'] = serialize($alumno);
                $_SESSION['error'] = 'Formulario no validado';
                $_SESSION['errores'] = $errores;

                // Redireccionamos
                header('location:' . URL . 'alumno/edit/' . $id);

            } else {
                # Actualizamos el registro
                $this->model->update($alumno, $id);

                // Mensaje
                $_SESSION['mensaje'] = "Alumno actualizado correctamente";

                # Redirigimos al main de alumnos
                header('location:' . URL . 'alumno');
            }
        }
    }

    public function order($param = [])
    {
        # Iniciamos o continuamos sesión
        session_start();

        # Compruebo si el usuario está autentificado
        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";
            header('location:' . URL . 'login');
        } else if (!in_array($_SESSION['id_rol'], $GLOBALS['alumno']['order'])) {
            $_SESSION['mensaje'] = 'Operación sin privilegios';
            header('location: ' . URL . 'alumno');
        } else {

            # Obtengo criterio de ordenación
            $criterio = $param[0];

            # Creo la propiedad title de la vista
            $this->view->title = "Ordenar - Panel Control Alumnos";

            # Creo la propiedad alumnos dentro de la vista
            # Del modelo asignado al controlador ejecuto el método get();
            $this->view->alumnos = $this->model->order($criterio);

            # Cargo la vista principal de alumno
            $this->view->render('alumno/main/index');
        }
    }

    public function filter($param = [])
    {
        # Iniciamos o continuamos sesión
        session_start();
        # Compruebo si el usuario está autentificado
        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";
            header('location:' . URL . 'login');
        } else if (!in_array($_SESSION['id_rol'], $GLOBALS['alumno']['filter'])) {
            $_SESSION['mensaje'] = 'Operación sin privilegios';
            header('location: ' . URL . 'alumno');
        } else {

            # Obtengo expresión de búsqueda
            $expresion = $_GET['expresion'];

            # Creo la propiedad title de la vista
            $this->view->title = "Buscar - Panel Control Alumnos";

            # Filtro a partir de la  expresión
            $this->view->alumnos = $this->model->filter($expresion);

            # Cargo la vista principal de alumno
            $this->view->render('alumno/main/index');
        }
    }

    public function delete($param = [])
    {

        # Iniciamos o continuamos sesión
        session_start();

        # Compruebo si el usuario está autentificado
        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";
            header('location:' . URL . 'login');
        } else if (!in_array($_SESSION['id_rol'], $GLOBALS['alumno']['delete'])) {
            $_SESSION['mensaje'] = 'Operación sin privilegios';
            header('location: ' . URL . 'alumno');
        } else {

            # Obtenemos el id del aluumno
            $id = $param[0];

            # Eliminar alumno
            $this->model->delete($id);

            # Genero mensaje
            $_SESSION['mensaje'] = 'Alumno eliminado correctamente';

            # Redireccionamos a la vista principal
            header('location:' . URL . 'alumno');
        }
    }
}

?>