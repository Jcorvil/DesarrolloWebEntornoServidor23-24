<?php

/*
    Ejemplo de validación de archivos subidos desde un formulario
*/

# iniciar sesión
session_start();

# saneamiento del formulario
$nombre = filter_var($_POST['nombre'] ??= null, FILTER_SANITIZE_SPECIAL_CHARS);
$observaciones = filter_var($_POST['observaciones'] ??= null, FILTER_SANITIZE_SPECIAL_CHARS);

# cargo el fichero
$fichero = $_FILES['fichero'];

# genero array de error de fichero
$FileUploadErrors = array(
    0 => 'No hay error, fichero subido con éxito.',
    1 => 'El fichero subido excede la directiva upload_max_filesize de php.ini.',
    2 => 'El fichero subido excede la directiva MAX_FILE_SIZE especificada en el formulario HTML.',
    3 => 'El fichero fue sólo parcialmente subido.',
    4 => 'No se subió ningún fichero.',
    6 => 'Falta la carpeta temporal.',
    7 => 'No se pudo escribir el fichero en el disco.',
    8 => 'Una extensión de PHP detuvo la subida de ficheros.',
);

# validación del fichero

echo $fichero['error'];

$errores = [];

if (($fichero['error']) !== UPLOAD_ERR_OK) {

    # comprobar que error se ha producido
    if (is_null($fichero)) {
        $errores['fichero'] = $FileUploadErrors[1];
    } else {
        $errores['fichero'] = $FileUploadErrors[$fichero['error']];
    }

    echo $errores['fichero'];

} else if (is_uploaded_file($fichero['tmp_name'])) {

    # Validar máximmo tamaño
    $max_tamano = 2 * 1024 * 1024;

    if ($fichero['size'] > $max_tamano) {
        $errores['fichero'] = "Tamaño de archivo no permitido. Máximo 2MB";
    }

    echo $errores['fichero'];

    # Validar tipo archivo
    $info = new SplFileInfo($fichero['name']);
    $tipos_permitidos = ['JPG', 'GIF', 'PNG'];

    if (!in_array(strtoupper($info->getExtension()), $tipos_permitidos)) {
        $errores['fichero'] = "Tipo de archivo no permitido. Sólo JPG, PNG y GIF";
    }
}

if (!empty($errores)) {

    # Creamos las variables de sessión
    $_SESSION['error'] = 'Formulario no validado';
    $_SESSION['errores'] = $errores;

    $_SESSION['nombre'] = $nombre;
    $_SESSION['observaciones'] = $observaciones;
    $_SESSION['fichero'] = $fichero;

    # Fomrulario no validado
    header('location: index.php');

} else {
    # Mover fichero desde carpeta temporal a carpeta del servidor
    move_uploaded_file($fichero['tmp_name'], 'files/' . $fichero['name']);

    # genero mensaje
    $_SESSION['mensaje'] = 'Archivo subido con éxito';

    # regreso al formulario
    header('location: index.php');
}







