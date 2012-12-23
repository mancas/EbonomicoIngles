<?php
include_once ('../_procedures/GestionDB.php');
require_once ('../_procedures/UserDataInfo.php');

include_once ('../_includes/bo-checkLogin.inc');

$gestionBD = new GestionDB();

$banners = $gestionBD -> getListadoBanners();

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
        <script type="text/javascript">
            $item = 'banner';
        </script>
        <?php
        include ($_SERVER["DOCUMENT_ROOT"] . "/aptana/ebonomicoingles/cpanel/_includes/bo-delete.inc");
        ?>

        <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">

    </head>
    <body>

        <?php
        include ($_SERVER["DOCUMENT_ROOT"] . "/aptana/ebonomicoingles/cpanel/_includes/bo-banner.inc");
        ?>

        <div class="content">

            <table class="table">
                <tr>
                    <th> Nombre del Banner </th>
                    <th> Identificador </th>
                    <th> Activo </th>
                    <th> Posición </th>
                    <th> Acciones </th>
                </tr>
                <?php if($banners->rowCount() > 0) {
                ?>
                <?php foreach($banners as $banner){
                ?>
                <tr>
                <td>
                <?php echo $banner['name']; ?>
                </td>
                <td>
                <?php $id = $banner['id'];
                    echo $id;
                ?>
                </td>
                <td>
                <?php if($banner['active']){
                ?>
                <input type="checkbox" checked="checked" value="<?php echo $id; ?>" id="banner_<?php echo $id; ?>" onclick="toggleActiveBanner(<?php echo $id ?>);" />
                <?php }else{ ?>
                <input type="checkbox" value="<?php echo $id; ?>" id="banner_<?php echo $id; ?>" onclick="toggleActiveBanner(<?php echo $id ?>);" />
                <?php } ?>
                </td>
                <td>
                    <select id="_position_<?php echo $id; ?>" <?php if(!$banner['active']){ ?>disabled="disabled" <?php } ?> onchange="updatePosition(<?php echo $id; ?>)">
                        <option value="" <?php if($banner['posicion'] == 0){ ?> selected="selected" <?php } ?>>Seleccione la posición</option>
                        <option value="1" <?php if($banner['posicion'] == 1){ ?> selected="selected" <?php } ?> >Arriba Izquierda</option>
                        <option value="2" <?php if($banner['posicion'] == 2){ ?> selected="selected" <?php } ?> >Arriba Derecha</option>
                        <option value="3" <?php if($banner['posicion'] == 3){ ?> selected="selected" <?php } ?> >Abajo Izquierda</option>
                        <option value="4" <?php if($banner['posicion'] == 4){ ?> selected="selected" <?php } ?> >Abajo Derecha</option>
                    </select>
                </td>
                <td>
                <a class="delete" title="Eliminar" href="<?php echo $id; ?>" ><i class="icon-trash"></i></a>
                </td>
                </tr>
                <?php } ?>
                <?php } else { ?>
                <tr>
                <td colspan="5" class="alert-info">
                <strong>Aviso:</strong> No hay ningún banner en la Base de Datos. Puede agregarlos haciendo click en <i>"Añadir Banner"</i>, situado en la parte inferior de esta ventana.
                </td>
                </tr>
                <?php } ?>
            </table>

            <div>
                <a title="Añadir nuevo Banner" href="banner-add.php"><i class="icon-menu"></i>Añadir Banner</a>
            </div>

            <!-- ALERTS -->
            <div id="message-alert" class="<?php if($dataInfo->isHide()){ echo 'hide'; } ?> <?php echo $dataInfo->getClasses(); ?>">
                <span id="message"><strong><?php echo $dataInfo->getType(); ?>:</strong> <?php echo $dataInfo->getMessage(); ?></span>
                <i id="close-alert" class="icon-cross close" onclick="closeAlert();"></i>
            </div>

        </div>

        <?php
        include ($_SERVER["DOCUMENT_ROOT"] . "/aptana/ebonomicoingles/cpanel/_includes/bo-dialog.inc");
        ?>
        
    </body>
</html>
<?php
$dataInfo->resetInstance();
?>