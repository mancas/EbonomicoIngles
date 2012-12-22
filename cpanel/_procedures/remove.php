<?php
include_once ('GestionDB.php');
include_once ('Util.php');

$gestionDB = new GestionDB();

$id = $_REQUEST['id'];
$item = $_REQUEST['item'];

$method = 'remove' . ucfirst($item);
if ($item == 'banner') {
    $result = $gestionDB -> $method($id);

    $file_path = '';
    foreach ($result['path'] as $path) {
        $file_path = $path['path'];
    }

    if ($result['OK'] && !empty($file_path)) {

        $util = new Util();
        $util -> setPath($_SERVER['DOCUMENT_ROOT'] . $file_path);
        $delete_file = $util -> deleteFile();

        if (!$delete_file) {
            echo "<strong>Aviso:</strong> No se encuentra el archivo asociado al Banner con <b>Identificador</b> $id. Pongase en contacto con el administrador del sitio web.";
        } else {
            echo "<strong>Info:</strong> Se ha eliminado correctamente el Banner con <b>Identificador</b> $id.";
        }
    } else {
        echo "<strong>Aviso:</strong> Se ha producido un error durante la eliminación del Banner con <b>Identificador</b> $id. Si el problema persiste pongase en contacto con el administrador del sitio web.";
    }
}

if ($item == 'user') {
    $result = $gestionDB -> $method($id);

    if ($result) {
        echo "<strong>Info:</strong> Se ha eliminado correctamente el Usuario con <b>Identificador</b> $id.";
    } else {
        echo "<strong>Aviso:</strong> Se ha producido un error durante la eliminación del Usuario con <b>Identificador</b> $id. Si el problema persiste pongase en contacto con el administrador del sitio web.";
    }

}
?>