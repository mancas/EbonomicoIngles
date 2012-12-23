<?php
include_once ('../_procedures/GestionDB.php');
require_once ('../_procedures/UserDataInfo.php');

include_once ('../_includes/bo-checkLogin.inc');

$gestionBD = new GestionDB();

$textosInicio = $gestionBD -> getTextosInicio();

$dataInfo = $_SESSION['UserInfo'];

if(!isset($dataInfo) || !$dataInfo instanceof UserDataInfo){
    $dataInfo = UserDataInfo::getInstance();
    $_SESSION['UserInfo'] = $dataInfo;
}

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Panel de Control</title>

        <?php
        include ($_SERVER["DOCUMENT_ROOT"] . "/aptana/ebonomicoingles/cpanel/_includes/bo-styles.inc");
        ?>

        <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">

    </head>
    <body>

        <?php
        include ($_SERVER["DOCUMENT_ROOT"] . "/aptana/ebonomicoingles/cpanel/_includes/bo-textos.inc");
        ?>

        <div class="content">

            <table class="table">
                <tr>
                    <th> Sección </th>
                    <th> Texto </th>
                    <th> Acciones </th>
                </tr>
                <?php if($textosInicio->rowCount() > 0) {
                ?>
                <?php foreach($textosInicio as $texto){
                ?>
                <tr>
	                <td>
	                <?php echo $texto['categoria']; ?>
	                </td>
	                <td>
	                <?php echo $texto['texto']; ?>
	                </td>
	                <td>
	                <a class="edit" title="Modificar" href="textos-edit.php?id=<?php echo $texto['id']; ?>" ><i class="icon-pencil"></i></a>
	                </td>
                </tr>
	            <?php } ?>
	            <?php } else { ?>
	                <tr>
	                <td colspan="5" class="alert-info">
	                <strong>Aviso:</strong> No se han encontrado los textos correspondientes a la página principal de English Be Prepared. Pongase en contacto con el administrador del sito web.
	                </td>
                </tr>
                <?php } ?>
            </table>

            <!-- ALERTS -->
            <div id="message-alert" class="<?php if($dataInfo->isHide()){ echo 'hide'; } ?> <?php echo $dataInfo->getClasses(); ?>">
                <span id="message"><strong><?php echo $dataInfo->getType(); ?>:</strong> <?php echo $dataInfo->getMessage(); ?></span>
                <i id="close-alert" class="icon-cross close" onclick="closeAlert();"></i>
            </div>

        </div>
        
    </body>
</html>
<?php
$dataInfo->resetInstance();
?>