<?php
require_once 'UserLogin.php';

session_start();

$user = $_SESSION['login'];

if (!isset($user) || !($user instanceof UserLogin)) {
    $_SESSION['elogin'] = true;
    header('Location:../index.php');
} else {
    $name = $_REQUEST['_name'];
    $password = $_REQUEST['_password'];
    
    $user->setUser($name);
    $user->setPassword($password);
    
	$_SESSION['login'] = $user;
	
    $result = $user->getUserCredentials();
    
    if ($result->rowCount() == 1) {
        $_SESSION['elogin'] = null;
        header('Location:../banner/banner-view.php');
    } else {
        $_SESSION['elogin'] = true;
        header('Location:../index.php');
    }
}

?>