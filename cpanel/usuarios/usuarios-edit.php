<?php

require_once ('../_procedures/UserDataInfo.php');

session_start();

$id = $_REQUEST['id'];

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
        include ($_SERVER["DOCUMENT_ROOT"] . "/aptana/ebonomicoingles/cpanel/_includes/bo-usuarios.inc");
        ?>

        <div class="content">
            <form method="post" action="../_procedures/update.php?id=<?php echo $id?>" onsubmit="return checkUpload(new Array('_password'));">
                <table class="table">
                    <tr>
                        <th colspan="3">Modifique su contraseña</th>
                    </tr>

                    <tr>
                        <td><label for="item_password">Nueva Contraseña:</label></td>
                        <td>
                        <input id="item_password" type="password" value="" name="_password" />
                        <input type="hidden" value="user" name="action" />
                        </td>
                        <td id="e_password" class="text-error"></td>
                    </tr>

                    <tr>
                        <td colspan="3">
                        <input class="btn" type="submit" value="Enviar" />
                        </td>
                    </tr>

                </table>
            </form>
            <div>
                <a title="Volver al listado" href="usuarios-view.php"><i class="icon-menu-list"></i>Volver al listado de Usuarios</a>
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