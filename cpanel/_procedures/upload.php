<?php
include_once ('GestionDB.php');
include_once ('Util.php');
include_once ('UserDataInfo.php');

session_start();

$name = $_REQUEST['_name'];
$link = $_REQUEST['_link'];
$file_errors = $_FILES['_file']['error'];
$tipo_archivo = $_FILES["_file"]["type"];
$tamano_archivo = $_FILES["_file"]["size"];
$nombre_temp = $_FILES["_file"]["tmp_name"];
$banner_name = $_REQUEST['_name'];

$data = array('_name' => $name);

/**
 * CONTROL ERRORES
 */

$util = new Util();

$util -> checkUpload($data);

$fieldsCheck = $util -> getErrors();

$dataInfo = null;

if (isset($file_errors) && $file_errors != 0) {
    $dataInfo = UserDataInfo::getInstance();
    $dataInfo -> setIsHide(false);

    $dataInfo -> setClasses(array('alert', 'alert-error', 'action-error', 'action'));
    $dataInfo -> setType('Error');

    switch ($file_errors) {
        case 1 :
            $dataInfo -> setMessage("El archivo seleccionado excede los limites de subida establecidos.");
            break;
        case 2 :
            $dataInfo -> setMessage("El archivo seleccionado excede los limites de subida establecidos.");
            break;
        case 3 :
            $dataInfo -> setMessage("Fallo al cargar el fichero. Reintentelo de nuevo.");
            break;
        case 4 :
            $dataInfo -> setMessage("Por favor, seleccione un archivo para cargarlo en el servidor.");
            break;
        case 6 :
            $dataInfo -> setMessage("Fallo en la carpeta temporal. Consulte al administrador del sitio web.");
            break;
        case 7 :
            $dataInfo -> setMessage("Fallo al escribir el archivo. Consulte al administrador del sitio web.");
            break;
    }

} else {

    $isGif = $util -> isGif($tipo_archivo);
    $size = $util -> checkSize($tamano_archivo);

    if (!$isGif || !$size) {
        $dataInfo = UserDataInfo::getInstance();
        $dataInfo -> setIsHide(false);

        $dataInfo -> setClasses(array('alert', 'alert-error', 'action-error', 'action'));
        $dataInfo -> setType('Error');
        $dataInfo -> setMessage("El archivo seleccionado no es un gif o supera los límites de peso establecidos.");
    }
}

if (!($dataInfo instanceof UserDataInfo) && empty($fieldsCheck)) {

    $nombre_archivo = $_FILES["_file"]["name"];

    $path = $util -> getPath();
    $file_path = $path . basename($nombre_archivo);
    $completePath = $_SERVER['DOCUMENT_ROOT'] . $file_path;
	$util -> setPath($completePath);
    $res = $util -> moveUploadFile($nombre_temp);

    if ($res) {

        $dataInfo = UserDataInfo::getInstance();
        $dataInfo -> setIsHide(false);

        $url = $util -> sanitizeUrl($link);
        $gestionDB = new GestionDB();

		$date = date('Y-m-d H:i:s');

        $values = array('name' => $name, 'path' => $file_path, 'link' => $url, 'date' => $date);

        $operation = $gestionDB -> createBanner($values);

        if ($operation) {
            $dataInfo -> setClasses(array('alert', 'alert-info', 'action-info', 'action'));
            $dataInfo -> setType('Info');
            $dataInfo -> setMessage("Se ha creado correctamete el nuevo banner. Puede activarlo en esta misma página. No olvide que en el caso de activar más de cuatro banners, tendrán preferencia los más antiguos.");

            $_SESSION['UserInfo'] = $dataInfo;
			$_SESSION['dataUpload'] = null;
            header("Location:../banner/banner-view.php");
        } else {
        	$util->deleteFile();
            $dataInfo -> setClasses(array('alert', 'alert-error', 'action-error', 'action'));
            $dataInfo -> setType('Error');
            $dataInfo -> setMessage("Ocurrió un error al añadir el nuevo banner. Intentelo de nuevo. Si el problema persiste contacte con el administrador del sitio web.");

            $_SESSION['UserInfo'] = $dataInfo;
            $_SESSION['dataUpload'] = $data;
            header("Location:../banner/banner-add.php");
        }

    } else {
        $dataInfo = UserDataInfo::getInstance();
        $dataInfo -> setIsHide(false);

        $dataInfo -> setClasses(array('alert', 'alert-error', 'action-error', 'action'));
        $dataInfo -> setType('Oops');
        $dataInfo -> setMessage("Ocurrió un error mientras se subía el archivo. Intentelo de nuevo. Si el problema persiste contacte con el administrador del sitio web.");

        $_SESSION['UserInfo'] = $dataInfo;
        $_SESSION['dataUpload'] = $data;
        header("Location:../banner/banner-add.php");
    }

} else {
    $_SESSION['fieldsError'] = $fieldsCheck;
    $_SESSION['UserInfo'] = $dataInfo;
    $_SESSION['dataUpload'] = $data;
    header("Location:../banner/banner-add.php");
}
?>