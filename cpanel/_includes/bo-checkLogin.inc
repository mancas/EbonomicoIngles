<?php
require_once ($_SERVER["DOCUMENT_ROOT"] . "/aptana/ebonomicoingles/cpanel/_procedures/UserLogin.php");

session_start();

$user = $_SESSION['login'];

if (!isset($user) || !($user instanceof UserLogin)) {
    header('Location:../../index.php');
} else {
	$result = $user->getUserCredentials();
    
    if ($result->rowCount() != 1) {
        $_SESSION['elogin'] = true;
        header('Location:../index.php');
    }
}
?>
	