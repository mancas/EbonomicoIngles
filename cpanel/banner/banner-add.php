<?php
require_once ('../_procedures/UserDataInfo.php');

session_start();

$dataInfo = $_SESSION['UserInfo'];

if(!isset($dataInfo) || !$dataInfo instanceof UserDataInfo){
    $dataInfo = UserDataInfo::getInstance();
    $_SESSION['UserInfo'] = $dataInfo;
}
$nameError = $_SESSION['msg']['_name'];
$linkError = $_SESSION['msg']['_link'];
$fileError = $_SESSION['msg']['_file'];

if (!isset($classes) && !isset($isHide) && !isset($message) && !isset($nameError) && !isset($fileError) && !isset($linkError)) {
    $nameError = "";
    $fileError = "";
    $linkError = "";
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Panel de Control-Añadir nuevo Banner</title>

        <?php
        include ($_SERVER["DOCUMENT_ROOT"] . "/aptana/ebonomicoingles/cpanel/_includes/bo-styles.inc");
        ?>

        <script type="text/javascript" src="../_js/forms.js"></script>

        <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
            
        <script type="text/javascript">
            $(document).ready(function(){
                alertInfo();
            });
        </script>

    </head>
    <body>

        <?php
        include ($_SERVER["DOCUMENT_ROOT"] . "/aptana/ebonomicoingles/cpanel/_includes/bo-banner.inc");
        ?>

        <div class="content">
            <form method="post" enctype="multipart/form-data" action="../_procedures/upload.php" onsubmit="return checkUpload(new Array('_name', '_file', '_link'));">
                <table class="table">
                    <tr>
                        <th colspan="3"> Rellene los campos para añadir un nuevo banner </th>
                    </tr>

                    <tr>
                        <td><label for="item_name">Nombre del banner:</label></td>
                        <td>
                        <input id="item_name" type="text" value="" name="_name" maxlength="160" />
                        <a class="info" href="#"><i class="icon-info-sign"></i> <span class="hide note text-warning alert"><strong>Aviso: </strong> La longitud máxima del nombre para el banner es de 160 caracteres</span> </a></td>
                        <td id="e_name" class="text-error"><?php echo $nameError; ?></td>
                    </tr>
                    
                    <tr>
                        <td><label for="item_link">Link:</label></td>
                        <td>
                        <input id="item_link" type="text" value="" name="_link" />
                        </td>
                        <td id="e_link" class="text-error"><?php echo $linkError; ?></td>
                    </tr>

                    <tr>
                        <td><label for="banner_file">Archivo:</label></td>
                        <td>
                        <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
                        <input id="item_file" type="file" name="_file" />
                        <a class="info" href="#"><i class="icon-info-sign"></i> <span class="hide note text-warning alert"><strong>Aviso: </strong> El tamaño del archivo no debe ser superior a 1MB y la extensión debe ser <b>.gif</b></span> </a></td>
                        <td id="e_file" class="text-error"><?php echo $fileError; ?></td>
                    </tr>
                    <tr>
                        <td colspan="3">
                        <input class="btn" type="submit" value="Enviar" />
                        </td>
                    </tr>

                </table>
            </form>
            <div>
                <a title="Volver al listado" href="banner-view.php"><i class="icon-menu-list"></i>Volver al listado de Banners</a>
            </div>
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