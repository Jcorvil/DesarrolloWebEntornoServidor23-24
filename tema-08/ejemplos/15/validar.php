<?php

/*
    Ejemplo de validación de archivos subidos desde un formulario
*/

// Iniciamos sesión
session_start();

// Saneo el formulario
$nombre = filter_var($_POST['nombre'] ??= null, FILTER_SANITIZE_SPECIAL_CHARS);
$observaciones = filter_var($_POST['observaciones'] ??= null, FILTER_SANITIZE_SPECIAL_CHARS);

// Cargo el fichero
$fichero = $_FILES['fichero'];

// Genero array de error de fichero
$FileUploadErrors = [
    0 => 'No hay error, el archivo se subió con exito',
    1 => 'El archivo excede la directiva "upload_max_filesize" en php.ini',
    2 => 'El archivo excede la directiva "MAX_FILE_SIZE" en el formulario HTML',
    3 => 'El archivo se subió parcialmente',
    4 => 'No hay archivo',
    6 => 'Falta una carpeta temporal',
    7 => 'Error al escribir el archivo',
    8 => 'PHP detuvo la subida del archivo con un error'
];

// Validación
$errores = [];

if (($fichero['error']) !== UPLOAD_ERR_OK) {

    // Comprobar que error se ha producido
    if (is_null($fichero)) {
        $errores['fichero'] = $FileUploadErrors[1];

    } else {
        $errores['fichero'] = $FileUploadErrors[$fichero['error']];
    }

} else if (is_uploaded_file($fichero['tmp_name'])) {
    // Validar máximo tamaño
    $max_tamano = 2 * 1024 * 1024;

    if ($fichero['size'] > $max_tamano) {
        $errores['fichero'] = "El archivo no puede superar los 2MB.";
    }

    // Validar tipo archivo
    $info = new SplFileInfo($fichero['name']);
    $tipos_permitidos = ['JPG', 'GIF', 'PNG'];

    if (!in_array(strtoupper($info->getExtension()), $tipos_permitidos)) {
        $errores['fichero'] = "El archivo debe ser JPG, GIF o PNG.";
    }
}

if (!empty($errores)) {
    // Creamos las variables de sesión
    $_SESSION['error'] = 'Formulario no validado';
    $_SESSION['errores'] = $errores;

    $_SESSION['nombre'] = $nombre;
    $_SESSION['observaciones'] = $observaciones;
    $_SESSION['fichero'] = $fichero;

    // Formulario no validado
    header('Location: index.php');

} else {
    // Mover fichero desde la carpeta temporal a la carpeta del servidor
    move_uploaded_file($fichero['tmp_name'], 'files/' . $fichero['name']);

    # Genero mensaje
    $_SESSION['mensaje'] = 'Archivo subido con éxito';

    # Regreso al formulario
    header('location: index.php');
}


?>