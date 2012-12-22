<?php

session_start();

$data = $_SESSION['_contacta'];

$_SESSION['_warning'] = null;

if(isset($data)){
	$data['_mail'] = $_REQUEST['_mail'];
	$data['_message'] = $_REQUEST['_message'];
	$data['_name'] = $_REQUEST['_name'];
	
	$_SESSION['_contacta'] = $data;	
}else{
	header("Location:../index.php");
}

$warning = checkForm($data);

if(count($warning) > 0){
	$_SESSION['_warning'] = $warning;
	header("Location:../_web/contacta.php");
}else{
	header("Location:sendMail.php");
}

function checkForm($dataForm){
	
	if(empty($dataForm['_name'])){
		$warning['_name'] = "Introduzca su nombre, por favor"; 
	}
	
	if(empty($dataForm['_mail']) || !(preg_match("/^[\w+\.]+@([\w+]+\.)+[\w+]{2,4}$/", $dataForm['_mail']))){	
		$warning['_mail'] = "Introduzca una dirección de correo válida"; 	
	}
	
	if(empty($dataForm['_message'])){
		$warning['_message'] = "Escriba un mensaje";
	}
	
	return $warning;
	
}

?>