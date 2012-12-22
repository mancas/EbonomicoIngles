<?php

include_once ('Util.php');
include_once ('UserDataInfo.php');

session_start();

$item = $_REQUEST['item'];

$method = 'create' . ucfirst($item);

if ($item == 'user') {
    
    include_once ('GestionLogin.php');
    
    $gestionDB = new GestionLogin();
    $dataInfo = UserDataInfo::getInstance();
    $dataInfo->setIsHide(false);

    $name = $_REQUEST['_name'];
    $password = $_REQUEST['_password'];
    
    $result = $gestionDB->$method($name, $password);
    
    if ($result) {
        $dataInfo->setMessage("Se ha creado correctamente el Usuario con nombre $name");
        $dataInfo->setClasses(array('alert', 'alert-info', 'action-info', 'action'));
        $dataInfo->setType('Info');
    } else {
        $dataInfo->setMessage("Se ha producido un error durante la creación del Usuario con nombre $name. Si el problema persiste pongase en contacto con el administrador del sitio web.");
        $dataInfo->setClasses(array('alert', 'alert-error', 'action-error', 'action'));
        $dataInfo->setType('Aviso');
    }
    
    $_SESSION['UserInfo'] = $dataInfo;
    header('Location:../usuarios/usuarios-view.php');
}

?>