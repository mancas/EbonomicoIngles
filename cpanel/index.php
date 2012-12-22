<?php
require_once ('_procedures/UserLogin.php');

session_start();

/**
$name = $_SESSION['login']['_name'];
$password = $_SESSION['login']['_password'];

if (!isset($name) && !isset($password)) {
    $name = "";
    $password = "";
    $_SESSION['login']['_name'] = $name;
    $_SESSION['login']['_password'] = $password;
}**/
$user = $_SESSION['login'];
$eLogin = $_SESSION['elogin'];

if ($user instanceof UserLogin) {
    $name = $user->getUser();
} else {
    $name = '';
    $user = UserLogin::getInstance();
    $eLogin = false;
    $_SESSION['elogin'] = $eLogin;
    $_SESSION['login'] = $user; 
}


?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Panel de Control</title>

        <link type="text/css" rel="stylesheet" href="_css/bo.css" />

        <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">

    </head>
    <body>
        
        <div class="login">
            
            <div class="<?php if (!$eLogin) { ?>hide<?php } ?> alert alert-error action-error">
                <strong>Aviso:</strong> El servidor no autorizó su ingreso
            </div>
            
            <form id="login_form" method="post" action="_procedures/checkLogin.php">
                <fieldset>
                    <legend>Iniciar sesión</legend>
                    <div class="item">
                        <label for="login_form_name">Usuario:</label>
                        <input type="text" name="_name" id="login_form_name" value="<?php echo $name; ?>" />
                    </div>
                    <div class="item">
                        <label for="login_form_password">Contraseña:</label>
                        <input type="password" name="_password" id="login_form_password" value="" />
                    </div>
                    <div class="item-footer">
                        <input class="btn" id="input_go" type="submit" value="Continuar" />
                    </div>
                </fieldset>
            </form>
        </div>
        
    </body>
</html>

