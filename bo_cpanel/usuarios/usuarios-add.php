<?php
require_once ('../_procedures/UserDataInfo.php');

include_once ('../_includes/bo-checkLogin.inc');

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
        include ($_SERVER["DOCUMENT_ROOT"] . "/bo_cpanel/_includes/bo-styles.inc");
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
        include ($_SERVER["DOCUMENT_ROOT"] . "/bo_cpanel/_includes/bo-usuarios.inc");
        ?>

        <div class="content">
            <form method="post" action="../_procedures/create.php" onsubmit="return checkUpload(new Array('_name', '_password'));">
                <table class="table">
                    <tr>
                        <th colspan="3"> Rellene los campos para añadir un nuevo usuario con permisos de Administrador</th>
                    </tr>

                    <tr>
                        <td><label for="item_name">Nombre del usuario:</label></td>
                        <td>
                        <input id="item_name" type="text" value="" name="_name" maxlength="50" />
                        <a class="info" href="#"><i class="icon-info-sign"></i> <span class="hide note text-warning alert"><strong>Aviso: </strong> La longitud máxima del nombre para el usuario es de 50 caracteres</span> </a></td>
                        <td id="e_name" class="text-error"></td>
                    </tr>
                    
                    <tr>
                        <td><label for="item_password">Contraseña:</label></td>
                        <td>
                        <input id="item_password" type="password" value="" name="_password" />
                        <input type="hidden" value="user" name="item" />
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
