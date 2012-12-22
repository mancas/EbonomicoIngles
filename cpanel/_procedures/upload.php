<?php
include_once ('GestionDB.php');
include_once ('Util.php');

session_start();

$name = $_REQUEST['_name'];
$link = $_REQUEST['_link'];
$file_errors = $_FILES['_file']['error'];

/**
 * CONTROL ERRORES
 */

$msg_name = "";
$msg_link = "";
$msg_file = "";
$clases = "";
$hide = true;
$error = "";

$util = new Util();

$fieldsCheck = $util -> checkUpload(array('_name' => $name, '_link' => $link));

if (!$fieldsCheck) {
    var_dump("hi");
    $msg_name = $GLOBALS['errors']['_name'];
    $msg_link = $GLOBALS['errors']['_link'];
}
var_dump($GLOBALS['errors']['_link']);

if (isset($file_errors) && $file_errors != 0) {
    echo "file_error    ";
    $clases = 'alert alert-error action-error action';
    $hide = false;

    switch ($file_errors) {
        case 1 :
            $error = "<strong>Error</strong> El archivo seleccionado excede los limites de subida establecidos.";
            break;
        case 2 :
            $error = "<strong>Error</strong> El archivo seleccionado excede los limites de subida establecidos.";
            break;
        case 3 :
            $error = "<strong>Error</strong> Fallo al cargar el fichero. Reintentelo de nuevo.";
            break;
        case 4 :
            $clases = "";
            $hide = true;
            $msg_file = "<strong>Error</strong> Este campo no puede ser vacio";
            break;
        case 6 :
            $error = "<strong>Error</strong> Fallo en la carpeta temporal. Consulte al administrador del sitio web.";
            break;
        case 7 :
            $error = "<strong>Error</strong> Fallo al escribir el archivo. Consulte al administrador del sitio web.";
            break;
    }
}

if (empty($error) && empty($msg_name) && empty($msg_file) && empty($msg_link)) {

    $nombre_archivo = $_FILES["_file"]["name"];
    $tipo_archivo = $_FILES["_file"]["type"];
    $tamano_archivo = $_FILES["_file"]["size"];
    $nombre_temp = $_FILES["_file"]["tmp_name"];
    $banner_name = $_REQUEST['_name'];

    $isGif = $util -> isGif($tipo_archivo);

    $size = $util -> checkSize($tamano_archivo, 10000);

    if (!$isGif || !$size) {
        $_SESSION['clases'] = 'alert alert-error action-error action';
        $_SESSION['isHide'] = false;
        $_SESSION['error'] = '<strong>Error:</strong> El archivo sobrepasa el peso soportado o bien no es un archivo <b>.gif</b>';
        header("Location:../cpanel-add-banner.php");
    } else {
        $path = $util->getPath();
        $completePath = $_SERVER['DOCUMENT_ROOT'] . $path . basename($nombre_archivo);
        $res = $util -> moveUploadFile($nombre_temp, $path);
    }
} else {
    $_SESSION['isHide'] = $hide;
    $_SESSION['error'] = $error;
    $_SESSION['msg']['_name'] = $msg_name;
    $_SESSION['msg']['_link'] = $msg_link;
    $_SESSION['msg']['_file'] = $msg_file;
    $_SESSION['clases'] = $clases;
    //header("Location:../cpanel-add-banner.php");
}
?>