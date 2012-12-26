<?php
require_once ('../_procedures/UserDataInfo.php');
include_once ('../_procedures/GestionDB.php');

include_once ('../_includes/bo-checkLogin.inc');

$gestionBD = new GestionDB();

$users = $gestionBD -> getUsers();
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
        <script type="text/javascript">
            $item = 'user';
        </script>
        <?php
        include ($_SERVER["DOCUMENT_ROOT"] . "/bo_cpanel/_includes/bo-delete.inc");
        ?>

        <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">

    </head>
    <body>

        <?php
        include ($_SERVER["DOCUMENT_ROOT"] . "/bo_cpanel/_includes/bo-usuarios.inc");
        ?>

        <div class="content">
           
            <table class="table">
                <tr>
                    <th> Identificador </th>
                    <th> Usuario </th>
                    <th> Acciones </th>
                </tr>
                <?php if($users->rowCount() > 0) { ?>
                    <?php foreach ($users as $user) { ?>
                <tr>
                    <td>
                        <?php echo $user['id']; ?>
                    </td>
                    <td>
                        <?php echo $user['user']; ?>
                    </td>
                    <td>
                        <a class="edit" title="Modificar" href="usuarios-edit.php?id=<?php echo $user['id']; ?>" ><i class="icon-pencil"></i></a>
                        <a class="delete" title="Eliminar" href="<?php echo $user['id']; ?>" ><i class="icon-trash"></i></a>
                    </td>
                </tr>
                <?php } ?>
                    <?php } ?>
                
            </table>

            <div>
                <a title="Añadir Nuevo Usuario" href="usuarios-add.php"><i class="icon-menu"></i>Añadir Usuario</a>
            </div>
            <!-- ALERTS -->
            <div id="message-alert" class="<?php if($dataInfo->isHide()){ echo 'hide'; } ?> <?php echo $dataInfo->getClasses(); ?>">
                <span id="message"><strong><?php echo $dataInfo->getType(); ?>:</strong> <?php echo $dataInfo->getMessage(); ?></span>
                <i id="close-alert" class="icon-cross close" onclick="closeAlert();"></i>
            </div>

        </div>
		
		<?php
        include ($_SERVER["DOCUMENT_ROOT"] . "/bo_cpanel/_includes/bo-dialog.inc");
        ?>
        
    </body>
</html>
<?php
$dataInfo->resetInstance();
?>