<?php
include_once ('GestionDB.php');
include_once ('Util.php');
include_once ('UserDataInfo.php');

session_start();

$id = $_REQUEST['id'];
$action = $_REQUEST['action'];

$gestionDB = new GestionDB();

$method = 'update' . ucfirst($action);

if ($action == 'position') {

    $value = $_REQUEST['value'];
    $result = $gestionDB -> $method($id, $value);

    if ($result) {
        echo "<strong>Info:</strong> Se ha actualizado correctamente la posición del Banner con <b>Identificador</b> $id.";
    } else {
        echo "<strong>Aviso:</strong> Se ha producido un error durante la actualización de la posición del Banner con <b>Identificador</b> $id. Si el problema persiste pongase en contacto con el administrador del sitio web.";
    }

}

if ($action == 'user') {

    $password = $_REQUEST['_password'];
    $result = $gestionDB -> $method($id, $password);
    
    $dataInfo = UserDataInfo::getInstance();
    $dataInfo->setIsHide(false);

    if ($result) {
        $dataInfo->setMessage("Se ha actualizado correctamente la contraseña del Usuario con Identificador $id.");
        $dataInfo->setClasses(array('alert', 'alert-info', 'action-info', 'action'));
        $dataInfo->setType('Info');
        $_SESSION['UserInfo'] = $dataInfo;
        header("Location:../usuarios/usuarios-view.php");
    } else {
        $dataInfo->setMessage("Se ha producido un error durante la actualización de la contraseña del Usuario con Identificador $id. Este error puede deberse a que la contraseña actual sea igual a su nueva contraseña. Si el problema persiste pongase en contacto con el administrador del sitio web.");
        $dataInfo->setClasses(array('alert', 'alert-error', 'action-error', 'action'));
        $dataInfo->setType('Aviso');
        $_SESSION['UserInfo'] = $dataInfo;
        header("Location:../usuarios/usuarios-edit.php?id=$id");
    }
}

if ($action == 'textoInicio') {

	$texto = $_REQUEST['_texto'];
    $result = $gestionDB -> $method($id, $texto);
    
    $dataInfo = UserDataInfo::getInstance();
    $dataInfo->setIsHide(false);

    if ($result) {
        $dataInfo->setMessage("Se ha actualizado correctamente el texto.");
        $dataInfo->setClasses(array('alert', 'alert-info', 'action-info', 'action'));
        $dataInfo->setType('Info');
        $_SESSION['UserInfo'] = $dataInfo;
        header("Location:../textos/textos-view.php");
    } else {
        $dataInfo->setMessage("Se ha producido un error durante la actualización del texto. Si el problema persiste pongase en contacto con el administrador del sitio web.");
        $dataInfo->setClasses(array('alert', 'alert-error', 'action-error', 'action'));
        $dataInfo->setType('Aviso');
        $_SESSION['UserInfo'] = $dataInfo;
        header("Location:../textos/textos-edit.php?id=$id");
    }
}
?>