<?php

include_once ('GestionDB.php');

$gestionBD = new GestionDB();

$id = $_REQUEST['id'];
$value = $_REQUEST['value'];

$result = $gestionBD->toggleActiveBanner($id, $value);

if($result){
    echo "<strong>Info:</strong> Se ha modificado correctamente el banner con Identificador $id. Recuerde que si hay más de cuatro banners "
     . "con una posición establecida, solo se mostrarán cuatro según el orden de las posiciones";
}else{
    echo "<strong>Aviso:</strong> Se ha producido un error durante la modificación del banner con Identificdor $id. Si el problema persiste pongase en contacto con el administrador del sitio web.";
}

?>